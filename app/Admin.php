<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\notifications\AdminPasswordResetNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    public function role()
    {
        return $this->belongsToMany(role::class,'role_admins');
    }
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminPasswordResetNotification($token));
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
}
