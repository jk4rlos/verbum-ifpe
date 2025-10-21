<?php

namespace App\Filament\Resources\WeeklyWarningResource\Pages;

use App\Filament\Resources\WeeklyWarningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeeklyWarning extends EditRecord
{
    protected static string $resource = WeeklyWarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
