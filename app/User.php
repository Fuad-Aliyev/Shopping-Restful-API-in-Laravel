<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = 1;
    const UNVERIFIED_USER = 0;
    const ADMIN_USER = true;
    const REGULAR_USER = false;

    protected const TABLE = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'verification_token', 'admin',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token',
    ];

    public function isVerfied() {

        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin() {

        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationToken() {

        return str_random(45);
    }
}
