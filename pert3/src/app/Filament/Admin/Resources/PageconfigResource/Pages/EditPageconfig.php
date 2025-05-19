<?php

namespace App\Filament\Admin\Resources\PageconfigResource\Pages;

use App\Filament\Admin\Resources\PageconfigResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageconfig extends EditRecord
{
    protected static string $resource = PageconfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
