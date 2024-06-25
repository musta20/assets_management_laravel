<?php

namespace App\Filament\Resources\AssetResource\RelationManagers;

use App\Enums\MediaType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'Media';

    protected static function getModelLabel(): ?string
    {

        return __('media');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('description')
                    ->label(__('description')),
                FileUpload::make('file_name')
                    ->label(__('file name'))
                    ->disk('asset')
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file name')
            ->modelLabel(__('media'))
            ->columns([
                ImageColumn::make('file_name')
                    ->size('300px')
                    ->label(__('file name'))
                    ->disk('asset'),
                TextColumn::make('description')
                    ->label(__('description')),
                TextColumn::make('media_type')
                    ->formatStateUsing(fn (string $state): string => __($state))
                    ->label(__('media type')),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
                    if (in_array($ext, ['mp4', 'avi'])) {
                        $data['media_type'] = MediaType::VIDEO->value;
                    } else {
                        $data['media_type'] = MediaType::IMAGE->value;
                    }
                    $data['file_path'] = 'asset';

                    return $data;
                }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
