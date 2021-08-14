<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NONE()
 * @method static static DISABLED()
 * @method static static ENABLED()
 */
final class PermissionStatuses extends Enum
{
    public const NONE = null;
    public const DISABLED = 0;
    public const ENABLED = 1;

    public $label = [
        self::NONE => '権限無し',
        self::DISABLED => '無効',
        self::ENABLED => '有効',
    ];
}
