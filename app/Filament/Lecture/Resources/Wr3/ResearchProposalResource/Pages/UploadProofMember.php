<?php

namespace App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource;
use App\Models\Participant;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Js;

class UploadProofMember extends page
{
    use InteractsWithRecord;
    protected static string $resource = ResearchProposalResource::class;
    protected static string $view = "filament.lecture.resources.wr3.research-proposals.upload-proof-member";
    public ?array $data = [];
    public ?Participant $participant;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->participant = Participant::query()
            ->whereHumanResourceId(auth()->id())
            ->whereResearchProposalId($record)
            ->first();
        $this->form->fill($this->participant?->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('proof')
                    ->description('Form Proposal Riset')
                    ->schema([
                        TextInput::make('role')
                            ->label('Peran')
                            ->disabled(),
                        FileUpload::make('attachment')
                            ->label('Upload File')
                            ->helperText('File .pdf')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['application/pdf'])
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
            ->model($this->participant);

    }

    public function create(): void
    {
        $this->participant->update($this->form->getState());
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
