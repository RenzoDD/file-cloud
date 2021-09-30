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
				<h1 class="text-center"> <?php echo $file->Name; ?></h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<?php
						foreach ($ancestors as $f) {
							if ($f->ParentID === null)
								$icon = '<i class="bi bi-house-door-fill"></i>';
							else
								$icon = '<i class="bi bi-archive"></i>';

							echo "
                                    <li class='breadcrumb-item'><a href='/folder/$f->Token'>$icon $f->Name</a></li>
                                ";
						}
						?>
						<li class='breadcrumb-item'><a href='/folder/<?php echo $folder->Token; ?>'><i class="bi bi-archive-fill"></i> <?php echo $folder->Name; ?></a></li>
						<li class="breadcrumb-item active"><i class="bi bi-file-earmark-text-fill"></i> <?php echo $file->Name; ?></li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-6">
				<table class="table table-bordered mb-4">
					<thead>
						<tr>
							<th colspan="2" class="text-center">File details</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Name: </th>
							<td><?php echo $file->Name; ?></td>
						</tr>
						<tr>
							<th scope="row">Owner: </th>
							<td><?php echo $user->Username; ?></td>
						</tr>
						<tr>
							<th scope="row">Upload Time: </th>
							<td><?php echo $file->UploadDate; ?></td>
						</tr>
						<tr>
							<th scope="row">Visibility: </th>
							<td><?php echo ($file->Visibility === "ALL") ? "Everyone" : "Just me"; ?></td>
						</tr>
					</tbody>
				</table>
				<div class="text-center">
					<a class="btn btn-success btn-sm" href="/file/download/<?php echo $file->Token ?>"><i class="bi bi-download"></i> Download</a>
					<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#rename"><i class="bi bi-type"></i> Rename</button>
					<button class="btn btn-primary btn-sm" type="button"><i class="bi bi-share-fill"></i> Share</button>
					<a class="btn btn-danger btn-sm" href="/file/delete/<?php echo $file->Token ?>"><i class="bi bi-trash"></i> Delete</a>
				</div>
			</div>
		</div>
	</main>

	<?php require __VIEW__ . "/.parts/page/footer.php"; ?>
	<?php require __VIEW__ . "/.parts/modal/renameFile.php"; ?>

	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/bootstrap.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>