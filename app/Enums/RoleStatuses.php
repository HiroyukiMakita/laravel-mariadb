<?php

namespace App\Enums;

/**
 * @method static static DISABLED()
 * @method static static ENABLED()
 */
final class RoleStatuses extends BaseEnum
{
    public const DISABLED = 0;
    public const ENABLED = 1;

    public static $labels = [
        self::DISABLED => '権限なし',
        self::ENABLED => '権限あり',
    ];
}
