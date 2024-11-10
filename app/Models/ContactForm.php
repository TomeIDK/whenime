<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\ContactFormStatus;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    protected $casts = [
        'status' => ContactFormStatus::class,
    ];

    public function scopeUnread($query) {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query) {
        return $query->where('status', 'read');
    }

    public function scopeSolved($query) {
        return $query->where('status', 'solved');
    }
}
