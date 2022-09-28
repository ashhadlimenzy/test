<?php

namespace App\Models;

use App\Notifications\DoctorResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'mobile',
        'expertise',
        'email',
        'email_verified_at',
        'password',
        'status',
        'profile_image',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * Send password reset notification
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DoctorResetPasswordNotification($token));
    }
}
