<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Models\Prodi;
use App\Models\Laporan;
use App\Notifications\LaporanNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /* =========================
     | MASS ASSIGNMENT
     ========================= */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
        'prodi_id',
        'photo',
    ];

    /* =========================
     | HIDDEN ATTRIBUTES
     ========================= */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* =========================
     | CASTS
     ========================= */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /* =========================
     | RELATIONS
     ========================= */

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    /* =========================
     | ACCESSORS
     ========================= */

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            return asset('storage/' . $this->photo);
        }

        return asset('assets/images/user/avatar-2.jpg');
    }

    /* =========================
     | ROLE HELPERS
     ========================= */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function getRoleLabelAttribute(): string
    {
        return ucfirst($this->role);
    }

    /* =========================
     | NOTIFICATION HELPERS
     ========================= */

    public function allNotifications()
    {
        return $this->notifications()->latest()->get();
    }

    public function unreadNotificationsList()
    {
        return $this->unreadNotifications()->latest()->get();
    }

    public function unreadNotificationsCount(): int
    {
        return $this->unreadNotifications()->count();
    }

    public function markAllNotificationsAsRead(): void
    {
        $this->unreadNotifications()->update(['read_at' => now()]);
    }

    public function laporanNotifications()
    {
        return $this->notifications()
            ->where('type', LaporanNotification::class)
            ->latest()
            ->get();
    }
}
