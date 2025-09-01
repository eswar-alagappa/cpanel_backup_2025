<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet'
  type='text/css'>

<script>
  $(document).ready(function () {
    var d = new Date();
    $("#datepicker").datepicker({
      maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
      changeMonth: true,
      changeYear: true,
      yearRange: '-60:-06',
      dateFormat: 'mm/dd/yy',
    });


    $('.close_img').on('click', function () {
      var img = $(this).attr('data');
      if (img != '') {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>dance/student/remove_img",
          data: { imgname: img },
          success: function (value) {
            if (value == 1) {
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

    $("a.refresh").on('click', function () {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url().'dance/student/captcha_refresh'; ?>",
        success: function (res) {
          if (res) {
            $("div.image").html(res);
            //$('.realperson-hash').val(res);
          }
        }
      });
    });


  });


</script>
<style>
  #studentForm ul li p {
    color: #f00;
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
        <a target="_blank" href="<?php echo base_url() ?>assets/home/application_form-dance.pdf"><img width="270"
            height="30" src="<?php echo base_url()?>assets/home/images/download-btn.gif"></a>
      </div>

      <div class="registerFormOuter">
        <div class="fl"><img width="5" height="44"
            src="<?php echo base_url()?>assets/home/images/register-title-bg-left.png"></div>
        <!--<div class="registerFormTitle">To Get Admissions, Please fill in the form given below.</div>-->
        <div class="registerFormTitle">To Get Admissions, Please send the details given below.</div>
        <div class="fr"><img width="5" height="44"
            src="<?php echo base_url()?>assets/home/images/register-title-bg-right.png"></div>

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
          <form enctype="multipart/form-data" method="post"
            action="<?php echo base_url(); ?>#" id="#">
      <!--        action="<?php echo base_url(); ?>dance/student/new_registration" id="studentForm"> -->
            <p style="font-size:14px;">Personal Details</p>
            <ul>
              <li>
                <label>First Name :<strong class="star">*</strong></label><input type="text"
                  value="<?php echo (isset($post_set['txtFirstName']) && !empty($post_set['txtFirstName']) ? $post_set['txtFirstName'] : '');?>"
                  name="txtFirstName">
                <?php echo form_error('txtFirstName'); ?>
              </li>
              <li>
                <label>Age :<strong class="star">*</strong></label>
                <input type="text"
                  value="<?php echo (isset($post_set['txtAge']) && !empty($post_set['txtAge']) ? $post_set['txtAge'] : '');?>"
                  name="txtAge">
                <?php echo form_error('txtAge'); ?>
              </li>
              <li><label> Gender :<strong class="star">*</strong></label>
                <div class="studentgender"><input type="radio" value="Male" name="txtGender" <?php if(
                    !empty($post_set['txtGender']) && $post_set['txtGender']=='Male' ) { ?> checked
                  <?php }else{ ?>checked
                  <?php } ?> class="radiobtn">Male
                  <input type="radio" value="Female" name="txtGender" class="radiobtn" <?php if(!empty($post_set['txtGender'])
                    && $post_set['txtGender']=='Female' ) { ?> checked
                  <?php } ?>>Female
                </div>
                <?php echo form_error('txtGender'); ?>
              </li>
              <li style="margin-top:7px;"><label>Mobile :<strong class="star">*</strong> </label><input type="text"
                  name="txtMobileNo"
                  value="<?php echo (isset($post_set['txtMobileNo']) && !empty($post_set['txtMobileNo']) ? $post_set['txtMobileNo'] : '');?>">
                <?php echo form_error('txtMobileNo'); ?>
              </li>
              <li><label>Email:<strong class="star">*</strong></label><input type="text" name="txtEmail"
                  value="<?php echo (isset($post_set['txtEmail']) && !empty($post_set['txtEmail']) ? $post_set['txtEmail'] : '');?>">
                <?php echo form_error('txtEmail'); ?>
              </li>
              <li><label>Father Name:<strong class="star">*</strong></label><input type="text" name="txtFatherName"
                  value="<?php echo (isset($post_set['txtFatherName']) && !empty($post_set['txtFatherName']) ? $post_set['txtFatherName'] : '');?>">
                <?php echo form_error('txtFatherName'); ?>
              </li>
              <li><label>Father Occupation:</label><input type="text" name="txtFatherOcc"
                  value="<?php echo (isset($post_set['txtFatherOcc']) && !empty($post_set['txtFatherOcc']) ? $post_set['txtFatherOcc'] : '');?>">
                <?php echo form_error('txtFatherOcc'); ?>
              </li>
              <li><label>Mother Name:<strong class="star">*</strong></label><input type="text" name="txtMotherName"
                  value="<?php echo (isset($post_set['txtMotherName']) && !empty($post_set['txtMotherName']) ? $post_set['txtMotherName'] : '');?>">
                <?php echo form_error('txtMotherName'); ?>
              </li>
              <li><label>Mother Occupation:</label><input type="text" name="txtMotherOcc"
                  value="<?php echo (isset($post_set['txtMotherOcc']) && !empty($post_set['txtMotherOcc']) ? $post_set['txtMotherOcc'] : '');?>">
                <?php echo form_error('txtMotherOcc'); ?>
              </li>
              
              
            </ul>
            <ul>
              <li>
                <label>Last Name : <strong class="star">*</strong></label><input type="text"
                  value="<?php echo (isset($post_set['txtLastName']) && !empty($post_set['txtLastName']) ? $post_set['txtLastName'] : '');?>"
                  name="txtLastName">
                <?php echo form_error('txtLastName'); ?>
              </li>
              <li class="studentdate"><label>D.O.B : </label><input type="text"
                  value="<?php echo (isset($post_set['txtDOB']) && !empty($post_set['txtDOB']) ? $post_set['txtDOB'] : '');?>"
                  id="datepicker" class="datetxtbox hasDatepick" name="txtDOB">
              </li>
              <li class="photo">
                <label>Photo(Image Only) : <strong class="star">*</strong></label><input type="file" class="custom_upload" id="flePhoto" name="flePhoto" required >
                <input type="hidden" name="uploadImage"
                  value="<?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? $post_set['uploadImage'] : '');?>">
                <?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? '<img src="../../assets/profile/'.$post_set['uploadImage'].'"><img data="'.$post_set['uploadImage'].'" class="close_img" src="../../assets/home/images/button_close1.gif">' : '');?>
              </li>
              <li><label>Alternate Phone Number: </label><input type="text"
                  value="<?php echo (isset($post_set['txtAlterMobileNo']) && !empty($post_set['txtAlterMobileNo']) ? $post_set['txtAlterMobileNo'] : '');?>"
                  name="txtAlterMobileNo"> </li>
                <li><label>Address:<strong class="star">*</strong> </label><textarea rows="" cols=""
                  name="txtAddress"><?php echo (isset($post_set['txtAddress']) && !empty($post_set['txtAddress']) ? $post_set['txtAddress'] : '');?></textarea>
                <?php echo form_error('txtAddress'); ?>
              </li>
              <li> <label>City :<strong class="star">*</strong></label><input type="text" name="txtCity"
                  value="<?php echo (isset($post_set['txtCity']) && !empty($post_set['txtCity']) ? $post_set['txtCity'] : '');?>">
                <?php echo form_error('txtCity'); ?>
              </li>
              <li>
                <label>State :<strong class="star">*</strong></label><input type="text" name="txtState"
                  value="<?php echo (isset($post_set['txtState']) && !empty($post_set['txtState']) ? $post_set['txtState'] : '');?>">
                <?php echo form_error('txtState'); ?>
              </li>
              <li>
                <label>Zip :<strong class="star">*</strong></label><input type="text" name="txtZip"
                  value="<?php echo (isset($post_set['txtZip']) && !empty($post_set['txtZip']) ? $post_set['txtZip'] : '');?>">
                <?php echo form_error('txtZip'); ?>
              </li>
              <li>
                <label>Country :<strong class="star">*</strong></label><input type="text" name="txtCountry"
                  value="<?php echo (isset($post_set['txtCountry']) && !empty($post_set['txtCountry']) ? $post_set['txtCountry'] : '');?>">
                <?php echo form_error('txtCountry'); ?>
              </li>
              <li class="photo">
                <label>Birth Certificate(Image Only) :<strong class="star">*</strong> </label><input type="file" class="custom_upload" id="fleBirth" name="fleBirth" required >
                <input type="hidden" name="uploadBirthImage"
                  value="<?php echo (isset($post_set['uploadBirthImage']) && !empty($post_set['uploadBirthImage']) ? $post_set['uploadBirthImage'] : '');?>">
                <?php echo (isset($post_set['uploadBirthImage']) && !empty($post_set['uploadBirthImage']) ? '<img src="../../assets/profile/'.$post_set['uploadBirthImage'].'"><img data="'.$post_set['uploadBirthImage'].'" class="close_img" src="../../assets/home/images/button_close1.gif">' : '');?>
              </li>
            </ul>
            
            <p style="font-size:14px;">Academic Background</p>
            <ul>
              <li>
                <label>Level : </label><input type="text"
                  value="<?php echo (isset($post_set['txtLevel']) && !empty($post_set['txtLevel']) ? $post_set['txtLevel'] : '');?>"
                  name="txtLevel">
                <?php echo form_error('txtLevel'); ?>
              </li>
            <!--  <li> <label>City :<strong class="star">*</strong></label><input type="text" name="txtAcaCity"
                  value="<?php echo (isset($post_set['txtAcaCity']) && !empty($post_set['txtAcaCity']) ? $post_set['txtAcaCity'] : '');?>">
                <?php echo form_error('txtAcaCity'); ?>
              </li>-->
            </ul>
            <ul>
              <li>
                <label>Name of institution : </label><input type="text"
                  value="<?php echo (isset($post_set['txtNameofIns']) && !empty($post_set['txtNameofIns']) ? $post_set['txtNameofIns'] : '');?>"
                  name="txtNameofIns">
                <?php echo form_error('txtNameofIns'); ?>
              </li>
             <!-- <li>
                <label>State :<strong class="star">*</strong></label><input type="text" name="txtAcaState"
                  value="<?php echo (isset($post_set['txtAcaState']) && !empty($post_set['txtAcaState']) ? $post_set['txtAcaState'] : '');?>">
                <?php echo form_error('txtAcaState'); ?>
              </li>-->
           <!--   <li>
                <label>Country :<strong class="star">*</strong></label><input type="text" name="txtAcaCountry"
                  value="<?php echo (isset($post_set['txtAcaCountry']) && !empty($post_set['txtAcaCountry']) ? $post_set['txtAcaCountry'] : '');?>">
                <?php echo form_error('txtAcaCountry'); ?>
              </li>-->
            </ul>
            <br>
            <p style="font-size:14px;">Experience in Bharathanatyam</p>
            <ul>
              <li>
                <label>Year of Experience : </label><input type="text"
                  value="<?php echo (isset($post_set['txtExpInBhar']) && !empty($post_set['txtExpInBhar']) ? $post_set['txtExpInBhar'] : '');?>"
                  name="txtExpInBhar">
                <?php echo form_error('txtExpInBhar'); ?>
              </li>
              <li>
                <label>Name of your Guru : </label><input type="text"
                  value="<?php echo (isset($post_set['txtNameofGuru']) && !empty($post_set['txtNameofGuru']) ? $post_set['txtNameofGuru'] : '');?>"
                  name="txtNameofGuru">
                <?php echo form_error('txtNameofGuru'); ?>
              </li>
              <li>
                <label>Name of the Dance Institution : </label><input type="text"
                  value="<?php echo (isset($post_set['txtNameofDanceIns']) && !empty($post_set['txtNameofDanceIns']) ? $post_set['txtNameofDanceIns'] : '');?>"
                  name="txtNameofDanceIns">
                <?php echo form_error('txtNameofDanceIns'); ?>
              </li>
              
              
              <!--<li style="margin-top:15px;">
                <label>Country :<strong class="star">*</strong></label><input type="text" name="txtBharCountry"
                  value="<?php echo (isset($post_set['txtBharCountry']) && !empty($post_set['txtBharCountry']) ? $post_set['txtBharCountry'] : '');?>">
                <?php echo form_error('txtBharCountry'); ?>
              </li>-->
            </ul>
            <ul>
              <li>
                <label>Special accomplishments (if any) : </label><input type="text"
                  value="<?php echo (isset($post_set['txtSpecqualification']) && !empty($post_set['txtSpecqualification']) ? $post_set['txtSpecqualification'] : '');?>"
                  name="txtSpecqualification">
                <?php echo form_error('txtSpecqualification'); ?>
              </li>
              
              <li><label>Credentials & Awards: </label><input type="text"
                  value="<?php echo (isset($post_set['txtBharAlterMobileNo']) && !empty($post_set['txtBharAlterMobileNo']) ? $post_set['txtBharAlterMobileNo'] : '');?>"
                  name="txtBharAlterMobileNo"> </li>
                <li><label>Mobile :<strong class="star">*</strong> </label><input type="text" name="txtBharMobileNo"
                  value="<?php echo (isset($post_set['txtBharMobileNo']) && !empty($post_set['txtBharMobileNo']) ? $post_set['txtBharMobileNo'] : '');?>">
                <?php echo form_error('txtBharMobileNo'); ?>
              </li>
              <li><label>Address:<strong class="star">*</strong> </label><textarea rows="" cols=""
                  name="txtBharAddress"><?php echo (isset($post_set['txtBharAddress']) && !empty($post_set['txtBharAddress']) ? $post_set['txtBharAddress'] : '');?></textarea>
                <?php echo form_error('txtBharAddress'); ?>
              </li>
              <!--<li> <label>City :<strong class="star">*</strong></label><input type="text" name="txtBharCity"
                  value="<?php echo (isset($post_set['txtBharCity']) && !empty($post_set['txtBharCity']) ? $post_set['txtBharCity'] : '');?>">
                <?php echo form_error('txtBharCity'); ?>
              </li>
              <li>
                <label>State :<strong class="star">*</strong></label><input type="text" name="txtBharState"
                  value="<?php echo (isset($post_set['txtBharState']) && !empty($post_set['txtBharState']) ? $post_set['txtBharState'] : '');?>">
                <?php echo form_error('txtBharState'); ?>
              </li>
              <li>
                <label>Zip :<strong class="star">*</strong></label><input type="text" name="txtBharZip"
                  value="<?php echo (isset($post_set['txtBharZip']) && !empty($post_set['txtBharZip']) ? $post_set['txtBharZip'] : '');?>">
                <?php echo form_error('txtBharZip'); ?>
              </li>-->
            </ul>
            <label>Program Enrolled :<strong class="star">*</strong></label>
            <table class="course" border="1" width="100%" cellspacing="0" cellpadding="0"
              style="margin-top:10px;margin-bottom:10px;">
              <tr>
                <th>Certificate</th>
                <th>Advanced Certificate</th>
                <th>Diploma</th>
                <th>Degree</th>
              </tr>
              <tr>
                <td><input type="checkbox" name="txtRegular" class="group" value="Certificate" /> Regular</td>
                <td><input type="checkbox" name="txtRegular" class="group" value="Advanced Certificate" /> Regular</td>
                <td><input type="checkbox" name="txtRegular" class="group" value="Diploma" /> Regular</td>
                <td><input type="checkbox" name="txtRegular" class="group" value="Degree" /> Regular</td>
              </tr>
            </table>
            <p>Sequence for course enrollment: Certificate, Advanced Certificate, Diploma, Bachelor’s Degree</p>
            <table class="course" border="1" width="50%" cellspacing="0" cellpadding="0"
              style="margin-top:10px;margin-bottom:10px;float:left;">
              <tr>
                <th colspan='3'>CERTIFICATE PROGRAM</th>
              </tr>
              <tr>
                <th>Course Code</th>
                <th>Course Contents</th>
                <th>Fees USD</th>
              </tr>
              <tr>
                <td>CEB RG</td>
                <td>Registration</td>
                <td style='text-align:right;'>$ 75.00</td>
              </tr>
              <tr>
                <td>CEB 01</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 75.00</td>
              </tr>
              <tr>
                <td>CEB P1</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>CEB 02</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 75.00</td>
              </tr>
              <tr>
                <td>CEB P2</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>CEB P3</td>
                <td>Project</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td>CEB GR</td>
                <td>Graduation</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td>CEB LSV</td>
                <td>Lecture videos</td>
                <td style='text-align:right;'>$ 25.00</td>
              </tr>
              <tr>
                <td colspan='2' style='text-align:right;margin-right:-10px;'>Total</td>
                <td style='text-align:right;'>$ 450.00</td>
              </tr>
            </table>
            <table class="course" border="1" width="50%" cellspacing="0" cellpadding="0"
              style="margin-top:10px;margin-bottom:10px;float:left;">
              <tr>
                <th colspan='3'>ADVANCED CERTIFICATE PROGRAM</th>
              </tr>
              <tr>
                <th>Course Code</th>
                <th>Course Contents</th>
                <th>Fees USD</th>
              </tr>
              <tr>
                <td>ADB RG</td>
                <td>Registration</td>
                <td style='text-align:right;'>$ 75.00</td>
              </tr>
              <tr>
                <td>ADB 01</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 125.00</td>
              </tr>
              <tr>
                <td>ADB P1</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>ADB 02</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 125.00</td>
              </tr>
              <tr>
                <td>ADB P2</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>ADB P3</td>
                <td>Project</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td>ADB GR</td>
                <td>Graduation</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td>ADB LSV</td>
                <td>Lecture videos</td>
                <td style='text-align:right;'>$ 25.00</td>
              </tr>
              <tr>
                <td colspan='2' style='text-align:right;margin-right:-10px;'>Total</td>
                <td style='text-align:right;'>$ 600.00</td>
              </tr>
            </table>

            <table class="course" border="1" width="50%" cellspacing="0" cellpadding="0"
              style="margin-top:10px;margin-bottom:10px;float:left;">
              <tr>
                <th colspan='3'>DIPLOMA PROGRAM</th>
              </tr>
              <tr>
                <th>Course Code</th>
                <th>Course Contents</th>
                <th>Fees USD</th>
              </tr>
              <tr>
                <td>DIB RG</td>
                <td>Registration</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td>DIB 01</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 150.00</td>
              </tr>
              <tr>
                <td>DIB P1</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>DIB 02</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 150.00</td>
              </tr>
              <tr>
                <td>DIB P2</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>DIB P3</td>
                <td>Project</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td>DIB P4</td>
                <td>Project</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td>DIB GR</td>
                <td>Graduation</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td colspan='2' style='text-align:right;margin-right:-10px;'>Total</td>
                <td style='text-align:right;'>$ 800.00</td>
              </tr>
            </table>
            <table class="course" border="1" width="50%" cellspacing="0" cellpadding="0"
              style="margin-top:10px;margin-bottom:10px;float:left;">
              <tr>
                <th colspan='3'>DEGREE PROGRAM</th>
              </tr>
              <tr>
                <th>Course Code</th>
                <th>Course Contents</th>
                <th>Fees USD</th>
              </tr>
              <tr>
                <td>BSB RG</td>
                <td>Registration</td>
                <td style='text-align:right;'>$ 100.00</td>
              </tr>
              <tr>
                <td>BSB 01</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 175.00</td>
              </tr>
              <tr>
                <td>BSB P1</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>BSB A1</td>
                <td>Allied</td>
                <td style='text-align:right;'>$ 50.00</td>
              </tr>
              <tr>
                <td>BSB 02</td>
                <td>Theory</td>
                <td style='text-align:right;' rowspan='2'>$ 175.00</td>
              </tr>
              <tr>
                <td>BSB P2</td>
                <td>Practical</td>
              </tr>
              <tr>
                <td>BSB A2</td>
                <td>Allied</td>
                <td style='text-align:right;'>$ 50.00</td>
              </tr>
              <tr>
                <td>BSB P3</td>
                <td>Project I</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td>BSB P4</td>
                <td>Project II</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td>BSB GR</td>
                <td>Graduation</td>
                <td style='text-align:right;'>$ 150.00</td>
              </tr>
              <tr>
                <td colspan='2' style='text-align:right;margin-right:-10px;'>Total</td>
                <td style='text-align:right;'>$ 1000.00</td>
              </tr>
            </table>

<label>NOTE:</label>
 <p>Students are requested to fill in all the fields. If any field is missed, your application will not be registered. Once it is successfully registered, a confirmation message will be displayed. "Thanks for your Registration. Please wait for Admin approval"</p>

          <!--  <div class="registerBtn"><input type="submit" id="submit" value="Register" class="registerBtn"
                name="submit"></div> -->
<div class="registerBtn"><input type="submit" id="submit" value="Register" class="registerBtn"
                name="submit"></div>

          </form>
        </div>

      </div>


    </div>
  </div>
</div>