<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
      
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                  
               
                  <div class="tab-content">
                  
                     <div class="row" id="npi_data-table">
                        
                       
                        <div class="col-md-12">
                          <div>
                              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                       
                           <?php
                            $this->load->view('admin/npi_api/table_html',array('url'=>admin_url('Npi_data/table'))); 
                         ?>
                                  </div>
                              </div>
                        </div>
                     </div>
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>




















                

    <div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">

          
               
         </div>
          </div>
</div>
    </div>
                            
   
<?php init_tail(); ?>

</body>
</html>
