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
    public function CheckLogIn($username, $password)
    {
        $user = new UserModel();
        $user = $user->ReadUsernamePassword($username, $password);
        if ($user !== null)
        {
            $folder = new FolderModel();
            $folder = $folder->ReadUserRoot($user->UserID);

            $_SESSION["UserID"] = $user->UserID;
            header("Location: /folder/$folder->Token");
        }
        else
        {
            header("Location: /login");
        }
    }
}
?>