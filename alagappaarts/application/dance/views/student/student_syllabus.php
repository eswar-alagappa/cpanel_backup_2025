<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    <style>
        .makePaymentForm{
            width:auto;
            text-align:center;
        }
        /*.makePaymentForm ul {
            padding: 0;
            margin: 0;
            width: 470px;
            display: block;
            overflow: hidden;
        }
        #keyaspects ul {
            padding: 0;
            margin: 0;
            width: 100%;
            display: block;
            overflow: hidden;
        }*/
        .own_video_class{
            padding:0;
        	margin:0 auto;
        	width:470px;
        	display:block;
        	overflow:hidden;
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
					<style>
					.tab {
					  overflow: hidden;
					  border: 1px solid #ccc;
					  background-color: #f1f1f1;
					}

					/* Style the buttons inside the tab */
					.tab button {
					  background-color: inherit;
					  /*float: left;*/
					  border: none;
					  outline: none;
					  cursor: pointer;
					  padding: 14px 16px;
					  transition: 0.3s;
					  font-size: 17px;
					  
						width: auto;
						height: auto;
						margin: 0 auto;
						position: relative;
					}

					/* Change background color of buttons on hover */
					.tab button:hover {
					  background-color: #ddd;
					}

					/* Create an active/current tablink class */
					.tab button.active {
					  background-color: #6d2d2b;
					  color:#ffffff;
					}

					/* Style the tab content */
					.tabcontent {
					  display: none;
					  padding: 6px 12px;
					  border: 1px solid #cccccc;
					  border-top: none;
					  color:#000000;
					}
					.pdf_item{
						width: auto;
						height: auto;
						margin: 0 auto;
						position: relative;
					}
					
					</style>
				
					<!--<h2>Tabs</h2>
					<p>Click on the buttons inside the tabbed menu:</p>-->

					<div class="tab">
					  <button class="tablinks" onclick="openTab(event, 'syllabus')">Syllabus</button>
					  <button class="tablinks" onclick="openTab(event, 'keyaspects')">Key Aspects</button>
					  <button class="tablinks" onclick="openTab(event, 'pdf')" id="defaultOpen">Theory Material/Theory PDF</button>
                      <button class="tablinks" onclick="openTab(event, 'video')">Practical Material/Practical Video</button>
					  <button class="tablinks" onclick="openTab(event, 'guideline')">Guideline</button>
					</div>
                    
                    <div id="syllabus" class="tabcontent">
                        <?php 
                        if( $syllabusList && count($syllabusList) > 0)
						{
							foreach($syllabusList as $key => $syllabus)
							{
							    ?>
							    <div class="items">
								<?php echo $syllabus->syllabus_content; ?>
								</div>
							    <?php
							}
						}
                        ?>
                    </div>
                    
                    <div id="keyaspects" class="tabcontent">
                        <?php 
                        if( $syllabusList && count($syllabusList) > 0)
						{
							foreach($syllabusList as $key => $syllabus)
							{
							    ?>
							    <div class="items" style="text-align:left !important;">
								<?php echo $syllabus->key_aspects; ?>
								</div>
							    <?php
							}
						}
                        ?>
                    </div>
                    
					<div id="pdf" class="tabcontent">
					
						<?php
			
							if( $syllabusList && count($syllabusList) > 0)
							{
								foreach($syllabusList as $key => $syllabus)
								{
									if( trim($syllabus->type) == 'Pdf'){
										echo $pdfPath = trim($syllabus->path);
										//echo "Pdf ".($key+1);
										 //echo '<center><h4>'.$syllabus->pdf_title.'</h4></center>';
										?>
										<div class="items">
										  <h2><center><?php echo $syllabus->pdf_title ?></center></h2>
										  <!--<p>London is the capital city of England.</p>-->
										  <iframe class="disableRightClick" ?wmode="transparent" type="application/pdf" id="iframe" src="<?php echo base_url() ?>syllabuspdf/<?php echo $pdfPath; ?>#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1000px"></iframe>
										</div>
										<?php
									}
								}
							}
							//echo '<pre>syllabusList->';print_r($syllabusList);
						?>
					</div>

					<div id="video" class="tabcontent">
						
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
										<div class="items">
											<h2><center><?php echo $syllabus->video_title ?></center></h2>
											<!--<p>Paris is the capital of France.</p>-->
											<!--<ul class="list-unstyled video-list-thumbs row" style="margin:0px auto !important;">
											<li class="col-lg-3 col-sm-4 col-xs-6">
											<object height="316" style="width:100%;">
											<param name="movie" value="https://www.youtube.com/v/<?php echo $video_id?>?version=3">
											<param name="allowScriptAccess" value="always">
											<embed src="https://www.youtube.com/v/<?php echo $video_id?>?version=3" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="">
											</object>
											</li>
											</ul>-->
											<div class="list-unstyled video-list-thumbs row own_video_class" style="margin:0px auto !important;">
											<span class="col-lg-3 col-sm-4 col-xs-6">
											<object height="316" style="width:100%;">
											<param name="movie" value="https://www.youtube.com/v/<?php echo $video_id?>?version=3">
											<param name="allowScriptAccess" value="always">
											<embed src="https://www.youtube.com/v/<?php echo $video_id?>?version=3" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="">
											</object>
											</span>
											</div>
											<span style="color:#000000 !important;text-align:left;"><?php echo $syllabus->video_desc ?></span>
										</div>
									<?php } } 
									}
								}
							}
							//echo '<pre>syllabusList->';print_r($syllabusList);
						?>
					</div>
					<div id="guideline" class="tabcontent">
					    <?php 
                        if( $syllabusList && count($syllabusList) > 0)
						{
							foreach($syllabusList as $key => $syllabus)
							{
							    ?>
							    <div class="items" style="text-align:left;">
								<?php echo $syllabus->guidelines; ?>
								</div>
							    <?php
							}
						}
                        ?>
                    </div>

					<script>
					function openTab(evt, cityName) {
					  var i, tabcontent, tablinks;
					  tabcontent = document.getElementsByClassName("tabcontent");
					  for (i = 0; i < tabcontent.length; i++) {
						tabcontent[i].style.display = "none";
					  }
					  tablinks = document.getElementsByClassName("tablinks");
					  for (i = 0; i < tablinks.length; i++) {
						tablinks[i].className = tablinks[i].className.replace(" active", "");
					  }
					  document.getElementById(cityName).style.display = "block";
					  evt.currentTarget.className += " active";
					}
					document.getElementById("defaultOpen").click();
					</script>
				</div>
      </div>
      </div>
      
<div>
  
</div>
           
    </div>
</div>