<?php

namespace App\Filament\Resources\WeeklyWarningResource\Pages;

use App\Filament\Resources\WeeklyWarningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyWarnings extends ListRecords
{
    protected static string $resource = WeeklyWarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
