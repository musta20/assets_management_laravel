<?php

namespace App\Filament\Resources\MaintenanceResource\Pages;

use App\Filament\Resources\MaintenanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMaintenances extends ListRecords
{
    protected static string $resource = MaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
