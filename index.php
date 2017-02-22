<?php require_once '_app/vendors/steamauth/steamauth.php'; ?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Jackpot</title>

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/cs.css">
	<link rel="stylesheet" href="assets/css/components.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.css">
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<img src="assets/img/500logo.png" class="img-responsive centered" alt="Logo">
				</div>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container">
				<ul class="nav navbar-nav navbar-left">
					<li class="active">
						<a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> HOW TO PLAY</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-trophy" aria-hidden="true"></i> FAIR</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> SUPPORT</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (!isset($_SESSION['steamid'])):
							echo '<li class="login">';
							loginbutton();
							echo '</li>';
						else:
							require_once '_app/vendors/steamauth/userInfo.php';
						endif;
					?>

					<li class="dropdown logout" style="display: none;">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
								<img src="" class="img-responsive img-rounded pull-left avatar" width="24" style="margin-right: 3px;"/> <span id="name"></span> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
							</span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#" id="profile"><i class="fa fa-gear" aria-hidden="true"></i> PROFILE</a></li>
							<li><a href="#" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<div>
		<audio src="assets/sounds/gun-sound.mp3" id="gun-sound"></audio>
	</div>

	<main class="container">
		<div class="content-area">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">LAST WINNER</div>
						<div class="panel-body">
								<!---->
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">JACKPOT</div>
						<div class="panel-body">

							<!---->

						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">LAST WINNER</div>
						<div class="panel-body">
							<!---->
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<div class="container container-publi-area">
		<div class="publi-area">
			<div class="publi">
				<img src="http://www.enaindia.in/themes/frontend/images/728.png">
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>2017 © <?= "CSGOForms" ?> - All rights reserved.</p>
		</div>
	</footer>

	<div class="modal fade animated bounceInLeft" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">EXAMPLE</h4>
				</div>
				<div class="modal-body">
					<p>A EXAMPLE HERE&hellip;</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">A EXAMPLE BUTTON</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.js"></script>
</body>
</html>