<?php



class pagination{
	
	var $lastPageNo = "";
	
	function getQuery( $sqlQuery, $pageNo ){
				
		if( ! $_GET[ pageNo ] ) $_GET[ pageNo ] = 0;
		$pageNo = $_GET[ pageNo ];
		
		$startingIndex = ( $pageNo * MAX_NO_OF_ROWS_PAGINATION );
		
		$limitClause = "limit {$startingIndex}, ". MAX_NO_OF_ROWS_PAGINATION;
		
		$sqlQuery = "{$sqlQuery} {$limitClause}";
		
		return $sqlQuery;
		
	}
	
	function getLinks( $sqlQuery, $pageNo ){
		
		
		global $DB;
		
		if( ! $_GET[ pageNo ] ) $_GET[ pageNo ] = 0;
		$pageNo = $_GET[ pageNo ];

		
		$rsQuery = $DB -> Execute( $sqlQuery );
							  
		$recordCount = $rsQuery -> RecordCount( );
		$noofpages = ceil($recordCount/MAX_NO_OF_ROWS_PAGINATION);
		$firstPageNo = 0;
		$prevPageNo = $pageNo - 1;
		$nextPageNo = $pageNo + 1;
		if ( ($recordCount % MAX_NO_OF_ROWS_PAGINATION) == 0)
		{
			$lastPageNo = floor( $recordCount / MAX_NO_OF_ROWS_PAGINATION )-1;
		}
		else 
		{
			$lastPageNo = floor( $recordCount / MAX_NO_OF_ROWS_PAGINATION );
		}
		$this -> lastPageNo = $lastPageNo;
		
		$paginationLinks = "";
		if($recordCount > MAX_NO_OF_ROWS_PAGINATION)
		{
			if( $pageNo == 0 ){
				
				$paginationLinks .= "<li> <a class='p0 prevBtn Inactive' href='javascript:;' > </a></li> <li class='prevInactive'><a  href='javascript:;'>&laquo;Prev </a></li> ";
				
			}else{
				
				$paginationLinks .= "<li><a  class='p0 prevBtn active' href='?pageNo={$firstPageNo}'></a> </li> ";
				$paginationLinks .= "<li class='prevlink'><a  href='?pageNo={$prevPageNo}'>&laquo; Prev</a></li>  ";
				
			}
			
			for ($i = 1; $i <= $noofpages ; $i++)
			{
				$j = $i -1 ;
				 if($j== $pageNo)
				$paginationLinks .= "<li><a class='active' href='?pageNo={$j}'>$i</a></li>  "; 
				else  $paginationLinks .= "<li><a class='' href='?pageNo={$j}'>$i</a></li>  "; 
				
			}
			
			if( $pageNo == $lastPageNo ){
				
				$paginationLinks .= "<li class='nextInactive'><a  href='javascript:;'>Next »</a></li> <li><a  class='lastInactive p0'  href='javascript:;'></a></li> ";
				
			}else{
	
				$paginationLinks .= "<li class='next'><a href='?pageNo={$nextPageNo}'>Next »</a> </li> ";
				$paginationLinks .= "<li><a class='p0 nextBtn' href='?pageNo={$lastPageNo}'></a></li>";
				
			}
		}
	
		return $paginationLinks;
		
	}
	
	function goToPageTextBox(){

		$goToPageScript .= "<script language='javascript'>
		function validatePageNo( max )
		{ 
			document.getElementById( 'pageNo' ).value = document.getElementById( 'pageNo' ).value - 1; 
			if( document.getElementById( 'pageNo' ).value > max )
				{
					alert( 'Max Page Number is: '+ (max+1) );
					return false; 
				} 
			return true; 
		}
		</script>";
		$goToPageScript .= "
		<form name='frmPaging' style='display: inline;float:right;padding:0 10px 0 10px;' id='pagination' method='get' action='' onsubmit=\"return validatePageNo( {$this->lastPageNo} )\">
			<input id='pageNo' name='pageNo' type='text' size='2'>
			<input type='submit' value='Go' class='gobutton' onclick='return validatego(frmPaging);'>
		</form>";		
		return $goToPageScript;
		
	}
	function rowsperPageFromTo($recordCount){

		if( ! $_GET[ pageNo ] ) $_GET[ pageNo ] = 0;
		$pageNo = $_GET[ pageNo ];
		$noofpages = ceil($recordCount/MAX_NO_OF_ROWS_PAGINATION);
		$from = ( $pageNo *  MAX_NO_OF_ROWS_PAGINATION ) +1;
		if ( ($recordCount % MAX_NO_OF_ROWS_PAGINATION) == 0)
		{
			$lastPageNo = floor( $recordCount / MAX_NO_OF_ROWS_PAGINATION )-1;
		}
		else 
		{
			$lastPageNo = floor( $recordCount / MAX_NO_OF_ROWS_PAGINATION );
		}
		if($pageNo == $lastPageNo)
		$to = $recordCount  ;
		else
		$to = ( $pageNo *  MAX_NO_OF_ROWS_PAGINATION )+  MAX_NO_OF_ROWS_PAGINATION;
		$rowsFromTo = $from ."-".$to;
		return $rowsFromTo;
		
	}
	
}

$paginationObj = new pagination();

?>