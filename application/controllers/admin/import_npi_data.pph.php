<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Npi_api extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('knowledge_base_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {

        /*if (!has_permission('knowledge_base', '', 'view')) {
            access_denied('knowledge_base');
        }
       */
        $this->load->view('admin/npi_api/npi_home', $data);
    }
   public function npi_search_result(){
    //$this->load->view('admin/npi_api/npi_home', $data);
    $this->load->helper('form');
    //print_R($this->input->post());die;
  // $data =   file_get_contents('https://npiregistry.cms.hhs.gov/registry/search-results-table?city=INDIA&addressType=ANY');
   $data['res'] =   file_get_contents('https://npiregistry.cms.hhs.gov/api/?number=&enumeration_type=&taxonomy_description=&first_name=&use_first_name_alias=&last_name=&organization_name=&address_purpose=&city='.$this->input->post('city').'&state=&postal_code=&country_code=&limit=&skip=&version=2.1');
    //$data = "https://npiregistry.cms.hhs.gov/registry/search-results-table?city=india&addressType=ANY&skip=100&skip=200";
   //echo "<pre>";
   $inset_data = json_decode($data['res']);
    foreach($inset_data->results as $sinle){
         $data_to_insert = array(
        'number'=>$sinle->number,
        'first_name'=>$sinle->basic->first_name,
        'last_name'=>$sinle->basic->last_name,
        'primary_address'=>serialize($sinle->addresses),
        'secondary_address'=>serialize($sinle->addresses),
    );
        $this->db->insert('tblnpi_api_data',$data_to_insert);
    }
   
        $this->load->view('admin/npi_api/npi_home_with_data', $data);
   }
  
}
