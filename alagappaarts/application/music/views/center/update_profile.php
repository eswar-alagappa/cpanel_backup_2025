<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    
  <script>
  $(document).ready(function () {
	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'mm/dd/yy',
    });
 });
</script>

<div class="content">
     <div class="contentOuter">
      <h2>Edit Profile</h2>
       <form enctype="multipart/form-data" method="post" name="formStudentadd" action="<?php echo base_url(); ?>music/center/edit_profile" id="frmprofileedit">
       
	   <div class="registrationForm contentInner">
              <div class="registrationFormStudents profileContent">
          <fieldset class="w100">
        <legend>Academy Details</legend>
      <ul>
      
      <li><label>Academy Name:<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtAcademyname']) && !empty($post_set['txtAcademyname']) ? $post_set['txtAcademyname'] : (isset( $user_data->academyName) && !empty($user_data->academyName)) ? $user_data->academyName : ''); ?>" name="txtAcademyname">  
		<span><?php echo form_error('txtAcademyname'); ?></span>
		</li>
        
      <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtacademyEmail']) && !empty($post_set['txtacademyEmail']) ? $post_set['txtacademyEmail'] : (isset( $user_data->academyEmail) && !empty($user_data->academyEmail)) ? $user_data->academyEmail : ''); ?>" name="txtacademyEmail">  
		<span><?php echo form_error('txtacademyEmail'); ?></span>
		</li>
      
       <li><label> Website:</label>
		<input type="text" value="<?php echo (  isset($post_set['txtWebsite']) && !empty($post_set['txtWebsite']) ? $post_set['txtWebsite'] : (isset( $user_data->website) && !empty($user_data->website)) ? $user_data->website : ''); ?>" name="txtWebsite">  <span><?php //echo form_error('txtWebsite'); ?></span> </li>
        
        <li><label> Phone Day Time :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtPhonedaytime']) && !empty($post_set['txtPhonedaytime']) ? $post_set['txtPhonedaytime'] : (isset( $user_data->contact) && !empty($user_data->contact)) ? $user_data->contact : ''); ?>" name="txtPhonedaytime">  <span><?php echo form_error('txtPhonedaytime'); ?></span> </li>
        
        <li>
           <label>Alternate Phone : </label>
		<input type="text" value="<?php echo (  isset($post_set['txtAlternatephoneno']) && !empty($post_set['txtAlternatephoneno']) ? $post_set['txtAlternatephoneno'] : (isset( $user_data->alternate_contact) && !empty($user_data->alternate_contact)) ? $user_data->alternate_contact : ''); ?>" name="txtAlternatephoneno">   <span><?php //echo form_error('txtAlternatephoneno'); ?></span> </li>
        <li><label>Year of Establishment : </label>
		<input type="text" value="<?php echo (  isset($post_set['txtYearofestablishment']) && !empty($post_set['txtYearofestablishment']) ? $post_set['txtYearofestablishment'] : (isset( $user_data->no_of_establishment) && !empty($user_data->no_of_establishment)) ? $user_data->no_of_establishment : ''); ?>" name="txtYearofestablishment"> <span><?php //echo form_error('txtYearofestablishment'); ?></span>  </li>
        
        <li>
           <label>Number Arangetrams : </label>
		<input type="text" value="<?php echo (  isset($post_set['txtNumberarangetrams']) && !empty($post_set['txtNumberarangetrams']) ? $post_set['txtNumberarangetrams'] : (isset( $user_data->no_of_arangetram) && !empty($user_data->no_of_arangetram)) ? $user_data->no_of_arangetram : ''); ?>" name="txtNumberarangetrams">  <span><?php //echo form_error('txtNumberarangetrams'); ?></span> </li>
     
      </ul>
     
      <ul>
