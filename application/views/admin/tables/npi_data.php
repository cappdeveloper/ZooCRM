<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* Database Table Columns*/
$CI          = & get_instance();
$aColumns = [
    'NPI',
    'EntityCode',
    'OrganizationName',
    'FirstName',
    'LastName',
    'TaxonomyCode',
    'FirstPracticeAddress',
    'PracticeState',
    'PracticeCity',
    'PracticeTelephone',
    'BusinessTelephone',
    'BusinessPostal',
    'PracticePostal',

    ];
/* Used for search by and Indexing*/

$sIndexColumn ='NPI' ;
$sTable       = db_prefix() . 'npi_bulk';
$where        = [];

 //$join = ['LEFT JOIN ' . db_prefix() . 'taxnomy_value ON ' . db_prefix() . 'taxnomy_value.Tax_value = ' . db_prefix() . 'npi_bulk.TaxonomyCode'];
 //get all id selected from name

//now match the records where code in () for each column

//then build the query
if ($this->ci->input->post('npi'))
{
    array_push($where, 'AND NPI ='. '"'.$this->ci->db->escape_str($this->ci->input->post('npi')).'"');
}
if ($this->ci->input->post('city'))
{
    array_push($where, 'AND PracticeCity='. '"'.$this->ci->db->escape_str($this->ci->input->post('city')).'"');
}
if ($this->ci->input->post('postal'))
{
    array_push($where, 'AND PracticePostal ='. '"'.$this->ci->db->escape_str($this->ci->input->post('postal')).'"');
}

if ($this->ci->input->post('taxsources'))
{

    $t_name=$this->ci->input->post('taxsources');
    $where_Search='Tax_name Like '.'"%'.$t_name.'%"';
    $this->ci->db->select('Tax_val');
    $this->ci->db->from('tbltaxnomy_code');
    $this->ci->db->where($where_Search);
    $taxonomy_code = $this->ci->db->get()->result();
    for ($i = 0; $i < count($taxonomy_code); $i++)
    {
       $t_code =$taxonomy_code[$i]->Tax_val;
       $new_code=rtrim($t_code);
       $in_stmt = "'".str_replace(" ", "','", $new_code)."'";
       $data=$data.$in_stmt.',';

    }
    $_inValue = rtrim($data, ",");
     array_push($where, 'AND (TaxonomyCode in('.$_inValue.')'.
         'OR TaxonomyCode_1 in('.$_inValue.')'.
         'OR TaxonomyCode_2 in('.$_inValue.')'.
         'OR TaxonomyCode_3 in('.$_inValue.')'.
         'OR TaxonomyCode_4 in('.$_inValue.')'.
         'OR TaxonomyCode_5 in('.$_inValue.')'.
         'OR TaxonomyCode_6 in('.$_inValue.')'.
         'OR TaxonomyCode_7 in('.$_inValue.')'.
         'OR TaxonomyCode_8 in('.$_inValue.')'.
         'OR TaxonomyCode_9 in('.$_inValue.')'.
         'OR TaxonomyCode_10 in('.$_inValue.')'.
         'OR TaxonomyCode_11 in('.$_inValue.'))');

}
if ($this->ci->input->post('state'))
{
    array_push($where, 'AND PracticeState ='. '"'.$this->ci->db->escape_str($this->ci->input->post('state')).'"');
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
    for ($i = 0; $i < count($aColumns); $i++)
    {
        if($i ==5)
        {
            $_data = $aRow[$aColumns[$i]];
            $_trimData=rtrim($_data);
            $this->ci->db->select('Tax_Name');
            $this->ci->db->from('tbltaxnomy_code');
            $this->ci->db->where('Tax_val', $_trimData);
            $taxonomy = $this->ci->db->get()->result();
            $t_code = $taxonomy[0]->Tax_Name ;
            $_data = $t_code;
        }
        else
        {
            $_data = $aRow[$aColumns[$i]];
        }
        $row[] = $_data;
    }
 $output['aaData'][] = $row;
}




