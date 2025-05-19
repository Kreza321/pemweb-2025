<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BeasiswaResource\Pages;
use App\Filament\Admin\Resources\BeasiswaResource\RelationManagers\PendaftarsRelationManager;
use App\Models\Beasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class BeasiswaResource extends Resource
{
    protected static ?string $model = Beasiswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Manajemen Beasiswa';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Beasiswa';
    protected static ?string $pluralModelLabel = 'Beasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Beasiswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Beasiswa'),
                        Forms\Components\RichEditor::make('deskripsi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('kuota')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->label('Kuota Penerima'),
                        Forms\Components\DatePicker::make('deadline')
                            ->required()
                            ->minDate(now())
                            ->label('Batas Pendaftaran'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Persyaratan')
                    ->schema([
                        Forms\Components\RichEditor::make('persyaratan')
                            ->required()
                            ->columnSpanFull()
                            ->label('Syarat Pendaftaran'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Beasiswa'),
                    
                Tables\Columns\TextColumn::make('kuota')
                    ->numeric()
                    ->sortable()
                    ->label('Kuota'),
                    
                Tables\Columns\TextColumn::make('pendaftars_count')
                    ->counts('pendaftars')
                    ->label('Jumlah Pendaftar')
                    ->numeric()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('deadline')
                    ->date()
                    ->sortable()
                    ->label('Batas Akhir')
                    ->color(function ($state) {
                        return now()->gt($state) ? 'danger' : 'success';
                    }),
                    
                Tables\Columns\TextColumn::make('status')
                    ->state(function (Beasiswa $record): string {
                        return $record->deadline > now() ? 'active' : 'expired';
                    })
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'active' => 'success',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'expired' => 'Kadaluarsa',
                    ])
                    ->label('Status Beasiswa')
                    ->query(function (Builder $query, array|string|null $state): Builder {
                        // Jika state adalah array (misalnya dari multiple select), ambil elemen pertama
                        if (is_array($state)) {
                            $state = $state[0] ?? null;
                        }

                        if ($state === 'active') {
                            return $query->where('deadline', '>=', now());
                        }

                        if ($state === 'expired') {
                            return $query->where('deadline', '<', now());
                        }

                        return $query; // jika null, tampilkan semua
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Beasiswa $record) => route('beasiswa.export', $record))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('exportAll')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            return redirect()->route('beasiswa.export.all', $records->pluck('id'));
                        })
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Beasiswa')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama')
                            ->label('Nama Beasiswa'),
                        Infolists\Components\TextEntry::make('deskripsi')
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('kuota')
                            ->label('Kuota Penerima'),
                        Infolists\Components\TextEntry::make('deadline')
                            ->date()
                            ->label('Batas Pendaftaran')
                            ->badge()
                            ->color(function ($state) {
                                return now()->gt($state) ? 'danger' : 'success';
                            }),
                        Infolists\Components\TextEntry::make('pendaftars_count')
                            ->label('Jumlah Pendaftar')
                            ->state(function (Beasiswa $record): int {
                                return $record->pendaftars()->count();
                            }),
                    ])->columns(2),
                    
                Infolists\Components\Section::make('Persyaratan')
                    ->schema([
                        Infolists\Components\TextEntry::make('persyaratan')
                            ->html()
                            ->columnSpanFull(),
                    ]),
                    
                Infolists\Components\Section::make('Statistik')
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Diupdate Pada')
                            ->dateTime(),
                    ])->columns(2)
            ]);
    }

    public static function getRelations(): array
    {
        return [
           // PendaftarsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeasiswas::route('/'),
            'create' => Pages\CreateBeasiswa::route('/create'),
            'view' => Pages\ViewBeasiswa::route('/{record}'),
            'edit' => Pages\EditBeasiswa::route('/{record}/edit'),
        ];
    }
}