<?php

namespace App\Filament\Resources\Pendaftarans\Tables;


use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class PendaftaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_pendaftaran')
                    ->label('Nomor Pendaftaran')
                    ->default(fn() => 'REG-' . time() . '-' . Auth::id())
                    ->disabled(),

                TextColumn::make('user.profil.nama_lengkap')
                    ->label('Nama Peserta')
                    ->searchable(),

                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Pelatihan Yang Dipilih'),

                TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->date(),

                TextColumn::make('status_seleksi_administrasi')
                    ->label('Status Pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'lolos' => 'success',
                        'tidak_lolos' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'lolos_administrasi' => 'Lolos Administrasi',
                        'ditolak' => 'Ditolak',
                        default => $state,
                    }),
            ])
            ->filters([
                SelectFilter::make('pelatihan_id')
                    ->label('Saring Pelatihan')
                    ->relationship('pelatihan', 'nama_pelatihan'),

                SelectFilter::make('status_seleksi')
                    ->label('Status Berkas')
                    ->options([
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'lolos_administrasi' => 'Lolos Administrasi',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Periksa Berkas'),
            ])
            ->bulkActions([
                BulkActionGroup::make([

                    BulkAction::make('kirimKeSubkor')
                        ->label('Kirim Data Pendaftar ke Subkor')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Kirim Pengajuan Pendaftaran Kolektif')
                        ->modalDescription('Apakah Anda yakin ingin mengirim data para pendaftar yang dipilih ini ke dashboard Subkoordinator?')
                        ->action(function (Collection $records) {

                            $selectedIds = $records->pluck('id')->toArray();

                            $pendaftarLolos = \App\Models\Pendaftaran::whereIn('id', $selectedIds)
                                ->where('status_seleksi_administrasi', 'lolos')
                                ->get();

                            if ($pendaftarLolos->isEmpty()) {
                                Notification::make()
                                    ->title('Pengiriman Gagal')
                                    ->body('Tidak ada pendaftar dengan status "Lolos Administrasi" dari data yang Anda centang.')
                                    ->danger()
                                    ->send();
                                return;
                            }


                            if ($pendaftarLolos->isEmpty()) {
                                Notification::make()
                                    ->title('Pengiriman Gagal')
                                    ->body('Tidak ada pendaftar dengan status "Lolos Administrasi" dari data yang Anda centang.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            Notification::make()
                                ->title('Data Berhasil Dikirim!')
                                ->body($pendaftarLolos->count() . ' data pendaftar telah diteruskan ke Subkoordinator.')
                                ->success()
                                ->send();
                        }),

                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
