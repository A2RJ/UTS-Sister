<?php

namespace App\Filament\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Resources\Wr3\ResearchProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearchProposals extends ListRecords
{
    protected static string $resource = ResearchProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder|null
    {
        return parent::getTableQuery()
            ->whereDate('created_at', '>', '2024-08-01')
            ->orderBy('created_at');
    }
}
