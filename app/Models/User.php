<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'balance', 'total_spent', 'is_admin', 'is_active', 'is_banned', 'currency', 'language'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function apiKeys() {
        return $this->hasMany(ApiKey::class);
    }
}