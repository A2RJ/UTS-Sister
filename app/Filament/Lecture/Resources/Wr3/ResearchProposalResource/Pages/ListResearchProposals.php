<?php

namespace App\Filament\Lecture\Resources\Wr3\ResearchProposalResource\Pages;

use App\Filament\Lecture\Resources\Wr3\ResearchProposalResource;
use Closure;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListResearchProposals extends ListRecords
{
    protected static string $resource = ResearchProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder|null
    {
        return parent::getTableQuery()
            ->whereDate('created_at', '>', '2024-08-01')
            ->where('sdm_id', auth()->id())
            ->orWhereHas('participant', function (Builder $query) {
                $query->where('human_resource_id', auth()->id());
            })
            ->orderBy('created_at');
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()->recordUrl(null);
    }
}
