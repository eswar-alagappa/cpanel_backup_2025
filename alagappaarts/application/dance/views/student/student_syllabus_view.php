<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

      <script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
      <div style="width:100%">
                <div style="width:50%; float:left"><h2>Syllabus</h2></div>
                <div style="width:50%; float:right"><h2><a style="color:#600505;text-decoration:none;float:right" href="<?php echo base_url().'dance/student/student_syllabus'?>"><< Back</a></h2></div>
            </div>
			
			<?php
				$fullPath =  base_url().'syllabuspdf/'.$syllabusList[0]->path;
				
				echo '<iframe class="disableRightClick" ?wmode="transparent" type="application/pdf" id="iframe" src="'.$fullPath.'#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1000px"></iframe>';
			    
			?>											  
		
      