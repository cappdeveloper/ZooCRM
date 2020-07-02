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
                       
                          <button class="btn btn-success" id="bulk">Bulk Import Data</button>
                                         <?php $this->load->view('admin/npi_api/table_html',array('url'=>admin_url('Npi_data/table'))); ?>
      

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







                            
     <?php init_tail(); ?>
<script type="text/javascript">
  
   $(document).on('click','#bulk',function(){
      var Npi_Number = [];
      $('.sorting_1').each(function()
        {
          Npi_Number.push($(this).html()); 
        });
      
     $.ajax({
      url:"<?php echo site_url("admin/Npi_Data/NPI_page_bulk_import") ?>",
      type:'POST',
      data: {res:Npi_Number},
      success:function(result){

        alert(result);

      }
     });
    });
</script>

</body>
</html>
