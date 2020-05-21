<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\Uuid;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, Uuid;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
    ];

    public static function rules($type = 'register') {

        if ('login' === $type) {
            return [
                'email' => 'required|email',
                'password' => 'required',
            ];
        }

        return [
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
