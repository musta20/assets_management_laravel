<?php

namespace App\Enums;

enum AssetsStatus: string
{
    case in_use = 'in_use';
    case maintenance = 'maintenance';
    case disposed = 'disposed';

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
