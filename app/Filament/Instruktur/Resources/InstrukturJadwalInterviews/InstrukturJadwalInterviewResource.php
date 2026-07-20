<?php

namespace App\Filament\Instruktur\Resources\InstrukturJadwalInterviews;

use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Pages\CreateInstrukturJadwalInterview;
use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Pages\EditInstrukturJadwalInterview;
use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Pages\ListInstrukturJadwalInterviews;
use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Schemas\InstrukturJadwalInterviewForm;
use App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Tables\InstrukturJadwalInterviewsTable;
use App\Models\JadwalInterview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class InstrukturJadwalInterviewResource extends Resource
{
    protected static ?string $model = JadwalInterview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?string $navigationLabel = 'Jadwal Interview';

    protected static ?string $pluralModelLabel = 'Jadwal Interview';

    protected static ?string $modelLabel = 'Jadwal Interview';

    protected static ?string $slug = 'manajemen-jadwal-interview';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return InstrukturJadwalInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstrukturJadwalInterviewsTable::configure($table);
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
            ->where('interviewer_user_id', Auth::id())
            ->with(['pendaftaran.pelatihan']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstrukturJadwalInterviews::route('/'),
            'create' => CreateInstrukturJadwalInterview::route('/create'),
            'edit' => EditInstrukturJadwalInterview::route('/{record}/edit'),
        ];
    }
}
