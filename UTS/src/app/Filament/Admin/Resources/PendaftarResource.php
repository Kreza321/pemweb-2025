<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftarResource\Pages;
use App\Filament\Admin\Resources\PendaftarResource\RelationManagers;
use App\Models\Pendaftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Beasiswa';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Pendaftar Beasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('beasiswa_id')
                            ->relationship('beasiswa', 'nama')
                            ->required()
                            ->label('Program Beasiswa'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('User'),
                    ])->columns(2),

                Forms\Components\Section::make('Data Mahasiswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nim')
                            ->required()
                            ->numeric()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('jurusan')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_hp')
                            ->tel()
                            ->required()
                            ->maxLength(15),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Pendaftaran')
                    ->schema([
                        Forms\Components\FileUpload::make('berkas_khs')
                            ->directory('berkas-pendaftar/khs')
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->required()
                            ->label('KHS'),
                        Forms\Components\FileUpload::make('berkas_ktp')
                            ->directory('berkas-pendaftar/ktp')
                            ->image()
                            ->downloadable()
                            ->required()
                            ->label('KTP'),
                        Forms\Components\FileUpload::make('surat_rekomendasi')
                            ->directory('berkas-pendaftar/rekomendasi')
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->label('Surat Rekomendasi'),
                    ])->columns(3),

                Forms\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'menunggu' => 'Menunggu Verifikasi',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\RichEditor::make('catatan')
                            ->columnSpanFull()
                            ->label('Catatan Admin'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Lengkap'),
                Tables\Columns\TextColumn::make('beasiswa.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Beasiswa'),
                Tables\Columns\TextColumn::make('nim')
                    ->searchable()
                    ->label('NIM'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->label('Tanggal Daftar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('beasiswa_id')
                    ->relationship('beasiswa', 'nama')
                    ->label('Filter Beasiswa'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('terima')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->action(function (Pendaftar $record) {
                        $record->update(['status' => 'diterima']);
                        // Kirim notifikasi ke user
                    })
                    ->visible(fn (Pendaftar $record) => $record->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Terima Pendaftar')
                    ->modalDescription('Apakah Anda yakin ingin menerima pendaftar ini?'),
                Tables\Actions\Action::make('tolak')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->action(function (Pendaftar $record) {
                        $record->update(['status' => 'ditolak']);
                        // Kirim notifikasi ke user
                    })
                    ->visible(fn (Pendaftar $record) => $record->status === 'menunggu')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Pendaftar')
                    ->modalDescription('Apakah Anda yakin ingin menolak pendaftar ini?'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
                Infolists\Components\Section::make('Informasi Pendaftaran')
                    ->schema([
                        Infolists\Components\TextEntry::make('beasiswa.nama')
                            ->label('Program Beasiswa'),
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('User'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'diterima' => 'success',
                                'ditolak' => 'danger',
                                default => 'warning',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'menunggu' => 'Menunggu Verifikasi',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                            }),
                    ])->columns(3),

                Infolists\Components\Section::make('Data Mahasiswa')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_lengkap')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('nim')
                            ->label('NIM'),
                        Infolists\Components\TextEntry::make('jurusan')
                            ->label('Jurusan'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email'),
                        Infolists\Components\TextEntry::make('no_hp')
                            ->label('No. HP'),
                    ])->columns(2),

                Infolists\Components\Section::make('Berkas Pendaftaran')
                    ->schema([
                        Infolists\Components\TextEntry::make('berkas_khs')
                            ->label('KHS')
                            ->url(fn ($record) => storage_path('app/public/'.$record->berkas_khs))
                            ->openUrlInNewTab(),
                        Infolists\Components\TextEntry::make('berkas_ktp')
                            ->label('KTP')
                            ->url(fn ($record) => storage_path('app/public/'.$record->berkas_ktp))
                            ->openUrlInNewTab(),
                        Infolists\Components\TextEntry::make('surat_rekomendasi')
                            ->label('Surat Rekomendasi')
                            ->url(fn ($record) => $record->surat_rekomendasi 
                                ? storage_path('app/public/'.$record->surat_rekomendasi) 
                                : null)
                            ->openUrlInNewTab(),
                    ])->columns(3),

                Infolists\Components\Section::make('Catatan')
                    ->schema([
                        Infolists\Components\TextEntry::make('catatan')
                            ->html()
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //PendaftarsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftars::route('/'),
            'create' => Pages\CreatePendaftar::route('/create'),
            'view' => Pages\ViewPendaftar::route('/{record}'),
            'edit' => Pages\EditPendaftar::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['beasiswa', 'user'])
            ->latest();
    }
}