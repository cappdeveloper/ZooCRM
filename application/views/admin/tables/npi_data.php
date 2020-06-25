<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'Tax_name',
    'Tax_value',
               ];
$sIndexColumn ='Tax_value' ;
$sTable       = db_prefix() . 'taxnomy_value';
$where        = [

    ];
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, [
   'Tax_value',
    ]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];

        $row[] = $_data;
    }


    $output['aaData'][] = $row;
}


