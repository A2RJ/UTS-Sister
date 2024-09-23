<?php

namespace App\Filament\Resources\Wr3;

use App\Filament\Lecture\Resources\Wr3\DedicationResource as Wr3DedicationResource;
use App\Filament\Resources\Wr3\DedicationResource\Pages;
use App\Filament\Resources\Wr3\DedicationResource\RelationManagers;
use App\Models\User;
use App\Models\Wr3\Dedication;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;

class DedicationResource extends Resource
{
    protected static ?string $model = Dedication::class;
    protected static ?string $label = "Pengabdian";
    protected static ?string $navigationGroup = "Warek 3";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $currentForm = new Wr3DedicationResource();
        return $currentForm->form($form);
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
                Tables\Actions\Action::make('addLetterNumber')
                    ->label('Tambah/Ubah nomor surat')
                    ->visible(fn(Dedication $record) => $record->participant->count() == 0 ? true : $record->participant->count() === $record->participant->whereNotNull('attachment')->count())
                    ->url(fn(Dedication $record) => route('filament.warek3.resources.wr3.dedications.add-letter-number', ['record' => $record->id]))
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
            'add-letter-number' => Pages\AddLetterNumber::route('/{record}/letter-number')
        ];
    }
}
