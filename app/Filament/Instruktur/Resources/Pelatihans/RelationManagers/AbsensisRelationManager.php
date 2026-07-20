<?php

namespace App\Filament\Instruktur\Resources\Pelatihans\RelationManagers;

use App\Models\Absensi;
use App\Models\JadwalInterview;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\DissociateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;


class AbsensisRelationManager extends RelationManager
{
    protected static string $relationship = 'absensis';

    public static ?string $title = 'Absensi';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tanggal')
                    ->required()
                    ->maxLength(255),

                Select::make('status_kehadiran')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tanggal')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Peserta')
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery->whereHas('profil', function ($profilQuery) use ($search) {
                                $profilQuery->where('nama_lengkap', 'like', "%{$search}%");
                            });
                        });
                    }),

                TextColumn::make('tanggal')
                    ->label('Tanggal Pertemuan')
                    ->date()
                    ->sortable(),

                SelectColumn::make('status_kehadiran')
                    ->label('Status Kehadiran')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ])
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('generateAbsenHariIni')
                    ->label('Buat Sesi Absen Hari Ini')
                    ->icon('heroicon-o-plus')
                    ->color('success')
                    ->action(function () {
                        $pelatihanId = $this->getOwnerRecord()->id;
                        $hariIni = now()->toDateString();
                        $instrukturId = Auth::id();

                        $pesertaIds = JadwalInterview::where('interviewer_user_id', $instrukturId)
                            ->whereHas('pendaftaran', function ($query) use ($pelatihanId) {
                                $query->where('pelatihans_id', $pelatihanId);
                            })
                            ->pluck('pendaftaran_id')
                            ->unique();

                        if ($pesertaIds->isEmpty()) {
                            Notification::make()
                                ->title('Gagal Membuat Absensi')
                                ->body('Tidak ditemukan data jadwal pendaftar untuk Anda di kelas ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        foreach ($pesertaIds as $pendaftaranId) {
                            $pendaftaran = \App\Models\Pendaftaran::find($pendaftaranId);

                            if (! $pendaftaran) {
                                continue;
                            }

                            Absensi::firstOrCreate([
                                'pelatihans_id' => $pelatihanId,
                                'user_id' => $pendaftaran->user_id,
                                'tanggal' => $hariIni,
                            ], [
                                'status_kehadiran' => 'hadir',
                            ]);
                        }

                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Sesi absensi hari ini berhasil dibuat untuk ' . $pesertaIds->count() . ' peserta.')
                            ->success()
                            ->send();
                    }),
            ])

            ->recordActions([
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                Action::make('unduhAbsensiPDF')
                    ->label('Unduh Lembar Fisik (PDF)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        $pelatihanId = $this->getOwnerRecord()->id;

                        return response()->redirectToRoute('pelatihan.unduh-absensi', ['id' => $pelatihanId]);
                    }),
            ]);
    }
}
