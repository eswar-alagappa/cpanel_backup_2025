<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    
  <script>
  $(document).ready(function () {
	  var d = new Date();
	$( "#datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'mm/dd/yy',
    });
	
	
	$('.close_img').on('click',function(){
			var img = $(this).attr('data');
			if(img !='')
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>dance/student/remove_img",
					data:{imgname:img},
					success: function(value)
					{
							if( value ==1){
								//window.location.reload();
								$('li.photo').find('img').hide();
								$('input[name="uploadImage"]').val(' ');
							}
					}
					
				});
			}
	});
	
	
  });
  
  $(document).ready(function () {
	
	$("a.refresh").on('click',function() { 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'dance/student/captcha_refresh'; ?>",
                        success: function(res) { 
                            if (res)
                            {
                                  $("div.image").html(res);
								  //$('.realperson-hash').val(res);
                            }
                        }
                    });
                });
				

  });
  

  </script>
  <style>
  #studentForm ul li p{
	  color:#f00;
  }
  </style>
<div class="danceInnerContent">
<?php $this->load->view('left_banner'); ?> 
<div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span>Student’s Registration</span></h2>
</div>
<div class="apaaContent">
<div class="fr mB10">
<a target="_blank" href="<?php echo base_url() ?>assets/home/application_form-dance.pdf"><img width="270" height="30" src="<?php echo base_url()?>assets/home/images/download-btn.gif"></a>
</div>

   <div class="registerFormOuter">
<div class="fl"><img width="5" height="44" src="<?php echo base_url()?>assets/home/images/register-title-bg-left.png"></div>
<!--<div class="registerFormTitle">To Get Admissions, Please fill in the form given below.</div>-->
<div class="registerFormTitle">To Get Admissions, Please send the details given below.</div><div class="fr"><img width="5" height="44" src="<?php echo base_url()?>assets/home/images/register-title-bg-right.png"></div>
<div class="registerForm">

<p>Dear Student,</p>

<p>Greetings from APAA</p>

<p>It is with great pleasure that we welcome you to APAA structured Learning Program in Bharathanatyam. The students of APAC (Alagappa Performing Arts Authorized Center) are requested to download the Application form. The filled Application has to be enclosed with stated below:</p>

<p>1. A current passport size photograph.</p>
<p>2. Proof of age certificate.</p>
<p>3. Payment of fees to the program which can be found at <a href="http://alagappaarts.com/dance/academics/fee-structure" target="_blank">Fees structure page</a> The check made payable to :</p>
<p style="line-height:8px;">APAA,</p>
<p style="line-height:8px;">1647 Andorre Glen,</p>
<p style="line-height:8px;">Escondido,</p>
<p style="line-height:8px;">CA 92029, USA</p>
<br/>
<p>Please mail 1,2 & 3 to the above address. Once this has been received and the application is complete we will mail you the educational aids and will notify your Guru. An id. and password will be assigned to you and you can start with the program. </p>
<p>Individual Students are requested to register with an APAC (Alagappa Performing Arts Academy Authorized Center) or can directly enroll for the Certificate and Advance Certificate Program only (Note for Diploma, Degree student must enroll with APAC).</p>
<p style="text-align: start;">If you have any questions please feel free to contact us at <a href="mailto:customersupport@alagappaarts.com" target="_top">customersupport@alagappaarts.com</a></p>
<p style="line-height:8px;">Sincerely yours</p>
<p style="line-height:8px;">APAA Team</p>

</div>
<!---

//  new hide


<div class="registerForm">
<center><span class="studentregCorrect"></span></center>
<center><span class="successMsg">
				<?php if ($this->session->flashdata('SucMessage')) { ?>
					<div class="alert alert-danger alert-dismissable">
                        <?php echo $this->session->flashdata('SucMessage'); ?>
                    </div>
			</span><span class="errorMsg">
				<?php }if ($this->session->flashdata('ErrMessage')) { ?>
					<div class="alert alert-danger alert-dismissable">
                        <?php echo $this->session->flashdata('ErrMessage'); ?>
                    </div>
				<?php } ?>
</span></center>
 <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>dance/student/registration" id="studentForm">
<ul>
<li><label>Program :<strong class="star">*</strong></label><select name="program_id" id="program_id">
  <option value="">Select</option>
  <?php if(!empty($programs)) { foreach($programs as $k=>$pgm){?>
		<option value="<?php echo $pgm->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $pgm->program_id) ? 'selected' : '');?>><?php echo stripslashes($pgm->name); ?></option>
	<?php } } ?>
