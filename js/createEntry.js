// JavaScript Document
var urlRx = new RegExp('(?:https?:\/\/)?(?:www\.)?((?:youtube\.com|youtu.be))(\/)(?:watch|embed)?(?:.*v=|v\/|\/)?([a-z|0-9|\_\-]+)?(\S+)?','i');
var nameRx = new RegExp('^[A-Za-z]+([\ A-Za-z]+)*','i');
var topicRx = new RegExp('<(|\/|[^>\/bi]|\/[^>bi]|[^\/>][^>]+|\/[^>][^>]+)>');
var timeRx = new RegExp('^[+]?[0-9]+');

var inputErrors = {name: false, url: false, timestamp: false};

function isValidName(name){
	let testName = name.trim().match(nameRx);
	console.log(testName);
	if(testName == null){
		return {result: false , message: "Invalid Characters. Only Characters A - Z Allowed"};
	}else{
		if(testName[0] !== name.trim()){
			return {result: false , message: "Invalid Characters. Only Characters A - Z Allowed"};
		}
	}
	
	return {result: true , message: ""};
}

function isValidTopic(topic){
	
}

function isValidURL(url){
	let arr = url.trim().match(urlRx);
	console.log(arr);
	
	if(arr == null){
		return {result: false , message:"Invalid URL"};
	}else{
		if(typeof arr[3] === 'undefined'){
			return {result: false , message:"Video Id Missing"};
		}
	}
	return {result: true,  message:"Valid Url"};
}


function isValidTime(val){
	let testVal = val.trim().match(timeRx);
	
	if(testVal == null){
		return {result: false , message: "Invalid Value. Only 0 - 9 Allowed"};
	}else{
		if(testVal[0] !== val.trim()){
			return {result: false , message: "Invalid Value. Only 0 - 9 Allowed"};
		}
	}
	
	return {result: true , message: ""};
}

$("#PresenterName").on("input",function(){
	let name = $(this).val();
	let result = isValidName(name);
					   
	if(result["result"] === true){
		inputErrors['name'] = false;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("success");
		$(this).siblings(".small_text").removeClass("error");
	}else{
		inputErrors['name'] = true;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("error");
		$(this).siblings(".small_text").removeClass("success");
	}
	
});


$("#SpeechTopic").on("input",function(){
	
	let topic = $(this).val();
	let result = isValidName(topic);
	
	
	if(result["result"] === true){
		inputErrors['name'] = false;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("success");
		$(this).siblings(".small_text").removeClass("error");
	}else{
		inputErrors['name'] = true;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("error");
		$(this).siblings(".small_text").removeClass("success");
	}
});
	
$("#VideoURL").on("input",function(){
	
	let url = $(this).val();
	
	let result = isValidURL(url);
	
	if(result["result"] === true){
		inputErrors['url'] = false;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("success");
		$(this).siblings(".small_text").removeClass("error");
	}else{
		inputErrors['url'] = true;
		$(this).siblings(".small_text").html(result["message"]);
		$(this).siblings(".small_text").addClass("error");
		$(this).siblings(".small_text").removeClass("success");
	}
	
});


$(".timeInput").on("input",function(){
	
	let min = $(this).val();
	let result = isValidTime(min);
	
	if(result['result'] === true){
		inputErrors['timestamp'] = false;
	//	$(".timeMessage").html(result['message']);
		$(this).addClass("border_gray");
		$(this).removeClass("border_red");
	}else{
		inputErrors['timestamp'] = true;
		//$(".timeMessage").html(result['message']);
		$(this).addClass("border_red");
		$(this).removeClass("border_gray");
	}
	
});

function displayUrls(viewUrl,resultUrl){
	$(".url_container").removeClass("hidden");
	$("#view_url").html("<h5>" + viewUrl + "</h5>");
	$("#result_url").html("<h5>" + resultUrl + "</h5>");
}

function getURLs(){
	let viewUrl = getURL("view");
	let resultUrl = getURL("result");
	displayUrls(viewUrl,resultUrl);
}


$("#generateUrls").on("click",function(e){
	if(inputErrors.name || inputErrors.url || inputErrors.timestamp){
		e.preventDefault();
	}else{
		$(this).submit();
	}
});