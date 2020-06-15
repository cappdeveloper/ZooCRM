<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
   <div id="overlay"><style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
 margin-left: 600px;
 margin-top: 220px;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>

<h2>How To Create A Loader</h2>

<div class="loader"></div></div>
    <!-- Content goes here -->
</div>
<style type="text/css">
  #overlay {
  position: fixed; /* Sit on top of the page content */
  display: none; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5); /* Black background with opacity */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}

</style>
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                   <div class="row">
                       <button class="btn mright5 btn-info pull-left display-block" id="bulk_import">Import Bulk Data</button>
                    </div>
                 <hr class="hr-panel-heading">
                      
                        <?php  /*echo "<pre>";
      $ress = json_decode($res);
      //print_r($ress->results);die;
      foreach($ress->results as $sinle){
        print_r($sinle);die;
      }*/

   ?>


   <table id="npi_data" class="display" style="width:100%">
        <thead>
            <tr>
                <th>NPI</th>
                <th>Name</th>
                <th>NPI Type</th>
                <th>Primary Practice Address</th>
                <th>Phone</th>
                <th>Primary Taxonomy</th>
                <th>Import</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
      <?php
      $ress = $this->session->userdata();
      /*$r = $ress['res'];
      $ress = json_decode($r);*/
     /* echo "<pre>";
     print_r($res);*/
    // $data_for_bulk1 = [];
   $data_ajax = array(
  "success" => false,
  "results" => array()
);

      foreach($res->results as $sinle){

        if($sinle->enumeration_type=='NPI-2'){
          $name = $sinle->basic->organization_name;
          $src="https://npiregistry.cms.hhs.gov/static/registry/img/glyphicons-90-building.png";
        }else{
          $name = $sinle->basic->first_name." ".$sinle->basic->last_name;
          $src = "https://npiregistry.cms.hhs.gov/static/registry/img/glyphicons-4-user.png";
        }
          
         $data_ajax['results'][] = array(
          'number' => $sinle->number,
          'enumeration_type' => $sinle->enumeration_type,
          'address' => $sinle->addresses[0]->address_1,
          'country' => $sinle->addresses[0]->country_name,
          'dateadded' => $sinle->basic->enumeration_date,
          'name'  =>$name,
          'last_updated'  =>$sinle->basic->last_updated,
          'state'  =>$sinle->addresses[0]->state,
          'city'  =>$sinle->addresses[0]->city,
          'zip'  =>$sinle->addresses[0]->postal_code,
          'postcode'  =>$sinle->addresses[0]->postal_code,
      
  );
       
       /* $items['name']=$name;
        $items['number']=$sinle->number;
        $items['enumeration_type']=$sinle->enumeration_type;
        $items['address']=$sinle->addresses[0]->address_1;
        $items['country']=$sinle->addresses[0]->country_name;
        $items['dateadded']=$sinle->basic->enumeration_date;
       */ 
      ?>

                <td data-toggle="modal" data-target="#exampleModalCenter" class="detail_npi_data" number="<?php echo $sinle->number;?>" firstname="<?php echo $sinle->basic->first_name;?>" lastname="<?php echo $sinle->basic->last_name;?>" type="<?php echo $sinle->enumeration_type;?>" status="<?php echo $sinle->basic->status;?>"  sole_proprietor="<?php echo $sinle->basic->sole_proprietor;?>" mailing_address="<?php echo $sinle->addresses[0]->address_1." ".$sinle->addresses[0]->country_name;?>" primary_texo="<?php echo $sinle->taxonomies[0]->primary;?>" selected_texonomy="<?php echo $sinle->taxonomies[0]->desc;?>" texonomy_state="<?php echo $sinle->taxonomies[0]->state;?>" texonomy_license="<?php echo $sinle->taxonomies[0]->license;?>" img_icon="<?php echo $src;?>" enumeration_date="<?php echo $sinle->basic->enumeration_date;?>" last_updated="<?php echo $sinle->basic->last_updated;?>"  primary_address="<?php echo $sinle->addresses[0]->address_1." ".$sinle->addresses[0]->country_name;?>" ><a href="#"><?php echo $sinle->number;?></a></td>
                <td><?php echo $name;?></td>
                <td><img src="<?php echo $src;?>" alt="img"></td>
                <td><?php echo $sinle->addresses[0]->country_code." ".$sinle->addresses[0]->country_name." ".$sinle->addresses[0]->address_1;?></td>
                <td><?php echo $sinle->addresses[0]->telephone_number;?></td>
                <td><?php echo $sinle->taxonomies[0]->desc;?></td>
                <td class="import" number="<?php echo $sinle->number;?>" firstname="<?php echo $sinle->basic->first_name;?>" lastname="<?php echo $sinle->basic->last_name;?>" type="<?php echo $sinle->enumeration_type;?>"  country="<?php echo $sinle->addresses[0]->country_name;?>" city="<?php echo $sinle->addresses[0]->city;?>" state="<?php echo $sinle->addresses[0]->state;?>" zip="<?php echo $sinle->addresses[0]->postal_code;?>" address="<?php echo $sinle->addresses[0]->address_1;?>" added_date="<?php echo $sinle->basic->enumeration_date;?>" last_updated_date="<?php echo $sinle->basic->last_updated;?>"><a href="#">Import</a></td>
            </tr>
            <?php
            }
   ?>
   <!-- <h1><?php //echo "dcc"; print_r($data);?></h1> -->
        </tbody>
    </table>

                      <hr />
                     
                        <hr class="hr-10" />
                     
                             
                           </div>
                        </div>
                     </div>
                        </div>
                      </div>
              

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="col-md-10">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Provider Information for NPI  <img id="npi_icon"src="" alt=""> <p id="provider_info"></p></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               
         
       
                                  <table>
                    <tr><td rowspan='2' vertical-align='top'>
                  <img src="https://npiregistry.cms.hhs.gov/static/registry/img/glyphicons-46-calendar.png" alt="Calendar">
                   </td>
                        <td >&nbsp;&nbsp;</td><td >Last Updated:</td><td>&nbsp;&nbsp;</td><td id="last_updated"></td></tr>
                        <!--  <tr><td>&nbsp;&nbsp;</td><td align='right'>Certification Date:</td><td>&nbsp;</td><td> </td></tr> -->
                    </table>
                  
           



         <div class="row">
            <div class="col-lg-12">
            <h2>Details</h2>  
            <table class="table table-striped table-bordered">
            
            
            <thead>
              <tr>
                <th>Name</th>
                <th>Value</th>
              </tr>
            </thead>
            
            <tr>
        <td>NPI</td>
              <td id="npi_numberr"></td>
            </tr>
             <tr>
        <td>Enumeration Date</td>
              <td id="enumeration_date"></td>
            </tr>
      <tr>
        <td>NPI Type</td>
              <td id="npi_type">
            
              
          
       </td>
            </tr>
       
        <tr>
      
              <td>Status</td>
              
              <td id="npi_status">
                
                     
              </td>
            </tr>
         <tr>
        <!--   <td>Authorized Official Information</td>
          <td id="authorized_info">
          
            
          
          </td> -->
          
        </tr>
      
       
            
            
             <tr>
              <td>Mailing Address</td>
              <td id="mailing_address"> 
            
            
  
                
              
              </td>
            </tr>
            
            <tr>
              <td>Primary Practice Address</td>
              <td id="primary_address"> 
              </td>

            </tr>
      <!-- 

      
      
      
      <tr>
        <td>Health Information Exchange</td>
              <td>
        <table class="table table-striped table-bordered">
          <thead>
            <th>Endpoint Type</th>
            <th>Endpoint</th>
            <th>Endpoint Description</th>
            <th>Use</th>
            <th>Content Type</th>
            <th>Affiliation</th>
            <th>Endpoint Location</th>
            
          </thead>
        
        </table>
              </td>
            </tr> --> 
            
             
            
      <!--       <tr>
              <td>Other Identifiers</td>
              <td>
        <table class="table table-striped table-bordered">
          <thead>
            <th colspan='2'>Issuer</th>
            <th>State</th>
            <th>Number</th>
            
            
          </thead>
        
        </table>
              </td>
            </tr> -->

     <tr>
              <td>Taxonomy</td>
              <td>
          <table class="table table-striped table-bordered">
          <thead>
            <th>Primary Taxonomy</th>
            <th>Selected Taxonomy</th>
            <th>State</th>
            <th>License Number</th>
          </thead>
          
        
            
          <tr>
            <td id="primary_texonomy">
              
            </td>
            <td id="selected_texonomy">
            
              
            <td id="texonomy_state"></td>
            <td id="texonomy_license"></td>
          </tr>
           
              
        
            
              
        </table>
              </td>
            </tr>

            
            
            
            
            
            
          
            
            </table>
          </div>
          </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<?php init_tail(); ?>
