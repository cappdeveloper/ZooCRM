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
        
           $data_ajax = array(
          "success" => false,
          "results" => array()
       );

   $count =  count($res);
  
       if($count>1){
      foreach($res as $sinle){
        if($sinle->enumeration_type=='NPI-2'){
          $name = $sinle->basic->organization_name;
          $src="https://npiregistry.cms.hhs.gov/static/registry/img/glyphicons-90-building.png";
        }else{
          $name = $sinle->basic->first_name." ".$sinle->basic->last_name;
          $src = "https://npiregistry.cms.hhs.gov/static/registry/img/glyphicons-4-user.png";
        }
          
         $data_ajax['results'][] = array(
          'number' => $sinle->NPI,
          'enumeration_type' => $sinle->enumeration_type,
          'address' => $sinle->FirstLineBusinessMailingAddress,
          'country' => $sinle->BusinessCountry,
          'dateadded' => $sinle->EnumerationDate,
          'name'  =>$sinle->FirstName.$sinle->LastName,
          'last_updated'  =>$sinle->LastUpdate,
          'state'  =>$sinle->BusinessState,
          'city'  =>$sinle->BusinessCity,
          'zip'  =>$sinle->BusinessPostal,
          'postcode'  =>$sinle->BusinessPostal,
          'telephone_number'  =>$sinle->BusinessTelephone,
          'fax_number'  =>$sinle->BusinessFax,
      
  );
       
       /* $items['name']=$name;
        $items['number']=$sinle->number;
        $items['enumeration_type']=$sinle->enumeration_type;
        $items['address']=$sinle->addresses[0]->address_1;
        $items['country']=$sinle->addresses[0]->country_name;
        $items['dateadded']=$sinle->basic->enumeration_date;
       */ 
      ?>

                <td data-toggle="modal" data-target="#exampleModalCenter" class="detail_npi_data" number="<?php echo $sinle->NPI;?>" firstname="<?php echo $sinle->FirstName;?>" lastname="<?php echo $sinle->LastName;?>" type="" status=""  sole_proprietor="<?php echo $sinle->Is_Sole_Proprietor;?>" mailing_address="<?php echo $sinle->FirstLineBusinessMailingAddress." ".$sinle->BusinessCountry." ".$sinle->BusinessPostal;?>" primary_texo="<?php echo $sinle->TaxonomyCode;?>" selected_texonomy="<?php echo $sinle->TaxonomyCode;?>" texonomy_state="<?php echo $sinle->StateCode_1;?>" texonomy_license="<?php echo $sinle->LicenseNumber_1?>" img_icon="<?php echo $src;?>" enumeration_date="<?php echo $sinle->EnumerationDate;?>" last_updated="<?php echo $sinle->LastUpdate;?>"  primary_address="<?php echo $sinle->FirstPracticeAddress." ".$sinle->PracticeCountry." ".$sinle->PracticePostal;?>" ><a href="#"><?php echo $sinle->NPI;?></a></td>
                <td><?php echo $sinle->FirstName." ".$sinle->LastName;?></td>
                <td><img src="<?php echo $src;?>" alt="img"></td>
                <td><?php echo $sinle->FirstLineBusinessMailingAddress;?></td>
                <td><?php echo $sinle->BusinessTelephone;?></td>
                <td><?php echo $sinle->TaxonomyCode;?></td>
                <td class="import" number="<?php echo $sinle->NPI;?>" firstname="<?php echo $sinle->FirstName;?>" lastname="<?php echo $sinle->LastName;?>" type="<?php //echo $sinle->enumeration_type;?>"  country="<?php echo $sinle->BusinessCountry;?>" city="<?php echo $sinle->BusinessCity;?>" state="<?php echo $sinle->BusinessState;?>" zip="<?php echo $sinle->BusinessPostal;?>" address="<?php echo $sinle->FirstLineBusinessMailingAddress;?>" added_date="<?php echo $sinle->EnumerationDate;?>" last_updated_date="<?php echo $sinle->LastUpdate;?>" phone="<?php echo $sinle->BusinessTelephone;?>"><a href="#">Import</a></td>
            </tr>
            <?php
            }
          }else{
           
            $data_ajax['results'][] = array(
          'number' => $res[0]->NPI,
          'enumeration_type' => $res[0]->EntityCode,
          'address' => $res[0]->FirstLineBusinessMailingAddress,
          'country' => $res[0]->BusinessCountry,
          'dateadded' => $res[0]->EnumerationDate,
          'name'  =>$res[0]->FirstName.$sinle->LastName,
          'last_updated'  =>$res[0]->LastUpdate,
          'state'  =>$res[0]->BusinessState,
          'city'  =>$res[0]->BusinessCity,
          'zip'  =>$res[0]->BusinessPostal,
          'postcode'  =>$res[0]->BusinessPostal,
          'telephone_number'  =>$res[0]->BusinessTelephone,
          'fax_number'  =>$res[0]->BusinessFax,
      
       );
      
      ?>

                <td data-toggle="modal" data-target="#exampleModalCenter" class="detail_npi_data" number="<?php echo $res[0]->NPI;?>" firstname="<?php echo $res[0]->FirstName;?>" lastname="<?php echo $res[0]->LastName;?>" type="" status=""  sole_proprietor="<?php echo $res[0]->Is_Sole_Proprietor;?>" mailing_address="<?php echo $res[0]->FirstLineBusinessMailingAddress." ".$res[0]->BusinessCountry." ".$res[0]->BusinessPostal;?>" primary_texo="<?php echo $res[0]->TaxonomyCode;?>" selected_texonomy="<?php echo $res[0]->TaxonomyCode;?>" texonomy_state="<?php echo $res[0]->StateCode_1;?>" texonomy_license="<?php echo $res[0]->LicenseNumber_1;?>" img_icon="<?php echo $src;?>" enumeration_date="<?php echo $res[0]->EnumerationDate;?>" last_updated="<?php echo $res[0]->LastUpdate;?>"  primary_address=" <?php echo $res[0]->FirstPracticeAddress;?>" ><a href="#"><?php echo $res[0]->NPI;?></a></td>
                <td><?php echo $res[0]->FirstName." ".$res[0]->LastName;?></td>
                <td><img src="<?php echo $src;?>" alt="img"></td>
                <td><?php echo $res[0]->FirstLineBusinessMailingAddress;?></td>
                <td><?php echo $res[0]->BusinessTelephone;?></td>
                <td><?php echo $res[0]->TaxonomyCode;?></td>
                <td class="import" number="<?php echo $res[0]->NPI;?>" firstname="<?php echo $res[0]->FirstName;?>" lastname="<?php echo $res[0]->LastName;?>" type="<?php //echo $sinle->enumeration_type;?>"  country="<?php echo $res[0]->BusinessCountry;?>" city="<?php echo $res[0]->BusinessCity;?>" state="<?php echo $res[0]->BusinessState;?>" zip="<?php echo $res[0]->BusinessPostal;?>" address="<?php echo $res[0]->FirstLineBusinessMailingAddress;?>" added_date="<?php echo $res[0]->EnumerationDate;?>" last_updated_date="<?php echo $res[0]->LastUpdate;?>" phone="<?php echo $res[0]->BusinessTelephone;?>"><a href="#">Import</a></td>
            </tr>

            <?php
          }
   ?>
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
<!-- <?php $this->load->view('admin/reports/includes/sales_js'); ?> -->
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
         var phone = $(this).attr('phone');
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
    $.post("<?php echo base_url();?>/admin/Npi_api/ajax_get_response"/*'http://localhost/CRMwork-master/admin/Npi_api/ajax_get_response'*/, { number: number, firstname : firstname,lastname:lastname,type:type,country:country,city:city,state:state,zip:zip,address:address,last_updated_date:last_updated_date,added_date:added_date,phone:phone}, 
    function(returnedData){
     var actualData = JSON.parse(returnedData);
      if(!empty(actualData.message_exist)){
          swal("Result", actualData.message_exist, "error");
      }
     swal("Result", actualData.message, "success");

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
