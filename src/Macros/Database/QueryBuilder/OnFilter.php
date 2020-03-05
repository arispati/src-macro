<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onFilter', function (array $columns) {
    $request = app('request');

    if (count($columns)) {
        foreach ($columns as $alias => $column) {
            if ($request->filled($alias)) {
                $this->where($column, $request->get($alias));
            } elseif ($request->filled($column)) {
                $this->where($column, $request->get($column));
            }
        }
    }

    return $this;
});
