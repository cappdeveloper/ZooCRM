<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
              <div class="panel_s">
                  <div class="panel-body">

                  <div class="row">

<div class="_buttons">
                         <button class="btn btn-info mright5">Search NPI Records</button>      
               </div>
      
         <hr class="hr-panel-heading">

         <div class="col-md-10">
     <form  method="post" action="Npi_api/npi_search_result" enctype="multipart/form-data"  >
      <?php echo form_open('admin/Npi_api/npi_search_result');?>
     <input type="hidden" name="csrfmiddlewaretoken" value="TPhSv8CjU9bRuBISmShPJc4Wr1S7cJkz1ViHN6lVIGMZ5Oinbp1VjPKEWTanVVn7">
      <DIV class="form-group"> 

      <DIV class="row">

         <div class="col-sm-5 col-md-2">
            <LABEL class="control-label" for="id_number">NPI Number <SPAN class="nonbold"> </SPAN></LABEL>
            <INPUT id="id_number" maxlength='10' class="form-control" name="number" type="text">
         </div>
         
         <div class="col-sm-4 col-md-2">
            <LABEL class="control-label" for="id_entity_type">NPI Type <SPAN class="nonbold"> </SPAN></LABEL>
            <SELECT id="id_entity_type" class="form-control" name="entity_type">
                  <OPTION selected="selected" value="">Any</OPTION>
                  <OPTION            value="NPI-1">Individual</OPTION>
                  <OPTION             value="NPI-2">Organization</OPTION>
            </SELECT>
         </DIV>

         <div class="col-sm-5 col-md-5">
            <LABEL class="control-label" for="taxonomy_description">Taxonomy Description<SPAN class="nonbold"> </SPAN></LABEL>
            <INPUT id="taxonomy_description" class="form-control" name="taxonomy_description" type="text">
         </div>

        </div>
       </div>
       <DIV class="form-group">

       <DIV class="row">
          <div class="col-sm-5 col-md-2">
            <span class="style7"><label>for individuals</label></span><br>
            <LABEL class="control-label" for="id_first_name">First Name <SPAN class="nonbold"> </SPAN></LABEL>
            <INPUT id="id_first_name" class="form-control" name="first_name" type="text">
         </DIV>

         
          <div class="col-sm-5 col-md-2">
  <span class="style7"><label>&nbsp;&nbsp;  </label></span><br>
  <LABEL class="control-label" for="id_last_name">Last Name <SPAN class="nonbold"> </SPAN></LABEL>
  <INPUT id="id_last_name" class="form-control" name="last_name" type="text">
  </DIV>
  
  <DIV class="col-sm-8 col-md-5">
    <span class="style7"> <label>for organizations</label></span><br>
   <LABEL class="control-label" for="id_organization_name">Organization Name (LBN, DBA, Former LBN or Other Name)<SPAN class="nonbold"> </SPAN></LABEL>
   <INPUT id="id_organization_name" class="form-control" name="organization_name" type="text">
  </DIV>

  
  </div>
       </DIV>
       
       <DIV class="form-group">
