<?php

namespace App\Filament\Admin\Resources\PenerimaResource\Pages;

use App\Filament\Admin\Resources\PenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenerima extends EditRecord
{
    protected static string $resource = PenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
