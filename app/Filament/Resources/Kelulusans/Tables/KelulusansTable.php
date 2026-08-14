<?php

namespace App\Filament\Resources\Kelulusans\Tables;

use App\Models\Sertifikat;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class KelulusansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelatihan.nama_pelatihan')
                    ->label('Pelatihan'),
                TextColumn::make('user.profil.nama_lengkap')
                    ->label('Peserta')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('user.profil', function (Builder $q) use ($search) {
                            $q->where('nama_lengkap', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(),
                TextColumn::make('status_kelulusan')
                    ->label('Status Kelulusan')
                    ->badge()
                    ->colors([
                        'success' => 'lulus',
                        'danger' => 'tidak_lulus',
                        'warning' => 'pending',
                    ])
                    ->icons([
                        'heroicon-m-clock' => 'pending',
                        'heroicon-m-check-circle' => 'lulus',
                        'heroicon-m-x-circle' => 'tidak_lulus',
                    ]),
            ])
            ->filters([
                SelectFilter::make('status_kelulusan')
                    ->label('Status Kelulusan')
                    ->options([
                        'lulus' => 'Lulus',
                        'tidak_lulus' => 'Tidak Lulus',
                        'pending' => 'Pending',
                    ])
                    ->placeholder('Semua Status'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('generateSertifikat')
                        ->label('Terbitkan Sertifikat Massal')
                        ->icon('heroicon-m-document-check')
                        ->color('success')
                        ->form([
                            TextInput::make('nomor_sk_kadis')
                                ->label('Nomor SK Kepala Dinas')
                                ->default('188/087/431.306.2.1/2025')
                                ->required(),
                            DatePicker::make('tanggal_sk_kadis')
                                ->label('Tanggal SK Kepala Dinas')
                                ->required(),
                            TextInput::make('ditandatangani_oleh_nama')
                                ->label('Nama Penandatangan (Kepala Dinas)')
                                ->default('KHOLIL, S.P., M.P.')
                                ->required(),
                            TextInput::make('ditandatangani_oleh_nip')
                                ->label('NIP Penandatangan')
                                ->default('19680516 199203 1 012')
                                ->required(),
                            DatePicker::make('tanggal_terbit')
                                ->label('Tanggal Terbit Sertifikat')
                                ->default(now())
                                ->required(),
                        ])
                        ->requiresConfirmation()
                        ->action(function (Collection $records, array $data) {
                            $successCount = 0;
                            $tahun = date('Y', strtotime($data['tanggal_terbit']));

                            $lastSertifikat = Sertifikat::whereYear('tanggal_terbit', $tahun)
                                ->orderBy('id', 'desc')
                                ->first();

                            $currentCounter = 0;
                            if ($lastSertifikat && !empty($lastSertifikat->nomor_sertifikat)) {
                                $parts = explode('/', $lastSertifikat->nomor_sertifikat);
                                $currentCounter = is_numeric($parts[0]) ? (int)$parts[0] : 0;
                            }

                            foreach ($records as $record) {
                                // $record sekarang adalah instance Pendaftaran
                                if ($record->status_kelulusan === 'lulus') {
                                    $mulai = \Carbon\Carbon::parse($record->pelatihan->tanggal_mulai);
                                    $selesai = \Carbon\Carbon::parse($record->pelatihan->tanggal_selesai);
                                    $durasiHari = $mulai->diffInDays($selesai) + 1;

                                    $nextNumber = $currentCounter + 1;
                                    $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                                    $namaPelatihanClean = Str::slug($record->pelatihan->nama_pelatihan ?? 'Pelatihan');
                                    $nomorSertifikatFinal = "{$nomorUrut}/X/PBK-{$namaPelatihanClean}/{$tahun}";

                                    Sertifikat::updateOrCreate(
                                        ['pendaftaran_id' => $record->id],
                                        [
                                            'nomor_sertifikat' => $nomorSertifikatFinal,
                                            'nomor_sk_kadis' => $data['nomor_sk_kadis'],
                                            'tanggal_sk_kadis' => $data['tanggal_sk_kadis'],
                                            'durasi_pelatihan' => $durasiHari,
                                            'ditandatangani_oleh_nama' => $data['ditandatangani_oleh_nama'],
                                            'ditandatangani_oleh_nip' => $data['ditandatangani_oleh_nip'],
                                            'tanggal_terbit' => $data['tanggal_terbit'],
                                            'file_sertifikat_path' => 'generated_on_download',
                                        ]
                                    );
                                    $currentCounter++;
                                    $successCount++;
                                }
                            }

                            if ($successCount > 0) {
                                Notification::make()
                                    ->title('Sertifikat Berhasil Diterbitkan')
                                    ->body("Sebanyak {$successCount} sertifikat berhasil diproses.")
                                    ->success()
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }
}
