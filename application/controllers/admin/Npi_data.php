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
          
           $a=$this->totalNPI();

          $data = array();
$count= 0;
          foreach($books as $r) {
            $count++;
               $data[] = array(
                    $r->NPI,
                    $r->EntityCode,
                    $r->FirstName,
                    $r->LastName,
                    $r->BusinessTelephone
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
        $this->db->select('*');
        $this->db->from('tblnpi_bulk');
        $this->db->limit($length,$start);


        $NPIData = $this->db->get()->result();
        return $NPIData;

    }


}
