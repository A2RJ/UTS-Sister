<?php

namespace App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource;
use App\Models\Wr3\ResearchProposal;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearchProposal extends EditRecord
{
    protected static string $resource = ResearchProposalResource::class;
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
