<?php

declare(strict_types=1);

namespace App\Enums;

enum ItemType: string
{
    case PHYSICAL = 'physical';
    case DIGITAL = 'digital';

    /**
     * Get all constants in a name => value array
     */
    public static function getValuesAsArray(): array
    {
        return array_flip(collect(self::cases())->mapWithKeys(function ($value) {
            return [__($value->value) => $value->name];
        })->toArray());
    }
}
