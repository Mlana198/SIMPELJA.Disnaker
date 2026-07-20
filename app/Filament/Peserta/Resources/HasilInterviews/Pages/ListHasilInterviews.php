<?php

namespace App\Filament\Peserta\Resources\HasilInterviews\Pages;

use App\Filament\Peserta\Resources\HasilInterviews\HasilInterviewResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListHasilInterviews extends ListRecords
{
    protected static string $resource = HasilInterviewResource::class;

    protected function modifyQueryUsing(Builder $query): Builder
    {
        return $query->where('user_id', Auth::id());
    }

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
