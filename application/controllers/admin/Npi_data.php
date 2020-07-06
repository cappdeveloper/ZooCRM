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
        $this->load->model('leads_model');
        $this->load->model('staff_model');
    }

     public function index()
    {

        $data['members'] = $this->staff_model->get('', [
            'active'       => 1,
            'is_not_staff' => 0,
        ]);
        $data['statuses'] = $this->leads_model->get_status();
        $data['sources']  = $this->leads_model->get_source();

        $data['taxsources']  = $this->npi_model->get_taxnomy();
        $this->load->view('admin/npi_api/npi_data', $data);
    }

     public function table()
     {
          $this->app->get_table_data('npi_data');
     }

     public function NPI_page()
     {


          // Datatables Variables

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $books=$this->GetAPIData(1,5);
          //echo json_encode($books);
           $a=6;//$this->totalNPI();
           $aColumns = [
                'FirstName',
                'LastName'
            ];
            $sIndexColumn = 'NPI';
            $sTable       = 'tblnpi_bulk';//db_prefix().'tickets_predefined_replies';
            $result       = data_tables_init($aColumns, $sIndexColumn, $sTable, [], [], [
                'NPI',
            ]);
            $output  = $result['output'];
            $rResult = $result['rResult'];

            //echo json_encode($rResult);die;
             foreach ($rResult as $aRow) {
                $row = [];
                for ($i = 0; $i < count($aColumns); $i++) {
                    if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
                        $_data = $aRow[strafter($aColumns[$i], 'as ')];
                    } else {
                        $_data = $aRow[$aColumns[$i]];
                    }
                   /* if ($i == 0) {
                        $_data = '<a href="' . admin_url('clients/client/' . $aRow['userid']) . '" target="_blank">' . $aRow['company'] . '</a>';
                    } elseif ($aColumns[$i] == $select[2] || $aColumns[$i] == $select[3]) {
                        if ($_data == null) {
                            $_data = 0;
                        }
                        $_data = app_format_money($_data, $currency->name);
                    }*/
                    $row[] = $_data;
                }
                $output['aaData'][] = $row;
                //$x++;
            }

            echo json_encode($output);
            //die();
           //print_r($books
           //data_tables_init($aColumns, $sIndexColumn, $sTable, $join = [], $where = [], $additionalSelect = [], $sGroupBy = '', $searchAs = []);
/*
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
          exit();*/
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
        $Successfully=0;
        $failed=0;
        $alredy_exist=0;

        foreach($this->input->post()['res'] as $single)
        {
            $this->db->select('id');
            $this->db->from('tblleads');
            $this->db->where('number', $single);
            $id = $this->db->get()->result();

            if(!empty($id[0]->id))
            {
              $alredy_exist= $alredy_exist+1;
            }
            else
            {
            $this->db->select('*');
            $this->db->from('tblnpi_bulk');
            $this->db->where('NPI',$single);
            $fetched_data = $this->db->get()->result();
            $tags = '';
            $tag=$this->input->post('tag');
            if (isset($tag))
            {
                $tags = $tag;
                unset($tag);
            }
            $_assignee=$this->input->post('assignee');
            $data_to_insert = array(
                                     'hash'=>'',//app_generate_hash(),
                                     'name'=>$fetched_data[0]->FirstName.$fetched_data[0]->LastName,
                                     'title'=>'test',
                                     'company'=>'test',
                                     'description'=>'test',
                                     'country'=>$fetched_data[0]->PracticeCountry,
                                     'zip'=>$fetched_data[0]->PracticePostal,
                                     'city'=>$fetched_data[0]->PracticeCity,
                                     'state'=>$fetched_data[0]->PracticeState,
                                     'address'=>$fetched_data[0]->FirstPracticeAddress,
                                     'assigned'=>$_assignee,
                                     'dateadded'=>date('Y-m-d H:i:s'),
                                     'status'=>$this->input->post('status'),
                                     'source'=>$this->input->post('source'),
                                     'dateassigned'=>date('Y-m-d H:i:s'),
                                     'addedfrom'=> get_staff_user_id(),
                                     'email'=>$fetched_data[0]->NPI,
                                     'website'=>'test',
                                     'phonenumber'=>$fetched_data[0]->PracticeTelephone,
                                     'number'=>$fetched_data[0]->NPI
                                  );

                     $this->db->insert(db_prefix() . 'leads', $data_to_insert);
                     $insert_id = $this->db->insert_id();
                     if ($insert_id)
                     {
                         log_activity('New Lead Added [ID: ' . $insert_id . ']');
                         $this->leads_model->log_lead_activity($insert_id, 'not_lead_activity_created');
                         if($tags!=null)
                             handle_tags_save($tags, $insert_id, 'lead');
                         if($_assignee!=null)
                             $this->leads_model->lead_assigned_member_notification($insert_id, $_assignee);

                         hooks()->do_action('lead_created', $insert_id);
                         $Successfully = $Successfully+1;
                     }
                     else
                     {
                      $failed= $failed+1;
                     }

                 }
            }

            if(!empty($Successfully) && !empty($alredy_exist))
            {
             $error = ['message'=>" $Successfully Records Imported Successfully and $alredy_exist Records already exists "];
             echo json_encode($error);die;
             }
            if(!empty($Successfully))
            {
             $error = ['message'=>"Records Imported Successfully"];
             echo json_encode($error);die;
            }
            if(!empty($alredy_exist))
            {
             $error = ['message'=>"Records alredy exists"];
             echo json_encode($error);die;
            }
     }
}
