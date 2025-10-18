<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    
    const SUPERADMIN = 1;
    const CLIENT = 2;

    const STATUS = [
        'pending' => 0,
        'active' => 1,
        'nonactive' => 2,
    ];

    const ROLE_INDEX = [
        'superadmin' => self::SUPERADMIN,
        'client' => self::CLIENT,
    ];
    
    const ROLE = [
        'superadmin' => 1,
        'client' => 2,
    ];
    
    const ROLE_NAME = [
        self::SUPERADMIN => 'Superadmin',
        self::CLIENT => 'Client',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'plain_text',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
