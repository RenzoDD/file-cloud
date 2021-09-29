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
	            <h1 class="text-center"> <?php echo $folder->Name; ?></h1>
	            <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        
                        <?php
                            foreach ($ancestors as $f)
                            {
                                if ($f->ParentID === null)
                                    $icon = '<i class="bi bi-house-door-fill"></i>';
                                else
                                    $icon = '<i class="bi bi-archive"></i>';
                                    
                                echo "
                                    <li class='breadcrumb-item'><a href='/folder/$f->Token'>$icon $f->Name</a></li>
                                ";
                            }
                      
                        ?>
                        <li class="breadcrumb-item active"><i class="bi bi-archive-fill"></i> <?php echo $folder->Name; ?></li>
                    </ol>
                </nav>
	        </div>
	    </div>
	    <div class="row justify-content-center">
	        <div class="col-9">
	            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($childs as $f)
                            {
                                echo "
                                    <tr>
                                        <td>
                                            <i class='bi bi-folder-fill'></i>
                                        </td>
                                        <td>$f->Name</td>
                                        <td>$f->CreateDate</td>
                                        <td>
                                            <button type='button' class='btn btn-sm' onclick='ExploreFolder(`$f->Token`)'><i class='bi bi-search'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-share'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-type'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-arrows-move'></i></button>
                                            <button type='button' class='btn btn-sm' onclick='DeleteFolder($f->FolderID)'><i class='bi bi-trash'></i></button>
                                        </td>
                                    </tr>
                                ";
                            }
                            foreach ($files as $f)
                            {
                                echo "
                                    <tr>
                                        <td>
                                            <i class='bi bi-file-earmark-text-fill'></i>
                                        </td>
                                        <td>$f->Name</td>
                                        <td>$f->UploadDate</td>
                                        <td>
                                            <button type='button' class='btn btn-sm' onclick='DownloadFile(`$f->Token`)'><i class='bi bi-download'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-share'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-type'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-arrows-move'></i></button>
                                            <button type='button' class='btn btn-sm'><i class='bi bi-trash' onclick='DeleteFile($f->FileID)'></i></button>
                                        </td>
                                    </tr>
                                ";
                            }
                      
                        ?>
                    </tbody>
                </table>
                <script>
                    function DownloadFile(token)
                    {
                        window.location = "/file/" + token;
                    }
                    function ExploreFolder(token)
                    {
                        window.location = "/folder/" + token;
                    }
                    function DeleteFolder(id)
                    {
                        window.location = "/folder/delete/" + id;
                    }
                    function DeleteFile(id)
                    {
                        window.location = "/file/delete/" + id;
                    }
                </script>
                <div class="text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFolder">
                        <i class="bi bi-folder-plus"></i> Add folder
                    </button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFile">
                        <i class="bi bi-upload"></i> Upload file
                    </button>
                </div>
	        </div>
	    </div>
	</main>
	
	<?php require __VIEW__ . "/.parts/page/footer.php"; ?>
	
	<?php require __VIEW__ . "/.parts/modal/addFolder.php"; ?>
	<?php require __VIEW__ . "/.parts/modal/addFile.php"; ?>

	<script src="/assets/js/jquery.js"></script>
	<script src="/assets/js/bootstrap.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>