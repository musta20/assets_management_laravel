<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Toggle;

class PermissionToggle extends Toggle
{
    public function permissionName()
    {
        return $this->name;
    }
}
