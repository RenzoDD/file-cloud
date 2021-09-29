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
    if (__ROUTE__ === "/file/upload")
    {
        $files = new FileController();
        $files->UploadFile();
    }
    else if (str_starts_with(__ROUTE__, "/file/delete") === true)
    {
        $files = new FileController();
        $files->DeleteFile();
    }
    else
    {
        $files = new FileController();
        $files->DownloadFile();
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