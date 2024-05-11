<?php

namespace App\Filament\Resources\AssetResource\RelationManagers;

use App\Enums\MediaType;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->required()


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file name')
            ->modelLabel(__('media'))
            ->columns([
                Tables\Columns\ImageColumn::make('file_name')
                    ->label(__('file name'))
                    ->disk('asset'),
                    Tables\Columns\TextColumn::make('description')
                    ->label(__('description')),
                    Tables\Columns\TextColumn::make('media_type')
                    ->label(__('description')),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
                    if (in_array($ext, ['mp4', 'avi'])) {
                        $data['media_type'] = MediaType::VIDEO->value;
                    } else {
                        $data['media_type'] = MediaType::IMAGE->value;
                    }
                    $data['file_path'] = "asset";

                    return $data;
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
