<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
//error_reporting(0);
ini_set('display_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class Npi_api extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('npi_model');
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
    /*******************************Search Npi Data******************************************************/
   public function npi_search_result(){      
         $this->load->helper('form');

     if($this->input->post('taxonomy_description')){
            $this->db->select('Tax_value'); 
            $this->db->from('tbltaxnomy_value');   
            $this->db->where('Tax_Name', $this->input->post('taxonomy_description')); 
            $taxonomy_code = $this->db->get()->result();  
            $t_code = $taxonomy_code[0]->Tax_value ;
            $where['TaxonomyCode'] = $t_code;
          }
      if($this->input->post('country')){
            $where['BusinessCountry'] = $this->input->post('country');
          
          }
          if($this->input->post('postal_code')){
             $where['BusinessPostal'] = $this->input->post('postal_code');
            
          }

           if($this->input->post('number')){
      
            $where['NPI'] = $this->input->post('number');
          }
           if($this->input->post('last_name')){
                $where['LastName'] = $this->input->post('last_name');
               
          }
           if($this->input->post('first_name')){
                  $where['FirstName'] = $this->input->post('first_name');
             
          }
         if($this->input->post('state')){
                $where['BusinessState'] = $this->input->post('state');

            }
             if($this->input->post('entity_type')){
              if($this->input->post('entity_type')=='NPI-2'){
                $entity_type = 2;
              }else{
                $entity_type = 1;
              }
                $where['EntityCode'] = $entity_type;
                

            }
          $this->db->select('NPI,FirstName,LastName,TaxonomyCode,LicenseNumber_1,StateCode_1,FirstLineBusinessMailingAddress,BusinessCountry,BusinessPostal,EnumerationDate,LastUpdate,FirstPracticeAddress,PracticeCountry,PracticePostal,BusinessTelephone,EntityCode'); 
            $this->db->from('tblnpi_bulk');
            

            $this->db->where($where); 
            $data['res'] = $this->db->get()->result();
           
            $count =  count($data['res']);
             if($count>1){
             foreach($data['res'] as $sinle){
               $texo_code = $sinle->TaxonomyCode;
               $this->db->select('Tax_Name'); 
               $this->db->from('tbltaxnomy_value');   
               $this->db->where('Tax_value', $texo_code); 
               $taxonomy_name = $this->db->get()->result();  
               $t_name = $taxonomy_name[0]->Tax_Name ;
               $sinle->TaxonomyCode = $t_name;
            
             }
            }else{
              $texo_code = $data['res'][0]->TaxonomyCode;
              $this->db->select('Tax_Name'); 
              $this->db->from('tbltaxnomy_value');   
              $this->db->where('Tax_value', $texo_code); 
              $taxonomy_name = $this->db->get()->result();  
             $t_name = $taxonomy_name[0]->Tax_Name ;
             $data['res'][0]->TaxonomyCode = $t_name;
            }
              $this->load->view('admin/npi_api/npi_home_with_data', $data);
         }
/************************************Import Single Row From Table***********************************************/
   public function ajax_get_response(){


   $this->db->select('id');
            $this->db->select('id'); 
            $this->db->from('tblleads');   
            $this->db->where('number', $this->input->post('number'));
            $id = $this->db->get()->result();
            if(!empty($id[0]->id)){
              $error = ['message_exist'=>"This record already exist"];
                echo json_encode($error);
            }else{
    $data_to_insert = array(
        'hash'=>'test',
        'name'=>$this->input->post('firstname').$this->input->post('lastname'),
        'title'=>'test',
        'company'=>'test',
        'description'=>'test',
        'country'=>$this->input->post('country'),
        'zip'=>$this->input->post('zip'),
        'city'=>$this->input->post('city'),
        'state'=>$this->input->post('state'),
        'address'=>$this->input->post('address'),
        'assigned'=>'test',
        'dateadded'=>date('Y-m-d H:i:s'),
        'from_form_id'=>'test',
        'status'=>1,
        'source'=>3,
        'lastcontact'=>date('Y-m-d H:i:s'),
        'dateassigned'=>'',
        'last_status_change'=>'test',
        'addedfrom'=>'test',
        'email'=>'test',
        'website'=>'test',
        'phonenumber'=>$this->input->post('phone'),
        'date_converted'=>'',
        'lost'=>'test',
        'junk'=>'test',
        'last_lead_status'=>'',
        'is_imported_from_email_integration'=>'test',
        'email_integration_uid'=>'test',
        'is_public'=>'test',
        'default_language'=>'test',
        'client_id'=>'test',
        'number'=>$this->input->post('number')
    );
        if($this->db->insert('tblleads',$data_to_insert)){
            //echo "Records Imported Successfully";
          $insert_id = $this->db->insert_id();
            $this->npi_model->add_log($insert_id);
            $error = ['message'=>"Records Imported Successfully"];
                echo json_encode($error);
        }

      }
   }
  
/****************************************Bulk Import Code**********************************************/
  public function bulk_import(){
   $data = $this->input->post();
   $Successfully=0;
   $failed=0;
   $alredy_exist=0;
   foreach($data['results'] as $sinle_data){
     $this->db->select('id');
            $this->db->select('id'); 
            $this->db->from('tblleads');   
            $this->db->where('number', $sinle_data['number']);
            $id = $this->db->get()->result();
            if(!empty($id[0]->id)){
              $alredy_exist= $alredy_exist+1;
              
            }else{

             $data_to_insert = array(
        'hash'=>'test',
        'name'=>$sinle_data['name'],
        'title'=>'test',
        'company'=>$sinle_data['enumeration_type'],
        'description'=>'test',
        'country'=>$sinle_data['country'],
        'zip'=>$sinle_data['zip'],
        'city'=>$sinle_data['city'],
        'state'=>$sinle_data['state'],
        'address'=>$sinle_data['address'],
        'assigned'=>'',
        'dateadded'=>date('Y-m-d H:i:s'),
        'from_form_id'=>'test',
        'status'=>1,
        'source'=>3,
        'lastcontact'=>date('Y-m-d H:i:s'),
        'dateassigned'=>'',
        'last_status_change'=>'test',
        'addedfrom'=>'test',
        'email'=>'test',
        'website'=>'test',
        'phonenumber'=>$sinle_data['telephone_number'],
        'date_converted'=>'',
        'lost'=>'test',
        'junk'=>'test',
        'last_lead_status'=>'',
        'is_imported_from_email_integration'=>'test',
        'email_integration_uid'=>'test',
        'is_public'=>'test',
        'default_language'=>'test',
        'client_id'=>'test',
        'number'=>$sinle_data['number']
           );

              if($this->db->insert('tblleads',$data_to_insert)){
                $insert_id = $this->db->insert_id();
            $this->npi_model->add_log($insert_id);
            $Successfully = $Successfully+1;
        }else{
          $failed= $failed+1;
        }
   }
}

if(!empty($Successfully) && !empty($alredy_exist)){
  $error = ['message'=>" $Successfully Records Imported Successfully and $alredy_exist Records already exists "];
                echo json_encode($error);die;

}
if(!empty($Successfully)){
  $error = ['message'=>"Records Imported Successfully"];
                echo json_encode($error);die;

}
if(!empty($alredy_exist)){
  $error = ['message'=>"Records alredy exists"];
                echo json_encode($error);die;

}

 

  }
}
