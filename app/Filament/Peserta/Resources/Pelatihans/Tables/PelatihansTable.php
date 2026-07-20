<?php

namespace App\Filament\Peserta\Resources\Pelatihans\Tables;

use App\Models\Pendaftaran;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PelatihansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('kuota')
                    ->label('Kuota Sisa')
                    ->badge(),

                TextColumn::make('status_periode')
                    ->label('Status pelatihan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'aktif' => 'success',
                        'non-aktif' => 'warning',
                        'selesai' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_mulai')
                    ->label('Mulai Pelaksanaan')
                    ->date(),

                TextColumn::make('tanggal_selesai')
                    ->label('Selesai Pelaksanaan')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('status_pelatihan')
                    ->label('Saring Status')
                    ->options([
                        'aktif' => 'Sedang Aktif',
                        'non-aktif' => 'Tidak Aktif',
                        'selesai' => 'Selesai / Ditutup',
                    ]),
            ])
            ->recordActions([
                Action::make('daftarPelatihan')
                    ->label('Daftar')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->color('primary')
                    ->button()
                    ->visible(fn($record) => $record->status_pelatihan === 'aktif')
                    ->disabled(fn($record) => Pendaftaran::where('user_id', Auth::id())->where('pelatihan_id', $record->id)->exists())
                    ->modalHeading(fn($record) => 'Formulir Pendaftaran: ' . $record->nama_pelatihan)
                    ->form([
                        TextInput::make('nomor_pendaftaran')
                            ->default('REG-' . time() . '-' . Auth::id())
                            ->disabled()
                            ->dehydrated(),
                        FileUpload::make('berkas_ktp')
                            ->label('Unggah KTP (PDF/Format Gambar)')
                            ->required(),
                        FileUpload::make('berkas_ijazah')
                            ->label('Unggah Ijazah Terakhir')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        Pendaftaran::create([
                            'user_id' => Auth::id(),
                            'pelatihan_id' => $record->id,
                            'nomor_pendaftaran' => $data['nomor_pendaftaran'],
                            'status_seleksi_administrasi' => 'menunggu_verifikasi',
                        ]);

                        Notification::make()
                            ->title('Pendaftaran Berhasil!')
                            ->body('Berkas Anda telah terkirim ke Admin. Sila cek menu Pendaftaran Anda.')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
