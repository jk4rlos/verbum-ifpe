<?php

namespace App\Filament\Resources\MassResource\Pages;

use App\Filament\Resources\MassResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMass extends EditRecord
{
    protected static string $resource = MassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