<!--<option value="1">Certificate in Bharathanatyam</option><option value="2">Associate Degree</option><option value="3">Diploma in Bharathanatyam</option><option value="4">Bachelor's Degree</option><option value="5">MBA</option><option value="6">med</option><option value="7">TEST </option><option value="8">MCA</option>  -->
  </select><?php echo form_error('program_id'); ?></li>
  <!--<li>
  <label>Username :<strong class="star">*</strong></label><input type="text" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : '');?>" name="username"><?php echo form_error('username'); ?></li>-->
<!-- 
//
  <li>
 <li>
  <label>First Name :<strong class="star">*</strong></label><input type="text" value="<?php echo (isset($post_set['first_name']) && !empty($post_set['first_name']) ? $post_set['first_name'] : '');?>" name="first_name"><?php echo form_error('first_name'); ?></li>
<li>
</li><li>
  <label>Last Name : </label><input type="text" value="<?php echo (isset($post_set['last_name']) && !empty($post_set['last_name']) ? $post_set['last_name'] : '');?>" name="last_name"><?php echo form_error('last_name'); ?></li>
<li>
</li><li>
  <label>Age :<strong class="star">*</strong></label>
  <input type="text" value="<?php echo (isset($post_set['age']) && !empty($post_set['age']) ? $post_set['age'] : '');?>" name="age"><?php echo form_error('age'); ?></li>
<li class="studentdate"><label>D.O.B : </label><input type="text" value="<?php echo (isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : '');?>" id="datepicker" class="datetxtbox hasDatepick" name="dob">  // >
<!--<img class="datepick-trigger" src="http://alagappaarts.com/dance/wp-content/themes/dance/images/calendar.gif" alt="Select date" title="Select date">-->


<!-- //

</li>


<li><label> Gender :<strong class="star">*</strong></label>
		<div class="studentgender"><input type="radio" value="Male" name="gender" <?php if( !empty($post_set['gender']) && $post_set['gender'] =='Male') { ?> checked <?php }else{ ?>checked<?php } ?> class="radiobtn">Male
        <input type="radio" value="Female" name="gender" class="radiobtn" <?php if(!empty($post_set['gender']) && $post_set['gender'] =='Female') { ?> checked <?php } ?>>Female</div> <?php echo form_error('gender'); ?></li>

    

 <li class="photo">
 
  <label>Photo : </label><input type="file" class="custom_upload" id="flePhoto" name="flePhoto">
   <input type="hidden" name="uploadImage" value="<?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? $post_set['uploadImage'] : '');?>">
   <?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? '<img src="../../assets/profile/'.$post_set['uploadImage'].'"><img data="'.$post_set['uploadImage'].'" class="close_img" src="../../assets/home/images/button_close1.gif">' : '');?>
   
  
								
  </li>
<li>
  </li><li><label>Alternate Phone Number: </label><input type="text" value="<?php echo (isset($post_set['other_contact']) && !empty($post_set['other_contact']) ? $post_set['other_contact'] : '');?>" name="other_contact">  </li>     
  <li><label>Special accomplishments (if any)</label><input name="txtSpecqualification" value="<?php echo (isset($post_set['txtSpecqualification']) && !empty($post_set['txtSpecqualification']) ? $post_set['txtSpecqualification'] : '');?>" maxlength="100" tabindex="17"></li>
  <li><label>Other relevant info</label><textarea name="txtotherinfo" tabindex="20" style="height: 30px;"><?php echo (isset($post_set['txtotherinfo']) && !empty($post_set['txtotherinfo']) ? $post_set['txtotherinfo'] : '');?></textarea> </li>
  
  //>

   <!--<li>
  <label>What code is in the image? :<strong class="star">*</strong></label>
      <div style="width:200px;float:left;">
	  <input type="text" size="10" maxlength="10" id="selector" name="captcha" class="hasRealPerson">
	  </div>
	  
	  <div style="width:200px;float:left;">
	  <div class="image"><?php echo $image['image']; ?> </div>
	  <a href="javascript:;" class='refresh'><img id="ref_symbol" src="<?php echo base_url().'assets/img/refresh.png' ?>" ></a>
	  
	   <span class="red-c"><?php 
                                if((isset($captcha_error) && $captcha_error!='')){
                                echo (!empty($captcha_error) ? $captcha_error : '');} ?></span>
								
	</div>
 
</li>-->

<!-- //


</ul>
<ul>
<li><label>Center :<strong class="star">*</strong> </label><select name="center_id">
  <option value="">Select</option>
  
  <?php if(!empty($centers)) { foreach($centers as $k=>$center){?>
		<option value="<?php echo $center->center_academy_id; ?>" <?php echo (isset($post_set['center_id']) && !empty($post_set['center_id'])  && ($post_set['center_id']== $center->center_academy_id) ? 'selected' : '');?>><?php echo stripslashes($center->name); ?></option>
	<?php } } ?>
	
