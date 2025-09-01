<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
	
	$(function() {
    $( "#tabs" ).tabs();
  });
    /*$(document).ready(function(){

		var tabID = location.search.substring(1); 

		if(tabID){

			$('.contentLeftTop div').each(function(){ $(this).hide(); });

			$('#tabvanilla ul li').each(function(){ $(this).removeClass('ui-tabs-selected'); });

			$('#content'+tabID).show();

			$('#'+tabID).addClass('ui-tabs-selected');

			

		}

		});*/





</script>
<style>
.ui-widget-content{
	background:none;
	border:none;	
}
.ui-widget-header{
	background:none;
	border:none;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	 background: transparent url("../../../assets/home/images/left-bg.gif") no-repeat scroll left top;
    cursor: pointer;
    float: left !important;
    font-size: 12px;
    font-weight: bold !important;
    list-style: outside none none;
    margin-right: 3px;
    padding: 0;
    text-align: center !important;
    text-decoration: none;
    text-transform: uppercase;
}
.ui-tabs .ui-tabs-panel{
	background-color: #eed492;
}
table tr td, th{
	 background-color: #eed492;
}
table.course tr td{
	height:40px;
}
table.fees tr td{
	height:20px;
}
.altRows1 td{
	border-top:none !important;
}
.altRows td, .altRows1 td{
	padding:5px;
	background:#FCB064 !important;
}
th{
	background:#600505;
	color:#e9ca80;
	padding:8px;
}

#tabs ul li{
	background-color:#933C02 !important;
}
#tabs ul li.ui-state-hover{
	background-color:#600505 !important;
}
#tabs ul li.ui-state-active{
	background-color:#600505 !important;
}
.ui-state-default a{
	color:#e9ca80 !important;
}
.ui-tabs .ui-tabs-panel{
	padding:0px !important;
}
table tr td {
    border-bottom: 1px solid #bc9c64;
    border-right: 1px solid #bc9c64;
}
.brdnone{
 border-bottom: medium none;
}
<!--table tr.altRows td {
    background-color: #eed492;
}-->
</style>
<div class="danceInnerContent">
 <?php $this->load->view('left_banner'); ?>


<div class="danceInnerContentRight">

<div class="danceBanner">

<h2><span> Master's Degree</span></h2>