<li><label>Address: </label>
		<textarea name="txtAcademyaddress" class="h71"><?php echo (  isset($post_set['txtAcademyaddress']) && !empty($post_set['txtAcademyaddress']) ? $post_set['txtAcademyaddress'] : (isset( $user_data->academyAddress) && !empty($user_data->academyAddress)) ? $user_data->academyAddress : ''); ?></textarea> <span><?php //echo form_error('txtAcademyaddress'); ?></span> </li>
        <li>
		<label> City :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtAcademycity']) && !empty($post_set['txtAcademycity']) ? $post_set['txtAcademycity'] : (isset( $user_data->academyCity) && !empty($user_data->academyCity)) ? $user_data->academyCity : ''); ?>" name="txtAcademycity">  <span><?php echo form_error('txtAcademycity'); ?></span>  </li>
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtAcademystate']) && !empty($post_set['txtAcademystate']) ? $post_set['txtAcademystate'] : (isset( $user_data->academyState) && !empty($user_data->academyState)) ? $user_data->academyState : ''); ?>" name="txtAcademystate">  <span><?php echo form_error('txtAcademystate'); ?></span> </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtAcademycountry']) && !empty($post_set['txtAcademycountry']) ? $post_set['txtAcademycountry'] : (isset( $user_data->academyCountry) && !empty($user_data->academyCountry)) ? $user_data->academyCountry : ''); ?>" name="txtAcademycountry"> <span><?php echo form_error('txtAcademycountry'); ?></span>  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtAcademyzipcode']) && !empty($post_set['txtAcademyzipcode']) ? $post_set['txtAcademyzipcode'] : (isset( $user_data->academyZip) && !empty($user_data->academyZip)) ? $user_data->academyZip : ''); ?>" name="txtAcademyzipcode"> <span><?php echo form_error('txtAcademyzipcode'); ?></span>  </li>
       </ul>
      </fieldset>
      <fieldset class="w100">
        <legend>Director's Details</legend>
      <ul>

      <li>
        <label>Director Name :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtDirectorname']) && !empty($post_set['txtDirectorname']) ? $post_set['txtDirectorname'] : (isset( $user_data->name) && !empty($user_data->name)) ? $user_data->name : ''); ?>" name="txtDirectorname"> <span><?php echo form_error('txtDirectorname'); ?></span> </li>
        
      <li class="studentdate"><label>Director's D.O.B:<strong class="star">*</strong></label>
      		 <input type="text" value="<?php echo (  isset($post_set['txtDirectordob']) && !empty($post_set['txtDirectordob']) ? $post_set['txtDirectordob'] : (isset( $user_data->dob) && !empty($user_data->dob)) ? date('m/d/Y',strtotime($user_data->dob)) : ''); ?>" id="datepicker" name="txtDirectordob" class="w200 fL hasDatepick"><img class="datepick-trigger" src="../web/images/calendar-img.gif" alt="Select date" title="Select date"> 
         <!--<a href="#"><img width="21" height="21" src="images/calendar-img.gif" alt=" "></a></li>-->
		 <span><?php echo form_error('txtDirectordob'); ?></span>
       </li><li><label>Email :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtDirectorEmail']) && !empty($post_set['txtDirectorEmail']) ? $post_set['txtDirectorEmail'] : (isset( $user_data->email) && !empty($user_data->email)) ? $user_data->email : ''); ?>" name="txtDirectorEmail">  </li>
         <span><?php echo form_error('txtDirectorEmail'); ?></span>
        <li>
           <label> Special Qualifications : </label>
		<textarea rows="" cols="" class="h71" name="txtDirectorspecialqualifications"><?php echo (  isset($post_set['txtDirectorspecialqualifications']) && !empty($post_set['txtDirectorspecialqualifications']) ? $post_set['txtDirectorspecialqualifications'] : (isset( $user_data->special_qualification) && !empty($user_data->special_qualification)) ? $user_data->special_qualification : ''); ?></textarea>  <span><?php //echo form_error('txtDirectorspecialqualifications'); ?></span> </li>

      </ul>
     
      <ul>
      
