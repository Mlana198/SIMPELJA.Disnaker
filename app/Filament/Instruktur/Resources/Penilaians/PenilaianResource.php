<?php

namespace App\Filament\Instruktur\Resources\Penilaians;

use App\Filament\Instruktur\Resources\Penilaians\Pages\CreatePenilaian;
use App\Filament\Instruktur\Resources\Penilaians\Pages\EditPenilaian;
use App\Filament\Instruktur\Resources\Penilaians\Pages\ListPenilaians;
use App\Filament\Instruktur\Resources\Penilaians\Schemas\PenilaianForm;
use App\Filament\Instruktur\Resources\Penilaians\Tables\PenilaiansTable;
use App\Models\Penilaian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PenilaianResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Nilai Pelatihan';

    protected static ?string $pluralModelLabel = 'Nilai Pelatihan';

    protected static ?string $slug = 'manajemen-nilai-pelatihan';

    protected static ?string $recordTitleAttribute = 'nilai_teori';

    public static function form(Schema $schema): Schema
    {
        return PenilaianForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenilaiansTable::configure($table);
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
            'index' => ListPenilaians::route('/'),
            'create' => CreatePenilaian::route('/create'),
            'edit' => EditPenilaian::route('/{record}/edit'),
        ];
    }
}
