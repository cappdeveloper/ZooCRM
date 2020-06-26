<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
//error_reporting(0);
ini_set('display_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class Npi_Data extends AdminController
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
        $this->load->view('admin/npi_api/npi_data', $data);
    }
   public function NPI_page()
     {

          // Datatables Variables
    
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $books=$this->GetAPIData($start,$length);
          //echo json_encode($books);
           $a=$this->totalNPI();

          $data = array();
          $count= 0;
          foreach($books as $r) {
          $query = $this->db->select("*")->from("tbltaxnomy_value")->where('Tax_value',$r->TaxonomyCode);

        $result = $this->db->get()->result();
        
          $r->TaxonomyCode = $result[0]->Tax_Name;

        
            $count++;
               $data[] = array(
                    $r->NPI,
                    $r->FirstName." ".$r->LastName,
                    $r->EntityCode,
                    $r->FirstPracticeAddress,
                    $r->PracticeTelephone,
                    $r->TaxonomyCode
               );
          }


          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $a,
                 "recordsFiltered" => $a,
                 "data" => $data
            );
          //print_r($output);die;
          echo json_encode($output);
          exit();
     }
    public function totalNPI()
    {
        $query = $this->db->select("COUNT(*) as num")->from("tblnpi_bulk");
        $result = $this->db->get()->result();
        //print_r($result[0]->num);die;
        if(isset($result)) return $result[0]->num;
        return 0;
    }

    public function GetAPIData($start,$length)
    {
        $this->db->select('NPI,EntityCode,FirstName,LastName,FirstPracticeAddress,PracticeTelephone,TaxonomyCode');
        $this->db->from('tblnpi_bulk');
        $this->db->limit($length,$start);


        $NPIData = $this->db->get()->result();
        return $NPIData;

    }

     public function NPI_page_bulk_import()
    {
        $this->load->helper('form');
        //print_r($this->input->post()['res']);die;
        $Successfully=0;
       $failed=0;
       $alredy_exist=0;
        foreach($this->input->post()['res'] as $single){
             
            $this->db->select('id');
            $this->db->from('tblleads');
            $this->db->where('number', $single);
            $id = $this->db->get()->result();
            if(!empty($id[0]->id)){
              $alredy_exist= $alredy_exist+1;

            }else{
           $this->db->select('*');
           $this->db->from('tblnpi_bulk');
           $this->db->where('NPI',$single);
           $fetched_data = $this->db->get()->result();
           $data_to_insert = array(
        'hash'=>'test',
        'name'=>$fetched_data[0]->FirstName.$fetched_data[0]->LastName,
        'title'=>'test',
        'company'=>'test',
        'description'=>'test',
        'country'=>$fetched_data[0]->PracticeCountry,
        'zip'=>$fetched_data[0]->PracticePostal,
        'city'=>$fetched_data[0]->PracticeCity,
        'state'=>$fetched_data[0]->PracticeState,
        'address'=>$fetched_data[0]->FirstPracticeAddress,
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
        'phonenumber'=>$fetched_data[0]->PracticeTelephone,
        'date_converted'=>'',
        'lost'=>'test',
        'junk'=>'test',
        'last_lead_status'=>'',
        'is_imported_from_email_integration'=>'test',
        'email_integration_uid'=>'test',
        'is_public'=>'test',
        'default_language'=>'test',
        'client_id'=>'test',
        'number'=>$fetched_data[0]->NPI
    );
        if($this->db->insert('tblleads',$data_to_insert)){
           
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
