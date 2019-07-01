<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"></meta>
<title><?php echo $pagetitle; ?></title>
<link rel="stylesheet" type="text/css" href="./theme.css"></link>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="script/main.js"></script>
</head>
<body>
	<header>
		<?php
		require (File::build_path(array('view','media','nav.php')))?>
	</header>
		<?php
		$filepath = File::build_path(array("view",$controller,"$view.php"));
		require_once $filepath;
		?>		
	<footer>
	<?php require File::build_path(array('view', 'global', 'footer.php'))?>
	</footer>
</body>
</html>
