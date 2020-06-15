<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Import_npi_data extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('knowledge_base_model');
    }

    /* List all knowledgebase articles */
    public function index()
    {
            $this->load->helper('form');
            $this->load->database();
        /*if (!has_permission('knowledge_base', '', 'view')) {
            access_denied('knowledge_base');
        }
       */
        $this->load->view('admin/npi_api/npi_home_with_data', $data);
    }
   
  
}
