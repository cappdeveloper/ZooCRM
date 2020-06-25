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
    public function table()
    {
       

          // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

              $this->db->select('*');
            $this->db->from('tblnpi_bulk');   
      
            $books = $this->db->get()->result();
         // $books = $this->books_model->get_books();
            

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
                 "recordsTotal" => $count,
                 "recordsFiltered" => $count,
                 "data" => $data
            );
          //print_r($output);die;
          echo json_encode($output);
          exit();
     
    }


}
