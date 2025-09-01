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
include('adminheader.php');
include("../config/classes/questiontypemaster.class.php");
include("../config/classes/questionmaster.class.php");
$questionTypeMaster = new questiontypemaster();
$questionMaster = new questionmaster();

define( MAX_NO_OF_ROWS_PAGINATION,20);
 global $DB;
$pagename='questionlisting';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchquestion']);
}
if(isset($_REQUEST['btnSearch']))
{
	$arrSearch = array('qm.question'=>$_REQUEST['txtName'],'qm.question_type_id'=>$_REQUEST['ddlQuestionType'],'qm.status'=>$_REQUEST['ddlQuestionStatus']);
	$getQuestions = $questionMaster -> listquestions().$filterObj->applyFilter($arrSearch,$pagename);
	$_SESSION['searchquestion'] = $arrSearch;
	$rsQuestions = $DB -> Execute( $paginationObj->getQuery($getQuestions));
static $recordcount=0;
	$forcount = $DB->execute($getQuestions);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
}
else
{
	
	$arrSearch = array('qm.question'=>$_SESSION['searchquestion']['qm.question'],'qm.question_type_id'=>$_SESSION['searchquestion']['qm.question_type_id'],'qm.status'=>$_SESSION['searchquestion']['qm.status']);
	$getQuestions = $questionMaster -> listquestions().$filterObj->applyFilter($arrSearch,$pagename);
	
	$rsQuestions = $DB -> Execute( $paginationObj->getQuery($getQuestions));
static $recordcount=0;
	$forcount = $DB->execute($getQuestions);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
}
$countofQuestions = count($rsQuestions -> fields[id]);


?>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Online Exam </li>
        <li class="last"> &nbsp; questions </a></li>
        
      </ul>
    </div>
    <div class="studentViewContent">
     <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
      <h2><span>Questions </span>   
    <span class="addFieldOuter"><a class="submitBtn" href="admin_question_add.php">Add Question  </a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span></h2>
     <div class="studentList">
     <form name="frmQuestionSearch" method="post" action="admin_question_listing.php" id="frmQuestionSearch">
     <div class="searchBox">
        <label>Search By Name:</label>
        <input type="text" name="txtName" class="w200 mR10" value="<?php echo $_SESSION['searchquestion']['qm.question'];?>">
        <label class="w125">Question type :</label>
        <?php 
        $getQuestionType = $questionTypeMaster -> activequestiontypes();
		echo '<select class="questionType w200 mR10" id="ddlQuestionType" name="ddlQuestionType">';
		echo '<option value="">--Select--</option>';
		foreach($getQuestionType as $questiontype)
			{
				echo "<option value='{$questiontype[id]}' class='{$questiontype[controller]}'";
				if($_SESSION['searchquestion']['qm.question_type_id']== $questiontype['id'])
						{
							echo "selected";
						}
				
				echo ">{$questiontype[name]}</option>";
			}
		echo '</select>';
		?>
        
<label class="w65">Status :</label>
        <select class="questionType w105" name="ddlQuestionStatus">
            <option value="" selected="selected">Select</option>
<option value="Y" <?php if($_SESSION['searchquestion']['qm.status']== 'Y')
						{
							echo "selected";
						}?>>Active</option>
<option value="N" <?php if($_SESSION['searchquestion']['qm.status']== 'N')
						{
							echo "selected";
						}?> >Inactive</option>

</select>
        <input name="btnSearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchquestion']))
		{
			echo ' <input name="btnViewAll" value="View All Questions" type="submit" class="viewAll" />';
		}
		 ?>
      </div>
      </form>
      <?php if($countofQuestions)
		{ ?>
     
             
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th>Question</th>
                <th>Question type</th>
                <th>Courses</th>
                <th width="95">status</th>
                <th width="95"> Actions</th>
              </tr>
              <?php  
			  $i =0;
			  while(!$rsQuestions->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsQuestions->fields[id]}</td>
				<td>{$rsQuestions->fields[question]}</td>
                <td> {$rsQuestions->fields[questiontype]}  </td>
				<td>";
				$getCourses = $questionMaster -> getquestioncourse($rsQuestions->fields[id]);
				$i=1;
				$courseCount = count($getCourses);
				foreach($getCourses as $courses)
				{
					if($courseCount==$i)
					echo $courses['code'];
					else
					echo $courses['code'].' , ';
					$i++;
					
				}
				echo"</td>
                <td>";
				if($rsQuestions->fields[status]=='Y')
				echo 'Active'; 
				else
				echo 'Inactive';
				echo"</td>";
              
			   echo" <td><a href='admin_question_view.php?questionid={$rsQuestions->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a> <a href='admin_question_edit.php?questionid={$rsQuestions->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a> </td>
              </tr>";
				   $rsQuestions-> MoveNext();
				   $i++;
 				 }
				 ?>
              
              
              
              
              
              
              
               
            </tbody>
          </table>
        </div>
      </div>
     <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getQuestions ); ?></ul></div>
      </div>
        <?php  }
		else
		{
			echo "<div class='adminError'>No Results Found</div>";}
			?>
     
       </div>
  </div>
<?php 
include('adminfooter.php');
}
?>
  
