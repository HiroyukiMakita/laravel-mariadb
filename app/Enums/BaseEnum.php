<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class BaseEnum extends Enum
{
    protected static $labels;

    public static function getLabels(): array
    {
        return static::$labels;
    }

    public static function getLabel($value): string
    {
        $labels = static::getLabels();
        return $labels[$value];
    }

    public static function getLowerKeys(): array
    {
        $strToLower = static function ($upper) {
            return strtolower($upper);
        };
        return array_map($strToLower, static::getKeys());
    }

    public static function getLowerKey($value): string
    {
        return strtolower(static::getKey($value));
    }
}