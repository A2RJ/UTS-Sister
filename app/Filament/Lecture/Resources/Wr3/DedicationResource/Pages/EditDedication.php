<?php

namespace App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;

use App\Filament\Lecture\Resources\Wr3\DedicationResource;
use App\Models\User;
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

    public function mutateFormDataBeforeFill(array $data): array
    {
        $user = User::query()
            ->whereId($data['sdm_id'])
            ->first();
        $data['name'] = $user->sdm_name;
        $data['nidn'] = $user->nidn;

        return $data;
    }
}
