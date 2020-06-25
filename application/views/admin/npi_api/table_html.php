<?php defined('BASEPATH') or exit('No direct script access allowed');

$table_data = array(
 
  array(
    'name'=>_l('NPI'),
    'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-npi_bulk-Tax_Name')
  ),
   array(
   'name'=>_l('Entity'),
    'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-npi_bulk-Tax_value')
  ),
 array(
   'name'=>_l('Firstname'),
    'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-npi_bulk-Tax_value')
  ),
  array(
   'name'=>_l('Lastname'),
    'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-npi_bulk-Tax_value')
  ),
   array(
   'name'=>_l('Mobile'),
    'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-npi_bulk-Tax_value')
  ),


);
/*render_datatable($table_data,'npi_data',
  array(),
  array(
    'id'=>'table-npi_data',
    'data-url'=>$url,
   ));*/
render_datatable($table_data,'subscriptions',
  array(),
  array(
    'id'=>'table-subscriptions',
    'data-url'=>$url,
    'data-last-order-identifier' => 'subscriptions',
    'data-default-order'         => get_table_last_order('subscriptions'),
  ));

hooks()->add_action('app_admin_footer', function(){
?>
<script>
    $(function(){
      
        var url = $('#table-npi_data').data('url');
       
       // initDataTable('.table-npi_data', url);
        initDataTable('.table-npi_data',url);
    });
</script>
<?php
});
?>



