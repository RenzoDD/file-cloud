<!doctype html>
<html lang="en" class="h-100" prefix="og: http://ogp.me/ns#">

<head>
	<?php
	echo MetaHeaders("File storage", "Easy, fast and save");
	?>

	<link href="/assets/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/css/bootstrap-icons.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">

	<link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico" />
	<title>File Storage</title>
</head>

<body class="d-flex flex-column h-100">
	<?php require __VIEW__ . "/.parts/page/header.php"; ?>

	<main class="container my-5">
		<div class="row">
			<div class="col-12">
				<h1 class="text-center mb-3"><i class="bi bi-x-octagon-fill"></i></h1>
                <?php if ($file === null): ?>
				    <h1 class="text-center mb-3">This file doesn't exist</h1>
                <?php else : ?>
                    <h1 class="text-center mb-3">You don't have access to this file</h1>
                <?php endif ?>
			</div>
		</div>
	</main>

	<?php require __VIEW__ . "/.parts/page/footer.php"; ?>

	<?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $file->UserID) : ?>
		<?php require __VIEW__ . "/.parts/modal/renameFile.php"; ?>
		<?php require __VIEW__ . "/.parts/modal/visibilityFile.php"; ?>
	<?php endif ?>

	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/bootstrap.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>