<li><label>Address: </label>
		<textarea class="h71" name="txtDirectoraddress"><?php echo (  isset($post_set['txtDirectoraddress']) && !empty($post_set['txtDirectoraddress']) ? $post_set['txtDirectoraddress'] : (isset( $user_data->address) && !empty($user_data->address)) ? $user_data->address : ''); ?></textarea> <span><?php //echo form_error('txtDirectoraddress'); ?></span> </li>
        
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtDirectorstate']) && !empty($post_set['txtDirectorstate']) ? $post_set['txtDirectorstate'] : (isset( $user_data->state) && !empty($user_data->state)) ? $user_data->state : ''); ?>" name="txtDirectorstate">  <span><?php echo form_error('txtDirectorstate'); ?></span> </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtDirectorcountry']) && !empty($post_set['txtDirectorcountry']) ? $post_set['txtDirectorcountry'] : (isset( $user_data->country) && !empty($user_data->country)) ? $user_data->country : ''); ?>" name="txtDirectorcountry">   <span><?php echo form_error('txtDirectorcountry'); ?></span> </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" value="<?php echo (  isset($post_set['txtDirectorzip']) && !empty($post_set['txtDirectorzip']) ? $post_set['txtDirectorzip'] : (isset( $user_data->zip) && !empty($user_data->zip)) ? $user_data->zip : ''); ?>" name="txtDirectorzip">  <span><?php echo form_error('txtDirectorzip'); ?></span>  </li>
 
      </ul>
      </fieldset>

        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
     <ul>
                <li><label>Experience in Bharathanatyam :</label>
                     <input value="<?php echo (  isset($post_set['txtExperienceinBhar']) && !empty($post_set['txtExperienceinBhar']) ? $post_set['txtExperienceinBhar'] : (isset( $user_data->experience_bharathanatiyam) && !empty($user_data->experience_bharathanatiyam)) ? $user_data->experience_bharathanatiyam : ''); ?>" name="txtExperienceinBhar" maxlength="20" tabindex="16" id="txtExpBha" class="frm_element">  <span><?php //echo form_error('txtExperienceinBhar'); ?></span> </li>
                     <li>
           <label>Events Performances : </label>
		<textarea name="txtEvents" cols="" rows=""><?php echo (  isset($post_set['txtEvents']) && !empty($post_set['txtEvents']) ? $post_set['txtEvents'] : (isset( $user_data->events_performance) && !empty($user_data->events_performance)) ? $user_data->events_performance : ''); ?></textarea>   <span><?php //echo form_error('txtEvents'); ?></span> </li>
        <li>
           <label> Awards Titles : </label>
		<textarea name="txtAwarsds" cols="" rows=""> <?php echo (  isset($post_set['txtAwarsds']) && !empty($post_set['txtAwarsds']) ? $post_set['txtAwarsds'] : (isset( $user_data->award_title) && !empty($user_data->award_title)) ? $user_data->award_title : ''); ?></textarea>  <span><?php //echo form_error('txtAwarsds'); ?></span> </li>
        <li>
           <label>Ballets Choreographed: </label>
		<textarea name="txtBalletschoreographed" cols="" rows=""> <?php echo (  isset($post_set['txtBalletschoreographed']) && !empty($post_set['txtBalletschoreographed']) ? $post_set['txtBalletschoreographed'] : (isset( $user_data->ballets_choreographed) && !empty($user_data->ballets_choreographed)) ? $user_data->ballets_choreographed : ''); ?> </textarea> <span><?php //echo form_error('txtBalletschoreographed'); ?></span> </li>
     </ul>
            <ul>
                <li><label>Name of your Guru : </label><input value="<?php echo (  isset($post_set['txtGuruname']) && !empty($post_set['txtGuruname']) ? $post_set['txtGuruname'] : (isset( $user_data->master_name) && !empty($user_data->master_name)) ? $user_data->master_name : ''); ?>" name="txtGuruname" maxlength="50" tabindex="18" id="txtGuru" class="frm_element"> <span><?php //echo form_error('txtGuruname'); ?></span> </li>
                     
                      <li><label>Located at 	:</label><input value="<?php echo (  isset($post_set['txtguruLocatedat']) && !empty($post_set['txtguruLocatedat']) ? $post_set['txtguruLocatedat'] : (isset( $user_data->located_at) && !empty($user_data->located_at)) ? $user_data->located_at : ''); ?>" name="txtguruLocatedat" maxlength="50" tabindex="19" id="txtLoca" class="frm_element"> <span><?php //echo form_error('txtguruLocatedat'); ?></span> </li>
                      
                   <li><label>Other relevant info</label><textarea name="txtOtherInfo" tabindex="20" style="height: 30px;" id="txtInfo" class="frm_element"><?php echo (  isset($post_set['txtOtherInfo']) && !empty($post_set['txtOtherInfo']) ? $post_set['txtOtherInfo'] : (isset( $user_data->other_relevant_info) && !empty($user_data->other_relevant_info)) ? $user_data->other_relevant_info : ''); ?></textarea>  <span><?php //echo form_error('txtOtherInfo'); ?></span> 
              </li>
              
            </ul>
         <ul>
         
         </ul>
        </fieldset>
        
      </div>
      <ul><li class="btn"><input type="submit" class="submitBtn fL" value="Update" name="btnCenteredit">
          <a class="cancelBtn" href="<?php echo base_url().'music/center/profile'?>">Cancel</a>
        </li>
	  </ul>
      </div>
	   
      </form>
<div>
  
</div>
           
    </div>
</div>