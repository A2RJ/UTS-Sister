<?php

namespace App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearchProposals extends ListRecords
{
    protected static string $resource = ResearchProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
