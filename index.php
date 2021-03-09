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
.card{
	border-radius: 1rem;
	font-weight: bold;
}
.card-header:first-child{
	border-radius: 1rem 1rem 0px 0px;
}

</style>
</style>
</head>

<body>
	<div class="wrapper">
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<?php include 'header.php' ?>
			</div>
		</div>
	</div>	
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 main_content">
				<div class="row">
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header primary-bg text-white">
								<h2>Presenter</h2>
							</div>
							<div class="card-body mt-1">
								<a type="button" href="instructions/Persuasive Speech Instructions.pdf" target="_blank" class="btn btn-primary-outline">Instructions</a>
								<a type="button" href="createEntry.php" class="btn btn-primary">Get Started</a>
								<p class="text-black mt-3">Already created your URLs?</p>
								<p class="text-lighter">Enter the presenter view link you were given into your browser address bar.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header primary-bg text-white">
								<h2>Audience</h2>
							</div>
							<div class="card-body mt-1">
								<p class="text-lighter">View presentations by entering the URLs shared with you by the instructor or the presenter into the address bar.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	</div> <!--  wrapper -->

	<div class="container-fluid">
		<div class="row">
			<?php include 'footer.php' ?>
		</div>
	</div>
	
</body>
</html>