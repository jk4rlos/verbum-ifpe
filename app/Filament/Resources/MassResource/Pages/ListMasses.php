<?php

namespace App\Filament\Resources\MassResource\Pages;

use App\Filament\Resources\MassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasses extends ListRecords
{
    protected static string $resource = MassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
