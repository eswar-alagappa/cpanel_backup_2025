<div class="content">
       <div class="contentOuter">
      <h2><span>Center's Profile</span> 
       <div class="profileRightBtn">
       <ul>
       <li class="edit"><a href="<?php echo base_url().'dance/center/edit_profile'?>">Edit Profile</a></li>
       <li class="changePassword"><a href="<?php echo base_url().'dance/center/change_password'?>">Change password</a></li>
       </ul>
       </div>
      </h2>
      
      
       <div class="contentInner">
       <div class="profileContent">
       <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <th width="500" scope="col">Centre Profile</th>
    <th width="500" scope="col">Director Profile</th>
  </tr>
  <tr>
    <td>
     <span>RefCode</span>		:<?php echo $user_data->username ?>    <br>
      <span>Academy Name: </span>
	<?php echo $user_data->academyName ?>  <br>
   
      <span>Address	</span>	:    <?php echo $user_data->academyAddress ?> <br>
     <span> City</span>		: <?php echo $user_data->academyCity ?><br>
     <span> State</span>		: <?php echo $user_data->academyState ?> <br>
     <span> Zip code</span>		: <?php echo $user_data->academyZip ?> <br>
     <span> Country	</span>	: <?php echo $user_data->academyCountry ?><br>
      <span> Phone Day Time : </span><?php echo $user_data->contact ?><br>
<span>  Alternate Phone :	</span>	:  <?php echo ((isset($user_data->alternate_contact) && !empty($user_data->alternate_contact) && $user_data->alternate_contact!=0) ? $user_data->alternate_contact : '-'); ?><br>
  <span>Email :  </span>
	<?php echo $user_data->academyEmail ?> <br>
      <span> Website: </span> <?php echo ((isset($user_data->website) && !empty($user_data->website)) ? $user_data->website : '-'); ?><br>
       <span>Year of Establishment	</span>		: <?php echo ((isset($user_data->no_of_establishment) && !empty($user_data->no_of_establishment) && $user_data->no_of_establishment!=0) ? $user_data->no_of_establishment : '-'); ?><br>
        <span>Number Arangetrams	</span>		: <?php echo ((isset($user_data->no_of_arangetram) && !empty($user_data->no_of_arangetram) && $user_data->no_of_arangetram!=0) ? $user_data->no_of_arangetram : '-'); ?><br>

	
    
     </td>
    <td>
         
     <span>Director Name :</span> <?php echo $user_data->name ?><br>
        
      <span>Director's D.O.B: </span>  <?php echo date('d-M-Y',strtotime($user_data->dob)) ?><br>
        
      
         
       <span>Email : </span>  <?php echo $user_data->email ?> <br>
        <span style="width:160px">Special Qualifications : </span>   <?php echo ((isset($user_data->special_qualification) && !empty($user_data->special_qualification)) ? $user_data->special_qualification : '-'); ?><br>

      
 <span>Address: </span>   <?php echo ((isset($user_data->address) && !empty($user_data->address)) ? $user_data->address :'-'); ?><br>
        
       <span>State : </span>   
		 <?php echo $user_data->state ?> <br>
               <span>Country: </span>     <?php echo $user_data->country ?><br>
               <span>Zip: </span>    <?php echo $user_data->zip ?><br>
    
    <span style="width:240px">   Experience in Bharathanatyam :</span>   <?php echo ((isset($user_data->experience_bharathanatiyam) && !empty($user_data->experience_bharathanatiyam)) ? $user_data->experience_bharathanatiyam : '-'); ?> <br>
                  
             <span>Events Performances :</span> <?php echo ((isset($user_data->events_performance) && !empty($user_data->events_performance)) ? $user_data->events_performance :'-'); ?> <br>
          <span>Awards Titles :</span> <?php echo ((isset($user_data->award_title) && !empty($user_data->award_title)) ? $user_data->award_title : '-'); ?><br>
         <span style="width:160px">Ballets Choreographed:</span> <?php echo ((isset($user_data->ballets_choreographed) && !empty($user_data->ballets_choreographed)) ? $user_data->ballets_choreographed : '-'); ?><br>
         
       <span>Name of your Guru :</span> <?php echo ((isset($user_data->master_name) && !empty($user_data->master_name)) ? $user_data->master_name : '-'); ?><br>
                <span>Located at 	:</span> <?php echo ((isset($user_data->located_at) && !empty($user_data->located_at)) ? $user_data->located_at : '-'); ?><br>
               <span> Other relevant info :</span> <?php echo ((isset($user_data->other_relevant_info) && !empty($user_data->other_relevant_info)) ? $user_data->other_relevant_info : '-'); ?> <br>
    </td>
  </tr>
</tbody></table>


</div>
       </div>
      <div>
        
      </div>
           
    </div>
    </div>