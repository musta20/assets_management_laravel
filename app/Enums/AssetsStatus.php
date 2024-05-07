<?php
namespace App\Enums;

enum AssetsStatus: string
{
    case in_use = 'in_use';
    case maintenance = 'maintenance';
    case disposed = 'disposed';


    
    /**
     * Get all constants in a name => value array
     *
     * @return array
     */
    public static function getValuesAsArray(): array
    {
        return array_flip(collect(self::cases())->mapWithKeys(function ($value) {
            return [$value->value => $value->name];
        })->toArray());
    }

}



?>