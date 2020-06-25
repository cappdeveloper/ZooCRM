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
                       
                          <!--  <?php
                           // $this->load->view('admin/npi_api/table_html'); 
                         ?> -->

             <head>
        <title>Npi Bulk Data</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
    </head>
    <body>
    <h1>NPI DATA</h1>
    <table id="book-table">
<thead>
<tr><td>NPI</td><td>Entity</td><td>Firstname</td><td>Lastname</td><td>Mobile</td></tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable({
        "processing": true,
       "serverSide": true,
        "pageLength" : 5,
        "start": 0,
        "ajax": {
            url : "<?php echo site_url("admin/Npi_Data/NPI_page") ?>",
            type : 'GET'
        },
    });
});
</script>

    </body>
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







                            
   


</body>
</html>
