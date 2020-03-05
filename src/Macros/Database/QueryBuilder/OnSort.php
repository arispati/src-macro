<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onSort', function (
    array $columns = [],
    string $sortParam = 'sort',
    string $sortTypeParam = 'sort_type'
) {
    $request = app('request');

    if ($request->filled($sortParam)) {
        $sortParams = explode(',', $request->get($sortParam));
        $order      = $request->filled($sortTypeParam)
            ? $request->get($sortTypeParam)
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
