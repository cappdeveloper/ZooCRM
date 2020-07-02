<?php defined('BASEPATH') or exit('No direct script access allowed');

      $table_data = array(
        array(
          'name'=>_l('NPI'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-Name')
        ),
        array(
          'name'=>_l('LastName'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-LastName')
        ),
         array(
          'name'=>_l('FirstName'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-Firstname')
        ),

      );
      render_datatable($table_data,'npi_data',
        array(),
        array(
          'id'=>'table-npi_data',
          'data-url'=>$url,

        ));

      hooks()->add_action('app_admin_footer', function(){
?>
<script>
    $(function(){
     
        var url = $('#table-npi_data').data('url');
        initDataTable('.table-npi_data', url);
    });
</script>
<?php
      });
?>
