<?php

namespace App\Filament\Resources\MaintenanceResource\Pages;

use App\Filament\Resources\MaintenanceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMaintenance extends EditRecord
{
    protected static string $resource = MaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),

        ];
    }
}
