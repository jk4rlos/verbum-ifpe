<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationGroup = 'Conteúdo Dinâmico';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Mídia';

    protected static ?string $pluralModelLabel = 'Mídias';

    protected static ?string $modelLabel = 'Mídia';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Mídia')
                    ->description('Configure os detalhes e tipo de mídia')
                    ->icon('heroicon-o-photo')
                    ->iconColor('primary')
                    ->columns(2)
                    ->schema([

                        Grid::make(1)->schema([
                            TextInput::make('title')
                                ->label('Título')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Ex: Homilia Dominical, Podcast #42...')
                                ->prefixIcon('heroicon-m-document-text'),

                            Select::make('type')
                                ->label('Tipo de Mídia')
                                ->options([
                                    'image' => '🖼️ Imagem',
                                    'audio_spotify' => '🎵 Áudio (Spotify/Podcast)',
                                    'audio_file' => '🎧 Áudio (Arquivo)',
                                    'video_youtube' => '🎬 Vídeo (YouTube)',
                                ])
                                ->required()
                                ->native(false)
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->prefixIcon('heroicon-m-queue-list')
                                ->helperText('Selecione o tipo de mídia que deseja adicionar'),
                        ]),

                        Section::make('Upload de Arquivo')
                            ->description('Envie o arquivo de mídia ou informe o link')
                            ->icon('heroicon-o-cloud-arrow-up')
                            ->collapsed()
                            ->schema([
                                FileUpload::make('file_url')
                                    ->label(fn ($get) => match ($get('type')) {
                                        'image' => 'Arquivo de Imagem',
                                        'audio_file' => 'Arquivo de Áudio',
                                        default => 'Arquivo'
                                    })
                                    ->image()
                                    ->multiple()
                                    ->maxFiles(10)
                                    ->minFiles(1)
                                    ->directory('media')
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                                    ->acceptedFileTypes(fn ($get) => match ($get('type')) {
                                        'image' => [
                                            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg',
                                            'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                                            'image/webp', 'image/svg+xml', 'image/svg'
                                        ],
                                        'audio_file' => [
                                            'mp3', 'wav', 'm4a', 'ogg',
                                            'audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/m4a', 'audio/ogg'
                                        ],
                                        default => []
                                    })
                                    ->maxSize(fn ($get) => $get('type') === 'image' ? 5120 : 51200) // 5MB imagens, 50MB áudio
                                    ->visible(fn ($get) => in_array($get('type'), ['image', 'audio_file']))
                                    ->helperText(fn ($get) => match ($get('type')) {
                                        'image' => 'Formatos: JPG, PNG, GIF, WebP, SVG (máx. 5MB cada, até 10 arquivos)',
                                        'audio_file' => 'Formatos: MP3, WAV, M4A, OGG (máx. 50MB cada, até 10 arquivos)',
                                        default => ''
                                    })
                                    ->imagePreviewHeight('150'),

                                TextInput::make('link_url')
                                    ->label(fn ($get) => match ($get('type')) {
                                        'audio_spotify' => 'Link do Spotify/Podcast',
                                        'video_youtube' => 'Link do YouTube',
                                        default => 'Link'
                                    })
                                    ->url()
                                    ->placeholder(fn ($get) => match ($get('type')) {
                                        'audio_spotify' => 'https://open.spotify.com/...',
                                        'video_youtube' => 'https://youtube.com/watch?v=...',
                                        default => 'https://...'
                                    })
                                    ->visible(fn ($get) => in_array($get('type'), ['audio_spotify', 'video_youtube']))
                                    ->helperText(fn ($get) => match ($get('type')) {
                                        'audio_spotify' => 'Cole o link completo do Spotify ou plataforma de podcast',
                                        'video_youtube' => 'Cole o link completo do vídeo do YouTube',
                                        default => ''
                                    })
                                    ->prefixIcon('heroicon-m-link'),
                            ]),

                        Section::make('Detalhes Adicionais')
                            ->description('Informações complementares sobre a mídia')
                            ->icon('heroicon-o-information-circle')
                            ->collapsed()
                            ->schema([
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->maxLength(500)
                                    ->placeholder('Descreva o conteúdo da mídia, contexto, data, etc.')
                                    ->rows(3)
                                    ->helperText('Descrição detalhada da mídia (opcional)')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color(Color::Blue)
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    }),

                BadgeColumn::make('type')
                    ->label('Tipo')
                    ->colors([
                        'primary' => 'image',
                        'success' => 'audio_spotify',
                        'warning' => 'audio_file',
                        'danger' => 'video_youtube',
                    ])
                    ->icons([
                        'heroicon-m-camera' => 'image',
                        'heroicon-m-musical-note' => 'audio_spotify',
                        'heroicon-m-speaker-wave' => 'audio_file',
                        'heroicon-m-video-camera' => 'video_youtube',
                    ])
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'image' => 'Imagem',
                            'audio_spotify' => 'Áudio Spotify',
                            'audio_file' => 'Áudio Arquivo',
                            'video_youtube' => 'Vídeo YouTube',
                            default => $state,
                        };
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('file_url')
                    ->label('Arquivo')
                    ->limit(30)
                    ->placeholder('Sem arquivo')
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (!$state) return null;

                        if (is_array($state)) {
                            $fileName = !empty($state) ? $state[0] : '';
                        } else {
                            $fileName = $state;
                        }

                        return $fileName ? 'Arquivo: ' . basename($fileName) : null;
                    })
                    ->color(Color::Green)
                    ->icon('heroicon-m-document')
                    ->copyable()
                    ->copyMessage('URL do arquivo copiada!')
                    ->copyMessageDuration(1500),

                TextColumn::make('link_url')
                    ->label('Link')
                    ->limit(30)
                    ->placeholder('Sem link')
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state ? 'Link: ' . $state : null;
                    })
                    ->color(Color::Purple)
                    ->icon('heroicon-m-link')
                    ->copyable()
                    ->copyMessage('Link copiado!')
                    ->copyMessageDuration(1500),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->placeholder('Sem descrição')
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color(Color::Gray),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filtrar por tipo')
                    ->options([
                        'image' => 'Imagem',
                        'audio_spotify' => 'Áudio (Spotify/Podcast)',
                        'audio_file' => 'Áudio (Arquivo)',
                        'video_youtube' => 'Vídeo (YouTube)',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Visualizar')
                        ->icon('heroicon-m-eye'),
                    Tables\Actions\EditAction::make()
                        ->label('Editar')
                        ->icon('heroicon-m-pencil-square')
                        ->color(Color::Blue),
                    Tables\Actions\Action::make('preview')
                        ->label('Preview')
                        ->icon('heroicon-m-play')
                        ->color(Color::Green)
                        ->url(fn ($record) => match ($record->type) {
                            'video_youtube' => $record->link_url,
                            'audio_spotify' => $record->link_url,
                            default => null,
                        })
                        ->openUrlInNewTab()
                        ->visible(fn ($record) => in_array($record->type, ['video_youtube', 'audio_spotify'])),
                    Tables\Actions\DeleteAction::make()
                        ->label('Excluir')
                        ->icon('heroicon-m-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Confirmar exclusão')
                        ->modalDescription('Tem certeza que deseja excluir esta mídia? Esta ação não pode ser desfeita.')
                        ->modalSubmitActionLabel('Sim, excluir')
                        ->color(Color::Red),
                ])
                ->icon('heroicon-m-ellipsis-horizontal')
                ->color(Color::Gray)
                ->tooltip('Ações'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Excluir selecionados')
                        ->icon('heroicon-m-trash')
                        ->color(Color::Red)
                        ->requiresConfirmation()
                        ->modalHeading('Excluir mídias selecionadas')
                        ->modalDescription('Tem certeza que deseja excluir as mídias selecionadas? Esta ação não pode ser desfeita.')
                        ->modalSubmitActionLabel('Sim, excluir todos'),
                ])
                ->color(Color::Gray),
            ])
            ->emptyStateHeading('Nenhuma mídia cadastrada')
            ->emptyStateDescription('Comece adicionando imagens, vídeos ou áudios para enriquecer seu conteúdo.')
            ->emptyStateIcon('heroicon-o-photo')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Adicionar primeira mídia')
                    ->icon('heroicon-m-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
