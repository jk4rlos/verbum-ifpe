<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfessionResource\Pages;
use App\Models\Confession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Colors\Color;

class ConfessionResource extends Resource
{
    protected static ?string $model = Confession::class;
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Confissões';
    protected static ?string $pluralModelLabel = 'Confissões';
    protected static ?string $navigationGroup = 'Horários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Confissão')
                    ->description('Configure os horários e detalhes das confissões')
                    ->icon('heroicon-o-heart')
                    ->iconColor('danger')
                    ->columns(2)
                    ->schema([

                        Grid::make(1)->schema([
                            Forms\Components\Select::make('dayweek')
                                ->label('Dia da Semana')
                                ->options([
                                    'Segunda-feira' => 'Segunda-feira',
                                    'Terça-feira' => 'Terça-feira',
                                    'Quarta-feira' => 'Quarta-feira',
                                    'Quinta-feira' => 'Quinta-feira',
                                    'Sexta-feira' => 'Sexta-feira',
                                    'Sábado' => 'Sábado',
                                    'Domingo' => 'Domingo',
                                ])
                                ->required()
                                ->native(false)
                                ->searchable()
                                ->preload()
                                ->columnSpanFull()
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('dayweek')
                                        ->label('Nome do dia')
                                        ->required(),
                                ]),
                        ]),

                        TimePicker::make('time')
                            ->label('Horário de Início')
                            ->seconds(false)
                            ->required()
                            ->prefixIcon('heroicon-m-clock')
                            ->helperText('Quando começam as confissões'),

                        TimePicker::make('end_time')
                            ->label('Horário de Término')
                            ->seconds(false)
                            ->required()
                            ->prefixIcon('heroicon-m-clock')
                            ->helperText('Quando terminam as confissões'),

                        Section::make('Observações')
                            ->description('Informações adicionais sobre as confissões')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->collapsed()
                            ->schema([
                                RichEditor::make('description')
                                    ->label('Descrição / Observações')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'unorderedList',
                                        'undo',
                                        'redo',
                                    ])
                                    ->placeholder('Ex: Confissões antes da missa das 18h, apenas para idosos, etc.')
                                    ->columnSpanFull()
                                    ->maxLength(500),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dayweek')
                    ->label('Dia')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->color(Color::Blue)
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'Domingo' => '🌟 Domingo',
                            'Segunda-feira' => '📅 Segunda-feira',
                            'Terça-feira' => '📅 Terça-feira',
                            'Quarta-feira' => '📅 Quarta-feira',
                            'Quinta-feira' => '📅 Quinta-feira',
                            'Sexta-feira' => '📅 Sexta-feira',
                            'Sábado' => '📅 Sábado',
                            default => $state,
                        };
                    }),

                TextColumn::make('time')
                    ->label('Início')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i'))
                    ->weight(FontWeight::SemiBold)
                    ->color(Color::Green)
                    ->prefix('🕐 ')
                    ->alignCenter(),

                TextColumn::make('end_time')
                    ->label('Término')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i'))
                    ->weight(FontWeight::SemiBold)
                    ->color(Color::Red)
                    ->prefix('🕐 ')
                    ->alignCenter(),

                TextColumn::make('duration')
                    ->label('Duração')
                    ->getStateUsing(function ($record) {
                        if ($record->time && $record->end_time) {
                            $start = \Carbon\Carbon::parse($record->time);
                            $end = \Carbon\Carbon::parse($record->end_time);
                            $minutes = $start->diffInMinutes($end);
                            $hours = intval($minutes / 60);
                            $mins = $minutes % 60;

                            if ($hours > 0) {
                                return "{$hours}h {$mins}min";
                            }
                            return "{$mins}min";
                        }
                        return '-';
                    })
                    ->badge()
                    ->color(Color::Orange)
                    ->alignCenter(),

                TextColumn::make('description')
                    ->label('Observações')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->placeholder('Sem observações')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color(Color::Gray),
            ])
            ->defaultSort('dayweek', 'asc')
            ->defaultSort('time', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('dayweek')
                    ->label('Filtrar por dia')
                    ->options([
                        'Domingo' => 'Domingo',
                        'Segunda-feira' => 'Segunda-feira',
                        'Terça-feira' => 'Terça-feira',
                        'Quarta-feira' => 'Quarta-feira',
                        'Quinta-feira' => 'Quinta-feira',
                        'Sexta-feira' => 'Sexta-feira',
                        'Sábado' => 'Sábado',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Ver detalhes')
                        ->icon('heroicon-m-eye'),
                    Tables\Actions\EditAction::make()
                        ->label('Editar')
                        ->icon('heroicon-m-pencil-square')
                        ->color(Color::Blue),
                    Tables\Actions\DeleteAction::make()
                        ->label('Excluir')
                        ->icon('heroicon-m-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Confirmar exclusão')
                        ->modalDescription('Tem certeza que deseja excluir este horário de confissão? Esta ação não pode ser desfeita.')
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
                        ->modalHeading('Excluir horários selecionados')
                        ->modalDescription('Tem certeza que deseja excluir os horários selecionados? Esta ação não pode ser desfeita.')
                        ->modalSubmitActionLabel('Sim, excluir todos'),
                ])
                ->color(Color::Gray),
            ])
            ->emptyStateHeading('Nenhum horário de confissão cadastrado')
            ->emptyStateDescription('Comece cadastrando os horários de confissão da sua paróquia.')
            ->emptyStateIcon('heroicon-o-heart')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Cadastrar primeiro horário')
                    ->icon('heroicon-m-plus'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConfessions::route('/'),
            'create' => Pages\CreateConfession::route('/create'),
            'edit' => Pages\EditConfession::route('/{record}/edit'),
        ];
    }
}
