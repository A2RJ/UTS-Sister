<?php

namespace App\Filament\Lecture\Resources;

use App\Filament\Lecture\Resources\ResearchProposalResource\Pages;
use App\Filament\Lecture\Resources\ResearchProposalResource\RelationManagers;
use App\Models\Wr3\ResearchProposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResearchProposalResource extends Resource
{
    protected static ?string $model = ResearchProposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sdm_id')
                    ->numeric(),
                Forms\Components\TextInput::make('proposal_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('grant_scheme')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('start')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('end')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('participants')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('target_outcomes')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('proposal_file')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('application_status')
                    ->required(),
                Forms\Components\TextInput::make('contract_period')
                    ->maxLength(255),
                Forms\Components\TextInput::make('funding_amount')
                    ->maxLength(255),
                Forms\Components\Toggle::make('verification')
                    ->required(),
                Forms\Components\TextInput::make('publication_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('author_status'),
                Forms\Components\TextInput::make('journal_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('publication_year')
                    ->maxLength(255),
                Forms\Components\TextInput::make('volume_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('publication_date_year')
                    ->maxLength(255),
                Forms\Components\TextInput::make('publisher')
                    ->maxLength(255),
                Forms\Components\TextInput::make('journal_accreditation_status'),
                Forms\Components\TextInput::make('journal_publication_link')
                    ->maxLength(255),
                Forms\Components\TextInput::make('journal_pdf_file')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sdm_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proposal_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grant_scheme')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_outcomes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('proposal_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('application_status'),
                Tables\Columns\TextColumn::make('contract_period')
                    ->searchable(),
                Tables\Columns\TextColumn::make('funding_amount')
                    ->searchable(),
                Tables\Columns\IconColumn::make('verification')
                    ->boolean(),
                Tables\Columns\TextColumn::make('publication_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author_status'),
                Tables\Columns\TextColumn::make('journal_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('volume_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_date_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('journal_accreditation_status'),
                Tables\Columns\TextColumn::make('journal_publication_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('journal_pdf_file')
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
            'index' => Pages\ListResearchProposals::route('/'),
            'create' => Pages\CreateResearchProposal::route('/create'),
            'edit' => Pages\EditResearchProposal::route('/{record}/edit'),
        ];
    }
}
