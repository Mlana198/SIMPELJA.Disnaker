<?php

namespace App\Filament\Instruktur\Resources\InstrukturJadwalInterviews\Tables;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Slider;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class InstrukturJadwalInterviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('interviewer_user_id', Auth::id())
                    ->with(['pendaftaran.user.profil', 'pendaftaran.pelatihan', 'penilaianInterview']);
            })
            ->columns([
                TextColumn::make('pendaftaran.user.profil.nama_lengkap')
                    ->label('Nama Peserta')
                    ->searchable(),
                TextColumn::make('pendaftaran.pelatihan.nama_pelatihan')
                    ->label('Jenis Pelatihan'),
                TextColumn::make('waktu_interview')
                    ->label('Jadwal')
                    ->dateTime('d M Y - H:i')
                    ->sortable(),
                TextColumn::make('tempat_atau_link')
                    ->label('Lokasi/Link'),

                TextColumn::make('penilaian.skor_minat')
                    ->label('Skor Minat')
                    ->badge()
                    ->color(fn($state) => $state >= 7 ? 'success' : 'warning'),

                TextColumn::make('penilaian.skor_bakat')
                    ->label('Skor Bakat')
                    ->badge()
                    ->color(fn($state) => $state >= 7 ? 'success' : 'warning'),

                TextColumn::make('penilaian.status_akhir')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Lulus' => 'success',
                        'Cadangan' => 'warning',
                        'Gagal' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('input_nilai')
                    ->label('Nilai Peserta')
                    ->icon('heroicon-o-pencil')
                    ->modalHeading('Penilaian Minat & Bakat')
                    ->form([
                        Slider::make('skor_minat')->label('Skor Minat (1-10)')->required()->minValue(1)->maxValue(10),
                        Slider::make('skor_bakat')->label('Skor Bakat (1-10)')->required()->minValue(1)->maxValue(10),
                        RichEditor::make('catatan_kualitatif')->label('Ulasan Minat & Bakat'),
                        Select::make('status_akhir')
                            ->options(['Lulus' => 'Lulus', 'Cadangan' => 'Cadangan', 'Gagal' => 'Gagal'])
                            ->default('Lulus'),
                    ])
                    ->fillForm(fn($record) => $record->penilaian?->toArray() ?? [])
                    ->action(function ($record, array $data) {
                        $data['status_pengajuan'] = 'Draft';

                        $record->penilaian()->updateOrCreate(
                            ['jadwal_interview_id' => $record->id],
                            $data
                        );
                    }),
            ]);
    }
}
