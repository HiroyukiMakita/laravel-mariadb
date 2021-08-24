<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function app\Helpers\aes_decrypt;
use function app\Helpers\aes_encrypt;

/**
 * @method static create(array $array)
 */
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

    /**
     * 複合化名称検索スコープ
     *
     * @param $query
     * @param $input
     */
    public function scopeName($query, $input): void
    {
        $query->whereRaw(aes_decrypt('name') . ' like ?', ["%$input%"]);
    }

    /**
     * 複合化メールアドレス検索スコープ
     *
     * @param $query
     * @param $input
     */
    public function scopeEmail($query, $input): void
    {
        $query->whereRaw(aes_decrypt('email') . ' like ?', ["%$input%"]);
    }

    public function createUser($inputs)
    {
        $role = $inputs['role'] ?? Roles::HANDLER;
        return self::create([
            'name' => aes_encrypt($inputs['name']),
            'email' => $inputs['email'],
            'role' => $role,
            'password' => $inputs['password'],
        ]);
    }
}
