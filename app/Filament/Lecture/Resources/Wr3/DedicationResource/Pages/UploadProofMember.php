<?php

namespace App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;

use App\Filament\Lecture\Resources\Wr3\DedicationResource;
use Filament\Forms\Components\Actions\Action;
use App\Models\Participant;
use App\Models\Wr3\Dedication;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Js;

class UploadProofMember extends Page
{
    use InteractsWithRecord;
    protected static ?string $breadcrumb = "Form Upload Bukti pengabdian";
    protected static ?string $title = "Form Upload Bukti pengabdian";
    protected static string $resource = DedicationResource::class;

    protected static string $view = 'filament.lecture.resources.wr3.dedication-resource.pages.upload-proof-member';

    public ?array $data = [];
    public ?Participant $participant;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->participant = Participant::query()
            ->whereHumanResourceId(auth()->id())
            ->whereDedicationId($record)
            ->first();
        $this->form->fill($this->participant?->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->label('Form')
                    ->description('Form Proposal Riset')
                    ->schema([
                        TextInput::make('role')
                            ->label('Peran')
                            ->disabled(),
                        TextInput::make('detail')
                            ->label('Uraian Tugas')
                            ->required(),
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
