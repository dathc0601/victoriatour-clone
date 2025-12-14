<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.administration');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.user.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.user.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.user.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->description('Basic user account details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Password')
                    ->description('Leave empty to keep current password')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(Password::default())
                            ->maxLength(255)
                            ->confirmed()
                            ->revealable(),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->maxLength(255)
                            ->dehydrated(false)
                            ->revealable(),
                    ])->columns(2),

                Forms\Components\Section::make('Roles & Permissions')
                    ->description('Assign roles to control user access')
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'content_manager' => 'success',
                        'blog_editor' => 'info',
                        'inquiry_manager' => 'warning',
                        'settings_admin' => 'gray',
                        default => 'primary',
                    })
                    ->separator(', '),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (User $record) {
                        // Prevent deleting the last super admin
                        if ($record->hasRole('super_admin')) {
                            $superAdminCount = User::role('super_admin')->count();
                            if ($superAdminCount <= 1) {
                                throw new \Exception('Cannot delete the last Super Admin.');
                            }
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->hasRole('super_admin')) {
                                    $superAdminCount = User::role('super_admin')->count();
                                    $selectedSuperAdmins = $records->filter(fn ($r) => $r->hasRole('super_admin'))->count();
                                    if ($superAdminCount <= $selectedSuperAdmins) {
                                        throw new \Exception('Cannot delete all Super Admins. At least one must remain.');
                                    }
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
