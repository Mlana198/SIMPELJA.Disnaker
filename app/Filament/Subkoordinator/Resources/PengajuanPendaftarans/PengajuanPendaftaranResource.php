<?php

namespace App\Filament\Subkoordinator\Resources\PengajuanPendaftarans;

use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Pages\CreatePengajuanPendaftaran;
use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Pages\EditPengajuanPendaftaran;
use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Pages\ListPengajuanPendaftarans;
use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Schemas\PengajuanPendaftaranForm;
use App\Filament\Subkoordinator\Resources\PengajuanPendaftarans\Tables\PengajuanPendaftaransTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PengajuanPendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen ';

    protected static ?string $navigationLabel = 'Pengajuan Pendaftaran';

    protected static ?string $pluralModelLabel = 'Pengajuan Pendaftaran';

    protected static ?string $modelLabel = 'Pengajuan Pendaftaran';

    protected static ?string $slug = 'manajemen-pengajuan';

    protected static ?string $recordTitleAttribute = 'user.tanggal_daftar';

    public static function form(Schema $schema): Schema
    {
        return PengajuanPendaftaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuanPendaftaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return \App\Models\Pendaftaran::query();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPengajuanPendaftarans::route('/'),
            'create' => CreatePengajuanPendaftaran::route('/create'),
            'edit' => EditPengajuanPendaftaran::route('/{record}/edit'),
        ];
    }
}
