<script>
function removeqids(){
document.getElementById('removeqids').submit();
}
var selstatus="0";
function selectall(noq){

for(var i=1; i <= noq; i++){
var che="checkbox"+i;
if(selstatus=="0"){
document.getElementById(che).checked=true;
}else{
document.getElementById(che).checked=false;
}
}

	if(selstatus=="0"){
	selstatus="1";
	}else if(selstatus=="1"){
	selstatus="0";
	}
}


function sortby(limi,cid){
window.location="<?php echo base_url();?>dance/admin/qbank/index/0/"+cid;
}
</script>

<?php 
if( isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
 ?> 
 <div style="margin-top:10px;">

 <a href="<?php echo site_url('dance/admin/qbank/add_new');?>" class="btn btn-success">Add new</a>

<div style="clear:both;"></div>
</div>

<div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($title){ echo $title; } ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form method="post" action="<?php echo site_url('dance/admin/qbank/remove_qids/'.$limit);?>" id="removeqids">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name=""  onClick="selectall('<?php echo count($result);?>');"></th>
                                             <th>ID</th>
                                             <th>Question</th>
                                            <!--<th>Category</th>
                                            <th>Level</th>-->
                                            <th>Type</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
								<?php
								if($result==false){
								?>
								<tr>
								<td colspan="6">
								No record foud!
								</td>
								</tr>
								<?php

								}else{

								$j=0;
								foreach($result as $row){
								$j+=1;
								if($row->q_type=="0"){
								$type="Multiple Choice - single answers";
								}
								if($row->q_type=="1"){
								$type="Multiple Choice - multiple answers";
								}
								if($row->q_type=="2"){
								$type="Fill in the Blank";
								}
								if($row->q_type=="3"){
								$type="Short Answer";
								}
								if($row->q_type=="4"){
								$type="Essay";
								}
								if($row->q_type=="5"){
								$type="Matching";
								}
								?>
								<tr>
								<td data-th="Select"><input type="checkbox" name="qid[]" value="<?php echo $row->qid;?>" id="checkbox<?php echo $j;?>"></td>
								<td data-th="ID"><?php echo $row->qid;?></td>
								<td data-th="Question"><?php echo substr(strip_tags($row->question),"0","20");?></td>
								<!--<td data-th="Category"><?php echo $row->category_name;?></td>
								<td data-th="Level"><?php echo $row->level_name;?></td>-->
								<td data-th="Type"><?php echo $type;?></td>
								<td data-th="Action">
								<a href="<?php echo site_url('dance/admin/qbank/remove_question/'.$row->qid );?>"; class="btn btn-danger btn-xs">Remove</a> 
								 <a href="<?php echo site_url('dance/admin/qbank/edit_question/'.$row->qid.'/'.$row->q_type );?>" class="btn btn-info btn-xs">Edit</a></td>
								</tr>
								<?php
								}
								}
								?>
                                    </tbody>
                                </table></form>
                            </div>
                        </div>
                    </div>
                </div>
</div>

<a href="javascript:removeqids();"  class="btn btn-danger">Remove</a> 
&nbsp;&nbsp;
<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('dance/admin/qbank/index/'.$back.'/'.$fcid);?>"  class="btn btn-primary">Back</a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('dance/admin/qbank/index/'.$next.'/'.$fcid);?>"  class="btn btn-primary">Next</a>
