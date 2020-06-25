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
        $this->app->get_table_data('npi_data');
    }


}
