<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationGroup = 'Ofertas & Contribuições';
    protected static ?string $navigationLabel = 'Ofertas e PIX';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('pix')
                    ->label('Chave PIX')
                    ->maxLength(255)
                    ->helperText('Informe a chave PIX ou o código Copia e Cola.'),

                Forms\Components\TextInput::make('bank')
                    ->label('Banco')
                    ->maxLength(255)
                    ->helperText('Nome do banco ou instituição financeira.'),

                Forms\Components\FileUpload::make('qrcode')
                    ->label('QR Code do PIX')
                    ->directory('offers/qrcodes')
                    ->image()
                    ->maxSize(2048) // 2MB
                    ->imagePreviewHeight('150')
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->label('Descrição')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'undo',
                        'redo'
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable(),
                Tables\Columns\TextColumn::make('pix')->label('Chave PIX')->limit(20),
                Tables\Columns\TextColumn::make('bank')->label('Banco'),
                Tables\Columns\ImageColumn::make('qrcode')->label('QR Code'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
