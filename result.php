<?php
require_once '../../Google/google-api-php-client-2.2.0/vendor/autoload.php';

require_once 'config.php';

require_once 'dataHandler.php';

require_once 'perpareResults.php';

header('Content-Type: text/html; charset=utf-8');

try{
	if(!isset($_GET['id'])){
		throw new Exception("Resource Id Required.");
	}else{
		$id = $_GET['id'];
		$results = getAllResultData();
		$resource = getEntryData($id)[0];
		prepareResults($resource,$results,$id);
	}
	
}catch(Exception $e){
	echo $e->getMessage();
	die();
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Persuasive Speech</title>
	
<?php include "head.php" ?>
<style>
	html,body{
		height: 100%;
		margin: 0;
	}
	.wrapper{
		min-height: 100%;
		margin: 0 auto;
	}
	#heading{
		text-align: left;
	}
	#heading h1{
		padding: 0rem;
		margin-bottom: 0px;
	}
	#logo, .speech_info{
		display: inline-block;
	}
	#logo img{
		width: 10rem;
	}
	.speech_info{
		/*margin-left: 2rem;*/
		font-weight: 400;
		padding-top: 3rem;
	}
	.speech_info h3{
		font-weight: 400;
	}
	.card{
		border:none;
	}
	/*.card-header{
		background-color: #ff7676e0;
	}
	.card-body{
		color: #3b3b3b;	
	}*/
	.card{
		text-align:center;
	}
	.btn-link{
		color:#fff;	
	}
	.btn-link:hover{
		color: #fff;
	}

</style>
</head>

<body>
	<div class="wrapper">
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-sm-12" id="heading">
					<div class="row">
						<div class="col-sm-6" id="logo">
							<img src="logo/PS_Logo_Large.svg" class="img-fluid">
							<div class="inline-flex primary-color">
								<h2>PERSUASIVE <br> SPEECH</h2>
							</div>
						</div>
						<?php 
							if(!empty($resource)){
								echo '<div class="speech_info col-sm-6">';
								echo '<h2 class="text-black">'.ucfirst($resource['Speech Topic']).'</h2>';
								echo '<h3 class="mb-3">'.ucfirst($resource['Presenter Name']).'</h3>';
								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container pb-2">
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header primary-bg">
						<h3>Audience Responses</h3>
					</div>
					<div class="card-body">
							<h4><?php echo $no_of_responses?></h4>
					</div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div id="accordion2">
				  <div class="card">
					<div class="card-header primary-bg" id="headingTwo">
					  <h5 class="mb-0">
						<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						  <h3>Opinions Changed</h3>
						</button>
					  </h5>
					</div>
					
					  
					<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
					  <div class="card-body">
						  <?php
							echo '<div class="row">
											<div class="col-sm-6">
												<p>Improved</p>
											</div>
											<div class="col-sm-6">
												<p class="primary-color">'.$persuaded.'</p>
											</div>
								</div>
								<div class="row">
											<div class="col-sm-6">
												<p>Unchanged</p>
											</div>
											<div class="col-sm-6">
												<p class="primary-color">'.$impartial.'</p>
											</div>
								</div>
								<div class="row">
											<div class="col-sm-6">
												<p>Worsened</p>
											</div>
											<div class="col-sm-6">
												<p class="primary-color">'.$dissuaded.'</p>
											</div>
								</div>
								';
						  ?>
					</div>  
					  
				   </div>
				</div>
			</div>
		</div>
			
				
		<div class="col-sm-12 mt-5">
			<div class="row">
				<!--<div class="col-sm-12">
					<div class="video_url"><h4 class="">Video URL: <span class="light_weight"><?php echo $resource['Youtube URL']?></span></h4></div>
				</div>-->
				<div class="col-sm-6">
					<div id="YT_Player_Container">
						<div id="player">
						</div>
					</div>
				</div>
				
				<div class="col-sm-6">
				<div id="accordion">
				  <div class="card">
					<div class="card-header primary-bg" id="headingOne">
					  <h5 class="mb-0">
						<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						  <h3>Individual Responses</h3>
						</button>
					  </h5>
					</div>
					
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					  <div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<h6 class="primary-color">Before</h6>
							</div>
							<div class="col-sm-6">
								<h6 class="primary-color">After</h6>
							</div>
						</div>
							<?php
								foreach($total_results as $res){
									$resJSON = json_decode($res['rating'],true);
									echo '<div class="row">
											<div class="col-sm-6">
												<p>'.$resJSON['start']['degreeOfPersuation'].'</p>
											</div>
											<div class="col-sm-6">
												<p>'.$resJSON['end']['degreeOfPersuation'].'</p>
											</div>
										</div>';
								}
							?>
					  </div>
					</div>  
					  
				   </div>
				</div>

			</div>

				<div class="col-sm-12 mt-3 mb-3">
						<div class="card">
							<div class="card-header primary-bg">
								<h3>Audience View  URL</h3>
							</div>
							<div class="card-body">
								<h5><i class="fa fa-users mr-3 primary-color" aria-hidden="true"></i><a class="text-gray" href=<?php echo $home."view.php?id=".$id; ?> target="_blank"> <?php echo $home."view.php?id=".$id; ?> </a></h5>
							</div>
						</div>
				</div>
				
				<div class="col-sm-12 mt-3 mb-3">
						<div class="card">
							<div class="card-header primary-bg">
								<h3>Original Video URL</h3>
							</div>
							<div class="card-body">
								<h5><i class="fa fa-link mr-3 primary-color" aria-hidden="true"></i><a class="text-gray" href=<?php echo $resource['Youtube URL']?> target="_blank"> <?php echo $resource['Youtube URL']?> </a></h5>
							</div>
						</div>
				</div>

			</div>
			
		</div>	
	</div>
	</div>
	</div>
	<div class="conatiner-fluid">
			<?php include "footer.php" ?>
	</div>
	
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
<script src="https://apis.google.com/js/api.js"></script>
<?php echo '<script> var youtubeUrl = "'.$resource['Youtube URL'].'"</script>' ?>
<script>
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
		 
	 var tag = document.createElement('script');

      tag.src = "js/youtube_iframe_api.js";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '500',
          width: '100%',
          videoId: getVideoId(youtubeUrl),
		 /* playerVars: {'controls': 0 },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }*/
        });
      }
</script>
</body>
</html>