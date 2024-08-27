<?php

namespace App\Filament\Lecture\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;
use App\Filament\Lecture\Resources\Wr3\DedicationResource\RelationManagers;
use App\Models\User;
use App\Models\Wr3\Dedication;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Html;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class DedicationResource extends Resource
{
    protected static ?string $model = Dedication::class;
    protected static ?string $label = "Pengabdian";
    protected static ?string $navigationGroup = "Warek 3";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->description('Form Pengabdian')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Hidden::make('sdm_id')
                            ->default(auth()->id()),
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->default(auth()->user()->sdm_name),
                        Forms\Components\TextInput::make('nidn')
                            ->label('NIDN')
                            ->disabled()
                            ->default(auth()->user()->nidn),
                        Forms\Components\TextInput::make('role')
                            ->label('Jabatan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('as')
                            ->label('Sebagai')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('theme')
                            ->label('Tema')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Pengabdian')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('funding_source')
                            ->label('Sumber Pendanaan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('funding_amount')
                            ->label('Jumlah Pendanaan')
                            ->prefix('RP.')
                            ->numeric()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('location')
                            ->label('Tempat')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('proposal_file')
                            ->label('File Proposal')
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(),
                        Forms\Components\FileUpload::make('report_file')
                            ->label('Laporan Pengabdian')
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('Diisi jika pengabdian telah selesai')
                            ->nullable(),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Dimulai')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->nullable(),
                        Forms\Components\Textarea::make('target_activity_outputs')
                            ->label('Target Luaran Kegiatan')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('public_media_publications')
                            ->label('Luaran Publikasi Media Masa')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('scientific_publications')
                            ->label('Luaran Publikasi Ilmiah')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('participants')
                            ->label('Anggota')
                            ->relationship('participant')
                            ->minItems(1)
                            ->columnSpanFull()
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
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('humanResource.sdm_name')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('humanResource.nidn')
                    ->label('NIDN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('as')
                    ->label('Sebagai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('theme')
                    ->label('Tema')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Pengabdian')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('participant')
                    ->label('Bukti Pengabdian')
                    ->formatStateUsing(function (Dedication $record) {
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
                    ->formatStateUsing(function (Dedication $record) {
                        $letterNumber = $record->letterNumber;
                        return "$letterNumber->number/$letterNumber->month/$letterNumber->year - " .
                            Carbon::createFromDate($record->letterNumber->accepted_date)->translatedFormat('l, j F Y');
                    })
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('funding_source')
                    ->label('Sumber Pendanaan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('funding_amount')
                    ->label('Jumlah Pendanaan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('proposal_file')
                    ->label('File Proposal')
                    ->formatStateUsing(fn(Dedication $record) => Html::tag('a', 'File', ['href' => "/storage/{$record->proposal_file}", 'class' => 'text-blue-500']))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('report_file')
                    ->label('Laporan Pengabdian')
                    ->formatStateUsing(fn(Dedication $record) => Html::tag('a', 'File', ['href' => "/storage/{$record->report_file}", 'class' => 'text-blue-500']))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Dimulai')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location')
                    ->label('Tempat')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->visible(fn(Dedication $record) => $record->sdm_id == auth()->id() && $record->letterNumber != null)
                    ->url(fn(Dedication $record) => route('filament.generateLetter.dedication', ['dedication' => $record->id]))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->visible(fn(Dedication $record) => $record->sdm_id == auth()->id()),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn(Dedication $record) => $record->sdm_id == auth()->id()),
                // members
                Tables\Actions\Action::make('updateByMembers')
                    ->label('Upload bukti pengabdian')
                    ->visible(fn(Dedication $record) => $record->sdm_id != auth()->id())
                    ->url(fn(Dedication $record) => route('filament.lecture.resources.wr3.dedications.upload-proof-member', ['record' => $record->id]))
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
            'upload-proof-member' => Pages\UploadProofMember::route('/{record}/upload-proof-member')
        ];
    }
}
