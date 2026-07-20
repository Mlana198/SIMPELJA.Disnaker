<?php

namespace App\Filament\Subkoordinator\Resources\JadwalInterviews;

use App\Filament\Subkoordinator\Resources\JadwalInterviews\Pages\CreateJadwalInterview;
use App\Filament\Subkoordinator\Resources\JadwalInterviews\Pages\EditJadwalInterview;
use App\Filament\Subkoordinator\Resources\JadwalInterviews\Pages\ListJadwalInterviews;
use App\Filament\Subkoordinator\Resources\JadwalInterviews\Schemas\JadwalInterviewForm;
use App\Filament\Subkoordinator\Resources\JadwalInterviews\Tables\JadwalInterviewsTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class JadwalInterviewResource extends Resource
{

    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen ';

    protected static ?string $navigationLabel = 'Jadwal Interview';

    protected static ?string $pluralModelLabel = 'Jadwal Interview';

    protected static ?string $modelLabel = 'Jadwal Interview';


    protected static ?string $slug = 'manajemen-jadwal-interview';

    protected static ?string $recordTitleAttribute = 'nomor_pendaftaran';

    public static function form(Schema $schema): Schema
    {
        return JadwalInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalInterviewsTable::configure($table);
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('catatan_keputusan', 'dijadwalkan_interview');
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
            'index' => ListJadwalInterviews::route('/'),
            'create' => CreateJadwalInterview::route('/create'),
            'edit' => EditJadwalInterview::route('/{record}/edit'),
        ];
    }
}
