<?php
include('/model/class.db.php');

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
	
	$db = new DBase();
	extract($_POST);

	$res = $db->queryDB("DELETE FROM test_blog WHERE rowid = ".$id;);
	
	if($res) {
		echo 'success';
	} else {
		echo 'failure';
	}
	

} else if(isset($_POST['action']) && $_POST['action'] == 'gethtml'){
	
	$db = new DBase();
	extract($_POST);
	
	$res = $db->queryDB("SELECT * FROM test_media WHERE rowid = ".$id." AND mediatype = 'image' ORDER BY addedtime ASC");
	
	
	$retstring = '';
	$divcounter = 1;
	
	while($temp = $db->fetchArrayDB($res)){
		
		$arrfileinfo = pathinfo($temp["imageurl"]);
		
		if(!empty($temp["rowid"])){
			
			$retstring .= '<div style="float:left;padding:5px;border:0px solid navy;"><a class="example-image-link" href="'.$temp["imageurl"].'" data-lightbox="example-set" data-title=""><img class="example-image" style="border:2px solid lightgray;" src="'.$arrfileinfo["dirname"].'/'.$arrfileinfo["filename"].'_croppedphoto.'.$arrfileinfo["extension"].'" border="0"></a><span style="color:red;cursor:pointer;margin-left:5px;vertical-align:top;position:relative;top:-4px;" onClick="javascript:DeleteEntry(\'delete\', '.$temp["rowid"].');">X</span></div>';
			
			
			if($divcounter % 4 == 0){
				$retstring .= '<div style="clear:both;">&nbsp;</div>';
			}
			
			
		}
		$retstring .= '';
		$divcounter++;
	}
	
	
	
} else if(isset($_POST['action']) && $_POST['action'] == 'getjson'){
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	$db = new DBase();
	extract($_POST);
	$results = $db->queryDB("SELECT * FROM json_test_table WHERE id = ". (int) $id);

	$outp = "";
	
	while($rs = $db->fetchArrayDB($results)) {
		
		if ($outp != "") {
			$outp .= ",";
		}
		$outp .= '{"productid":"'  . $rs["productid"] . '",';
		$outp .= '"productname":"'   . $rs["productname"]        . '",';
		$outp .= '"description":"'. $rs["description"]     . '"}';  
	}
	$outp ='{"records":['.$outp.']}';
	
	echo($outp);
}


?>