<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    <style>
        .makePaymentForm ul{
            width:auto;
            text-align:center;
        }
    </style>
  <script>
  $(document).ready(function () {
	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'mm/dd/yy',
    });
 });
</script>

<div class="content">
     <div class="contentOuter">
            <div style="width:100%">
                <div style="width:50%; float:left"><h2>Syllabus</h2></div>
                <div style="width:50%; float:right"><h2><a style="color:#600505;text-decoration:none;float:right" href="<?php echo base_url().'dance/student/studentprofile'?>"><< Back</a></h2></div>
            </div>
       
       <div class="contentInner">
                 <div class="profileContent">
      <div class="makePaymentForm">
      
      
			
			<?php
			
			    if( $syllabusList && count($syllabusList) > 0)
			    {
			        foreach($syllabusList as $key => $syllabus)
			        {
			            if( trim($syllabus->type) == 'Video'){
			                $videoPath = trim($syllabus->path);
			                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoPath, $match)) {
                                $video_id = $match[1];
                            
                                if($video_id){ 
                                    //echo "Video ".($key+1);
                                    //echo '<center><h4>'.$syllabus->video_title.'</h4></center>';
			                ?>
			                        <center><h4 title="<?php echo $syllabus->video_title ?>" alt="<?php echo $syllabus->video_title ?>" ><?php echo $syllabus->video_title ?></h4></center>
    			                <ul class="list-unstyled video-list-thumbs row">
    
                                    <li class="col-lg-3 col-sm-4 col-xs-6">
                                        
                                        <object width="560" height="316">
                                              <param name="movie"
                                                     value="https://www.youtube.com/v/<?php echo $video_id?>?version=3"></param>
                                              <param name="allowScriptAccess" value="always"></param>
                                              <embed src="https://www.youtube.com/v/<?php echo $video_id?>?version=3"
                                                     type="application/x-shockwave-flash"
                                                     allowscriptaccess="always"
                                                     allowfullscreen=""
                                                     ></embed>
                                            </object>
                                        
                                    </li>
                                
                                </ul>
			            <?php } } 
			                
			            }
			            if( trim($syllabus->type) == 'Pdf'){
			                $pdfPath = trim($syllabus->path);
			                //echo "Pdf ".($key+1);
			                 //echo '<center><h4>'.$syllabus->pdf_title.'</h4></center>';
			                ?>
			                <center><h4 alt="<?php echo $syllabus->pdf_title ?>" title="<?php echo $syllabus->pdf_title ?>"><?php echo $syllabus->pdf_title ?></h4></center>
			                <ul class="list-unstyled video-list-thumbs row">
    
                                    <li class="col-lg-3 col-sm-4 col-xs-6">
                                        <a href="<?php echo base_url().'/dance/student/student_syllabus_view/'.$syllabus->syllabus_program_id ?>"><span  alt="<?php echo $syllabus->pdf_title ?>"> </span><?php echo $pdfPath ?> </span> </a>
                                       
                                    </li>
                             </ul>
			                
			                <?php
			            }
			        }
			    }
				//echo '<pre>syllabusList->';print_r($syllabusList);
			?>
		
		
      </div>
      </div>
      </div>
      
<div>
  
</div>
           
    </div>
</div>