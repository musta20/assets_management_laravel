<?php

declare(strict_types=1);

namespace App\Enums;

enum UserPermission: string
{
    case Categories = 'Categories';
    case Setting = 'Setting';
    case Users = 'Users';
    case Assets = 'Assets';
    case Departments = 'Departments';
    case Messages = 'Messages';
    case Locations = 'Locations';
    case Maintenances = 'Maintenances';
    case Vendors = 'Vendors';
    case Roles = 'Roles';

    /**
     * Get all constants in a name => value array
     */
    public static function getValuesAsArray(): array
    {
        return array_flip(collect(self::cases())->mapWithKeys(function ($value) {
            return [$value->value => $value->name];
        })->toArray());
    }
}
