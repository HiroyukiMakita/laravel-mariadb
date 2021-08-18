<?php

namespace App\Enums;

/**
 * @method static static MANAGER()
 * @method static static AUTHORIZER()
 * @method static static OPERATOR()
 * @method static static HANDLER()
 */
final class Roles extends BaseEnum
{
    public const MANAGER = 90;
    public const AUTHORIZER = 80;
    public const OPERATOR = 70;
    public const HANDLER = 60;

    public static $labels = [
        self::MANAGER => '管理者',
        self::AUTHORIZER => '承認者',
        self::OPERATOR => 'オペレーター',
        self::HANDLER => '取扱者',
    ];

    public static $icons = [
        self::MANAGER => 'fa-user-tie',
        self::AUTHORIZER => 'fa-user-check',
        self::OPERATOR => 'fa-user-astronaut',
        self::HANDLER => 'fa-house-user',
    ];

    public static function getIcons(): array
    {
        return self::$icons;
    }
}
