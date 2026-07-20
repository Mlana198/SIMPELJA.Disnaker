<?php

namespace App\Filament\Peserta\Resources\HasilPelatihans;

use App\Filament\Peserta\Resources\HasilPelatihans\Pages\ListHasilPelatihans;
use App\Filament\Peserta\Resources\HasilPelatihans\Schemas\HasilPelatihanForm;
use App\Filament\Peserta\Resources\HasilPelatihans\Tables\HasilPelatihansTable;
use App\Models\Penilaian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class HasilPelatihanResource extends Resource
{
    protected static ?string $model = Penilaian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Hasil Pelatihan';

    protected static ?string $pluralModelLabel = 'Hasil Pelatihan';

    protected static ?string $slug = 'manajemen-hasil-pelatihan';

    protected static ?string $recordTitleAttribute = 'nilai_akhir';

    public static function form(Schema $schema): Schema
    {
        return HasilPelatihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HasilPelatihansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHasilPelatihans::route('/'),
        ];
    }
}
