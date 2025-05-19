<?php

namespace App\Filament\Admin\Resources\PageconfigResource\Pages;

use App\Filament\Admin\Resources\PageconfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageconfigs extends ListRecords
{
    protected static string $resource = PageconfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
