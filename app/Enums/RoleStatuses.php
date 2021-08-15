<?php

namespace App\Enums;

/**
 * @method static static NONE()
 * @method static static DISABLED()
 * @method static static ENABLED()
 */
final class RoleStatuses extends BaseEnum
{
    public const NONE = null;
    public const DISABLED = 0;
    public const ENABLED = 1;

    public static $labels = [
        self::NONE => '権限無し',
        self::DISABLED => '無効',
        self::ENABLED => '有効',
    ];
}
