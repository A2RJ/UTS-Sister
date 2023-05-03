<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait UtilsFunction
{
    // bisa menerapkan query lain seperti where namun perhatikan AND, OR dalam query
    public function scopeSearch(Builder $query, ?string $keyword, array $columns = [], array $relations = [])
    {
        return $query->when($keyword, function ($query) use ($keyword, $columns, $relations) {
            $query->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            });

            foreach ($relations as $relation => $callback) {
                $query->orWhereHas($relation, $callback);
            }

            return $query;
        });
    }

    public function scopeSearchManual(Builder $query, ?string $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            return $query
                ->whereHas('humanResource', function ($query) use ($keyword) {
                    $query->where('sdm_name', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('proposal_title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('grant_scheme', 'LIKE', "%$keyword%")
                ->orWhere('target_outcomes', 'LIKE', "%$keyword%")
                ->orWhere('application_status', 'LIKE', "%$keyword%")
                ->orWhere('publication_title', 'LIKE', "%$keyword%")
                ->orWhere('author_status', 'LIKE', "%$keyword%")
                ->orWhere('journal_name', 'LIKE', "%$keyword%");
        });
    }

    // return OffCampusActivity::select('sdm_id', 'title as judul')->export(['sdm_id', 'judul']);
    public function scopeExport($query, ?array $columns = null): StreamedResponse
    {
        if ($columns === null) {
            $data = $query->get();
        } else {
            $data = $query->get($columns);
        }

        return (new FastExcel($data))
            ->download($this->getTable() . '.xlsx');
    }
}
