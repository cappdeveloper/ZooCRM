<!DOCTYPE html>
<html lang="en">
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
        "ajax": {
            url : "<?php echo site_url("admin/Npi_api/NPI_page") ?>",
            type : 'GET'
        },
    });
});
</script>

    </body>
</html>