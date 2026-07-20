<?php

namespace App\Filament\Resources\JadwalInterviews;

// use App\Filament\Resources\JadwalInterviews\Pages\CreateJadwalInterview;
// use App\Filament\Resources\JadwalInterviews\Pages\EditJadwalInterview;
use App\Filament\Resources\JadwalInterviews\Pages\ListJadwalInterviews;
use App\Filament\Resources\JadwalInterviews\Schemas\JadwalInterviewForm;
use App\Filament\Resources\JadwalInterviews\Tables\JadwalInterviewsTable;
use App\Models\JadwalInterview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JadwalInterviewResource extends Resource
{
    protected static ?string $model = JadwalInterview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Jadwal Interview';

    protected static ?string $pluralModelLabel = 'Jadwal Interview';

    protected static ?string $slug = 'manajemen-jadwal-interview';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return JadwalInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalInterviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {

        return parent::getEloquentQuery()
            ->with([
                'pendaftaran.user.profil',
                'pendaftaran.pelatihan',
                'pendaftaran.buktiPendaftaran',
                'interviewer.profil',
                'penilaian'
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJadwalInterviews::route('/'),
            // 'create' => CreateJadwalInterview::route('/create'),
            // 'edit' => EditJadwalInterview::route('/{record}/edit'),
        ];
    }
}
