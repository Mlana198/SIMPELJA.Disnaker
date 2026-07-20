<?php

namespace App\Filament\Resources\Pendaftarans;

use App\Filament\Resources\Pendaftarans\Pages\CreatePendaftaran;
use App\Filament\Resources\Pendaftarans\Pages\EditPendaftaran;
use App\Filament\Resources\Pendaftarans\Pages\ListPendaftarans;
use App\Filament\Resources\Pendaftarans\Schemas\PendaftaranForm;
use App\Filament\Resources\Pendaftarans\Tables\PendaftaransTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Pendaftar';

    protected static ?string $pluralModelLabel = 'Pendaftar';


    protected static ?string $slug = 'manajemen-pendaftar';

    protected static ?string $modelLabel = 'Verifikasi Pendaftar';

    protected static ?string $recordTitleAttribute = 'user.nama_lengkap';

    public static function form(Schema $schema): Schema
    {
        return PendaftaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PendaftaransTable::configure($table);
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
            'index' => ListPendaftarans::route('/'),
            'create' => CreatePendaftaran::route('/create'),
            'edit' => EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
