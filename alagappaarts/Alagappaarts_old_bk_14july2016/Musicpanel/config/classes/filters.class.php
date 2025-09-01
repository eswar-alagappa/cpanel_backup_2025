<?php

class filters{




	public function applyFilter($inputArray,$page )
	{
      switch($page)
	  {
		  case 'courselisting':
		  						if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){

												if($input  == "cm.name")
													$whereClause .= " AND {$input} like '%{$value}%'";
												else 
													$whereClause .= " AND {$input}='{$value}'";

											}
											}
								}
		  						break;
		 case 'centre_listing':
		  						if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												if($input  == "cm.academy_name")
													$whereClause .= " AND {$input} like '%{$value}%'";
												else 
													$whereClause .= " AND {$input}='{$value}'";

											}
											}
								}
		  						break;
		case 'student_listing':
							if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												if($input  == "sm.first_nameonalpha")
													$whereClause .= " AND  sm.first_name  like '{$value}%'";
												else if($input  == "sm.first_name")
													$whereClause .= " AND {$input} like '%{$value}%'";

												else 
													$whereClause .= " AND {$input}='{$value}'";

											}
											}
									
								}
		  						break;
			case 'check_payment':
							if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												$whereClause .= " AND {$input}='{$value}'";

											}
											}
									
								}
		  						break;
		case 'questionlisting':
		  						if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												if($input  == "qm.question")
													$whereClause .= " AND {$input} like '%{$value}%'";
												else 
													$whereClause .= " AND {$input}='{$value}'";

												

											}
											}
									$whereClause .= " ORDER BY qm.id DESC";
								}
		  						break;	
	case 'admin_listing':
							if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												if($input  == "ad.name")
													$whereClause .= " AND {$input} like '%{$value}%'";
												else if($input  == "ad.status")
													$whereClause .= " AND {$input} like '%{$value}%'";
												else 
													$whereClause .= " AND {$input}='{$value}'";

											}
											}
								
									}
		  						break;		
								
	case 'exam_listing':
							if($inputArray)
								{ 
									foreach( $inputArray as $input => $value ){

											if( $value != '' ){
												 if($input  == "sm.first_name")
													$whereClause .= " AND {$input} like '%{$value}%'";

												else 
													$whereClause .= " AND {$input}='{$value}'";

											}
											}
									
								}
		  						break;	
	case 'student_report': 
						if($inputArray)
						{
							foreach($inputArray[searchContion] as $key => $value){
							switch($value)
							{
								case 'First Name':

										$whereClause .= " AND sm.first_name like '%{$inputArray[txtFirstname][$key]}%'";		
										break;

								case 'Last Name':
										
										$whereClause .= " AND sm.last_name like '%{$inputArray[txLasttname][$key]}%'";		
										break;
								
								case 'Program':
								
										$whereClause .= " AND se.program_id  = '{$inputArray[ddlProgram][$key]}' ";		
										break;
								
								case 'Centre':
								
								  		$whereClause .= " AND se.centre_id  = '{$inputArray[ddlCenter][$key]}'";									
										break;
							
								
								case 'Graduation Status':
								
										$whereClause .= " AND se.graduation_status = '{$inputArray[ddlGraduationstatus][$key]}'";									
											break;
								case 'Payment Status':
									
											$whereClause .= " AND 	se.payment_status_id = '{$inputArray[ddlPaymentstatus][$key]}'";									
											break;
								case 'Date of Joining':
											switch($inputArray[ddlDateofjoining][$key])
											{
												
												case 'Between':
														$fromDate =date('Y-m-d', strtotime($inputArray[txtFromdate][$key]));
														$toDate = date('Y-m-d', strtotime($inputArray[txtTodate][$key]));	
														break;
												case 'After':
														$fromDate =date('Y-m-d', strtotime($inputArray[txtTodate][$key]));
														$toDate =  date("Y-m-d");
														break;
												case 'Before':
														$fromDate ="2009-01-01";
														$toDate = date('Y-m-d', strtotime($inputArray[txtTodate][$key]));	
														break;
											}
											
											$whereClause .= " AND  date(se.enrollment_date)  between '{$fromDate}' and '{$toDate}'";
											break;
								default : 
								break;	
										
							}
							}
						}
						return $whereClause;
						break;
									
	  }
		return $whereClause;

	}

	public function applyFilter1($inputArray,$page )
	{	
		switch($page)
		{
			case 'reportlisting': 
						if($inputArray)
						{
							switch($inputArray[searchfor])
							{
								case 'Date':

										$whereClause = " and qm.modifiedon between '{$inputArray[datefrom]}' and '{$inputArray[dateto]}' group by qm.questionid order by qm.questionid";
																				
										break;

								case 'Level':
										
										if($inputArray[level])
										  		$whereClause .= " and qm.levelid='{$inputArray[level]}'";
										
										if($inputArray[subject])
												$whereClause.=" and qm.subjectid='{$inputArray[subject]}'";
												
										$whereClause.=" group by qm.questionid order by qm.questionid";
										break;
								
								case 'Tutor':
								
										if($inputArray[tutorname])
										  		$whereClause .= " and trm.tutorname like '{$inputArray[tutorname]}%'";
										
										if($inputArray[tutorsubject])
												$whereClause.=" and trm.subjectid='{$inputArray[tutorsubject]}'";
												
										$whereClause.=" group by qm.questionid order by qm.questionid";
										break;
								
								case 'Price':
								
								  		$whereClause .= " and (select sum(py.amountpaid) from payments py where py.questionid=qm.questionid)
															between '$inputArray[pricefrom]' and '$inputArray[priceto]' group by qm.questionid order by qm.questionid";										
										break;
								
								case 'Student':
								
										if($inputArray[studentname])
										  		$whereClause .= " and stm.studentname like '{$inputArray[studentname]}%'";
										
										if($inputArray[question])
												$whereClause.=" and qm.questionid='{$inputArray[question]}'";
												
										$whereClause.=" group by qm.questionid order by qm.questionid";
		
										break;
										
								default:
										$whereClause.=" group by qm.questionid order by qm.questionid desc";								
										break;										
							}
							
						}
						return $whereClause;
						break;
			
			case 'paymentlisting': 
			                            if( $inputArray)
										  {
											  	foreach( $inputArray as $input => $value )
														{
															if( $value != '' && $input!= 'searchfor')
															{	
																 if ( $input=='daterange' && $value != '')
																	{
																		$whereClause.= " AND $value";
																	}
																	
																	else if( $input=='pricerange' && $value != '' )
																	{
																		$whereClause .= " AND $value";
																	}
																	else if( $input=='student' && $value != '' )
																	{
																		$whereClause .= " AND $value";
																	}
																	else if( $input=='tutor' && $value != '' )
																	{
																		$whereClause .= " AND $value";
																	}
																	else
																	{
																	$whereClause .= " AND {$input}='{$value}'";
																	}
															}	
														}														
																						
										  }
											
											if($inputArray[searchfor]=='Refund')
											{
												$whereClause .= " group by questionid order by rp.refundid desc";
											}
											else
											{
												$whereClause .= " group by questionid order by py.paymentid desc";
											}
											break;
			case 'coordinatorlisting':
			case 'subjectlisting':
			
										  if($inputArray)
										  {
											foreach( $inputArray as $input => $value ){

											if( $value != '' ){

												$whereClause .= " AND {$input}='{$value}'";

											}
											}
										  }
										
											$whereClause .= " group by s.subjectid";
											break;
			
			case 'topiclisting':
			                             foreach( $inputArray as $input => $value ){

											if( $value != '' ){

												$whereClause .= " AND {$input}='{$value}'";

											}
											}

											break;
			case 'tutorlisting':
			
									foreach( $inputArray as $input => $value ){

											
											if(($value != '')&&($input=='tm.tutorid') ) {
												
												$whereClause .=" AND {$input}={$value}";
												
											}
											else if(($value != 0)&&($input=='sm.subjectid') ) {
												
												$whereClause .=" AND {$input}={$value}";
												
											}
											else if(($value != '')&&($input=='tm.status') )
											{
												if($value=='Inactive')
												{
												 $whereClause .=" AND ({$input}='{$value}' OR {$input}='Pending')";	
												}
												else
												{												
												$whereClause .=" AND {$input}='{$value}'";
												}
											}
										    else if(($value != '')&&($input=='tm.tutorname') ){

												$whereClause .= " AND tm.tutorname LIKE '{$value}%'";

											}
											
											}
										  												
											break;			
			
			
			case 'studentlisting':
											foreach( $inputArray as $input => $value ){

											
											if(($value != 0)&&($input=='sm.levelid') ) 
												{												
													$whereClause .=" AND {$input}={$value}";												
												}
												
												
												/* 10/06/2009 changed qm.studentid = sm.studentid to qm.studentid = um.userid*/
												else if(($value !='')&&($input=='txtto'))
												{									
													$whereClause .=" AND (SELECT SUM( py.amountpaid ) FROM payments py JOIN questionmaster qm ON qm.questionid =  
																		 py.questionid WHERE qm.studentid = um.userid)
													    	             BETWEEN {$inputArray[txtfrom]} AND {$inputArray[txtto]} ";
												}								
												
												else if(($value != '')&&($input=='um.userstatus') )
												{
													$whereClause .=" AND {$input}='{$value}'";
												}
										    	
												else if(($value != '')&&($input=='sm.studentname') )
												{
													$whereClause .= " AND sm.studentname LIKE '{$value}%'";
												}
												
												
											}
											return $whereClause." order by studentid desc";
											break;
				
											
			case 'questionlisting':
		
					if($inputArray)
							{
								switch($inputArray[searchfor])
								{
									case 'Date':
	
											$whereClause .= " and qm.modifiedon	between '{$inputArray[datefrom]}' and '{$inputArray[dateto]}' group by qm.questionid order by qm.questionid desc";
											
											break;
	
									case 'Level':
											
											if($inputArray[level])
													$whereClause .= " and qm.levelid='{$inputArray[level]}'";
											
											if($inputArray[subject])
													$whereClause.=" and qm.subjectid='{$inputArray[subject]}'";
													
											$whereClause.=" group by qm.questionid order by qm.questionid desc";
											break;
									
									case 'Tutor':
									
											if($inputArray[tutorname])
													$whereClause .= " and ttm.tutorname like '{$inputArray[tutorname]}%'";
											
											if($inputArray[tutorsubject])
													$whereClause.=" and ttm.subjectid='{$inputArray[tutorsubject]}'";
													
											$whereClause.=" group by qm.questionid order by qm.questionid desc";
											break;
									
									case 'Price':
									
											$whereClause .= " and (select sum(py.amountpaid) from payments py where py.questionid=qm.questionid)
																between '$inputArray[pricefrom]' and '$inputArray[priceto]' group by qm.questionid order by qm.questionid desc";										
											break;
									
									case 'Student':
									
											if($inputArray[studentname])
										  		$whereClause .= " and stm.studentname like '{$inputArray[studentname]}%'";
										
										if($inputArray[question])
												$whereClause.=" and qm.questionid='{$inputArray[question]}'";
												
										$whereClause.=" group by qm.questionid order by qm.questionid desc";
		
										break;		
	
									default:
										$whereClause.=" group by qm.questionid order by qm.questionid desc";								
										break;		
								}
								
							}
							return $whereClause;
							break;
							
				case 'solutionbagindex':
				
				if($inputArray)
				{
					$keywordlength = strlen($inputArray);
					
					
						$whereclause = " and (sm.subjectname like '%$inputArray%' or t.topicname like '%$inputArray%' or sb.shortdesc like '%$inputArray%' or sb.keywords like '%$inputArray%')"; 
					
					return $whereclause;
				}
				
				break;
			}
	return $whereClause;
	}
}



$filterObj = new filters();
?>