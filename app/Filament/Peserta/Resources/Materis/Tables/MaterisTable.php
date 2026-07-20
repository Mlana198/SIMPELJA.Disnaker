<?php

namespace App\Filament\Peserta\Resources\Materis\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MaterisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Pelatihan / Kelas')
                    ->wrap()
                    ->sortable(),

                TextColumn::make('judul_materi')
                    ->label('Materi')
                    ->description(fn($record): string => $record->deskripsi ?? '')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tgl Dibagikan')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Unduh Berkas')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn($record): bool => !empty($record->file_materi_path))
                    ->url(fn($record): string => asset('storage/' . $record->file_materi_path))
                    ->openUrlInNewTab(),

                Action::make('watch_video')
                    ->label('Tonton Video')
                    ->icon('heroicon-o-video-camera')
                    ->color('info')

                    ->visible(fn($record): bool => !empty($record->link_video))
                    ->url(fn($record): string => $record->link_video)
                    ->openUrlInNewTab(),
            ])

            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('pelatihan.pendaftarans', function ($q) {
                    $q->where('user_id', Auth::id());
                });
            });
    }
}
