<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
//error_reporting(0);
ini_set('display_errors', 0);
defined('BASEPATH') or exit('No direct script access allowed');

class Npi_api extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('knowledge_base_model');
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
   public function npi_search_result(){
    
    //$this->load->view('admin/npi_api/npi_home', $data);
    $this->load->helper('form');
    if(!empty($this->input->post('exactMatch'))){
        $true = TRUE;
    }else{
        $true = '';
    }
      $word = $this->input->post('taxonomy_description') ;
     $t= strtoupper($word);
// turn this into an array
$a = explode(" ", $t );

// output without final comma
$texo =  implode("+", $a );
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://npiregistry.cms.hhs.gov/api/?version=2.1&number='.$this->input->post('number').'&enumeration_type='.$this->input->post('entity_type').'&taxonomy_description='.$texo.'&first_name='.$this->input->post('first_name').'&use_first_name_alias='.$this->input->post('use_first_name_alias').'&last_name='.$this->input->post('last_name').'&organization_name='.$this->input->post('organization_name').'&address_purpose='.$this->input->post('address_purpose').'&city='.$this->input->post('city').'&state='.$this->input->post('state').'&exactMatch='.$true.'&postal_code='.$this->input->post('postal_code').'&country_code='.$this->input->post('country').'&limit=8000&skip=&version=2.1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => array('mcm ' => ' mdmm'),
));

$response = curl_exec($curl);

curl_close($curl);
$data['res'] = json_decode($response);
/*echo "<pre>";
print_r($data);die;
  */
  /* $data =   file_get_contents('https://npiregistry.cms.hhs.gov/api/?version=2.1&number='.$this->input->post('number').'&enumeration_type='.$this->input->post('entity_type').'&taxonomy_description='.$this->input->post('taxonomy_description').'&first_name='.$this->input->post('first_name').'&use_first_name_alias='.$this->input->post('use_first_name_alias').'&last_name='.$this->input->post('last_name').'&organization_name='.$this->input->post('organization_name').'&address_purpose='.$this->input->post('address_purpose').'&city='.$this->input->post('city').'&state='.$this->input->post('state').'&postal_code='.$this->input->post('postal_code').'&country_code='.$this->input->post('country').'&limit=8000&skip=&version=2.1');
   print_r($data);die;*/
    //$data = "https://npiregistry.cms.hhs.gov/registry/search-results-table?city=india&addressType=ANY&skip=100&skip=200";
   //echo "<pre>";
   //$inset_data = $data;//json_decode($data['res']);
/*    foreach($data->results as $sinle){
        //echo $sinle->number;die;
         $data_to_insert = array(
        'number'=>$sinle->number,
        'first_name'=>$sinle->basic->first_name,
        'last_name'=>$sinle->basic->last_name,
        'primary_address'=>serialize($sinle->addresses),
        'secondary_address'=>serialize($sinle->addresses),
    );
        //$this->db->insert('tblnpi_api_data',$data_to_insert);
    }*/
        //$this->session->set_userdata($data);

        $this->load->view('admin/npi_api/npi_home_with_data', $data);
   }

   public function ajax_get_response(){

/*print_R($this->input->post());
die;*/

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
        }/*else{
           // $error = ['message'=>"Records Imported Successfully"];
                echo json_encode($error);
        }*/

      }
   }
  

  public function bulk_import(){
   $data = $this->input->post();
   $Successfully=0;
   $failed=0;
   $alredy_exist=0;
   //print_R($data['results']);die;
   foreach($data['results'] as $sinle_data){
    //echo $sinle_data['enumeration_type'];die;
     $this->db->select('id');
            $this->db->select('id'); 
            $this->db->from('tblleads');   
            $this->db->where('number', $sinle_data['number']);
            $id = $this->db->get()->result();
            if(!empty($id[0]->id)){
              $alredy_exist= $alredy_exist+1;
              /*$error = ['message_exist'=>"This record already exist"];
                echo json_encode($error);*/
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
            /*$error = ['message'=>"Records are not Imported Successfully"];
                echo json_encode($error);*/
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
