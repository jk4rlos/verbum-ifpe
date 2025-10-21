<?php

namespace App\Filament\Resources\ConfessionResource\Pages;

use App\Filament\Resources\ConfessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfession extends EditRecord
{
    protected static string $resource = ConfessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
