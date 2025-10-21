<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeeklyWarningResource\Pages;
use App\Models\WeeklyWarning;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class WeeklyWarningResource extends Resource
{
    protected static ?string $model = WeeklyWarning::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Avisos Semanais';
    protected static ?string $pluralLabel = 'Avisos Semanais';
    protected static ?string $modelLabel = 'Aviso Semanal';
    protected static ?string $navigationGroup = 'Conteúdo Dinâmico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações principais')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('link')
                            ->label('Link (opcional)')
                            ->url()
                            ->placeholder('https://exemplo.com')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Conteúdo')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Conteúdo')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Período de Exibição')
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Data de Início')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        DatePicker::make('endDate')
                            ->label('Data de Término')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                    ])
                    ->columns(2),

                Section::make('Imagem ou Anexo')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagem ou Arquivo')
                            ->imagePreviewHeight('150')
                            ->maxSize(1024)
                            ->directory(function () {
                                return 'weekly-warnings/' . date('Y/m');
                            })
                            ->downloadable()
                            ->preserveFilenames(false)
                            ->getUploadedFileNameForStorageUsing(function (\Illuminate\Http\UploadedFile $file) {
                                $hash = hash('sha256', $file->getContent());
                                $extension = $file->getClientOriginalExtension();
                                return $hash . '.' . $extension;
                            })
                            ->acceptedFileTypes(['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'doc', 'docx']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagem')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('startDate')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('endDate')
                    ->label('Término')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeeklyWarnings::route('/'),
            'create' => Pages\CreateWeeklyWarning::route('/create'),
            'edit' => Pages\EditWeeklyWarning::route('/{record}/edit'),
        ];
    }
}
