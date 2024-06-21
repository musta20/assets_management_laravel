<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class StatusSwitcher extends Column
{
    protected string $view = 'tables.columns.status-switcher';

    public function hasPermission(): bool
    {
        return $this->record->hasPermissionTo($this->name);
    }
}
