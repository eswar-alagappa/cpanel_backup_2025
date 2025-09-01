<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/programmaster.class.php");
include('adminheader.php');
$programmaster  = new programmaster();
$programname = $programmaster->getProgramforProgramFee();

if(isset($_REQUEST['btnProgramFeeadd']))
{
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$programmaster  = new programmaster();
		$count = $programmaster -> checkprogramfee($_REQUEST['ddlProgram']);
		if(!$count)
	   {
		$programmaster -> addprogramfee ($_REQUEST);
		$ackmsg = $programmaster ->  updateProgramFeeonProg($_REQUEST['ddlProgram']);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Program fee added successfully';
			header("location:admin_programfee_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	  }
	  else
	  {
		  $msg = "Program  already exists";
	  }
		/*if($count){
			$msg = "Program Already Exsist";
		}
		else{
			 $programmaster -> addprogramfee ($_REQUEST);
			 $programmaster -> updateProgramFeeonProg($_REQUEST['ddlProgram']);
		     header('location:admin_programfee_listing.php');
		}*/
}
?>
<script type="text/javascript" src="../web/validation/program-fee.validate.js"></script>

<script type="text/javascript" >

$(document).ready(function() {
	$('#selectProgram').change(function() {
		$('fieldset').show();
  $("#programCourses").html('Loading sub-categories...');
   $(".dynamicfields>div:not(:first-child,:nth-child(2))").remove();
   $(".dynamicfields>div:nth-child(2)").find('.classMultiple').attr("disabled", false);

  var selctedval= $('#selectProgram').val();
  //alert(selctedval);
  $.ajax({
                       type: "GET",
                       url: "coursedropdown.php",
                       data: "programID=" + selctedval,
                       success: function(result){
                         $(".programCourses").html(result);
                       }
                     });
  });
  if( $(".dynamicfields").children().size() ==  2 ){
				 $(".dynamicfields>div:nth-child(2)").find(".deleteCourse img").attr("src","../web/images/delete-btn-inactive.png");
			}  
  
	var addFieldNo = 2;
	$('.addCourse').click(function() { 
	//alert( $(".dynamicfields").children().size());
	
	if( $(".dynamicfields>div:last-child select option:selected").length != 0   ){
		$(".dynamicfields>div").find('.errorSelectBox').remove();
	 $(".classMultiple").attr("disabled", true);
	var multipleValues='';
	$(".dynamicfields>div").find(".classMultiple").each(function() {
			 if($(this).val()  != 'null')
		  		 multipleValues += $(this).val() || [];
				 multipleValues =  multipleValues  + ',';
	});
	
	 var  multipleArray = multipleValues.split(','); 
	// alert($('.dynamicfields>div:first-child div select.programCourses option').length);
	 if($('.dynamicfields>div:first-child div select option').length != (multipleArray.length- 1)){
	
		 $(".dynamicfields>div:first-child").clone(true).insertAfter(".dynamicfields>div:last-child");
		   $.each(multipleArray,function(i,v){
			 if(v != ''){
			// alert(v);
			$(".dynamicfields>div:last-child select option[value="+ v +"]").remove();}
			 });
	$(".dynamicfields>div:last-child").css("display","block");
	 $(".dynamicfields>div:last-child").find(".classMultiple").attr("disabled", false);
	$(".dynamicfields>div:last-child").find("select").addClass('classMultiple');
	$(".dynamicfields>div:last-child").find("select").attr( "id", "listcourse"+addFieldNo);
	$(".dynamicfields>div:last-child").find("select").attr( "name", "listcourse1[array1]["+addFieldNo+"][]" );
	$(".dynamicfields>div:last-child").find("select").addClass('required');
	$(".dynamicfields>div:last-child").find("input").addClass('required');
	$(".dynamicfields>div:last-child").find("input").addClass('number');
	$(".dynamicfields>div:last-child").find("input").attr( "id", "txtFeeBox"+addFieldNo);
	$(".dynamicfields>div:last-child").find('div.error').remove();
	addFieldNo++;
	 if( $(".dynamicfields").children().size() ==  2 )
	 $(".dynamicfields>div:nth-child(2)").find(".deleteCourse img").attr("src","../web/images/delete-btn-inactive.png");
	 else 
	  $(".dynamicfields>div:nth-child(2)").find(".deleteCourse img").attr("src","../web/images/delete-btn.png");
	return false;
	}
	}
	else{
		$(".dynamicfields>div:last-child").find('.errorSelectBox').remove();
		//alert($(".dynamicfields>div:last-child").find('div.error').length);
		if ($(".dynamicfields>div:last-child").find('div.error').length == 0)
		$(".dynamicfields>div:last-child").append("<div class='errorSelectBox'>Please select</div>");
		}
	
		 
	 
	});
	$('.deleteCourse').click(function(){
		 
			if( $(".dynamicfields").children().size() > 2 ){
			$(this).parent().remove();
			var lastchildid = $(".dynamicfields>div:last-child").find("select").attr( "id");
			var lastchildname = $(".dynamicfields>div:last-child").find("select").attr( "name");
			var lastinputchild  = $(".dynamicfields>div:last-child").find("input").attr( "id");
			$(".dynamicfields>div:last-child").remove();
			//alert($(this).parent().attr('class'));
			$(".classMultiple").attr("disabled", true);
			var multipleValues='';
			$(".dynamicfields>div").find(".classMultiple").each(function() {
					 if($(this).val()  != 'null')
						 multipleValues += $(this).val() || [];
						 multipleValues =  multipleValues  + ',';
			});
			 var  multipleArray = multipleValues.split(','); 
			
			$(".dynamicfields>div:first-child").clone(true).insertAfter(".dynamicfields>div:last-child");
			 $.each(multipleArray,function(i,v){
			 if(v != ''){
			$(".dynamicfields>div:last-child select option[value="+ v +"]").remove();}
			 });
			 $(".dynamicfields>div:last-child").css("display","block");
			 $(".dynamicfields>div:last-child").find(".classMultiple").attr("disabled", false);
			
			$(".dynamicfields>div:last-child").find("select").addClass('classMultiple'); 
			$(".dynamicfields>div:last-child").find("select").addClass('required');
			$(".dynamicfields>div:last-child").find("select").attr( "id", lastchildid);
			$(".dynamicfields>div:last-child").find("select").attr( "name", lastchildname );
			$(".dynamicfields>div:last-child").find("input").addClass('required');
			$(".dynamicfields>div:last-child").find("input").addClass('number');
			$(".dynamicfields>div:last-child").find("input").attr( "id", lastinputchild);
			  
			}
			if( $(".dynamicfields").children().size() ==  2 )
	 $(".dynamicfields>div:nth-child(2)").find(".deleteCourse img").attr("src","../web/images/delete-btn-inactive.png");
	 else 
	  $(".dynamicfields>div:nth-child(2)").find(".deleteCourse img").attr("src","../web/images/delete-btn.png");
			
	});
$("#prgm-fee").submit(function(){
	$(".dynamicfields>div:last-child").find('div.errorSelectBox').remove();
	});
});
</script>
<div class="content">
 <div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a href="students_listing.html">students</a></li>
        <li class="last"> &nbsp; Edit student</li>
        
      </ul>
    </div>
    <div class="studentViewContent">
     <h2>Add Program fee</h2>
     <div class="onlineExamContent">
       <div class="addProgramForm programfee">
       <form id="prgm-fee" name="frmPrpgramfeeadd" method="post" >
     <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
         <ul class="w380">
      <li class="dropdownprogramlist">
        <label>Select Program :<strong class="star">*</strong></label>
<select  name="ddlProgram" id="selectProgram">
<option value="">Select</option>
<?php while(!$programname->EOF)
 	{
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>

 </select>  </li> 
        <li>
     <label>Registration Fee :<strong class="star">*</strong></label>
     <span>$ <input name="txtregfee" type="text" /></span></li> 
      <li>
     <label>Graduation Fee :<strong class="star">*</strong></label>
     <span>$ <input name="txtgradfee" type="text" /></span></li> 
     <li>
      
          <fieldset style="display:none";>
        <legend>Course Fees </legend>
        <div class="dynamicfields courseFeeOuter">
        <div class="courseFee" style="display:none"; > 
        <div class="selectBox">
 		<select name="listcourse1[array1][0][]" size="4"  multiple="multiple" class="w210 programCourses"  title="Select Course"  value="">
 		</select>   
        </div>
        <div class="inputBox">
        <input type="text" name="listcourse1[array2][]" class="w220"  title="Fee is required" /> </div>
        <span class="deleteCourse" > <img src="../web/images/delete-btn.png" width="20" height="18" /></span>
        </div>
        <div class="courseFee">
         <div class="selectBox">
 		<select name="listcourse1[array1][1][]" size="4" multiple="multiple"  class="w210 classMultiple programCourses required"  title="Select Course" value="">
 		</select>  </div> 
          <div class="inputBox">
        <input type="text" name="listcourse1[array2][]" class="w220 required number"  title="Fee is required"  id="txtFeeBox"/> </div>
        <span class="deleteCourse" > <img src="../web/images/delete-btn.png" width="20" height="18" /></span>
        </div>  
         </div>  
       <span class="addCourse"><a> + Add More Course</a></span>
          </fieldset></li>
           <li>
     <label>Penalty Fee :<strong class="star">*</strong><br />
<strong class="titleSub1">(Exam exceed limit penalty fee)</strong></label>
     <span>$ <input name="txtPenaltyfee" type="text" /></span></li>
          <li>
     <label>Other Fee :<strong class="star">*</strong><br /></label>
     <span>$ <input name="txtotherfee" type="text" /></span></li>
     <?php /*?><li>
        <label>Status :<strong class="star">*</strong>  </label>
         <div class="programfee-status"><span> <input class="radiobtn" name="rdStatus" type="radio" value="Y" />
         Active
		 <input class="radiobtn" name="rdStatus" type="radio" value="N"  />
		 Inactive</span></div>
		</li><?php */?>
         </ul>
<ul class="w380"><li class="btn"><input name="btnProgramFeeadd" value="Add" type="submit" class="submitBtn fl" />
       
         <a href="admin_programfee_listing.php" class="cancelBtn">Cancel</a>
        </li></ul> 
        </form>  
 		</div>
     </div> 
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>