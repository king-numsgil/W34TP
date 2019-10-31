<?php
session_start();

if (!isset($_GET["page"]) || empty($_GET["page"]) || !file_exists("pagez/" . $_GET["page"] . ".php")) {
	if (isset($_GET["page"]) == "logout") {
		session_unset();
		session_destroy();
	}
	//Renvoyer le user à la page Home en cas d'erreur ou de page manquante ou erronée
	header("Location:index.php?page=home");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Duplicants Not Included - Dupe Store W34</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom fonts for this template -->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
	      type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
	      rel='stylesheet' type='text/css'>

	<!-- Custom styles for this template -->
	<link href="assets/css/clean-blog.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand" href="index.php?page=home">Dupe Store</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
		        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
		        aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=home">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=shop">Shop</a>
				</li>

				<?php if (isset($_SESSION["login"])) { //Option dans le Menu si le user est loggé ?>

				<li class="nav-item">
					<a class="nav-link" href="index.php?page=logout">Log out</a>
				</li>
				<li class="nav-item">
					<a class="font-weight-light nav-link disabled">Logged as <?= $_SESSION["login"] ?></a>
				</li>

				<?php } else { //Options dans le menu si le user n'EST PAS loggé ?>

				<li class="nav-item">
					<a class="nav-link" href="index.php?page=login">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=register">Register</a>
				</li>

				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('aaaaaaaaaaaaaaaaaaah2.png')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="site-heading">
					<h1>Duplicants not Included</h1>
					<span class="subheading">Best Dupe Store Ever</span>
					<span class="subheading">(I mean, look at their faces!)</span>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Main Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-11 col-md-12 mx-auto">
			<?php
			include_once "pagez/" . $_GET["page"] . ".php";
			?>
		</div>
	</div>
</div>

<hr>

<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<ul class="list-inline text-center">
					<li class="list-inline-item">
						<a href="#">
							<span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
					<li class="list-inline-item">
						<a href="#">
			                <span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
			                </span>
						</a>
					</li>
					<li class="list-inline-item">
						<a href="#">
							<span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-github fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
				</ul>
				<p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
			</div>
		</div>
	</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="assets/js/clean-blog.js"></script>

</body>
</html>
