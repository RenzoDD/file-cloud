<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Folder controller
 */

require_once __MODEL__ . "/FileModel.php";
require_once __MODEL__ . "/FolderModel.php";

class FolderController
{
    public function ShowFolder()
    {
        $arg = explode("/", __ROUTE__);

        $folder = new FolderModel();
        $folder = $folder->ReadToken($arg[2]);

        if ($folder !== null)
        {
            if ($folder->Visibility === "ALL" || (isset($_SESSION["UserID"]) && $folder->UserID == $_SESSION["UserID"]))
            {
                $childs = $folder->ReadChilds($folder->FolderID);
                $ancestors = $folder->ReadAncestors($folder->FolderID);

                $file = new FileModel();
                $files = $file->ReadFolder($folder->FolderID);

                $_SESSION["FolderID"] = $folder->FolderID;

                require __VIEW__ . "/folder.php";
                return;
            }
        }

        require __VIEW__ . "/deny-folder.php";
        return;
    }
    public function CreateFolder()
    {
        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($_SESSION["FolderID"]);

        
        if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] == $folder->UserID)
        {
            $folder->Create($_SESSION["UserID"], $_SESSION["FolderID"], $_POST["FolderName"], "ME");

            $folder = $folder->ReadFolderID($_SESSION["FolderID"]);

            header("Location: /folder/$folder->Token");
            
        }
        else
            header("Location: /login");
    }
    public function RenameFolder($FolderID, $Name)
    {

        $modify = new FolderModel();
        $folder = $modify->ReadFolderID($_SESSION["FolderID"]);

        if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] == $folder->UserID)
        {
            if ($modify->ModifyName($FolderID, $Name))
                header("Location: /folder/$folder->Token/rename/done");
            else
                header("Location: /folder/$folder->Token/rename/fail");
        }
        else
            header("Location: /login");
    }
    public function DeleteFolder()
    {
        $arg = explode("/", __ROUTE__);

        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($_SESSION["FolderID"]);

        
        if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] == $folder->UserID)
        {
            if ($folder->DeleteID($arg[3]))
                header("Location: /folder/$folder->Token/delete/done");
            else
                header("Location: /folder/$folder->Token/delete/fail");
        }
        else
            header("Location: /login");
    }
}
