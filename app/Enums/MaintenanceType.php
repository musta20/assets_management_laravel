<?php

declare(strict_types=1);

namespace App\Enums;


enum  MaintenanceType  :string
{
     case CORRECTIVE = 'corrective';
     case PREVENTIVE = 'preventive';
         
    /**
     * Get all constants in a name => value array
     *
     * @return array
     */
    public static function getValuesAsArray(): array
    {
        return array_flip(collect(self::cases())->mapWithKeys(function ($value) {
            return [__($value->value) => $value->name];
        })->toArray());
    }
}


?>