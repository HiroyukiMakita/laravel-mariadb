<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DEVELOPER()
 * @method static static MANAGER()
 * @method static static AUTHORIZER()
 * @method static static OPERATOR()
 * @method static static HANDLER()
 */
final class Permissions extends Enum
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
        self::DEVELOPER => 'user-cog',
        self::MANAGER => 'user-tie',
        self::AUTHORIZER => 'thumbs-up',
        self::OPERATOR => 'keyboard',
        self::HANDLER => 'store-alt',
    ];

    public static function getLabels(): array
    {
        return self::$labels;
    }

    public static function getIcons(): array
    {
        return self::$icons;
    }

    public function getLabel(int $value): string
    {
        $labels = self::getLabels();
        return $labels[$value];
    }

    public static function getLowerKeys(): array
    {
        $strToLower = static function ($upper) {
            return strtolower($upper);
        };
        return array_map($strToLower, self::getKeys());
    }
}
