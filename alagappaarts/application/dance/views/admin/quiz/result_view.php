<style>
@media print {
   
   .clearfix{
   display:none;
   }
   #footer{
   display:none;
   }
   .hide_btn_while_print{
   display:none;
   }
   .show_btn_while_print{
   display:block;
   float:right;
   }
   
}

@media screen {
 .show_btn_while_print{
   display:none;
   }
}

.result_card tr td{

border-bottom:1px solid #dddddd;
}

</style>


<style>
 

.sharing-buttons{
  list-style: none;
  text-decoration: none;
  
}

.sharing-buttons li{
  display: inline;
}

.sharing-buttons a{
  border: 1px solid;
  padding: 0.5em;
  color: #fff;
  text-decoration: none;
}

.sharing-buttons a:hover{
  color: #eee;
  text-decoration: none;
}

.fa{
  padding: 0.5em;
}

.facebook{
  background: #3B5998; 
}

.twitter{
  background: #00ACED;
}

.google-plus{
  background: #D14836
}
</style>




		<?php 
$logged_in=$this->session->userdata('admin_logged_in');

if($resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
 ?> 	
<div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <?php if($title){ echo $title; } ?>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                               
                               
							   
							   
							   
                                <table class="table table-hover">
                                    
                                    <tbody>
									<?php
if($this->config->item('webcam_plugin') && $result->camera_req == '1'){
?><tr><td></td><td><?php
$photo=$result->photo;

if($photo!=""){ ?><img src="<?php echo base_url('photo/'.$photo);?>" style="width:<?php echo $this->config->item('photo_width');?>;height:<?php echo $this->config->item('photo_height');?>;"><?php }else{ echo "Camera was not detected!";} ?></td></tr>
<?php
}
?>

<tr><th >Result ID</th><td><?php echo $result->rid;?></td></tr>
<tr><th >User Name</th><td><?php echo $result->username;?></td></tr>
<tr><th >Email</th><td><?php echo $result->email;?></td></tr>
<tr><th >First Name</th><td><?php echo $result->firstname ;?></td></tr>
<tr><th >Last Name</th><td><?php echo $result->lastname;?></td></tr>
<tr><th >Quiz Name</th><td><?php echo $result->quiz_name;?></td></tr>

<tr><th >Exam Start Date & Time</th><td><?php echo $result->exam_startdate;?></td></tr>
<tr><th >Exam End Date & Time</th><td><?php echo $result->exam_completiondate;?></td></tr>

<tr><th >Score obtained</th><td><?php  //echo '<pre>result->';print_r($result);
$correct_score=explode(",",$result->correct_score);
if(count($correct_score) >= "2"){ echo $result->score."/".(array_sum($correct_score)); }else{ 
//echo $result->score."/".(count(explode(',',$result->qids)) * $correct_score['0'] );
echo $result->score."/".(100 * $correct_score['0'] );
}
if($result2==true){ echo "<span style='color:red'> <a href='".site_url('dance/admin/result/view_answer/'.$result->rid)."'> ( Essay Evaluation Pending ) </a></span>";}?></td></tr>
<tr><th >Percentage obtained</th><td><?php echo substr($result->percentage , 0, 5 );?>%</td></tr>
<tr><th >Percentile obtained</th><td><?php echo substr(((($percentile[1]+1)/$percentile[0])*100),0,5);   ?>%</td></tr>
<!--<tr><th  valign="top">Percentage obtained by Category</th><td><table><?php foreach($cct_per_total as $vk => $vval){ 
?>
<tr><td>
<?php echo $vk ; ?>: 
</td><td>
<?php $sper=(($cct_per[$vk]/$cct_per_total[$vk])*100);  echo number_format((float)$sper, 2, '.', '');?>%  (<?php echo $cct_per[$vk]."/".$cct_per_total[$vk]; ?>)
</td></tr>
<?php
} ?></table></td></tr>-->
<tr><th >Result</th><td><?php   if($result->q_result == "1"){  echo "Pass"; }else if($result->q_result == "0"){ echo "Fail"; }else{ echo "Pending"; } ?></td></tr>
<tr><th >Total Time Spent</th><td><?php if($result->time_spent <= ($result->duration * 60 ) ){  echo gmdate("H:i:s", $result->time_spent); }else{ echo gmdate("H:i:s", ($result->duration * 60)); } ?></td></tr>



                                    </tbody>
</table>



<?php if($result->view_answer =="1"){
?><div class="hide_btn_while_print">
<table id="detail">
<tr><td ><a href="<?php echo site_url('dance/admin/result/view_answer/'.$result->rid );?>" class="btn btn-success">View Answers</a></td>

<!--<td>

<a href="javascript:print();" class="btn btn-warning" style="margin-left:20px;">Print</a>

</td>-->

<td>

<?php 
/*
if($this->config->item('social_share') == true ){ 
?>
<ul class="sharing-buttons">
  <li>
  <a class="facebook"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("Hey, I have taken this ".$result->quiz_name." quiz on  ".base_url().". My score is ".$result->score."/".(count(explode(',',$result->qids)) * $result->correct_score).". ");?>" target="_blank"><i class="fa fa-facebook-square"></i>Share on Facebook</a>
	</li>
  <li>
	<a  class="twitter"  href="https://twitter.com/intent/tweet?url=&text=<?php echo urlencode("Hey, I have taken this ".$result->quiz_name." quiz on  ".base_url().". My score is ".$result->score."/".(count(explode(',',$result->qids)) * $result->correct_score).". ");?>&via=" target="_blank"><i class="fa fa-twitter-square"></i>Tweet</a>
 </li>
  <li>
 		<a class="google-plus" href="https://plus.google.com/share?url=<?php echo urlencode(base_url());?>" target="_blank"><i class="fa fa-google-plus-square"></i>Share on Google+</a>
 </li>
</ul>
<?php 
}*/
?>





</td>
</tr>
</table></div>
<?php
}
?> 
				
									
									
				