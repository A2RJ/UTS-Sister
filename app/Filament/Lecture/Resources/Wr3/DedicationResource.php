<?php

namespace App\Filament\Lecture\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;
use App\Filament\Lecture\Resources\Wr3\DedicationResource\RelationManagers;
use App\Models\Wr3\Dedication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DedicationResource extends Resource
{
    protected static ?string $model = Dedication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sdm_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('as')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('theme')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('funding_source')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('funding_amount')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('proposal_file')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('report_file')
                    ->maxLength(255),
                Forms\Components\TextInput::make('start_date')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('end_date')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('participants')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('target_activity_outputs')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('public_media_publications')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('scientific_publications')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('human_resource.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('as')
                    ->searchable(),
                Tables\Columns\TextColumn::make('theme')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('funding_source')
                    ->searchable(),
                Tables\Columns\TextColumn::make('funding_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('proposal_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('report_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
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
            'index' => Pages\ListDedications::route('/'),
            'create' => Pages\CreateDedication::route('/create'),
            'edit' => Pages\EditDedication::route('/{record}/edit'),
        ];
    }
}