//	-->
													
   <!--<option value="1">Natya Darshan School of Indian Dancing</option><option value="3">OnlineBharatanatyam</option><option value="5">Anuradha Dance Academy</option><option value="7">Tiruchitrambalam</option><option value="9">Nitya Shetra Dance School</option><option value="11">Abhinaya School of Dance</option><option value="13">Nritya Academy</option><option value="15">Kalavrsti-Jakarta</option><option value="17">Kalaprerana</option><option value="19">Natyanjali</option><option value="21">Natyamudra</option><option value="23">Nadanalaya Academy of Dance</option><option value="25">Nrithyakshethra Dance Academy</option><option value="27">Cultural Centre of India</option><option value="29">Bharatha School of Dance &amp; Music</option><option value="31">Rhythms School of Dance</option><option value="33">Bharathakala Nityashetra</option><option value="35">Kalabharathi School of Dance</option><option value="37">From Within Bharatanatyam Dance</option><option value="39">Hindu Temple Rhythyms</option><option value="41">Kalaikoil</option><option value="43">Shiv Jyoti Dance Academy</option><option value="45">Shri Krupa Dance Foundation</option><option value="47">Kalaivani Dance &amp; Music Academy</option><option value="49">Natya Anubha Academy of Dance</option><option value="51">Nrityakala Dance Academy</option><option value="53">Kalavrsti-Bandung</option><option value="55">Nritya School of Indian Dance &amp; Music</option><option value="57">Aum ~ Shakti Center for Dance &amp; Music Education </option><option value="59">Nrityanjali</option><option value="61">Sunanda's Performing Arts</option><option value="62">APAA</option><option value="63">Alapadma Dance Yoga</option><option value="64">Academy of Laya and Dhwani</option><option value="65">The Temple Of Dance,LLC</option><option value="72">Arunodhaya Dance Academy</option><option value="74">Center for Kuchipudi</option><option value="76">Nadanalaya Natya Mandram</option><option value="81">TARANAM MUSIC ACADEMY</option><option value="105">NrityArpana School of Performing Arts</option><option value="125">Nrityananda School of Bharatanatyam &amp; Music</option><option value="133">InQTest</option>-->
   <!-- 
   
   //
   </select><?php echo form_error('center_id'); ?></li>


  <li><label>Address:<strong class="star">*</strong> </label><textarea rows="" cols="" name="address"><?php echo (isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : '');?></textarea><?php echo form_error('address'); ?></li>
  <li> <label>City :<strong class="star">*</strong></label><input type="text" name="city" value="<?php echo (isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : '');?>"><?php echo form_error('city'); ?></li>

<li>
  <label>State :<strong class="star">*</strong></label><input type="text" name="state" value="<?php echo (isset($post_set['state']) && !empty($post_set['state']) ? $post_set['state'] : '');?>"><?php echo form_error('state'); ?></li>


<li>
  <label>Country :<strong class="star">*</strong></label><input type="text" name="country" value="<?php echo (isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : '');?>"><?php echo form_error('country'); ?></li>
<li>
  <label>Zip :<strong class="star">*</strong></label><input type="text" name="zip" value="<?php echo (isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : '');?>"><?php echo form_error('zip'); ?></li>
  <li><label>Mobile :<strong class="star">*</strong> </label><input type="text" name="contact" value="<?php echo (isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : '');?>"><?php echo form_error('contact'); ?></li>
 <li><label>Email:<strong class="star">*</strong></label><input type="text" name="email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : '');?>">  <?php echo form_error('email'); ?></li>

  <li><label>Experience in Bharathanatyam :<strong class="star">*</strong></label>
 <input name="exp_bharatanatyam" maxlength="20" tabindex="16" id="exp_bharatanatyam" class="frm_element" value="<?php echo (isset($post_set['exp_bharatanatyam']) && !empty($post_set['exp_bharatanatyam']) ? $post_set['exp_bharatanatyam'] : '');?>"><?php echo form_error('exp_bharatanatyam'); ?></li>

  <li><label>Name of your Guru :<strong class="star">*</strong> </label><input name="name_of_guru" maxlength="50" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : '');?>" tabindex="18"><?php echo form_error('name_of_guru'); ?></li>
 <li><label>Your Guru Located at 	:</label><input name="txtLoca" maxlength="50" tabindex="19" value="<?php echo (isset($post_set['txtLoca']) && !empty($post_set['txtLoca']) ? $post_set['txtLoca'] : '');?>"></li>
<br>
    
</ul>
<div class="registerBtn"><input type="submit" id="submit" value="Register" class="registerBtn" name="submit"></div>

</form>
	//-->
	
	<!-- //
</div>  

//-->

  </div>
  
  
</div>
</div>
</div>


