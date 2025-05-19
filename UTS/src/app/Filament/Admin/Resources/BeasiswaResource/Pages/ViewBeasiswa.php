<?php

namespace App\Filament\Admin\Resources\BeasiswaResource\Pages;

use App\Filament\Admin\Resources\BeasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBeasiswa extends ViewRecord
{
    protected static string $resource = BeasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Beasiswa')
                ->icon('heroicon-o-pencil'),
                
            Actions\DeleteAction::make()
                ->label('Hapus Beasiswa')
                ->icon('heroicon-o-trash'),
                
            Actions\Action::make('close')
                ->label('Tutup')
                ->color('gray')
                ->icon('heroicon-o-x-mark')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}