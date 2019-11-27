<?php
	if(!isset($_SESSION["login"])){
		header("Location: index.php?page=login");
		die();
	}else{ ?>
		<script>
			alert("An error has occured. Please come back later");
			window.location = "index.php?page=home";
		</script>
<?php
	}
?>