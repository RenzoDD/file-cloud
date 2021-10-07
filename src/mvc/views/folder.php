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
                <h1 class="text-center mb-3"><i class="bi bi-<?php echo $folder->ParentID === null ? "house-door-fill" : "archive-fill" ?>"></i></h1>
                <h1 class="text-center mb-3"> <?php echo $folder->Name; ?></h1>

                <?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID) : ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <?php foreach ($ancestors as $f) : ?>
                                <li class="breadcrumb-item"><a href="/folder/<?php echo $f->Token ?>"><i class="bi bi-<?php echo $f->ParentID === null ? "house-door-fill" : "archive" ?>"></i> <?php echo $f->Name ?></a></li>
                            <?php endforeach ?>
                            <li class="breadcrumb-item active"><i class="bi bi-<?php echo $folder->ParentID === null ? "house-door-fill" : "archive-fill" ?>"></i> <?php echo $folder->Name ?></li>
                        </ol>
                    </nav>
                <?php endif ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-9">
                <?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID) : ?>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $spaceUsed ?>%;"><?php echo $spaceUsed ?>%</div>
                    </div>
                <?php endif ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"><i class="bi bi-shield-lock"></i></th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($childs as $f) : ?>
                            <?php if ($f->Visibility === "ALL" || (isset($_SESSION["UserID"]) && $f->UserID == $_SESSION["UserID"])) : ?>
                                <tr>
                                    <td><i class="bi bi-folder-fill"></i></td>
                                    <td><i class="bi bi-<?php echo $f->Visibility === "ALL" ? "unlock" : "lock-fill" ?>"></i></td>
                                    <td><?php echo $f->Name ?></td>
                                    <td><?php echo $f->CreateDate ?></td>
                                    <td>
                                        <a type="button" class="btn btn-sm" href="/folder/<?php echo $f->Token ?>"><i class="bi bi-search"></i></a>
                                        <?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID) : ?>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" onclick="VisibilityFolder(<?php echo $f->FolderID ?>, '<?php echo $f->Visibility ?>')" data-bs-target="#folderVisibility"><i class="bi bi-share"></i></button>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" onclick="RenameFolder(<?php echo $f->FolderID ?>, '<?php echo $f->Name ?>')" data-bs-target="#folderRename"><i class="bi bi-type"></i></button>
                                            <a type="button" class="btn btn-sm" href="/folder/delete/<?php echo $f->FolderID ?>"><i class="bi bi-trash"></i></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>

                        <?php foreach ($files as $f) : ?>
                            <?php if ($f->Visibility === "ALL" || (isset($_SESSION["UserID"]) && $f->UserID == $_SESSION["UserID"])) : ?>
                                <tr>
                                    <td><i class="bi bi-file-earmark-text-fill"></i></td>
                                    <td><i class="bi bi-<?php echo $f->Visibility === "ALL" ? "unlock" : "lock-fill" ?>"></i></td>
                                    <td><?php echo $f->Name ?></td>
                                    <td><?php echo $f->UploadDate ?></td>
                                    <td>
                                        <a type="button" class="btn btn-sm" href="/file/<?php echo $f->Token ?>"><i class="bi bi-search"></i></a>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID) : ?>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFolder">
                            <i class="bi bi-folder-plus"></i> Add folder
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFile">
                            <i class="bi bi-upload"></i> Upload file
                        </button>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </main>

    <?php require __VIEW__ . "/.parts/page/footer.php"; ?>

    <?php if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID) : ?>
        <?php require __VIEW__ . "/.parts/modal/addFolder.php"; ?>
        <?php require __VIEW__ . "/.parts/modal/addFile.php"; ?>

        <?php require __VIEW__ . "/.parts/modal/folderVisibility.php"; ?>
        <?php require __VIEW__ . "/.parts/modal/folderRename.php"; ?>
    <?php endif ?>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>