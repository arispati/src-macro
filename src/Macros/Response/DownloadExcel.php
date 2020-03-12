<?php

namespace Arispati\SrcMacro\Macros\Response;

use Illuminate\Routing\ResponseFactory;

ResponseFactory::macro('downloadExcel', function (object $class, string $fileName) {
    if (! in_array('Maatwebsite\Excel\Concerns\Exportable', class_uses($class))) {
        throw new \Exception(get_class($class) . " must use Maatwebsite\Excel\Concerns\Exportable trait");
    } else {
        $class->store("excel/{$fileName}", 'local');
        
        $excelPath = storage_path("app/excel/{$fileName}");
    
        $downloadExcel = response()->download($excelPath, $fileName, [
            'Access-Control-Allow-Origin'   => '*',
            'Access-Control-Allow-Methods'  => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'  => 'X-Requested-With, Content-Type, X-Token-Auth, Authorization'
        ]);

        register_shutdown_function('unlink', $excelPath);

        return $downloadExcel;
    }
});
