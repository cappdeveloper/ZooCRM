<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'NPI',
    'LastName',
    'FirstName',
               ];
$sIndexColumn ='NPI' ;
$sTable       = db_prefix() . 'npi_bulk';
$where        = [

    ];
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, [
   'NPI',
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


