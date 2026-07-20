<?php

namespace App\Filament\Instruktur\Resources\Materis;

use App\Filament\Instruktur\Resources\Materis\Pages\CreateMateri;
use App\Filament\Instruktur\Resources\Materis\Pages\EditMateri;
use App\Filament\Instruktur\Resources\Materis\Pages\ListMateris;
use App\Filament\Instruktur\Resources\Materis\Schemas\MateriForm;
use App\Filament\Instruktur\Resources\Materis\Tables\MaterisTable;
use App\Models\MateriPelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MateriResource extends Resource
{
    protected static ?string $model = MateriPelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Materi Pelatihan';

    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'manajemen-materi';

    protected static ?string $recordTitleAttribute = 'judul_materi';

    public static function form(Schema $schema): Schema
    {
        return MateriForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaterisTable::configure($table);
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
            'index' => ListMateris::route('/'),
            'create' => CreateMateri::route('/create'),
            'edit' => EditMateri::route('/{record}/edit'),
        ];
    }
}
