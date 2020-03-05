<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onSort', function (
    array $columns = [],
    string $sortParam = 'sort',
    string $sortTypeParam = 'sort_type'
) {
    if (app('request')->filled($sortParam)) {
        $sortParams = explode(',', app('request')->get($sortParam));
        $order      = app('request')->filled($sortTypeParam)
            ? app('request')->get($sortTypeParam)
            : 'asc';

        foreach ($sortParams as $column) :
            if (count($columns)) {
                if (! is_numeric($column) && isset($columns[$column])) {
                    $this->orderBy($columns[$column], $order);
                } elseif (in_array($column, $columns)) {
                    $this->orderBy($column, $order);
                }
            } else {
                $this->orderBy($column, $order);
            }
        endforeach;
    }

    return $this;
});
