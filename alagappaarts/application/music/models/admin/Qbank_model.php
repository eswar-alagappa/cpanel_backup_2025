<?php
Class Qbank_model extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		//$this->load->library('session'); 
		//$this->load->database();
		$this->db = $this->load->database( 'db1', TRUE );
    }
	
function question_list($limit,$cid,$course_id)
 {
 $institute_id = 1;//1;
 	$extrap="";
 	if($cid>="1"){
 	$extrap="and qbank.cid='".$cid."'";
 	 }else{
 	$extrap="";
 	}
   $nor=30;//$this->config->item('number_of_rows');
   if($this->input->post('search_type')){
   $search_type=$this->input->post('search_type');
   $search=$this->input->post('search');
  
  $query = $this->db->query("select qbank.*, question_category.category_name, difficult_level.level_name from qbank, question_category, difficult_level where qbank.cid=question_category.cid and qbank.did=difficult_level.did and $search_type like '%$search%' and qbank.institute_id = '$institute_id' $extrap order by qid desc limit $limit, $nor");
  
  }else{ //echo "select qbank.*, question_category.category_name, difficult_level.level_name from qbank, question_category, difficult_level where qbank.cid=question_category.cid and qbank.did=difficult_level.did and qbank.institute_id = '$institute_id' $extrap order by qid desc limit $limit, $nor";die;qbank.course_id='".$course_id."' AND 
   if( isset($course_id) && !empty($course_id)){
		$query = $this->db->query("select qbank.*, question_category.category_name, difficult_level.level_name from qbank, question_category, difficult_level where qbank.course_id=$course_id and qbank.cid=question_category.cid and qbank.did=difficult_level.did and qbank.institute_id = '$institute_id' $extrap order by qid desc limit $limit, $nor");
  }else{
	  $query = $this->db->query("select qbank.*, question_category.category_name, difficult_level.level_name from qbank, question_category, difficult_level where qbank.cid=question_category.cid and qbank.did=difficult_level.did and qbank.institute_id = '$institute_id' $extrap order by qid desc limit $limit, $nor");
  }
  
	}
	
   if($query->num_rows() >= 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

 function add_new_mul(){
 
 $institute_id = 1;
			 	
			$insert_data = array(
			'cid' => $this->input->post('cid'),
			'q_type' => $this->input->post('qus_type'),
			'did' => $this->input->post('did'),
			'question' => $this->input->post('question'),
			'description' => $this->input->post('description'),
			'institute_id' => $institute_id
			);
			
 			
			if($this->db->insert('qbank',$insert_data)){
			$qid=$this->db->insert_id();
			foreach($_POST['option'] as $key => $value){
			foreach($_POST['CheckBox'] as $key2 => $value1){
			if($value1==$key){
			$score=1/count($_POST['CheckBox']);
			break;
			}else{
			$score="0";
			}
			
			
			
			}
			$insert_data = array(
			'qid' => $qid,
			'option_value' => $value,
			'score'=> $score,
			'institute_id' => $institute_id
			);
			
			$this->db->insert('q_options',$insert_data);
			}
	
			return "Question added successfully";
			}else{
			return "Unable to add question";
			}
 
 
 }
 
 
			function add_question(){
						$institute_id = 1;
						
						$insert_data = array(
						'cid' => 1,//$this->input->post('cid'),
						'q_type' => $this->input->post('qus_type'),
						'course_id' => $this->input->post('course_id'),
						'did' => 1,//$this->input->post('did'),
						'question' => $this->input->post('question'),
						'description' => $this->input->post('description'),
						'institute_id' => $institute_id
						);
						
			
						
						
						if($this->db->insert('qbank',$insert_data)){
						$qid=$this->db->insert_id();

						if( isset($_POST['option']) && !empty($_POST['option'])){
							foreach($_POST['option'] as $key => $value){
								if($this->input->post('qus_type')=="0" || $this->input->post('qus_type')=="6"){
									if($key==($this->input->post('score'))){
										$score="1";
									}else{
										$score="0";
									}
								}
								if($this->input->post('qus_type')=="2"||$this->input->post('qus_type')=="3"){
									$score="1";
								}
								if($this->input->post('qus_type')=="5"){
									$score=1/count($_POST['option']);
								}
								$insert_data = array(
								'qid' => $qid,
								'option_value' => $value,
								'score'=> $score,
								'institute_id' => $institute_id
								);
								
				
								$this->db->insert('q_options',$insert_data);
							}
						}
						return "Question added successfully";
						}else{
						return "Unable to add question";
						}
			}

function import_question($question){
//echo "<pre>"; print_r($question);exit;
$institute_id = 1;
$questioncid=$this->input->post('cid');
$questiondid=$this->input->post('did');
foreach($question as $key => $singlequestion){
	//$ques_type= 
	
//echo $ques_type; 

if($key != 0){
echo "<pre>";print_r($singlequestion);
$question= str_replace('"','&#34;',$singlequestion['1']);
$question= str_replace("`",'&#39;',$question);
$question= str_replace("‘",'&#39;',$question);
$question= str_replace("’",'&#39;',$question);
$question= str_replace("â€œ",'&#34;',$question);
$question= str_replace("â€˜",'&#39;',$question);



$question= str_replace("â€™",'&#39;',$question);
$question= str_replace("â€",'&#34;',$question);
$question= str_replace("'","&#39;",$question);
$question= str_replace("\n","<br>",$question);
$description= str_replace('"','&#34;',$singlequestion['2']);
$description= str_replace("'","&#39;",$description);
$description= str_replace("\n","<br>",$description);
$ques_type= $singlequestion['0'];

	$insert_data = array(
	'cid' => $questioncid,
	'did' => $questiondid,
	'question' =>$question,
	'description' => $description,
	'q_type' => $ques_type,
	'institute_id' => $institute_id
	);
	
	if($this->db->insert('qbank',$insert_data)){
		$qid=$this->db->insert_id();
		$optionkeycounter = 4;
		if($ques_type=="0" || $ques_type==""){
		for($i=1;$i<=10;$i++){
			if($singlequestion[$optionkeycounter] != ""){
				if($singlequestion['3'] == $i){ $correctoption ='1'; }
				else{ $correctoption = 0; }
				$insert_options = array(
				"qid" =>$qid,
				"option_value" => $singlequestion[$optionkeycounter],
				"institute_id" => $institute_id,
				"score" => $correctoption
				);
				$this->db->insert("q_options",$insert_options);
				$optionkeycounter++;
				}
			
			}
	}
	//multiple type
	if($ques_type=="1"){
			$correct_options=explode(",",$singlequestion['3']);
			$no_correct=count($correct_options);
			$correctoptionm=array();
			for($i=1;$i<=10;$i++){
			if($singlequestion[$optionkeycounter] != ""){
			foreach($correct_options as $valueop){
				if($valueop == $i){ $correctoptionm[$i-1] =(1/$no_correct);
					break;
					}
				else{ $correctoptionm[$i-1] = 0; }
			}
			}
			}
			
			//print_r($correctoptionm);
			
		for($i=1;$i<=10;$i++){
		
			if($singlequestion[$optionkeycounter] != ""){
			
				$insert_options = array(
				"qid" =>$qid,
				"option_value" => $singlequestion[$optionkeycounter],
				"institute_id" => $institute_id,
				"score" => $correctoptionm[$i-1]
				);
				$this->db->insert("q_options",$insert_options);
				$optionkeycounter++;
				
				
				}
			
			}
	}
	
	//multiple type end	
	
	//fillups
		if($ques_type=="2"){
		for($i=1;$i<=1;$i++){
			
			if($singlequestion[$optionkeycounter] != ""){
				if($singlequestion['3'] == $i){ $correctoption ='1'; }
				$insert_options = array(
				"qid" =>$qid,
				"option_value" => $singlequestion[$optionkeycounter],
				"institute_id" => $institute_id,
				"score" => $correctoption
				);
				$this->db->insert("q_options",$insert_options);
				$optionkeycounter++;
				}
				
				}
			
			}
	
		
	//endfillups
	
	//short Answer
		if($ques_type=="3"){
		for($i=1;$i<=1;$i++){
			
			if($singlequestion[$optionkeycounter] != ""){
				if($singlequestion['3'] == $i){ $correctoption ='1'; }
				$insert_options = array(
				"qid" =>$qid,
				"option_value" => $singlequestion[$optionkeycounter],
				"institute_id" => $institute_id,
				"score" => $correctoption
				);
				$this->db->insert("q_options",$insert_options);
				$optionkeycounter++;
				}
				
				}
			
			}
	
	//end Short answer
	
	//match Answer
		if($ques_type=="5"){
			$qotion_match=0;
			for($j=1;$j<=10;$j++){
			
			if($singlequestion[$optionkeycounter] != ""){
				
				$qotion_match+=1;
				$optionkeycounter++;
				}
				
				}
			///h
			$optionkeycounter=4;
		for($i=1;$i<=10;$i++){
			
			if($singlequestion[$optionkeycounter] != ""){
				 $correctoption =1/$qotion_match; 
				$insert_options = array(
				"qid" =>$qid,
				"option_value" => $singlequestion[$optionkeycounter],
				"institute_id" => $institute_id,
				"score" => $correctoption
				);
				$this->db->insert("q_options",$insert_options);
				$optionkeycounter++;
				}
				
				}
			
			}
	
	//end match answer
	
		}//
		}
	}

/*
$institute_id = 1;
if($question['question'] != ""){
			$insert_data = array(
			'cid' => $question['cid'],
			'did' => $question['did'],
			'question' => $question['question'],
			'institute_id' => $institute_id
			);
			
 	
			if($this->db->insert('qbank',$insert_data)){
			$qid=$this->db->insert_id();
			foreach($question['option'] as $key => $value){
			$sc=$question['score']-1;
			if($key==$sc){
			$score="1";
			}else{
			$score="0";
			}
			if($value != ""){
			$insert_data = array(
			'qid' => $qid,
			'option_value' => $value,
			'score'=> $score,
			'institute_id' => $institute_id
			);
			}
			$this->db->insert('q_options',$insert_data);
			}
			}
			}
			*/
}


			function update_question($id,$q_type){
						$institute_id = 1;
						$insert_data = array(
						'cid' => 1,//$this->input->post('cid'),
						'course_id' => $this->input->post('course_id'),
						'did' => 1,//$this->input->post('did'),
						'question' => $this->input->post('question'),
						'description' => $this->input->post('description')
						);
						$institute_id = 1;
						$this->db->where('institute_id',$institute_id);
						$this->db->where('qid',$id);
						if($this->db->update('qbank',$insert_data)){
							$emp=0;
							
						if( isset($_POST['option']) && !empty($_POST['option']))
						{
							foreach($_POST['option'] as $key => $value){
									if($q_type=="0"){
										if($key==($this->input->post('score'))){
											$score="1";
										}else{
											$score="0";
										}
									}
									if($q_type=="1"){
										foreach($_POST['CheckBox'] as $key2 => $value1){
											if($value1==$key){
												$score=1/count($_POST['CheckBox']);
											break;
											}else{
												$score="0";
											}
										}
										//exit;
									}
								if($q_type=="2"||$q_type=="3"){
									$score="1";
								}
								if($q_type=="5"){
									$score=1/count($_POST['option']);
								}
								
								//echo $score."<br>";
								
								$insert_data = array(
								'qid' => $id,
								'option_value' => $value,
								'score'=> $score
								);
								if( isset($_POST['oids'][$key]) && !empty($_POST['oids'][$key]) && $_POST['oids'][$key] >= "1"){
									$oid=$_POST['oids'][$key];
									$institute_id = 1;
									$this->db->where('institute_id',$institute_id);
									$this->db->where('oid',$oid);
									$this->db->update('q_options',$insert_data);
									
									//print_r($this->db->last_query());	
									if($value==""){
											$emp++;
										$this->db->where('institute_id',$institute_id);
										$this->db->where('oid', $oid);
										$this->db->delete('q_options'); 
										
										$score=1/(count($_POST['option'])-$emp);
										//echo $score;die;
										$insert_d = array(
										'score'=> $score
										);
											$this->db->where('qid',$id);
											$this->db->where('score >', '0');
										$this->db->update('q_options',$insert_d);
										
									}
								}else{
									$institute_id = 1;
									$this->db->insert('q_options',$insert_data);
								}
							}
						}
						return "Question updated successfully";
						}else{
						return "Unable to update question";
						}
			}




 function get_question($id){
	$institute_id = 1;
	$query = $this -> db -> query("SELECT * FROM  `qbank` JOIN question_category ON qbank.cid = question_category.cid WHERE qbank.qid='$id' and qbank.institute_id = '$institute_id'");
	$questions=$query->row_array();
	$query = $this -> db -> query("SELECT * FROM  q_options WHERE qid='$id' and institute_id = '$institute_id'");
	$options=$query->result_array();
	$dataarr=array($questions,$options);
	return $dataarr;
  }
  
  
 function remove_question($id)
 {
   $institute_id = 1;
   if($this->db->delete('qbank', array('qid' => $id, 'institute_id' => $institute_id)))
   {
 		$this->db->delete('q_options', array('qid' => $id, 'institute_id' => $institute_id));
   	return true;
   }
   else
   {
     return false;
   }
 }

function remove_qids($qids)
 {
 foreach($qids as $qid){
   $institute_id = 1;
   if($this->db->delete('qbank', array('qid' => $qid, 'institute_id' => $institute_id)))
   {
 		$this->db->delete('q_options', array('qid' => $qid, 'institute_id' => $institute_id));
   	
   }
   
   }
   return true;
 }

}
?>