</div>



  <div class="apaaContent">
	
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">SEMESTER I</a></li>
    <li><a href="#tabs-2">SEMESTER II</a></li>
    <li><a href="#tabs-3">SEMESTER III</a></li>
	<li><a href="#tabs-4">SEMESTER IV</a></li>
		
  </ul>
    <div id="tabs-1">
    				
    	<table class="course" border="0" width="100%" cellspacing="0" cellpadding="0">
    		<tbody>
    			<tr>
    				<th>Course Code</th>
    				<th>Course Name</th>
    				<th width="255">Content</th>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN01</td>
    				<td>Evolution of Bharathanatyam</td>
    				<td>Ancient Root(200 – 500 CE)<br>
                    Colonial Era(1500 – 1900 CE)<br>
                    Revival and reconstruction(20th Century)<br>
                    Diversity and Individuality<br>
                    Essential Qualities of an Artist</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN02</td>
    				<td>Concept of Talas</td>
    				<td>Aksharam, Avarthanam, Kalai, Eduppu<br>
                    Shadangam & Jathi<br>
                    Sapta Tala, 35 Tala<br>
                    Yathi<br>
                    108 Tala, 175 Tala</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP1</td>
    				<td>Adavus and Initial repertoire</td>
    				<td>16 Adavus, Initial Margam</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP2</td>
    				<td>Principles of Nritya & Elementary Course in Performance</td>
    				<td>Alarippu, Jateeswaram, Teermanam</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE1</td>
    				<td>Music and Yoga</td>
    				<td>Basic Varisai, Basic Asanas</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE2</td>
    				<td>Make up & Attire (Practical)</td>
    				<td>Eyes, Lips, Eyebrow, Jewels</td>
    			</tr>
    		</tbody>
    	</table>
    
    </div>
    <div id="tabs-2">
    				
    	<table class="course" border="0" width="100%" cellspacing="0" cellpadding="0">
    		<tbody>
    			<tr>
    				<th>Course Code</th>
    				<th>Course Name</th>
    				<th width="255">Content</th>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN03</td>
    				<td>Dramatic Elements of Bharathanatyam</td>
    				<td>Rasa (Emotion)<br>
                    Abhinaya (Expression)<br>
                    Mudras (Hand Gestures)<br>
                    Bhava (Mood)<br>
                    Rhythm and Tala<br>
                    Natya (Dramatic Element)</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN04</td>
    				<td>Revival of Bharathanatyam and Tamil culture</td>
    				<td>Historical Context of Bharathanatyam<br>
                    Dasi System – Deva Dasi System, Raja Dasi System <br>
                    Exponents: Swathy Tirunal, Kittapa Pillai, Balasaraswathy,<br> 
                    Rukmini Devi Arundale, KN Dandhayuthapani Pillai<br>
                    Educational Institutions<br>
                    Scope of Bharathanatyam</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP3</td>
    				<td>Nritya Abhinaya</td>
    				<td>Bhedas</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP4</td>
    				<td>Mastering rhythm in Bharathanatyam</td>
    				<td>Swarajathi (1), Javali(1), Keerthanai(1)</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE3</td>
    				<td>Classification of Tala</td>
    				<td>Sapta Tala, 35 Tala, Chappu Tala, Chanda Tala</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE4</td>
    				<td>Theatre art form</td>
    				<td>Dramatic Theory, Theatre Forms, Theatrical Elements<br>
                    Acting Theories, Directorial Concepts, Theatre Movements</td>
    			</tr>
    		</tbody>
    	</table>
    
    </div>
    <div id="tabs-3">
    				
    	<table class="course" border="0" width="100%" cellspacing="0" cellpadding="0">
    		<tbody>
    			<tr>
    				<th>Course Code</th>
    				<th>Course Name</th>
    				<th width="255">Content</th>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN05</td>
    				<td>Concept of Abhinayas (Aharyam, sathvikam )</td>
    				<td>Abhinaya (Expression)<br>
                    Introduction & Fundamentals of Abhinaya<br>
                    Aharya Abhinaya<br>
                    Sathvika Abhinaya<br>
                    Natya Sastaram, Abhinaya Darpanam<br>
                    Modern Interpretations</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN06</td>
    				<td>Evolution of Margam & Exponents</td>
    				<td>Role of Tanjore Quartette<br>
                    Repertoire of Margam <br>
                    Accompaniments - Chinna Melam<br>
                    Life history of Tanjore Quartette</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP5</td>
    				<td>Theory of Talas (Nattuvangam)</td>
    				<td>Components of Nattuvangam, Jathi (Rhythmic Pattern), Nadai (Tempo), Angam (Body Part), Vaythari (Hand Gestures), Pada (Footwork), Thattu (Basic Beat)</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP6</td>
    				<td>Bharathanatyam Repertoire </td>
    				<td>Dharu Varnam,Thillana, Prabantham</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE5</td>
    				<td>Role of Music in Bharathanatyam / Folk</td>
    				<td>Accompaniment, Rhythmic Structure, Melodic Contour, Emotional Expression, Narrative Support, Aesthetic Enhancement</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNE6</td>
    				<td>Silapathigaram</td>
    				<td>Bharthanatyam references in  Arengetru kaadhai</td>
    			</tr>
    		</tbody>
    	</table>
    
    </div>
    <div id="tabs-4">
    				
    	<table class="course" border="0" width="100%" cellspacing="0" cellpadding="0">
    		<tbody>
    			<tr>
    				<th>Course Code</th>
    				<th>Course Name</th>
    				<th width="255">Content</th>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNP7</td>
    				<td>Concert</td>
    				<td>Full Repertoire</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABNPR</td>
    				<td>Project</td>
    				<td>Assigned Project</td>
    			</tr>
    			<tr class="altRows">
    				<td class="courseName">MABN07</td>
    				<td>Research Methodology</td>
    				<td>Theoretical Framework, Methodological approach, Data Analysis, Literature Review</td>
    			</tr>
    		</tbody>
    	</table>
    
    </div>
</div>


</div>  







</div>

</div>