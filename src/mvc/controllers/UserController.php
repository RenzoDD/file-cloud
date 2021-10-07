<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * User controller
 */

require_once __MODEL__ . "/FolderModel.php";
require_once __MODEL__ . "/UserModel.php";

class UserController
{
    public function LogIn()
    {
        unset($_SESSION["UserID"]);
        require __VIEW__ . "/login.php";
    }
    public function SignUp()
    {
        unset($_SESSION["UserID"]);
        require __VIEW__ . "/signup.php";
    }
    public function CheckLogIn($username, $password)
    {
        $user = new UserModel();
        $user = $user->ReadUsernamePassword($username, $password);
        if ($user !== null)
        {
            $folder = new FolderModel();
            $folder = $folder->ReadUserRoot($user->UserID);

            $_SESSION["UserID"] = $user->UserID;
            $_SESSION["FolderID"] = $folder->FolderID;
            header("Location: /folder/$folder->Token");
        }
        else
        {
            header("Location: /login");
        }
    }
    public function Register($email, $username, $password)
    {
        $user = new UserModel();
        if ($user->Create($email, $username, $password, 1024))
        {
            $folder = new FolderModel();
            if ($folder->Create($user->UserID,null,$user->Username,"ME"))
            {
                $_SESSION["UserID"] = $user->UserID;
                $_SESSION["FolderID"] = $folder->FolderID;
                header("Location: /folder/$folder->Token");
                return;
            }
            else
            {
                header("Location: /signup/folder/error");
                return;
            }
        }
        else
        {
            header("Location: /signup/db/error");
            return;
        }
    }
}
?>