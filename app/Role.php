<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'developer',
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
