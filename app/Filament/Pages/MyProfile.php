<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Biodata';
    protected string $view = 'filament.pages.my-profile';
    protected static ?string $slug = 'biodata';
    protected static ?int $navigationSort = 99;
    protected static string|UnitEnum|null $navigationGroup = null;
    public ?array $data = [];
    public bool $isProfileComplete = false;

    public function mount(): void
    {
        $user = Auth::user();

        $profilData = $user?->profil ? $user->profil->toArray() : [];
        $profilData['avatar_url'] = $user?->avatar_url;

        if (
            $user instanceof User &&
            $user->profil &&
            !empty($user->profil->no_hp) &&
            !empty($user->profil->gender) &&
            !empty($user->profil->alamat)
        ) {
            $this->isProfileComplete = true;
        } else {
            $this->isProfileComplete = false;
        }

        $this->form->fill($profilData);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Kelengkapan Data Profil')
                    ->description('Silakan lengkapi 
                    informasi biodata Anda di bawah ini.')
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('avatars')
                            ->visibility('public')
                            ->columnSpanFull(),

                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('no_hp')
                            ->label('Nomor HP / WhatsApp')
                            ->required()
                            ->tel()
                            ->maxLength(15),

                        Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->required()
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),

                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(50),

                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),

                        Textarea::make('alamat')
                            ->label('Alamat Domisili')
                            ->required()
                            ->rows(3),
                    ])->columns(2)
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $user = Auth::user();
        $formData = $this->form->getState();

        if ($user instanceof User) {
            $user->update([
                'avatar_url' => $formData['avatar_url'] ?? null,
            ]);
            unset($formData['avatar_url']);

            $user->profil()->updateOrCreate(
                ['user_id' => $user->id],
                $formData
            );

            $this->isProfileComplete = true;

            Notification::make()
                ->title('Profil Berhasil Diperbarui')
                ->success()
                ->send();

            $this->redirect(static::getUrl());
        }
    }
}
