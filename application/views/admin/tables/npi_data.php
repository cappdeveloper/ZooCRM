<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* Database Table Columns*/

$aColumns = [
    'NPI',
    'FirstName',
    'LastName',
    'tbltaxnomy_value.Tax_Name',
    'FirstPracticeAddress',
    'PracticeCity',
    'PracticeState',
    'PracticeTelephone',
    'BusinessTelephone',
    'PracticeCountry'
               ];
/* Used for search by and Indexing*/

$sIndexColumn ='NPI' ;
$sTable       = db_prefix() . 'npi_bulk';

$where        = [
           
    ];
      
$join = [
    'INNER JOIN ' . db_prefix() . 'taxnomy_value ON ' . db_prefix() . 'taxnomy_value.Tax_value = ' . db_prefix() . 'npi_bulk.TaxonomyCode'];
//print_r($join);die;  
$result = data_tables_init($aColumns, $sIndexColumn, $sTable,$join, $where, [/* Extra column you want to search*/]);

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


