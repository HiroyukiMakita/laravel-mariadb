<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function rolesOwnership(): BelongsTo
    {
        return $this->belongsTo(RoleOwnerships::class, 'id');
    }

//    /**
//     * name accessor
//     * @param string $value
//     * @return string
//     */
//    public function getNameAttribute($value): string
//    {
//        return Crypt::decrypt($value);
//    }
//
//    /**
//     * name mutator
//     * @param string $value
//     * @return void
//     */
//    public function setNameAttribute($value): void
//    {
//        $this->attributes['name'] = Crypt::encrypt($value);
//    }
//
//    /**
//     * email accessor
//     * @param string $value
//     * @return string
//     */
//    public function getEmailAttribute($value): string
//    {
//        return Crypt::decrypt($value);
//    }
//
//    /**
//     * email mutator
//     * @param string $value
//     * @return void
//     */
//    public function setEmailAttribute($value): void
//    {
//        $this->attributes['email'] = Crypt::encrypt($value);
//    }
}
