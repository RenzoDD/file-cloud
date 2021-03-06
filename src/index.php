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

if (str_starts_with(__ROUTE__, "/folder") === true)
{
    if (__ROUTE__ === "/folder/create")
    {
        $directories = new FolderController();
        $directories->CreateFolder();
        return;
    }
    else if (__ROUTE__ === "/folder/rename")
    {
        $directories = new FolderController();
        $directories->RenameFolder($_POST["id"],$_POST["name"]);
        return;
    }
    else if (__ROUTE__ === "/folder/visibility")
    {
        $directories = new FolderController();
        $directories->ChangeVisibility($_POST["id"],$_POST["visibility"]);
        return;
    }
    else if (str_starts_with(__ROUTE__, "/folder/delete") === true)
    {
        $directories = new FolderController();
        $directories->DeleteFolder();
        return;
    }
    else 
    {
        $directories = new FolderController();
        $directories->ShowFolder();
        return;
    }
}
else if (str_starts_with(__ROUTE__, "/file") === true)
{
    $files = new FileController();

    if (__ROUTE__ === "/file/upload")
    {
        $files->UploadFile();
        return;
    }
    else if (__ROUTE__ === "/file/rename")
    {
        $files->RenameFile();
        return;
    }
    else if (__ROUTE__ === "/file/visibility")
    {
        $files->ChangeVisibility();
        return;
    }
    else if (str_starts_with(__ROUTE__, "/file/delete") === true)
    {
        $files->DeleteFile();
        return;
    }
    else if (str_starts_with(__ROUTE__, "/file/download") === true)
    {
        $files->DownloadFile();
        return;
    }
    else
    {
        $files->ShowFile();
        return;
    }
}
else if (str_starts_with(__ROUTE__, "/login") === true)
{
    if (__ROUTE__ === "/login/check")
    {
        $users = new UserController();
        $users->CheckLogIn($_POST["username"], $_POST["password"]);
        return;
    }
    else
    {
        $users = new UserController();
        $users->LogIn();
        return;
    }
}
else if (str_starts_with(__ROUTE__, "/signup") === true)
{
    if (__ROUTE__ === "/signup/register")
    {
        $users = new UserController();
        $users->Register($_POST["email"],$_POST["username"], $_POST["password"]);
        return;
    }
    else
    {
        $users = new UserController();
        $users->SignUp();
        return;
    }
}
else if (__ROUTE__ === "/")
{
    header("Location: /login");
    return;
}
else
{
    $files = new FileController();
    $files->ShowFileIdentity();
    return;
}

?>