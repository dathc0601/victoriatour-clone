<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles if they don't exist
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $contentManager = Role::firstOrCreate(['name' => 'content_manager', 'guard_name' => 'web']);
        $blogEditor = Role::firstOrCreate(['name' => 'blog_editor', 'guard_name' => 'web']);
        $inquiryManager = Role::firstOrCreate(['name' => 'inquiry_manager', 'guard_name' => 'web']);
        $settingsAdmin = Role::firstOrCreate(['name' => 'settings_admin', 'guard_name' => 'web']);

        // Content Manager Permissions
        $contentManagerPermissions = [
            // Destinations
            'view_destination', 'view_any_destination', 'create_destination', 'update_destination', 'delete_destination', 'delete_any_destination',
            // Cities
            'view_city', 'view_any_city', 'create_city', 'update_city', 'delete_city', 'delete_any_city',
            // Tour Categories
            'view_tour::category', 'view_any_tour::category', 'create_tour::category', 'update_tour::category', 'delete_tour::category', 'delete_any_tour::category',
            // Tours
            'view_tour', 'view_any_tour', 'create_tour', 'update_tour', 'delete_tour', 'delete_any_tour',
            // Hotels
            'view_hotel', 'view_any_hotel', 'create_hotel', 'update_hotel', 'delete_hotel', 'delete_any_hotel',
            // MICE Content
            'view_mice::content', 'view_any_mice::content', 'create_mice::content', 'update_mice::content', 'delete_mice::content', 'delete_any_mice::content',
            // Pages
            'view_page', 'view_any_page', 'create_page', 'update_page', 'delete_page', 'delete_any_page',
            // Sliders
            'view_slider', 'view_any_slider', 'create_slider', 'update_slider', 'delete_slider', 'delete_any_slider',
            // Differentiators
            'view_differentiator', 'view_any_differentiator', 'create_differentiator', 'update_differentiator', 'delete_differentiator', 'delete_any_differentiator',
            // Page permissions
            'page_AboutPageSettings',
            // Widget permissions
            'widget_StatsOverviewWidget', 'widget_QuickActionsWidget', 'widget_LatestToursWidget',
        ];

        // Blog Editor Permissions
        $blogEditorPermissions = [
            // Blog Categories
            'view_blog::category', 'view_any_blog::category', 'create_blog::category', 'update_blog::category', 'delete_blog::category', 'delete_any_blog::category',
            // Blog Posts
            'view_blog::post', 'view_any_blog::post', 'create_blog::post', 'update_blog::post', 'delete_blog::post', 'delete_any_blog::post',
            // Widget permissions
            'widget_StatsOverviewWidget', 'widget_QuickActionsWidget', 'widget_LatestBlogPostsWidget',
        ];

        // Inquiry Manager Permissions
        $inquiryManagerPermissions = [
            // Inquiries (no create - inquiries come from frontend)
            'view_inquiry', 'view_any_inquiry', 'update_inquiry', 'delete_inquiry', 'delete_any_inquiry',
            // Widget permissions
            'widget_StatsOverviewWidget', 'widget_LatestInquiriesWidget',
        ];

        // Settings Admin Permissions
        $settingsAdminPermissions = [
            // Languages
            'view_language', 'view_any_language', 'create_language', 'update_language', 'delete_language', 'delete_any_language',
            // Menu Items
            'view_menu::item', 'view_any_menu::item', 'create_menu::item', 'update_menu::item', 'delete_menu::item', 'delete_any_menu::item',
            // Page permissions
            'page_Settings', 'page_FooterSettings',
            // Widget permissions
            'widget_StatsOverviewWidget',
        ];

        // Sync permissions to roles (super_admin gets all via Gate::before)
        $contentManager->syncPermissions($this->filterExistingPermissions($contentManagerPermissions));
        $blogEditor->syncPermissions($this->filterExistingPermissions($blogEditorPermissions));
        $inquiryManager->syncPermissions($this->filterExistingPermissions($inquiryManagerPermissions));
        $settingsAdmin->syncPermissions($this->filterExistingPermissions($settingsAdminPermissions));

        // Assign super_admin role to the existing admin user
        $admin = User::where('email', 'admin@victoriatour.com')->first();
        if ($admin && !$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }

        $this->command->info('Roles and permissions have been seeded successfully!');
    }

    /**
     * Filter to only include permissions that exist in the database.
     */
    private function filterExistingPermissions(array $permissions): array
    {
        return Permission::whereIn('name', $permissions)->pluck('name')->toArray();
    }
}
