<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Toggle;

class permissionToggle extends Toggle
{

  

    public function PermissionName()
    {
        return $this->name;
    }

    // protected function setUp(): void
    // {
    //     parent::setUp();

        // $state = $this->getRecord() ? $this->getRecord()->hasPermissionTo($this->PermissionName()): false;
        // $this->default($state);

        // $this->afterStateHydrated(static function (Toggle $component, $state): void {
        //     $component->state((bool) $state);
        // });

        // $this->rule('boolean');
    //}

    // public function getState(): bool
    // {
    //   return $this->getRecord() ? $this->getRecord()->hasPermissionTo($this->PermissionName()): false;
    // }


      // public function getState(): bool
    // {
    //   return $this->getRecord() ? $this->getRecord()->hasPermissionTo($this->PermissionName()): false;
    // }

   
}
