// JavaScript Document

const postURL = "postResult.php";

const state = {
	"Start":"start",
	"Middle": "middle",
	"End": "end",
	"Done":"done"
};

var currentState = "";

let result = {
	"id":"",
	"userData":{
		"start":{
			scale:-1,
			degreeOfPersuation:""
		},
		"middle":{
			scale:-1,
			degreeOfPersuation:""
		},
		"end":{
			scale:-1,
			degreeOfPersuation:""
		}
	}
};

let colors  = {
	sucess: '#3598db',
	error: '#e84c3d',
	warning: '#f39c11'
};

function displayMessage(data){
	
	let color = "";
	let message = "";
	let sub_message = "";
	let message_html = "";
	let sub_message_html = "";
	
	var timeOut;
	
	hideSurvey();
	
	$(".message_text").empty();
	$(".sub_message").empty();
	
	if(data.result == "error"){
	   color = colors.error;
	   message = data.description;
	   sub_message = "Something went wrong. Please try again later.";
	}
	
	if(data.result == 'success'){
		color = colors.sucess;
		message = data.description;
		sub_message = "Thank you for your participation!";

	}
	
	message_html = `<h5>${message}</h5>`;
	sub_message_html = `<p>${sub_message}</p>`;
	
//	$(".message_text").css("background-color",color);
	$(".message_text").append(message_html);
	
	$(".sub_message").append(sub_message_html);
	
	viewOverlay();
	viewMessage();
	
/*	timeOut = setTimeout(function(){ 
		hideOverlay();
		hideMessage();
	},4000);*/	
}

// ------- Display Functions  ----//

function viewSurvey(){
	$(".overlay").removeClass("hidden");
	$(".modal_window").removeClass("hidden");
}

function hideSurvey(){
	$(".overlay").addClass("hidden");
	$(".modal_window").addClass("hidden");
}

function hideOverlay(){
	$(".overlay").addClass("hidden");
}
function viewOverlay(){
	$(".overlay").removeClass("hidden");
}

function viewMessage(){
	$(".message").removeClass("hidden");
}

function hideMessage(){
	$(".message").addClass("hidden");
}

// ------- Display Functions End  ----//

// ------- Ajax POST -------//
function postResult(type, URL, data){

	$.ajax({
		type: type,
		url: URL,
		data: data,
		success: function(data) {
			displayMessage(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
				console.log({'result':'error','errorType': 'AJAX Client Error','jqXHR': jqXHR, 'textStatus': textStatus, 'errorThrown': errorThrown});
		},
	});
}
// ------- Ajax POST End -------//


$("#modal_btn").click(function(){
	
	let val = $('input[name="item"]:checked').val();
	let id = $('input[name="item"]:checked').attr("id");
	
	if(!id){
		$('.modal_error').empty();
		$('.modal_error').append('<p>Please select an option on the persuation scale.</p>');
		return;
	}
	
	let new_scale = id.substr(1,1);
	
	if(currentState === state.Start){
		result.userData.start.scale = new_scale;
		result.userData.start.degreeOfPersuation = val;
	}else if(currentState === state.Middle){
		result.userData.middle.scale = new_scale;
		result.userData.middle.degreeOfPersuation = val;
	}else if(currentState === state.End){
		result.userData.end.scale = new_scale;
		result.userData.end.degreeOfPersuation = val;
		currentState = state.Done;
		
		postResult('POST',postURL,result);
	}
	
	hideSurvey();
});

$(".close_browser").click(function(){
	window.close();
});