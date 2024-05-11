<?php

declare(strict_types=1);

namespace App\Enums;


enum  MediaType  :string
{

     case IMAGE = 'image';
     case VIDEO = 'video';

         
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