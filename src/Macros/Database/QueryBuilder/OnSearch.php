<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onSearch', function (array $columns = [], string $searchParam = 'search') {
    if (app('request')->filled($searchParam) && count($columns)) {
        $this->where(function ($query) use ($columns, $searchParam) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . app('request')->get($searchParam) . '%');
            }
        });
    }

    return $this;
});
