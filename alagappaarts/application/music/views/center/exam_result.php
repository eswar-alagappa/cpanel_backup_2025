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
	<h2><span>Exam Results </span>
		<div class="downloadbtn">
		<span>
		<form method="post" id="form">
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
                    <a href="<?php echo base_url(). "music/center/students"; ?>" class="btn btn-primary">Show All</a>
                </div>
            </div>
        <?php echo form_close(); ?>
        </div>
    </div>-->

    <div class="row">
        <div class="col-md-12 col-md-offset-0 bg-border">
			<?php if(isset($examResult) && !empty($examResult)){ ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>STUDENT NAME</th>
                    <th>PROGRAM ENROLLED</th>
                    <th>COURSE</th>
					<th>EXAM START DATE</th>
					<th>EXAM END DATE</th>
					<th>MARK OBTAINED</th>
					<th>RESULT</th>
					<th>GRADE</th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($examResult); ++$i) { ?>
                <tr>
                    <td><?php echo ($page+$i+1); ?></td> 
					<td><?php echo $examResult[$i]->firstname.' '.$examResult[$i]->lastname;?></td>
					<td><?php echo stripslashes($examResult[$i]->programName); ?></td>
                    <td><?php echo $examResult[$i]->course_code; ?></td>
					<td><?php echo date('d-M-Y',strtotime($examResult[$i]->exam_startdate)); ?></td>
					<td><?php echo date('d-M-Y',strtotime($examResult[$i]->exam_completiondate)); ?></td>
					<td><?php echo $examResult[$i]->score; ?></td>
					<td><?php echo $examResult[$i]->result; ?></td>
					<td><?php echo $examResult[$i]->grade; ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
			<?php }else{ ?>
			<div class='information'> Exam not taken / Result not published.  </div> 
			<?php } ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
