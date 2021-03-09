<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Persuasive Speech</title>
	
<?php include "head.php" ?>
<style>
.main_content{
	text-align: left;
}
</style>
</head>

<?php 
	include "postEntry.php";
?>

	
<body>
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<?php include 'header.php' ?>

			<?php
			if(!empty($errors)){
				echo '<div class="col-sm-12 error_message">
					<ul>';
				foreach($errors as $err){
					echo '<li>'.$err.'</li>';
				}
				echo '</ul>
				</div>';
			}
			?>
			</div>
		</div>
	</div>

	<div class="container pb-2">
		<div class="row">
			<div class="col-sm-12 main_content mt-4">
				<div class="row">
					<h3>Generate Presentation Links</h3>
					<form method="post" action="createEntry.php">
						<div class="row mt-3">
						<div class="col-sm-6 input">
							<p class="label">Presenter Name*</p>
							<p class="small_text text-bold"></p>
							<input type="text" id="PresenterName" name="PresenterName" placeholder="First and Last Name" class="form-control" required/>
						</div>
						
						<div class="col-sm-6 input">
							<p class="label">Persuasive Speech Topic*</p>
							<p class="small_text text-bold"></p>
							<input type="text" id="SpeechTopic" name="SpeechTopic" placeholder="Speech Topic" class="form-control" required/>
						</div>
						
						<div class="col-sm-12 input">
							<p class="label">Enter Youtube URL*</p>
							<p class="small_text text-bold"></p>
							<input type="text" id="VideoURL" name="VideoURL" placeholder="Example: https://youtube.com" class="form-control" required/>
						</div>
						<div class="col-sm-12 input">
							<button id="generateUrls" type="submit" class="btn btn-primary">Generate URLs</button>
						</div>
						</div>
					</form>
					
						<?php
							if(!empty($urls)){
								echo
									'<div class="col-sm-12 url_container mb-3">
										<h4 class="text-black">Your URLs</h4>
										<h4 class="primary-color">Save these URLs now.<span class="text-lighter text-gray"> These URLs will not be listed again.</span></h4>
										<h5 class="text-black text-bold">Audience View <span class="text-gray text-lighter">will be used by your audience member to view and record their opinions on your presentation.</span></h5>
										<h5 class="text-black text-bold">Presenter View <span class="text-gray text-lighter">is for you to monitor audience responses.</span></h5>

										<div class="card mb-3 mt-3">
											<div class="card-header primary-bg">
												<h2>Audience View</h2>
											</div>
											<div class="card-body">
												<h5><i class="fa fa-users mr-3 primary-color" aria-hidden="true"></i><a class="text-gray" href="'.$urls['viewUrl'].'" target="_blank">'.$urls['viewUrl'].'</a></h5>
											</div>
										</div>

										<div class="card mb-3">
											<div class="card-header primary-bg">
												<h2>Presenter View</h2>
											</div>
											<div class="card-body">
												<h5><i class="fa fa-bar-chart mr-3 primary-color" aria-hidden="true"></i><a class="text-gray" href="'.$urls['resultUrl'].'" target="_blank">'.$urls['resultUrl'].'</a></h5>
											</div>
										</div>

									</div>';
							}
						?>
					
				</div>
			
			
		</div>
	</div>
	</div>
	
    <div class="container-fluid">
		<div class="row">
			<?php include 'footer.php' ?>
		</div>
	</div>

	<?php include '../../includes/tracking.php' ?>
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="js/config.js"></script>
	<script src="js/createEntry.js"></script>
</body>
</html>