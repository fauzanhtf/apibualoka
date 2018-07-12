<?php
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin: *");
	
	include_once "../config/config.php";
	include_once "../object/user.php";
	include_once "../object/logsesion.php";
	
	//koneksi ke database
	$database = new Database();
	$dbconnection = $database->getConnection();
	
	//objek user
	$user = new User();
	$user->_construct($dbconnection);
	$logsesion = new LogSesion($dbconnection);
	$logsesion->_construct($dbconnection);
	
	$user->email = $_POST['email'];
	$user->password = $_POST['password'];
	
	$getuserdata = $user->getdatauser();
	//$row = mysqli_num_rows($getuserdata);
	
	$getuserdata->bind_result($id, $email, $name, $password, $telp, $address, $district, $city, $province);
	
	$dbpassword = null;
	
	while($getuserdata->fetch()){
		$userdata = array(
			'id' => $id,
			'email' => $email,
			'name' => $name,
			'password' => $password,
			'telp' => $telp,
			'address' => $address,
			'district' => $district,
			'city' => $city,
			'province' => $province
		);
	}
	
	$log = array();
	
	if(password_verify($user->password, $password)){
		$logsesion->apikey = sha1(time());
		$logsesion->is_active = 1;
		$logsesion->id_user = $id;
		
		if($logsesion->setlogsesion()){
			$response = array(
				'message' => "Login berhasil",
				'apikey' => $logsesion->apikey
			);
			
			$log["response"] = $response;
			
			echo json_encode($log);
		} else {
			$response = "Terjadi kesalahan koneksi, coba beberapa saat lagi";
			
			$log["response"] = $response;
			
			echo json_encode($log);
		}
	} else {
		$response = "Login gagal, email atau password anda tidak cocok";
			
		$log["response"] = $response;
			
		echo json_encode($log);
	}
?>



