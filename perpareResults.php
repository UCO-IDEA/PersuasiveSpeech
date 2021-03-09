<?php

$total_results = array();
$no_of_responses;

$persuaded = 0;
$impartial = 0;
$dissuaded = 0;

function prepareResults($resource, $results,$id){
	GLOBAL $total_results,$no_of_responses,$persuaded,$impartial,$dissuaded;
	$no_of_responses = 0;
	foreach($results as $res){
		if($res['id'] == $id){
			$total_results[$no_of_responses] = array(
				"id" => $res['id'],
				"rating" => $res['Rating']
			);
			$no_of_responses++;
		}
	}
	
	foreach($total_results as $resArr){
		$resJSON = json_decode($resArr['rating'],true);
		$diff = intval($resJSON['end']['scale']) - intval($resJSON['start']['scale']);
		if( $diff > 0){
			$persuaded++;
		}else if($diff == 0){
			$impartial++;
		}else if($diff < 0){
			$dissuaded++;
		}
	}
	
}
?>