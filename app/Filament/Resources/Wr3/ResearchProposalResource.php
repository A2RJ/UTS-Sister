<?php

namespace App\Filament\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource as Wr3ResearchProposalResource;
use App\Filament\Resources\Wr3\ResearchProposalResource\Pages;
use App\Filament\Resources\Wr3\ResearchProposalResource\RelationManagers;
use App\Models\Participant;
use App\Models\User;
use App\Models\Wr3\ResearchProposal;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Html;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ResearchProposalResource extends Resource
{
    protected static ?string $model = ResearchProposal::class;
    protected static ?string $label = "Proposal Riset";
    protected static ?string $navigationGroup = "Warek 3";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $currentForm = new Wr3ResearchProposalResource();
        return $currentForm->form($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('humanResource.sdm_name')
                    ->label('Nama')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proposal_title')
                    ->label('Judul Proposal')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grant_scheme')
                    ->label('Skema Hibah')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('participant')
                    ->label('Status Bukti Peserta')
                    ->formatStateUsing(function (ResearchProposal $record): HtmlString {
                        $isCompleted = $record->participant->count() === $record->participant->whereNotNull('attachment')->count();
                        $status = $isCompleted ? 'Selesai' : 'Belum selesai';
                        $badgeClass = $isCompleted ? 'text-green-500' : 'text-red-500';

                        return Html::tag('p', $status, ['class' => $badgeClass . ' px-2 py-1 rounded']);
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('letterNumber.number')
                    ->label('Nomor Surat')
                    ->formatStateUsing(function (ResearchProposal $record) {
                        $letterNumber = $record->letterNumber;
                        return "$letterNumber->number/$letterNumber->month/$letterNumber->year - " .
                            Carbon::createFromDate($record->letterNumber->accepted_date)->translatedFormat('l, j F Y');
                    })
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start')
                    ->label('Terhitung Mulai')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('end')
                    ->label('Sampai Dengan')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('target_outcomes')
                    ->label('Target Luaran')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('proposal_file')
                    ->label('File Proposal')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('application_status')
                    ->label('Status Ajuan')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contract_period')
                    ->label('Periode Kontrak')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('funding_amount')
                    ->label('Jumlah Pendanaan')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('publication_title')
                    ->label('Judul Publikasi')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('author_status')
                    ->label('Status Penulis')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('journal_name')
                    ->label('Nama Jurnal')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('publication_year')
                    ->label('Tahun')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('volume_number')
                    ->label('Vol/No.')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('publication_date_year')
                    ->label('Tanggal & Tahun Terbit')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('publisher')
                    ->label('Penerbit')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('journal_accreditation_status')
                    ->label('Status Akreditasi Jurnal')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('journal_publication_link')
                    ->label('Link Jurnal Publikasi')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('journal_pdf_file')
                    ->label('Jurnal File')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat Pada')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Diperbarui Pada')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('addLetterNumber')
                    ->label('Tambah nomor surat')
                    ->visible(fn(ResearchProposal $record) => $record->participant->count() === $record->participant->whereNotNull('attachment')->count())
                    ->url(fn(ResearchProposal $record) => route('filament.warek3.resources.wr3.research-proposals.add-letter-number', ['record' => $record->id]))
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
            'add-letter-number' => Pages\AddLetterNumber::route('/{record}/letter-number')
        ];
    }
}
