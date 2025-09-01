<link rel="stylesheet" href="<?php echo base_url("assets/home/css/bootstrap.css"); ?>">
<style>
body{ font-family:Verdana,Geneva,sans-serif;  font-size: 12px;}
.table { background: #fff none repeat scroll 0 0;}
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th{ background-color:transparent!important;}
.table-hover > tbody > tr:hover > td {background-color:transparent!important;}
.table > tbody > tr > td{ border:none;}
h2{ color: #600505; font-size: 1.5em !important; font-weight: bold; text-transform: uppercase;}
</style>
<div class="studentViewContent">

<div class="row">
	<h2><span>students </span>
		<div class="downloadbtn">
		<span>
		<form method="post" id="form" action="<?php echo base_url(); ?>dance/center/students_excel">
		<input type="submit" value="" class="exceldownloadBtn" name="btnDownload"></form>  </span>
		<!--<span> <form id="form" method="post">
		<input name="btnDownloadword" class="worddownloadBtn"  value="" type="submit" ></form> </span>-->
		</div>

	</h2>
</div> 
	
    <!--<div class="row">
        <div class="col-md-8 col-md-offset-2 well">
        <?php 
        $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
        echo form_open("pagination/search", $attr);?>
            <div class="form-group">
                <div class="col-md-6">
                    <input class="form-control" id="book_name" name="book_name" placeholder="Search for Book Name..." type="text" value="<?php echo set_value('book_name'); ?>" />
                </div>
                <div class="col-md-6">
                    <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Search" />
                    <a href="<?php echo base_url(). "dance/center/students"; ?>" class="btn btn-primary">Show All</a>
                </div>
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>-->

    <div class="row">
        <div class="col-md-12 col-md-offset-0 bg-border">
			<?php if( isset($studentList) && !empty($studentList)){?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Student Id</th>
                    <th>Student Name</th>
                    <th>Student Email ID</th>
					<th>Status</th>
					<th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($studentList); ++$i) { ?>
                <tr>
                    <td><?php echo ($page+$i+1); ?></td>
                    <td><?php echo $studentList[$i]->username; ?></td>
                    <td><?php echo $studentList[$i]->firstname.' '.$studentList[$i]->lastname; ?></td>
                    <td><?php echo $studentList[$i]->email; ?></td>
					<td><?php echo (($studentList[$i]->status == 1) ? 'Active' : 'Inactive'); ?></td>
					<td><a href="<?php echo base_url()?>dance/center/student_view/<?php echo $studentList[$i]->user_id ?>"><img width="20" height="18" title="View" src="<?php echo base_url()?>assets/home/images/view-btn.png"></a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
			<?php }else{ ?>
			 <div class='warning'> NO STUDENTS AVAILABLE.  </div> 
			<?php } ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
