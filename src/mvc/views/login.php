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

	<main class="container my-3">
	    <div class="row">
	        <div class="col-12">
	            <h1 class="text-center">Log In</h1>
	        </div>
	    </div>
	    <div class="row justify-content-center">
	        <div class="col-5">
	            <form method="post" action="/login/check">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-door-open-fill"></i> Log In</button>
                    </div>
                </form>
	        </div>
	    </div>
	</main>
	
	<?php require __VIEW__ . "/.parts/page/footer.php"; ?>

	<script src="/assets/js/jquery.css"></script>
	<script src="/assets/js/bootstrap.css"></script>
	<script src="/assets/js/main.css"></script>
</body>

</html>