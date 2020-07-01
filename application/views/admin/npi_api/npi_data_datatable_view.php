<!-- 
             <head>
              <button class="btn btn-success" id="bulk">Bulk Import Data</button>
        <title>Npi Bulk Data</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    </head>
    <body>
    <h1>NPI DATA</h1>
    <table id="book-table">
<thead>
<tr><td>NPI</td><td>Name</td><td>Npi Type</td><td>Primary Practice Address</td><td>Phone </td><td>Primary Taxonomy</td></tr>
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
          dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
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
  
});
</script>

    </body> -->

   <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div id="wrapper">
  <div class="content">
    <div class="panel_s">
      <div class="panel-body">
        <?php $this->load->view('admin/npi_api/table_html'); ?>
      </div>
    </div>
  </div>
</div>
<?php init_tail(); ?>
<script>
  $(function(){
    initDataTable('.table-paymentss', admin_url+'Npi_Data/NPI_page');
  });
</script>
</body>
</html>
