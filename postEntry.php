<?php

	include_once 'config.php';
	include_once 'dataHandler.php';

	$errors = array();
	
	if(isset($_POST['PresenterName']) && isset($_POST['VideoURL']) && isset($_POST['SpeechTopic'])){
		
		if($_POST['PresenterName'] != "" && $_POST['VideoURL'] != "" && $_POST['SpeechTopic'] != ""){
			try{
				$urls = [];
				$newId = "";
				$presenterName = $_POST['PresenterName'];
				$youtubeUrl = $_POST['VideoURL'];
				$speechTopic = $_POST['SpeechTopic'];

			
				$newId = postEntryData($presenterName,$speechTopic,$youtubeUrl);
				$urls = generateUrls($newId);
			}catch(Exception $e){
				$error = array("error" => $e->getMessage());
				$errors = array_merge($errors,$error);
			}
		}else{
			$error = array("error" => "Presenter Name, Speech Topic and Video URL are required.");
			$errors = array_merge($errors,$error);
		}
	}

	function generateUrls($newId){
		GLOBAL $home;
		return $urls = [
			"viewUrl" => $home."view.php?id=".$newId,
			"resultUrl" => $home."result.php?id=".$newId
		];
	}

?>