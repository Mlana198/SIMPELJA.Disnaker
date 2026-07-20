<?php

namespace App\Filament\Resources\PenilaianInterviews;

use App\Filament\Resources\PenilaianInterviews\Pages\CreatePenilaianInterview;
use App\Filament\Resources\PenilaianInterviews\Pages\EditPenilaianInterview;
use App\Filament\Resources\PenilaianInterviews\Pages\ListPenilaianInterviews;
use App\Filament\Resources\PenilaianInterviews\Schemas\PenilaianInterviewForm;
use App\Filament\Resources\PenilaianInterviews\Tables\PenilaianInterviewsTable;
use App\Models\PenilaianInterview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenilaianInterviewResource extends Resource
{
    protected static ?string $model = PenilaianInterview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Hasil Interview';

    protected static ?string $pluralModelLabel = 'Hasil Interview';

    protected static ?string $slug = 'manajemen-hasil-interview';


    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PenilaianInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenilaianInterviewsTable::configure($table);
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
            'index' => ListPenilaianInterviews::route('/'),
            'create' => CreatePenilaianInterview::route('/create'),
            'edit' => EditPenilaianInterview::route('/{record}/edit'),
        ];
    }
}
