<?php

namespace App\Filament\Peserta\Resources\Pelatihans;

use App\Filament\Instruktur\Resources\Pelatihans\Pages\ViewPelatihan;
use App\Filament\Peserta\Resources\Pelatihans\Pages\ListPelatihans;
use App\Filament\Peserta\Resources\Pelatihans\Schemas\PelatihanForm;
use App\Filament\Peserta\Resources\Pelatihans\Tables\PelatihansTable;
use App\Models\Pelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Informasi Pelatihan';

    protected static \UnitEnum|string|null $navigationGroup = 'Informasi';

    protected static ?string $slug = 'informasi-pelatihan';

    public static ?string $label = 'Pelatihan';

    protected static ?string $recordTitleAttribute = 'nama_pelatihan';

    public static function form(Schema $schema): Schema
    {
        return PelatihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelatihansTable::configure($table);
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
            'index' => ListPelatihans::route('/'),
            'view' => ViewPelatihan::route('/{record}'),
        ];
    }
}
