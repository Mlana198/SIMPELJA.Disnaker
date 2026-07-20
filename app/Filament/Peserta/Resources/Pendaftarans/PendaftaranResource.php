<?php

namespace App\Filament\Peserta\Resources\Pendaftarans;

use App\Filament\Peserta\Resources\Pendaftarans\Pages\CreatePendaftaran;
use App\Filament\Peserta\Resources\Pendaftarans\Pages\ListPendaftarans;
use App\Filament\Peserta\Resources\Pendaftarans\Schemas\PendaftaranForm;
use App\Filament\Peserta\Resources\Pendaftarans\Tables\PendaftaransTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Pendaftaran';

    protected static ?string $pluralModelLabel = 'Pendaftaran';

    protected static ?string $resourceRouteKey = 'pendaftarans';

    protected static ?string $slug = 'manajemen-pendaftaran';

    protected static ?string $recordTitleAttribute = 'tanggal_daftar';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

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

        ];
    }
}
