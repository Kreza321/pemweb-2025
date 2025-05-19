<?php

namespace App\Filament\Admin\Resources\PenerimaResource\Pages;

use App\Filament\Admin\Resources\PenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenerimas extends ListRecords
{
    protected static string $resource = PenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
