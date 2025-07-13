<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeuntunganResource\Pages;
use App\Filament\Resources\KeuntunganResource\RelationManagers;
use App\Models\Keuntungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KeuntunganResource extends Resource
{
    protected static ?string $model = Keuntungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    
    protected static ?string $navigationLabel = 'Keuntungan';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('project', function (Builder $query) {
                $query->where('user_id', auth()->id());
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(\App\Models\Project::where('user_id', auth()->id())->pluck('nama_project', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('modal')
                    ->label('Modal')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0.00)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $modal = floatval($state) ?: 0;
                        $pendapatan = floatval($get('pendapatan')) ?: 0;
                        $total = $pendapatan - $modal;
                        $set('total_keuntungan', number_format($total, 2, '.', ''));
                    }),
                Forms\Components\TextInput::make('pendapatan')
                    ->label('Pendapatan')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0.00)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $pendapatan = floatval($state) ?: 0;
                        $modal = floatval($get('modal')) ?: 0;
                        $total = $pendapatan - $modal;
                        $set('total_keuntungan', number_format($total, 2, '.', ''));
                    }),
                Forms\Components\TextInput::make('total_keuntungan')
                    ->label('Total Keuntungan')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0.00)
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.nama_project')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('modal')
                    ->label('Modal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pendapatan')
                    ->label('Pendapatan')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_keuntungan')
                    ->label('Total Keuntungan')
                    ->money('IDR')
                    ->sortable()
                    ->color(fn (string $state): string => 
                        floatval($state) >= 0 ? 'success' : 'danger'
                    ),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeuntungans::route('/'),
            'create' => Pages\CreateKeuntungan::route('/create'),
            'edit' => Pages\EditKeuntungan::route('/{record}/edit'),
        ];
    }
}
