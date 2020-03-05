<?php

namespace Arispati\SrcMacro\Macros\Database\QueryBuilder;

use Illuminate\Database\Query\Builder;

Builder::macro('onBetween', function (
    string $column = 'created_at',
    string $startDateParam = 'start_date',
    string $endDateParam = 'end_date'
) {
    $request = app('request');

    if ($request->filled($startDateParam) && $request->filled($endDateParam)) {
        $endDate = date('Y-m-d', strtotime($request->get($endDateParam) . ' +1 day'));
        
        $this->whereBetween($column, [$request->get($startDateParam), $endDate]);
    } else {
        if ($request->filled($startDateParam)) {
            $this->where($column, '>=', $request->get($startDateParam));
        }

        if ($request->filled($endDateParam)) {
            $endDate = date('Y-m-d', strtotime($request->get($endDateParam) . ' +1 day'));

            $this->where($column, '<=', $endDate);
        }
    }

    return $this;
});
