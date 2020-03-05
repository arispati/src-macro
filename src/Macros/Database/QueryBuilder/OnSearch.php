<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onSearch', function (array $columns = [], string $searchParam = 'search') {
    $request = app('request');

    if ($request->filled($searchParam) && count($columns)) {
        $this->where(function ($query) use ($request, $columns, $searchParam) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . $request->get($searchParam) . '%');
            }
        });
    }

    return $this;
});
