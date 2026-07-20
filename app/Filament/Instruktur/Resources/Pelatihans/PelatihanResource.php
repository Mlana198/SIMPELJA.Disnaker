<?php

namespace App\Filament\Instruktur\Resources\Pelatihans;

use App\Filament\Instruktur\Resources\Pelatihans\Pages\CreatePelatihan;
use App\Filament\Instruktur\Resources\Pelatihans\Pages\EditPelatihan;
use App\Filament\Instruktur\Resources\Pelatihans\Pages\ListPelatihans;
use App\Filament\Instruktur\Resources\Pelatihans\Pages\ViewPelatihan;
use App\Filament\Instruktur\Resources\Pelatihans\RelationManagers\AbsensisRelationManager;
use App\Filament\Instruktur\Resources\Pelatihans\Schemas\PelatihanForm;
use App\Filament\Instruktur\Resources\Pelatihans\Schemas\PelatihanInfolist;
use App\Filament\Instruktur\Resources\Pelatihans\Tables\PelatihansTable;
use App\Models\Pelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Absensi Peserta';

    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'manajemen-absensi';

    protected static ?string $label = 'Absensi Peserta';

    protected static ?string $recordTitleAttribute = 'nama_pelatihan';

    public static function form(Schema $schema): Schema
    {
        return PelatihanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PelatihanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelatihansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AbsensisRelationManager::class,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPelatihans::route('/'),
            'create' => CreatePelatihan::route('/create'),
            'view' => ViewPelatihan::route('/{record}'),
            'edit' => EditPelatihan::route('/{record}/edit'),
        ];
    }
}
