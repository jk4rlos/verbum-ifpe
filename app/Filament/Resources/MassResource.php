<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MassResource\Pages;
use App\Filament\Resources\MassResource\RelationManagers;
use App\Models\Mass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;

class MassResource extends Resource
{
    protected static ?string $model = Mass::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Missas';
    protected static ?string $pluralModelLabel = 'Missas';
    protected static ?string $modelLabel = 'Missa';
    protected static ?string $navigationGroup = 'Horários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Missa')
                    ->description('Configure os horários e detalhes das missas')
                    ->icon('heroicon-o-user-group')
                    ->iconColor('success')
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
                            ->label('Horário da Missa')
                            ->seconds(false)
                            ->required()
                            ->prefixIcon('heroicon-m-clock')
                            ->helperText('Horário em que a missa será celebrada'),

                        Section::make('Detalhes Adicionais')
                            ->description('Informações complementares sobre a missa')
                            ->icon('heroicon-o-information-circle')
                            ->collapsed()
                            ->schema([
                                Textarea::make('description')
                                    ->label('Descrição / Observações')
                                    ->maxLength(255)
                                    ->placeholder('Ex: Missa com coro infantil, missa especial de natal, etc.')
                                    ->columnSpanFull()
                                    ->rows(3),
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
                    ->label('Horário')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('H:i'))
                    ->weight(FontWeight::SemiBold)
                    ->color(Color::Green)
                    ->prefix('🕐 ')
                    ->alignCenter(),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->placeholder('Sem descrição')
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
                        ->modalDescription('Tem certeza que deseja excluir este horário de missa? Esta ação não pode ser desfeita.')
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
                        ->modalHeading('Excluir missas selecionadas')
                        ->modalDescription('Tem certeza que deseja excluir os horários selecionados? Esta ação não pode ser desfeita.')
                        ->modalSubmitActionLabel('Sim, excluir todos'),
                ])
                ->color(Color::Gray),
            ])
            ->emptyStateHeading('Nenhum horário de missa cadastrado')
            ->emptyStateDescription('Comece cadastrando os horários de missa da sua paróquia.')
            ->emptyStateIcon('heroicon-o-church')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Cadastrar primeira missa')
                    ->icon('heroicon-m-plus'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //RelationManagers\MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMasses::route('/'),
            'create' => Pages\CreateMass::route('/create'),
            'edit' => Pages\EditMass::route('/{record}/edit'),
        ];
    }
}
