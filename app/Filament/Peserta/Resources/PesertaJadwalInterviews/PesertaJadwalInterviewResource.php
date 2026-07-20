<?php

namespace App\Filament\Peserta\Resources\PesertaJadwalInterviews;

use App\Filament\Peserta\Resources\PesertaJadwalInterviews\Pages\CreatePesertaJadwalInterview;
use App\Filament\Peserta\Resources\PesertaJadwalInterviews\Pages\EditPesertaJadwalInterview;
use App\Filament\Peserta\Resources\PesertaJadwalInterviews\Pages\ListPesertaJadwalInterviews;
use App\Filament\Peserta\Resources\PesertaJadwalInterviews\Schemas\PesertaJadwalInterviewForm;
use App\Filament\Peserta\Resources\PesertaJadwalInterviews\Tables\PesertaJadwalInterviewsTable;
use App\Models\JadwalInterview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class PesertaJadwalInterviewResource extends Resource
{
    protected static ?string $model = JadwalInterview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Jadwal Interview';

    protected static ?string $pluralModelLabel = 'Jadwal Interview';

    protected static ?string $modelLabel = 'Jadwal Interview';

    protected static ?string $slug = 'manajemen-jadwal-interview';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PesertaJadwalInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesertaJadwalInterviewsTable::configure($table);
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
            ->whereHas('pendaftaran', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['pendaftaran.pelatihan', 'interviewer.profil']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPesertaJadwalInterviews::route('/'),
            'create' => CreatePesertaJadwalInterview::route('/create'),
            'edit' => EditPesertaJadwalInterview::route('/{record}/edit'),
        ];
    }
}
