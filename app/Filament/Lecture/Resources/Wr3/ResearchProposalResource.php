<?php

namespace App\Filament\Lecture\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;
use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\RelationManagers;
use App\Models\Wr3\ResearchProposal;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResearchProposalResource extends Resource
{
    protected static ?string $model = ResearchProposal::class;
    protected static ?string $label = "Proposal Riset";
    protected static ?string $navigationGroup = "Warek 3";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description('Form Proposal Riset')
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
                        Forms\Components\TextInput::make('participants')
                            ->required(),
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
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sdm_id')
                    ->wrap()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proposal_title')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grant_scheme')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_outcomes')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('proposal_file')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('application_status')
                    ->wrap(),
                Tables\Columns\TextColumn::make('contract_period')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('funding_amount')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_title')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author_status')
                    ->wrap(),
                Tables\Columns\TextColumn::make('journal_name')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_year')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('volume_number')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publication_date_year')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publisher')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('journal_accreditation_status')
                    ->wrap(),
                Tables\Columns\TextColumn::make('journal_publication_link')
                    ->wrap()
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
            'index' => Pages\ListResearchProposals::route('/'),
            'create' => Pages\CreateResearchProposal::route('/create'),
            'edit' => Pages\EditResearchProposal::route('/{record}/edit'),
        ];
    }
}
