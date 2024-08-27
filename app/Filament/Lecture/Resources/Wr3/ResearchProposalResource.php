<?php

namespace App\Filament\Lecture\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;
use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\RelationManagers;
use App\Http\Middleware\Riset;
use App\Models\Participant;
use App\Models\User;
use App\Models\Wr3\LetterNumber;
use App\Models\Wr3\ResearchProposal;
use Auth;
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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ResearchProposalResource extends Resource
{
    protected static ?string $model = ResearchProposal::class;
    protected static ?string $label = "Proposal Riset";
    protected static ?string $navigationGroup = "Warek 3";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static string|array $routeMiddleware = ['riset'];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description('Form Proposal Riset')
                    ->schema([
                        Forms\Components\Hidden::make('sdm_id')
                            ->default(auth()->id()),
                        Forms\Components\Grid::make([
                            'default' => 1,
                            'sm' => 2
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->disabled()
                                    ->default(auth()->user()->sdm_name),
                                Forms\Components\TextInput::make('nidn')
                                    ->label('NIDN')
                                    ->disabled()
                                    ->default(auth()->user()->nidn),
                            ]),
                        Forms\Components\Textarea::make('proposal_title')
                            ->label('Judul Proposal')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('grant_scheme')
                            ->label('Skema Hibah')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make([
                            'default' => 1,
                            'sm' => 3
                        ])
                            ->schema([
                                Forms\Components\DatePicker::make('start')
                                    ->label('Terhitung Mulai')
                                    ->required(),
                                Forms\Components\DatePicker::make('end')
                                    ->label('Sampai Dengan')
                                    ->required(),
                                Forms\Components\TextInput::make('location')
                                    ->label('Lokasi')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Repeater::make('participants')
                            ->label('Anggota')
                            ->relationship('participant')
                            ->minItems(1)
                            ->columns(2)
                            ->schema([
                                Forms\Components\Select::make('human_resource_id')
                                    ->label('Nama')
                                    ->searchable()
                                    ->options(
                                        User::query()
                                            // ->whereSdmType('Dosen')
                                            ->get(['sdm_name', 'nidn', 'id'])
                                            ->mapWithKeys(function ($item) {
                                                return [$item->id => $item->sdm_name . ' - ' . $item->nidn];
                                            })
                                    )
                                    ->required(),
                                Forms\Components\TextInput::make('role')
                                    ->label('Peran')
                                    ->required(),
                            ]),
                        Forms\Components\Textarea::make('target_outcomes')
                            ->label('Target Luaran')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('proposal_file')
                            ->label('Upload File Proposal')
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(),
                        Forms\Components\Grid::make([
                            'default' => 2
                        ])
                            ->schema([
                                Forms\Components\DatePicker::make('contract_period')
                                    ->label('Periode Kontrak')
                                    ->required(),
                                Forms\Components\TextInput::make('funding_amount')
                                    ->label('Jumlah Pendanaan')
                                    ->prefix('RP. ')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('application_status')
                            ->label('Status Ajuan')
                            ->required()
                            ->live()
                            ->options([
                                'Lolos pendanaan' => 'Lolos pendanaan',
                                'Selesai penelitian' => 'Selesai penelitian',
                            ]),
                        Forms\Components\Grid::make([
                            'default' => 2
                        ])
                            ->visible(fn(Get $get) => $get('application_status') == 'Selesai penelitian')
                            ->schema([
                                Forms\Components\Select::make('author_status')
                                    ->label('Status Penulis')
                                    ->required()
                                    ->options([1, 2, 3, 'correspondence author']),
                                Forms\Components\TextInput::make('publication_title')
                                    ->label('Judul Publikasi')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('journal_name')
                                    ->label('Nama Jurnal')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('publication_year')
                                    ->label('Tahun')
                                    ->required(),
                                Forms\Components\TextInput::make('volume_number')
                                    ->label('Vol/No.')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('publication_date_year')
                                    ->label('Tanggal & Tahun Terbit')
                                    ->required(),
                                Forms\Components\TextInput::make('publisher')
                                    ->label('Penerbit')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('journal_accreditation_status')
                                    ->label('Status Akreditasi Jurnal')
                                    ->required()
                                    ->options([
                                        'International' => 'International',
                                        'Nationally' => 'Nationally accredited',
                                        'Internal' => 'Internal'
                                    ]),
                                Forms\Components\TextInput::make('journal_publication_link')
                                    ->label('Link Jurnal Publikasi')
                                    ->required()
                                    ->url()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('journal_pdf_file')
                                    ->label('Jurnal File')
                                    ->helperText('File .pdf')
                                    ->columnSpanFull()
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required(),
                            ])
                    ])
            ]);
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
                    ->label('Bukti Pengabdian')
                    ->formatStateUsing(function (ResearchProposal $record) {
                        $participants = $record->participant;
                        $listItems = $participants->map(function ($participant) {
                            if ($participant->attachment) {
                                return "<li class='list-disc'><a href='/storage/{$participant->attachment}' class='text-blue-500'>{$participant->humanResource->sdm_name}</a></li>";
                            }
                            return "<li class='list-disc'><a href='#' class=''>{$participant->humanResource->sdm_name}</a></li>";
                        })->implode('');

                        return new HtmlString("<ul class='list-inside'>{$listItems}</ul>");
                    })
                    ->searchable(),
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
            ->selectable()
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $user = User::query()
                            ->whereId($data['sdm_id'])
                            ->first();
                        $data['name'] = $user?->sdm_name;
                        $data['nidn'] = $user?->nidn;

                        return $data;
                    }),
                // author
                Tables\Actions\Action::make('donwload')
                    ->label('Unduh Surat')
                    ->visible(fn(ResearchProposal $record) => $record->sdm_id == auth()->id() && $record->letterNumber != null)
                    ->url(fn(ResearchProposal $record) => route('filament.generateLetter', ['researchProposal' => $record->id]))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->visible(fn(ResearchProposal $record) => $record->sdm_id == auth()->id()),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn(ResearchProposal $record) => $record->sdm_id == auth()->id()),

                // member
                Tables\Actions\Action::make('updateByMembers')
                    ->label('Upload bukti riset')
                    ->visible(fn(ResearchProposal $record) => $record->sdm_id != auth()->id())
                    ->url(fn(ResearchProposal $record) => route('filament.lecture.resources.wr3.research-proposals.upload-proof-member', ['record' => $record->id]))
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
            'upload-proof-member' => Pages\UploadProofMember::route('/{record}/upload-proof-member')
        ];
    }
}
