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
	header('location:index.php?msg=Login again');
}
else{
	
 include('adminheader.php');
 include("../config/classes/coursemaster.class.php");
 include("../config/classes/keywordmaster.class.php");
 
 define( MAX_NO_OF_ROWS_PAGINATION,20);
 global $DB;
$courseMaster = new coursemaster();
$pagename='courselisting';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchcourse']);
}
if(isset($_REQUEST['btnSearch']))
{
	$arrSearch = array('cm.name'=>$_REQUEST['txtName'],'cm.program_id'=>$_REQUEST['ddlProgram'],'cm.regulation_id'=>$_REQUEST['ddlRegulation']);
	$getCourses = $courseMaster -> getcourses().$filterObj->applyFilter($arrSearch,$pagename);
	$_SESSION['searchcourse'] = $arrSearch;
	$rsCourses = $DB -> Execute( $paginationObj->getQuery($getCourses));
static $recordcount=0;
	$forcount = $DB->execute($getCourses);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
}
else
{
	$arrSearch = array('cm.name'=>$_SESSION['searchcourse']['cm.name'],'cm.program_id'=>$_SESSION['searchcourse']['cm.program_id'],
					'cm.regulation_id'=>$_SESSION['searchcourse']['cm.regulation_id']);
	$getCourses = $courseMaster -> getcourses().$filterObj->applyFilter($arrSearch,$pagename);
	$rsCourses = $DB -> Execute( $paginationObj->getQuery($getCourses));
static $recordcount=0;
	$forcount = $DB->execute($getCourses);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
}
$countofCourses = count($rsCourses -> fields[id]);
	


?>
<script type="text/javascript" src="../web/validation/course.validate.js"></script>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; courses</a></li>
        
      </ul>
    </div>
    <div class="studentViewContent">
    <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     
      <h2><span>Courses </span>
<span class="addFieldOuter"><a class="submitBtn" href="admin_course_add.php">Add course</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>

</h2>
     
      <div class="studentList">
     <form name="frmCourseSearch" method="post" action="admin_course_listing.php" id="frmCourseSearch">
         <div class="searchBox">
        <label>Search By Name:</label>
        <input type="text" name="txtName" class="mR10 fillone w200 required_group" value="<?php echo $_SESSION['searchcourse']['cm.name'];?>"/>
        <label class="w100">Regulation :</label>
        <?php 
		$keywordMaster = new keywordmaster();
		$getRegulation = $keywordMaster -> getkeyword('regulation');
		$countR = count($getRegulation);
		if($countR)
		{
			echo '<select name="ddlRegulation" class="w136 fillone required_group">';
			echo '<option value="">--Select--</option>';
			foreach($getRegulation as $regulation)
			{
				echo "<option value='{$regulation[id]}'";
				if($_SESSION['searchcourse']['cm.regulation_id']== $regulation['id'])
						{
							echo "selected";
						}
				echo">{$regulation[value]}</option>";
			}
			echo '</select>';
		}
		?>
 
<label class="w100">Program :</label>
<?php 
		$getPrograms = $courseMaster -> getprograms();
		$countP = count($getPrograms);
		if($countP)
		{
			echo '<select name="ddlProgram" class="studentListing w136 mR10 fillone required_group">';
			echo '<option value="">--Select--</option>';
			foreach($getPrograms as $program)
			{
				echo "<option value='{$program[id]}'";
				if($_SESSION['searchcourse']['cm.program_id']== $program['id'])
						{
							echo "selected";
						}
				echo">{$program[name]}</option>";
			}
			echo '</select>';
		}
		?>

        <!-- <input  type="text" onblur="if(this.value =='') this.value='ID';" onfocus="if(this.value=='ID') this.value='';" class="mR10" value="ID" name="txtID">-->
        <input name="btnSearch" value="go" type="submit" class="goBtn" />
        <?php if(isset($_SESSION['searchcourse']))
		{
			echo ' <input name="btnViewAll" value="View All Courses" type="submit" class="viewAll" />';
		}
		 ?>
        
        <div class="errorContainer"></div>
      </div>    
      </form>
      <?php if($countofCourses)
		{ ?>   
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th> Code </th>
                <th>Course Name </th>
                <th width="400"> Course Description </th>
                <th width="95">Regulation </th>
                <th width="95"> Actions</th>
              </tr>
              <?php  
			  $i =0;
			  while(!$rsCourses->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsCourses->fields[id]}</td>
				<td>{$rsCourses->fields[code]}</td>
                <td> {$rsCourses->fields[name]}  </td>
                <td>{$rsCourses->fields[description]} </td>";
               echo "<td>{$rsCourses->fields[regulation]}</td>";
			   echo" <td><a href='admin_course_view.php?courseid={$rsCourses->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a> <a href='admin_course_edit.php?courseid={$rsCourses->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a> </td>
              </tr>";
				   $rsCourses-> MoveNext();
				   $i++;
 				 }?>
             
              
            
            </tbody>
          </table>
        </div>
      </div>
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getCourses ); ?></ul></div>
      </div>
      <?php  }
		else{
			echo "<div class='adminError'>No Results Found</div>";}
			?>
     
      
      
    </div>
  </div>

<?php 
include('adminfooter.php');
}
?>