<?php

namespace App\Filament\Resources\ResearchProposalResource\Pages;

use App\Filament\Resources\ResearchProposalResource;
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
