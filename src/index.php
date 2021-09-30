<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Home page
 */

require __DIR__ . "/utilities.php";
session_start();

require_once __CONTROLLER__ . "/FolderController.php";
require_once __CONTROLLER__ . "/FileController.php";
require_once __CONTROLLER__ . "/UserController.php";

if (isset($_SESSION["UserID"]) === false && str_starts_with(__ROUTE__, "/login") === false)
{
    header("Location: /login");
    return;
}

if (str_starts_with(__ROUTE__, "/folder") === true)
{
    if (__ROUTE__ === "/folder/create")
    {
        $directories = new FolderController();
        $directories->CreateFolder();
    }
    else if (str_starts_with(__ROUTE__, "/folder/delete") === true)
    {
        $directories = new FolderController();
        $directories->DeleteFolder();
    }
    else 
    {
        $directories = new FolderController();
        $directories->ShowFolder();
    }
}
else if (str_starts_with(__ROUTE__, "/file") === true)
{
    $files = new FileController();

    if (__ROUTE__ === "/file/upload")
    {
        $files->UploadFile();
    }
    else if (__ROUTE__ === "/file/rename")
    {
        $files->RenameFile();
    }
    else if (__ROUTE__ === "/file/visibility")
    {
        $files->ChangeVisibility();
    }
    else if (str_starts_with(__ROUTE__, "/file/delete") === true)
    {
        $files->DeleteFile();
    }
    else if (str_starts_with(__ROUTE__, "/file/download") === true)
    {
        $files->DownloadFile();
    }
    else
    {
        $files->ShowFile();
    }
}
else if (str_starts_with(__ROUTE__, "/login") === true)
{
    if (__ROUTE__ === "/login/check")
    {
        $users = new UserController();
        $users->CheckLogIn();
    }
    else
    {
        $users = new UserController();
        $users->LogIn();
    }
}
else
{
    header("Location: /login");
    return;
}

?>