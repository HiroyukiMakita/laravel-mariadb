<?php

namespace App\Enums;

/**
 * @method static static DEVELOPER()
 * @method static static MANAGER()
 * @method static static AUTHORIZER()
 * @method static static OPERATOR()
 * @method static static HANDLER()
 */
final class Roles extends BaseEnum
{
    public const DEVELOPER = 0;
    public const MANAGER = 2;
    public const AUTHORIZER = 4;
    public const OPERATOR = 6;
    public const HANDLER = 8;

    public static $labels = [
        self::DEVELOPER => '開発者',
        self::MANAGER => '管理者',
        self::AUTHORIZER => '承認者',
        self::OPERATOR => 'オペレーター',
        self::HANDLER => '取扱者',
    ];

    public static $icons = [
        self::DEVELOPER => 'fa-user-cog',
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
