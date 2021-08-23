<?php

/** @var Factory $factory */

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function app\Helpers\aes_encrypt;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function () {
    return [
        'name' => DB::raw(aes_encrypt('テストユーザー')),
        'email' => 'test@example.com',
        'email_verified_at' => now(),
        'role' => Roles::MANAGER,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
