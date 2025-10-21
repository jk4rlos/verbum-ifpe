<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;
    protected static ?string $navigationGroup = 'Conteúdo Dinâmico';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('content')
                    ->label('Conteúdo')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'strike',
                        'link',
                        'orderedList',
                        'unorderedList',
                        'blockquote',
                        'codeBlock',
                        'undo',
                        'redo',
                    ])
                    ->columnSpanFull(),

                FileUpload::make('images')
                    ->label('Imagens (máx. 5)')
                    ->multiple()
                    ->maxFiles(5)
                    ->maxSize(1024)
                    ->directory('abouts')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('images.0')
                    ->label('Imagem Principal')
                    ->square(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
