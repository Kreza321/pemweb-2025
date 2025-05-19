<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenerimaResource\Pages;
use App\Filament\Admin\Resources\PenerimaResource\RelationManagers;
use App\Models\Penerima;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenerimaResource extends Resource
{
    protected static ?string $model = Penerima::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Beasiswa';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Penerima Beasiswa';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pendaftar_id')
                    ->relationship('pendaftar', 'nama_lengkap')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('jumlah_dana')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pencairan')
                    ->required(),
                Forms\Components\Select::make('status_pencairan')
                    ->options([
                        'belum' => 'Belum Dicairkan',
                        'dicairkan' => 'Telah Dicairkan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pendaftar.nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_dana')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pencairan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pencairan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dicairkan' => 'success',
                        default => 'warning',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pencairan')
                    ->options([
                        'belum' => 'Belum Dicairkan',
                        'dicairkan' => 'Telah Dicairkan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('cairkan')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->action(function (Penerima $record) {
                        $record->update([
                            'status_pencairan' => 'dicairkan',
                            'tanggal_pencairan' => now()
                        ]);
                        // Tambahkan logic notifikasi ke user
                    })
                    ->visible(fn (Penerima $record) => $record->status_pencairan === 'belum'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenerimas::route('/'),
            'create' => Pages\CreatePenerima::route('/create'),
            'edit' => Pages\EditPenerima::route('/{record}/edit'),
        ];
    }
}
