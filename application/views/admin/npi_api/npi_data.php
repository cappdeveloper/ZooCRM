<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
      
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                     <div class="_buttons">
                    
                  <a id="bulk" class="btn btn-info pull-left display-block hidden-xs">Import Data to Lead</a>
                     
                     <div class="clearfix"></div>
                     
                  </div>
                  <hr class="hr-panel-heading" />
               
                  <div class="tab-content">
                  
                     <div class="row" id="npi_data-table">
                         <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-12">
                                 <p class="bold"><?php echo _l('filter_by'); ?></p>
                              </div>
                         
                              
                              <div class="col-md-3 leads-filter-column">
                                 <?php
                                 echo render_select('view_taxsources',$taxsources,array('Tax_value','Tax_Name'),'','',array('data-width'=>'100%','data-none-selected-text'=>'Taxnomy Name'),array(),'no-mbot');
                                 ?>
                              </div>

                               <div class="col-md-3 leads-filter-column">
                                   <select name="view_state" class="selectpicker" data-live-search="true" id="view_state">
  <option value="" selected>Select State</option>

  <option value="AL">Alabama</option>

  <option value="AK">Alaska</option>

  <option value="AS">American Samoa</option>

  <option value="AZ">Arizona</option>

  <option value="AR">Arkansas</option>

  <option value="AA">Armed Forces America</option>

  <option value="AE">Armed Forces Europe /Canada / Middle East / Africa</option>

  <option value="AP">Armed Forces Pacific</option>

  <option value="CA">California</option>

  <option value="CO">Colorado</option>

  <option value="CT">Connecticut</option>

  <option value="DE">Delaware</option>

  <option value="DC">District of Columbia</option>

  <option value="FM">Federated States of Micronesia</option>

  <option value="FL">Florida</option>

  <option value="GA">Georgia</option>

  <option value="GU">Guam</option>

  <option value="HI">Hawaii</option>

  <option value="ID">Idaho</option>

  <option value="IL">Illinois</option>

  <option value="IN">Indiana</option>

  <option value="IA">Iowa</option>

  <option value="KS">Kansas</option>

  <option value="KY">Kentucky</option>

  <option value="LA">Louisiana</option>

  <option value="ME">Maine</option>

  <option value="MP">Mariana Islands, Northern</option>

  <option value="MH">Marshall Islands</option>

  <option value="MD">Maryland</option>

  <option value="MA">Massachusetts</option>

  <option value="MI">Michigan</option>

  <option value="MN">Minnesota</option>

  <option value="MS">Mississippi</option>

  <option value="MO">Missouri</option>

  <option value="MT">Montana</option>

  <option value="NE">Nebraska</option>

  <option value="NV">Nevada</option>

  <option value="NH">New Hampshire</option>

  <option value="NJ">New Jersey</option>

  <option value="NM">New Mexico</option>

  <option value="NY">New York</option>

  <option value="NC">North Carolina</option>

  <option value="ND">North Dakota</option>

  <option value="OH">Ohio</option>

  <option value="OK">Oklahoma</option>

  <option value="OR">Oregon</option>

  <option value="PA">Pennsylvania</option>

  <option value="PR">Puerto Rico</option>

  <option value="RI">Rhode Island</option>

  <option value="SC">South Carolina</option>

  <option value="SD">South Dakota</option>

  <option value="TN">Tennessee</option>

  <option value="TX">Texas</option>

  <option value="UT">Utah</option>

  <option value="VT">Vermont</option>

  <option value="VI">Virgin islands</option>

  <option value="VA">Virginia</option>

  <option value="WA">Washington</option>

  <option value="WV">West Virginia</option>

  <option value="WI">Wisconsin</option>

  <option value="WY">Wyoming</option>

</select>
                               </div>
                                 <div class="col-md-3 leads-filter-column">
                                       <select name="view_entity" class="selectpicker" data-live-search="true" id="view_entity">
                                                <option selected="selected" value="">Entity Type</option>
                                                     <option value="1">Individual</option>
                                                      <option value="2">Organization</option>
                                          </select>
                                     </div>


                              
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr class="hr-panel-heading" />
                       
                        <div class="col-md-12">
                          <div>
                              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                       
                       
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

    /* Parameter Name for Option Dropdown */
    var NPIServerParams = {
        "taxsources": "[name='view_taxsources']",
        "state": "[name='view_state']",
        "entity": "[name='view_entity']",

    };

    /* Ajac call on drop down Change*/
    table_npi = $('table.table-npi_data');
    _table_api = initDataTable(table_npi, admin_url + 'Npi_data/table', undefined, undefined, NPIServerParams);
    $.each(NPIServerParams, function (i, obj) {
        $('select' + obj).on('change', function () {

            table_npi.DataTable().ajax.reload()
                .columns.adjust()
                .responsive.recalc();
        });
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
</script>

</body>
</html>
