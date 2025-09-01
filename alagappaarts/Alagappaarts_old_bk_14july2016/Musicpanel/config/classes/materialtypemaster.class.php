<?php

class materialtypemaster
{
	function checkMaterial($arrMaterial){
		global $DB;
		$MaterialName  = $arrMaterial[name];
		$checkaMaterialName = "select name from materialtype where name='$MaterialName'";
		$checkaMaterialNames = $DB->Execute($checkaMaterialName);
		$count = count($checkaMaterialNames->fields[0]);
		return $count;
	}
	
	function addmaterial($arrMaterial){
		global $DB;
		$insert = "insert into materialtype values('','{$arrMaterial[name]}','{$arrMaterial[description]}','{$arrMaterial[status]}','{$arrMaterial[created_on]}','{$arrMaterial[created_by]}',
		'{$arrMaterial[modified_by]}','{$arrMaterial[modified_on]}')";
		//echo $insert;
		$excuteInsert = $DB->Execute($insert);
		//echo $excuteInsert;
		return $excuteInsert ;
	}
	function getMaterial($arrMaterial)
	{
		global $DB;
		$getMaterial ="select id, name,description,status from materialtype";
		return $getMaterial;
	}
	function getMaterialType($materialid)
	{
		global $DB;
		$getMaterial ="select id, name, description, status from materialtype where id={$materialid}";
		$getMaterialtypes = $DB -> Execute($getMaterial);
		return $getMaterialtypes;
	}
	function updateMaterialtype($arrMaterial){
		global $DB;
		$update = "update materialtype set  name= '{$arrMaterial[name]}',description='{$arrMaterial[description]}',status='{$arrMaterial[status]}',created_on='{$arrMaterial[created_on]}',created_by='{$arrMaterial[created_by]}',modified_by='{$arrMaterial[modified_by]}',modified_on='{$arrMaterial[modified_on]}' where  id ={$arrMaterial[id]}";
		//echo $update;
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
}

?>