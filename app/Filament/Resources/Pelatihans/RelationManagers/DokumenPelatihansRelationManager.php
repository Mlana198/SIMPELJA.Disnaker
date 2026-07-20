<?php

namespace App\Filament\Resources\Pelatihans\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DokumenPelatihansRelationManager extends RelationManager
{
    protected static string $relationship = 'dokumenPelatihans';


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_dokumen')
                    ->required(),
                Select::make('jenis_dokumen')
                    ->options(['SK' => 'SK', 'Undangan' => 'Undangan', 'Lainnya' => 'Lainnya'])
                    ->required(),
                FileUpload::make('file_path')
                    ->label('File Dokumen (PDF)')
                    ->disk('public')
                    ->directory('dokumen-pelatihan')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->preserveFilenames(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_dokumen')
            ->columns([
                TextColumn::make('nama_dokumen')->searchable(),
                TextColumn::make('jenis_dokumen')->badge(),
                TextColumn::make('created_at')->label('Tanggal Unggah')->dateTime('d-m-Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
