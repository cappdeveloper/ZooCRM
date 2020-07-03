<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* Database Table Columns*/
$CI          = & get_instance();
$aColumns = [
    'NPI',
    'EntityCode',
    'FirstName',
    'LastName',
    'TaxonomyCode',
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
$where        = [];

 //'LEFT JOIN ' . db_prefix() . 'taxnomy_value ON ' . db_prefix() . 'taxnomy_value.Tax_value = ' . db_prefix() . 'npi_bulk.TaxonomyCode'];

if ($this->ci->input->post('taxsources'))
{
    array_push($where, 'AND TaxonomyCode =' . $this->ci->db->escape_str($this->ci->input->post('taxsources')));
}
if ($this->ci->input->post('state'))
{
    array_push($where, 'AND PracticeState =' . $this->ci->db->escape_str($this->ci->input->post('state')));
}
if ($this->ci->input->post('entity'))
{
    array_push($where, 'AND EntityCode =' . $this->ci->db->escape_str($this->ci->input->post('entity')));
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable,[], $where, [/* Extra column you want to search*/]);

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


