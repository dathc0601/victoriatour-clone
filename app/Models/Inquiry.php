<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'tour_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    protected $casts = [
        'type' => 'string',
        'status' => 'string',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeContact($query)
    {
        return $query->where('type', 'contact');
    }

    public function scopeTourBooking($query)
    {
        return $query->where('type', 'tour_booking');
    }

    public function scopeNewsletter($query)
    {
        return $query->where('type', 'newsletter');
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function markAsReplied(): void
    {
        $this->update(['status' => 'replied']);
    }
}