<?php $this->load->view('admin/reports/includes/sales_js'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#npi_data').DataTable({
  "pageLength": 25
} );
} );

</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click','.import',function(){
         var number = $(this).attr('number');
         var firstname = $(this).attr('firstname');
         var lastname = $(this).attr('lastname');
         var type = $(this).attr('type');
         var country = $(this).attr('country');
         var city = $(this).attr('city');
         var state = $(this).attr('state');
         var zip = $(this).attr('zip');
         var address = $(this).attr('address');
         var added_date = $(this).attr('added_date');
         var last_updated_date = $(this).attr('last_updated_date');
         //var number = $(this).attr('number');
     /*    $.ajax({
        url: 'http://localhost/schat/checkout.php',
        type: 'POST',
        data: { field1: number, field2 : "hello2"} ,
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert(response);
        }
    }); */
    $.post("<?php echo base_url();?>/admin/Npi_api/ajax_get_response"/*'http://localhost/CRMwork-master/admin/Npi_api/ajax_get_response'*/, { number: number, firstname : firstname,lastname:lastname,type:type,country:country,city:city,state:state,zip:zip,address:address,last_updated_date:last_updated_date,added_date:added_date}, 
    function(returnedData){
     var actualData = JSON.parse(returnedData);
      if(!empty(actualData.message_exist)){
          swal("Result", actualData.message_exist, "error");
      }
     swal("Result", actualData.message, "success");

      //alert(returnedData);
         console.log(returnedData.message);
}).fail(function(){
      console.log("error");
});
    });

    $(document).on('click','.detail_npi_data',function(){
           $('#npi_number').text($(this).attr('number'));
           $('#provider_info').text($(this).attr('number'));
           $('#npi_numberr').text($(this).attr('number'));
           $('#npi_type').text($(this).attr('type'));
           $('#mailing_address').text($(this).attr('mailing_address'));
           $('#primary_address').text($(this).attr('primary_address'));
           $('#texonomy_state').text($(this).attr('texonomy_state'));
           $('#primary_texonomy').text($(this).attr('primary_texo'));
           $('#selected_texonomy').text($(this).attr('selected_texonomy'));
           $('#texonomy_license').text($(this).attr('texonomy_license'));
           $('#npi_status').text($(this).attr('status'));
           $('#npi_icon').attr('src',$(this).attr('img_icon'));
           $('#enumeration_date').text($(this).attr('enumeration_date'));
           $('#last_updated').text($(this).attr('last_updated'));
    });

$('#bulk_import').click(function(){
$('#overlay').show();
   $.post("<?php echo base_url();?>/admin/Npi_api/bulk_import"/*'http://localhost/CRMwork-master/admin/Npi_api/ajax_get_response'*/, <?php echo json_encode($data_ajax);?>, 
    function(returnedData){
      $('#overlay').hide();
     var actualData = JSON.parse(returnedData);
      if(!empty(actualData.message_exist)){
          swal("Result", actualData.message_exist, "error");
      }
     swal("Result", actualData.message, "success");

      //alert(returnedData);
         console.log(returnedData.message);
}).fail(function(){
      console.log("error");
});
   /*  $.ajax({
  url: "/admin/Npi_api/bulk_import",
  cache: false,
  type: "POST",
  data: "",
  success: function(returnedData){
     var actualData = JSON.parse(returnedData);
      if(!empty(actualData.message_exist)){
          swal("Result", actualData.message_exist, "error");
      }
  }
});*/
})
    
} );

</script>
</body>
</html>
