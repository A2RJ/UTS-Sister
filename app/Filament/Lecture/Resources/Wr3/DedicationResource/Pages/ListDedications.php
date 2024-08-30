<?php

namespace App\Filament\Lecture\Resources\Wr3\DedicationResource\Pages;

use App\Filament\Lecture\Resources\Wr3\DedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListDedications extends ListRecords
{
    protected static string $resource = DedicationResource::class;

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
