<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoleOwnerships extends Model
{
    protected $table = 'role_ownerships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'manager',
        'authorizer',
        'operator',
        'handler',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }
}
