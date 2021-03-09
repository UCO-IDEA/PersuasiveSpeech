<?php
require_once '../../Google/google-api-php-client-2.2.0/vendor/autoload.php';

require_once 'config.php';

require_once 'dataHandler.php';

header('Content-Type: text/html; charset=utf-8');	

$errors = array();

try {
	$entry = getEntryData($_GET['id'])[0];
} catch (Exception $e) {
	echo $e;
	exit;
}
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Persuasive Speech</title>
	
<?php include "head.php" ?>
	<style>
		html{
			height: 100%;
			margin: 0;
		}
		body::-webkit-scrollbar{
			width: 0.25rem;
		}

		body::-webkit-scrollbar-track{
			background: ##9c9494;
		}

		body::-webkit-scrollbar-thumb{
			background: #424242;
		}
		body{
			/*background-image: linear-gradient(#002d62, #000815);*/
			background: #150307;
			height: 100%;
			margin: 0;
		}
		.wrapper{
			min-height: 100%;
			margin: 0 auto;
		}
		input{
			display: none; 
		}
		.radio_text{
			display: inline;
		}
		#heading{
			text-align: left;
		}
		#heading h1{
			padding: 0rem;
			margin-bottom: 0px;
		}
	/*	#logo, .speech_info{
			display: inline-block;
		}*/
		#logo img{
			width: 10rem;
		}
		.speech_info{
			/*margin-left: 2rem;*/
			font-weight: 400;
			padding-top: 3rem;
		}
		#crowd_image{
			padding: 0px;
			background:#150307;
		}
		#crowd_image img{
			width:100%!important;
		}
		.logo_lumina{
			width: 15rem!important;
		}
	</style>
</head>

<body>
	<div class="overlay hidden"></div>
	<div class="modal_window hidden">
		<div id="modal_topic_container">
			<div id="modal_topic" class="primary-bg"><h3><?php echo ucfirst($entry['Speech Topic']); ?></h3></div>
		</div>
		<div id="modal_radio_container">
		  <input type="radio" value="Strongly Opposed" id="r1" name="item">
		  <label class="radio" for="r1">
		  <p class="radio_text mr-1 text-bold">Strongly Opposed</p>
			<span class="big">
			  <span class="small"></span>
			</span>
		  </label>
		  <input type="radio" value="Moderately Opposed" id="r2" name="item">
		  <label class="radio" for="r2">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text"></p>
		  </label>
		  <input type="radio"  value="Slightly Opposed" id="r3" name="item">
		  <label class="radio" for="r3">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text"></p>
		  </label>
		  <input type="radio"  value="Neutral" id="r4" name="item">
		  <label class="radio" for="r4">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text"></p>
		  </label>
		 <input type="radio"  value="Slightly In Favor" id="r5" name="item">
		  <label class="radio" for="r5">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text"></p>
		  </label>
		 <input type="radio" value="Moderately In Favor" id="r6" name="item">
		  <label class="radio" for="r6">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text"></p>
		  </label>
		<input type="radio" value="Strongly In Favor" id="r7" name="item">
		  <label class="radio" for="r7">
			<span class="big">
			  <span class="small"></span>
			</span><p class="radio_text text-bold">Strongly In Favor</p>
		  </label>
		</div>
		
		<button type="button" id="modal_btn" class="btn btn-primary">Continue</button>
		<div class="modal_error mt-2"></div>
	</div>
	<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12" id="heading">
				<div class="row">
					<div class="col-sm-6" id="logo">
						<img src="logo/PS_Logo_Small_White.svg" class="img-fluid">
						<div class="inline-flex text-white">
								<h2>PERSUASIVE <br> SPEECH</h2>
						</div>
					</div>
					<?php 
						if(!empty($entry)){
							echo '<div class="speech_info col-sm-6">';
							echo '<h2 class="text-white">'.ucfirst($entry['Speech Topic']).'</h2>';
							echo '<h3 class="mb-3">'.ucfirst($entry['Presenter Name']).'</h3>';
							echo '</div>';
						}
					?>
				</div>
			</div>
			
			<div class="card message hidden">
				<div class="card-header primary-bg">
					<div class="message_text"></div>
				</div>
				<div class="card-body">
					<div class="sub_message text-gray"></div>
					<!--<button class="btn btn-primary close_browser">Close Browser Tab</button>-->
				</div>
			</div> 

		<!--	<div class="message">
				<div class="message_text"></div>
				<div class="sub_message"></div>
				<button class="btn close_browser">Close Browser</button>
			</div> -->
			
			<div class="col-sm-12 main_content">
				<div class="row">
					<div id="YT_Player_Container">
						  <div id="player"></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<div id="crowd_image" class="container-fluid">
		<img src="images/Crowd.png">
	</div>
	</div>

	<div id="uco_logos" class="container-fluid">
		<img class="img-fluid" src="../img/logo/UCO_White.svg">
		<img class="img-fluid" src="../img/logo/IDEA_White.svg">
		<img class="img-fluid logo_lumina" src="logo/Lumina_horiz_white.svg">
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>
	<script src="js/view.js"></script>
	<script src="https://apis.google.com/js/api.js"></script>
	<?php echo '<script> var youtubeUrl = "'.$entry['Youtube URL'].'"; result.id = '.$_GET['id'].'; </script>' ?>
	<script>
		
		$(".big").click(function(){
			let label_ele = $(this).parent(".radio");
			let atr = $(label_ele).attr("for");
			let id = '#'+atr;
			$(id).prop('checked', true);
		});
		
		function getVideoId(youtubeUrl){
			
			let urlRx = new RegExp('(?:https?:\/\/)?(?:www\.)?((?:youtube\.com|youtu.be))(\/)(?:watch|embed)?(?:.*v=|v\/|\/)?([a-z|0-9|\_\-]+)?(\S+)?','i');
			let arr = youtubeUrl.match(urlRx);

			if(arr == null){
				return -1;
			}else{
				if(typeof arr[3] === 'undefined'){
					return -1;
				}
			}
			return arr[3];
		}
	
		
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "js/youtube_iframe_api.js";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '700',
          width: '100%',
          videoId: getVideoId(youtubeUrl),
		 // playerVars: {'controls': 0 },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
       // event.target.playVideo();
		 	viewSurvey();
		  	currentState = state.Start;
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1)
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {

        }
		if(event.data == YT.PlayerState.ENDED){
			viewSurvey();
		  	currentState = state.End;
		} 
		  
      }
	  function playVideo(){
		  player.playVideo();
	  }
	  function pausevideo(){
		  player.pauseVideo();
	  }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
</body>
</html>