<DIV class="row">

 <div class="col-sm-5 col-md-2">
    <LABEL class="control-label" for="id_city">City <SPAN class="nonbold"> </SPAN>
    </LABEL><INPUT id="id_city" class="form-control" name="city" type="text">
  </DIV>
   
      <DIV class="col-sm-7 col-md-3">
         <LABEL class="control-label" for="id_state">State <SPAN class="nonbold"> </SPAN></LABEL>
 <select name="state" class="form-control" id="id_state">
  <option value="" selected>Any</option>

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
            
 </Div>
      <DIV class="col-sm-7 col-md-3">
         <LABEL class="control-label" for="id_country">Country <SPAN class="nonbold"> </SPAN></LABEL>
         
         <select name="country" class="form-control" id="id_country">
  <option value="" selected>Any</option>

  <option value="AF">Afghanistan</option>

  <option value="AL">Albania</option>

  <option value="DZ">Algeria</option>

  <option value="AD">Andorra</option>

  <option value="AO">Angola</option>

  <option value="AI">Anguilla</option>

  <option value="AQ">Antarctica</option>

  <option value="AG">Antigua and Barbuda</option>

  <option value="AR">Argentina</option>

  <option value="AM">Armenia</option>

  <option value="AW">Aruba</option>

  <option value="AU">Australia</option>

  <option value="AT">Austria</option>

  <option value="AZ">Azerbaijan</option>

  <option value="BS">Bahamas</option>

  <option value="BH">Bahrain</option>

  <option value="BD">Bangladesh</option>

  <option value="BB">Barbados</option>

  <option value="BY">Belarus</option>

  <option value="BE">Belgium</option>

  <option value="BZ">Belize</option>

  <option value="BJ">Benin</option>

  <option value="BM">Bermuda</option>

  <option value="BT">Bhutan</option>

  <option value="BO">Bolivia</option>

  <option value="BA">Bosnia and Herzegovina</option>

  <option value="BW">Botswana</option>

  <option value="BV">Bouvet Island</option>

  <option value="BR">Brazil</option>

  <option value="IO">British Indian Ocean Territory</option>

  <option value="BN">Brunei Darussalam</option>

  <option value="BG">Bulgaria</option>

  <option value="BF">Burkina Faso</option>

  <option value="BI">Burundi</option>

  <option value="KH">Cambodia</option>

  <option value="CM">Cameroon</option>

  <option value="CA">Canada</option>

  <option value="CV">Cape Verde</option>

  <option value="KY">Cayman Islands</option>

  <option value="CF">Central African Republic</option>

  <option value="TD">Chad</option>

  <option value="CL">Chile</option>

  <option value="CN">China</option>

  <option value="CX">Christmas Island</option>

  <option value="CC">Cocos (Keeling) Islands</option>

  <option value="CO">Colombia</option>

  <option value="KM">Comoros</option>

  <option value="CD">Congo, The Democratic Republic of the</option>

  <option value="CK">Cook Islands</option>

  <option value="CR">Costa Rica</option>

  <option value="HR">Croatia</option>

  <option value="CI">Ctte D&#39;Ivoire</option>

  <option value="CU">Cuba</option>

  <option value="CY">Cyprus</option>

  <option value="CZ">Czech Republic</option>

  <option value="DK">Denmark</option>

  <option value="DJ">Djibouti</option>

  <option value="DM">Dominica</option>

  <option value="DO">Dominican Republic</option>

  <option value="EC">Ecuador</option>

  <option value="EG">Egypt</option>

  <option value="SV">El Salvador</option>

  <option value="GQ">Equatorial Guinea</option>

  <option value="ER">Eritrea</option>

  <option value="EE">Estonia</option>

  <option value="ET">Ethiopia</option>

  <option value="FK">Falkland Islands (Malvinas)</option>

  <option value="FO">Faroe Islands</option>

  <option value="FJ">Fiji</option>

  <option value="FI">Finland</option>

  <option value="FR">France</option>

  <option value="GF">French Guiana</option>

  <option value="PF">French Polynesia</option>

  <option value="TF">French Southern Territories</option>

  <option value="GA">Gabon</option>

  <option value="GM">Gambia</option>

  <option value="GE">Georgia</option>

  <option value="DE">Germany</option>

  <option value="GH">Ghana</option>

  <option value="GI">Gibraltar</option>

  <option value="GB">Great Britain</option>

  <option value="GR">Greece</option>

  <option value="GL">Greenland</option>

  <option value="GD">Grenada</option>

  <option value="GP">Guadeloupe</option>

  <option value="GT">Guatemala</option>

  <option value="GG">Guernsey</option>

  <option value="GN">Guinea</option>

  <option value="GW">Guinea-Bissau</option>

  <option value="GY">Guyana</option>

  <option value="HT">Haiti</option>

  <option value="HM">Heard Island and McDonald Islands</option>

  <option value="VA">Holy See (Vatican City State)</option>

  <option value="HN">Honduras</option>

  <option value="HK">Hong Kong</option>

  <option value="HU">Hungary</option>

  <option value="IS">Iceland</option>

  <option value="IN">India</option>

  <option value="ID">Indonesia</option>

  <option value="IR">Iran, Islamic Republic of</option>

  <option value="IQ">Iraq</option>

  <option value="IE">Ireland</option>

  <option value="IM">Isle Of Man</option>

  <option value="IL">Israel</option>

  <option value="IT">Italy</option>

  <option value="JM">Jamaica</option>

  <option value="JP">Japan</option>

  <option value="JE">Jersey</option>

  <option value="JO">Jordan</option>

  <option value="KZ">Kazakhstan</option>

  <option value="KE">Kenya</option>

  <option value="KI">Kiribati</option>

  <option value="KP">Korea, Democratic People&#39;s Republic of</option>

  <option value="KR">Korea, Republic of</option>

  <option value="XK">Kosovo</option>

  <option value="KW">Kuwait</option>

  <option value="KG">Kyrgyzstan</option>

  <option value="LA">Lao People&#39;s Democratic Republic</option>

  <option value="LV">Latvia</option>

  <option value="LB">Lebanon</option>

  <option value="LS">Lesotho</option>

  <option value="LR">Liberia</option>

  <option value="LY">Libyan Arab Jamahiriya</option>

  <option value="LI">Liechtenstein</option>

  <option value="LT">Lithuania</option>

  <option value="LU">Luxembourg</option>

  <option value="MO">Macao</option>

  <option value="MK">Macedonia, The Former Yugoslav Republic of</option>

  <option value="MG">Madagascar</option>

  <option value="MW">Malawi</option>

  <option value="MY">Malaysia</option>

  <option value="MV">Maldives</option>

  <option value="ML">Mali</option>

  <option value="MT">Malta</option>

  <option value="MQ">Martinique</option>

  <option value="MR">Mauritania</option>

  <option value="MU">Mauritius</option>

  <option value="YT">Mayotte</option>

  <option value="MX">Mexico</option>

  <option value="MD">Moldova, Republic of</option>

  <option value="MC">Monaco</option>

  <option value="MN">Mongolia</option>

  <option value="MS">Montserrat</option>

  <option value="MA">Morocco</option>

  <option value="MZ">Mozambique</option>

  <option value="MM">Myanmar</option>

  <option value="NA">Namibia</option>

  <option value="NR">Nauru</option>

  <option value="NP">Nepal</option>

  <option value="NL">Netherlands</option>

  <option value="AN">Netherlands Antilles</option>

  <option value="NC">New Caledonia</option>

  <option value="NZ">New Zealand</option>

  <option value="NI">Nicaragua</option>

  <option value="NE">Niger</option>

  <option value="NG">Nigeria</option>

  <option value="NU">Niue</option>

  <option value="NF">Norfolk Island</option>

  <option value="NO">Norway</option>

  <option value="OM">Oman</option>

  <option value="PK">Pakistan</option>

  <option value="PW">Palau</option>

  <option value="PS">Palestinian Territory, Occupied</option>

  <option value="PA">Panama</option>

  <option value="PG">Papua New Guinea</option>

  <option value="PY">Paraguay</option>

  <option value="PE">Peru</option>

  <option value="PH">Philippines</option>

  <option value="PN">Pitcairn</option>

  <option value="PL">Poland</option>

  <option value="PT">Portugal</option>

  <option value="QA">Qatar</option>

  <option value="RE">Reunion</option>

  <option value="RO">Romania</option>

  <option value="RU">Russian Federation</option>

  <option value="RW">Rwanda</option>

  <option value="SH">Saint Helena</option>

  <option value="KN">Saint Kitts and Nevis</option>

  <option value="LC">Saint Lucia</option>

  <option value="PM">Saint Pierre and Miquelon</option>

  <option value="VC">Saint Vincent and the Grenadines</option>

  <option value="WS">Samoa</option>

  <option value="SM">San Marino</option>

  <option value="ST">Sao Tome and Principe</option>

  <option value="SA">Saudi Arabia</option>

  <option value="SN">Senegal</option>

  <option value="CS">Serbia and Montenegro</option>

  <option value="SC">Seychelles</option>

  <option value="SL">Sierra Leone</option>

  <option value="SG">Singapore</option>

  <option value="SK">Slovakia</option>

  <option value="SI">Slovenia</option>

  <option value="SB">Solomon Islands</option>

  <option value="SO">Somalia</option>

  <option value="ZA">South Africa</option>

  <option value="GS">South Georgia and the South Sandwich Islands</option>

  <option value="ES">Spain</option>

  <option value="LK">Sri Lanka</option>

  <option value="SD">Sudan</option>

  <option value="SR">Suriname</option>

  <option value="SJ">Svalbard and Jan Mayen</option>

  <option value="SZ">Swaziland</option>

  <option value="SE">Sweden</option>

  <option value="CH">Switzerland</option>

  <option value="SY">Syrian Arab Republic</option>

  <option value="TW">Taiwan</option>

  <option value="TJ">Tajikistan</option>

  <option value="TZ">Tanzania, United Republic of</option>

  <option value="TH">Thailand</option>

  <option value="TL">Timor-Leste</option>

  <option value="TG">Togo</option>

  <option value="TK">Tokelau</option>

  <option value="TO">Tonga</option>

  <option value="TT">Trinidad and Tobago</option>

  <option value="TN">Tunisia</option>

  <option value="TR">Turkey</option>

  <option value="TM">Turkmenistan</option>

  <option value="TC">Turks and Caicos Islands</option>

  <option value="TV">Tuvalu</option>

  <option value="UG">Uganda</option>

  <option value="UA">Ukraine</option>

  <option value="AE">United Arab Emirates</option>

  <option value="US">United States</option>

  <option value="UM">United States Minor Outlying Islands</option>

  <option value="UY">Uruguay</option>

  <option value="UZ">Uzbekistan</option>

  <option value="VU">Vanuatu</option>

  <option value="VE">Venezuela</option>

  <option value="VN">Viet Nam</option>

  <option value="VG">Virgin Islands, British</option>

  <option value="WF">Wallis and Futuna</option>

  <option value="EH">Western Sahara</option>

  <option value="YE">Yemen</option>

  <option value="ZM">Zambia</option>

  <option value="ZW">Zimbabwe</option>

