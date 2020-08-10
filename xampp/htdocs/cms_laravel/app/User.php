<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 日本語のメールを作成するクラス(さっき作ったもの)
use App\Notifications\VerifyEmailJP;
use App\Notifications\ResetPasswordJP as ResetPasswordNotificationJP;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    // オーバーライド
    public function sendEmailVerificationNotification()
    {
        // $this->notify(new VerifyEmail);
        $this->notify(new VerifyEmailJP);
    }
 
    // オーバーライド
    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new ResetPasswordNotification($token));
        $this->notify(new ResetPasswordNotificationJP($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
