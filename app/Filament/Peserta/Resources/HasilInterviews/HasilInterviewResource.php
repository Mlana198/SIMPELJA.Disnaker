<?php

namespace App\Filament\Peserta\Resources\HasilInterviews;

// use App\Filament\Peserta\Resources\HasilInterviews\Pages\CreateHasilInterview;
// use App\Filament\Peserta\Resources\HasilInterviews\Pages\EditHasilInterview;
use App\Filament\Peserta\Resources\HasilInterviews\Pages\ListHasilInterviews;
use App\Filament\Peserta\Resources\HasilInterviews\Schemas\HasilInterviewForm;
use App\Filament\Peserta\Resources\HasilInterviews\Tables\HasilInterviewsTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HasilInterviewResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Hasil Seleksi';

    protected static ?string $pluralModelLabel = 'Hasil Seleksi';

    protected static ?string $slug = 'manajemen-hasil-seleksi';

    protected static ?string $recordTitleAttribute = 'status_akhir';

    public static function form(Schema $schema): Schema
    {
        return HasilInterviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HasilInterviewsTable::configure($table);
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
            ->where('user_id', Auth::id())
            ->with([
                'pelatihan',
                'jadwalInterview.penilaianInterview'
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHasilInterviews::route('/'),
            // 'create' => CreateHasilInterview::route('/create'),
            // 'edit' => EditHasilInterview::route('/{record}/edit'),
        ];
    }
}
