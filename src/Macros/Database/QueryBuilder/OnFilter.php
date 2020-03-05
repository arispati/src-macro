<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onFilter', function (array $columns) {
    if (count($columns)) {
        foreach ($columns as $alias => $column) {
            if (app('request')->filled($alias)) {
                $this->where($column, app('request')->get($alias));
            } elseif (app('request')->filled($column)) {
                $this->where($column, app('request')->get($column));
            }
        }
    }

    return $this;
});
