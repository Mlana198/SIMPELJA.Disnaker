<?php

namespace App\Filament\Kabid\Resources\LaporanPelatihans;

use App\Filament\Kabid\Resources\LaporanPelatihans\Pages\CreateLaporanPelatihan;
use App\Filament\Kabid\Resources\LaporanPelatihans\Pages\EditLaporanPelatihan;
use App\Filament\Kabid\Resources\LaporanPelatihans\Pages\ListLaporanPelatihans;
use App\Filament\Kabid\Resources\LaporanPelatihans\Schemas\LaporanPelatihanForm;
use App\Filament\Kabid\Resources\LaporanPelatihans\Tables\LaporanPelatihansTable;
use App\Models\Pelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class LaporanPelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Laporan Pelatihan';

    protected static ?string $pluralModelLabel = 'Laporan Pelatihan';

    protected static ?string $slug = 'manajemen-laporan-pelatihan';

    protected static ?string $recordTitleAttribute = 'nama_pelatihan';

    public static function form(Schema $schema): Schema
    {
        return LaporanPelatihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanPelatihansTable::configure($table)
            ->modifyQueryUsing(fn($query) => $query->whereIn('status_laporan', ['diajukan', 'disetujui', 'direvisi', 'ditolak']));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('status_laporan', ['diajukan', 'disetujui', 'direvisi', 'ditolak']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaporanPelatihans::route('/'),
            'create' => CreateLaporanPelatihan::route('/create'),
            'edit' => EditLaporanPelatihan::route('/{record}/edit'),
        ];
    }
}