</select>
  </div>
      <DIV class="col-sm-4 col-md-2">
            <LABEL class="control-label" for="id_postal_code">Postal Code <SPAN class="nonbold"> </SPAN></LABEL>
            <INPUT id="id_postal_code" class="form-control" name="postal_code" type="text">
      </DIV>
       <div class="col-sm-5 col-md-2">
         <LABEL class="control-label" for="addressType">Address Type <SPAN class="nonbold"> </SPAN></LABEL>
         
         
            
         
            
         
            
      <select name="addressType" class="form-control" id="id_addressType">
  <option value="ANY" selected>Any</option>

  <option value="PR">Primary Location</option>

  <option value="SE">Secondary Location</option>

</select>
        
      </DIV>

  </div>
</dIV>
  
  <DIV class="form-group">
  <DIV class="row">
   <DIV class="col-sm-8 col-md-5">
   <input type="checkbox" id="id_exactMatch" aria-labelledby="chk1-label" value="true" name="exactMatch"> <LABEL  id="chk1-label" class="control-label" 
   for="exactMatch">Check this box to search for Exact Matches only</label> 
       
   </DIV>
   </DIV>
   </DIV>
  <DIV class="form-group">
<DIV class="row">
  <DIV class="col-sm-8 col-md-4">

<INPUT class="btn  btn-large" onClick="window.location.reload();" value="Clear" type="button">&nbsp;&nbsp;

<INPUT class="btn btn-info mright5" value="Search" type="submit">  <BR><BR>
</div>

</DIV>
</dIV>
  
 
      </form>
             </div> 
      </div>
</div>


 
                    
               </div>
         
            </div>
         </div>
      </div>
   </div>


<?php init_tail(); ?>
<?php $this->load->view('admin/reports/includes/sales_js'); ?>

    