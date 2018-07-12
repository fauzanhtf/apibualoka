<?php	
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin: *");
	
	//include database config and region object
	include_once "../config/config.php";
	include_once "../object/region.php";

	//init database connection and object(database & region)
	$db = new Database();
	$connection = $db->getConnection();
	
	$region = new Region();
	$region->_construct($connection);
	
	//get url parameter
	$parent = $_GET["parent"];
	
	//query get all region
	$query = $region->getRegion($parent);
	
	//init variabel result
	$query->bind_result($id,$parent,$name,$level);
	
	//init array
	
	$response = array();
	
	if($query){
		$response['status'] = true;
		$response['message'] = "Data region berhasil didapatkan";
		$response['data'] = array();
		
		//echo dalam bentuk json
		while($query->fetch()){
			$output = array(
				'id' => $id,
				'parent' => $parent,
				'name' => $name,
				'level' => $level
			);
		
			array_push($response['data'], $output);
		}
	
		echo json_encode($response);
	} else {
		$response['status'] = false;
		$response['message'] = "Data region gagal didapatkan";
		
		echo json_encode($response);
	}
	
?>