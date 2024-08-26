<?php

namespace App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;

use App\Filament\Lecture\Resources\Wr3\DedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDedication extends EditRecord
{
    protected static string $resource = DedicationResource::class;

    protected function getHeaderActions(): array
    {
        $data = $this->data;
        if ($data['sdm_id'] != auth()->id()) {
            return [];
        }
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getFormActions(): array
    {
        $data = $this->data;
        if ($data['sdm_id'] != auth()->id()) {
            return [];
        }
        return parent::getFormActions();
    }
}
