<?php

require_once '../../Google/google-api-php-client-2.2.0/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("Persuasive_Speech_Data_Sheet");
$client->setDeveloperKey($keys['API_KEY']);
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$client->setAccessType('offline');
$client->setAuthConfig($keys["Service_Account"]);

$service = new Google_Service_Sheets($client);

$spreadsheetId = $keys['SHEET_ID'];

function getEntryData($id){
	GLOBAL $service, $spreadsheetId;
	
	$range = 'Sheet1!A'.$id.":D".$id;
	$options = array('valueRenderOption' => 'FORMATTED_VALUE');

	$response = $service->spreadsheets_values->get($spreadsheetId, $range, $options);

	$values = $response->getValues();
	$myVals = Array();

	$ids = ["Presenter Name","Speech Topic","Youtube URL"];

	for ($i = 0; $i < count($values); $i++) { 
		$myJSON[] = array_combine($ids, $values[$i]);
	}
	//$myJSON[] = array_combine("id",$id);
	return $myJSON;
}

function getAllResultData(){
	
	GLOBAL $service, $spreadsheetId;
	
	$range = 'Sheet2!A:B';
	$options = array('valueRenderOption' => 'FORMATTED_VALUE');
	
	$response = $service->spreadsheets_values->get($spreadsheetId, $range, $options);
	
	$values = $response->getValues();
	
	$ids = ["id","Rating"];
	
		
	for ($i = 0; $i < count($values); $i++) { 
		if(empty($values[$i])){
			$values[i] = "";
		}
			$myJSON[] = array_combine($ids, $values[$i]);
	}
	
	return $myJSON;
	
}

function postEntryData($presenterName,$speechTopic,$youtubeUrl){
	
	GLOBAL $service, $spreadsheetId;
	
	$range = 'Sheet1!A:C';
	$requestBody = new Google_Service_Sheets_ValueRange();
	
	$values = [$presenterName,$speechTopic,$youtubeUrl];
	
	$requestBody->setValues(["values" => $values]);
	
	$conf = ["valueInputOption" => "RAW"];
	
	$response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, $conf);
	
	
	//print("<pre>".print_r($response)."</pre>");
	
	$updatedRange = $response["updates"]->updatedRange;
	
	$newRangePos = strpos($updatedRange, "A") + 1;
	
	$rangeId = substr($updatedRange, $newRangePos, strrpos($updatedRange, ":") - $newRangePos);
	
	return $rangeId;
	
}

function postresultData($id,$userData){
	GLOBAL $service, $spreadsheetId;
	
	$rangeId = -1;
	
	$range = 'Sheet2!A:B';
	$requestBody = new Google_Service_Sheets_ValueRange();
	
	$values = [$id,$userData];
	
	$requestBody->setValues(["values" => $values]);
	
	$conf = ["valueInputOption" => "RAW"];
	
	$response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, $conf);
	
	
	//print("<pre>".print_r($response)."</pre>");
	
	$updatedRange = $response["updates"]->updatedRange;
	
	$newRangePos = strpos($updatedRange, "A") + 1;
	
	$rangeId = substr($updatedRange, $newRangePos, strrpos($updatedRange, ":") - $newRangePos);
	
	return $rangeId;
	
}

?>