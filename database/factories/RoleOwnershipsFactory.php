<?php

/** @var Factory $factory */

use App\Enums\Roles;
use App\Models\RoleOwnerships;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(RoleOwnerships::class, function (Faker $faker) {
    $roles = [];
    /**
     * @link Roles
     * 権限の定数名を小文字にしたものをカラム名にする
     */
    foreach (Roles::getLowerKeys() as $label) {
        if (Roles::getValue(strtoupper($label)) !== Roles::HANDLER) {
            $roles[$label] = 1;
        }
    }
    return array_merge([
        'id' => static function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ], $roles);
});
