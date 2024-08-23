<?php

namespace App\Filament\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Resources\Wr3\ResearchProposalResource;
use App\Models\Wr3\LetterNumber;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Illuminate\Support\Js;

class AddLetterNumber extends Page
{
    use InteractsWithRecord;
    public ?array $data = [];
    public LetterNumber $letterNumber;
    protected static ?string $breadcrumb = "Form Nomor Surat";
    protected static ?string $title = "Form Nomor Surat";
    protected static string $resource = ResearchProposalResource::class;
    protected static string $view = 'filament.resources.wr3.research-proposal-resource.pages.add-letter-number';


    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $check = LetterNumber::query()
            ->whereProposalId($record)
            ->first();
        if (is_null($check)) {
            $this->letterNumber = LetterNumber::query()
                ->create(['proposal_id' => $record]);
        } else {
            $this->letterNumber = $check;
        }
        $this->form->fill($this->letterNumber->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->label('Form')
                    ->description('Form Proposal Riset')
                    ->schema([
                        TextInput::make('number')
                            ->label('Nomor')
                            ->numeric()
                            ->required(),
                        Select::make('month')
                            ->label('Bulan')
                            ->required()
                            ->options([
                                "1" => "1",
                                "2" => "2",
                                "3" => "3",
                                "4" => "4",
                                "5" => "5",
                                "6" => "6",
                                "7" => "7",
                                "8" => "8",
                                "9" => "9",
                                "10" => "10",
                                "11" => "11",
                                "12" => "12",
                            ]),
                        TextInput::make('year')
                            ->label('Tahun')
                            ->numeric()
                            ->required(),
                        DatePicker::make('accepted_date')
                            ->label('Tanggal Disetujui')
                            ->required(),
                    ])
                    ->footerActions([
                        Action::make('save')
                            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                        Action::make('cancel')
                            ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')')
                            ->color('gray')
                    ])
            ])
            ->statePath('data')
            ->model($this->letterNumber);
    }

    public function create(): void
    {
        $this->letterNumber->update($this->form->getState());
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
