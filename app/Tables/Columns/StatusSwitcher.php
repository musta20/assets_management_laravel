<?php

namespace App\Tables\Columns;

use App\Enums\UserPermission;
use Filament\Tables\Columns\Column;

class StatusSwitcher extends Column
{
    protected string $view = 'tables.columns.status-switcher';

    public function HasPermission(): bool
    {
        return $this->record->hasPermissionTo($this->name);
    }

}
