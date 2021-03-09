<?php
//header("Access-Control-Allow-Origin:  Your Control Origin Here ");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('config.php');
require_once ('dataHandler.php');


if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
	try{
		
		$id = -1;
		$data = -1;
		
		$id = isset($_REQUEST['id']) ? ($_REQUEST['id']) : -1;
		$data = isset($_REQUEST['userData']) ? ($_REQUEST['userData']) : -1;

		
		if($data == -1 || $id == -1){
			$error = array(
			"result" => "error",
			"description" => "Id and userData Cannot be Empty"
			);
			print_r(json_encode($error));
			die();
		}
		
		$res = postresultData($id,json_encode($data));
		
		if($res != -1){
			$success = array(
				"result" => "success",
				"description" => "Result Stored Successfully"
			);
			print_r(json_encode($success));
			die();	
		}
		
	}catch(Exception $e){
		$error = array(
			"result" => "error",
			"description" => $e->getMessage()
		);
		print_r(json_encode($error));
		die();
	}
	
}else{
	$error = array(
			"result" => "error",
			"description" => "Request does not use SSL"
		);
		print_r(json_encode($error));
		die();	
}
?>