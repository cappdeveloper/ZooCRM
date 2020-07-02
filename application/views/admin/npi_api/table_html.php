<?php defined('BASEPATH') or exit('No direct script access allowed');

      $table_data = array(
        array(
          'name'=>_l('NPI'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-NPI')
        ),
        array(
          'name'=>_l('First Name'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-FirstName')
        ),
         array(
          'name'=>_l('Last Name'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-LastName')
        ),
         array(
          'name'=>_l('Taxnomy Name'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-TaxName')
        ),
         array(
          'name'=>_l('Practice Address'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-PAddress')
        ),
            array(
          'name'=>_l('City'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-PCity')
        ),
            array(
          'name'=>_l('State'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-PState')
        ),
           array(
          'name'=>_l('Practice Phone'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-PPhone')
        ),
           array(
          'name'=>_l('Business Phone'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-BPhone')
        ),
           array(
          'name'=>_l('Country'),
          'th_attrs'=>array('class'=>'toggleable', 'id'=>'th-country')
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
