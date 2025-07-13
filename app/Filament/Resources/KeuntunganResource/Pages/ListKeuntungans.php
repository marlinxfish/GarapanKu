<?php

namespace App\Filament\Resources\KeuntunganResource\Pages;

use App\Filament\Resources\KeuntunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeuntungans extends ListRecords
{
    protected static string $resource = KeuntunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
