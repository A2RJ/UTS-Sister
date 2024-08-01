<?php

namespace App\Filament\Lecture\Resources\ResearchProposalResource\Pages;

use App\Filament\Lecture\Resources\ResearchProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearchProposal extends EditRecord
{
    protected static string $resource = ResearchProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
