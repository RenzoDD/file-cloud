<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Folder controller
 */

require_once __MODEL__ . "/UserModel.php";
require_once __MODEL__ . "/FileModel.php";
require_once __MODEL__ . "/FolderModel.php";

class FileController
{
    public function ShowFile()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadToken($arg[2]);

        if ($file !== null)
        {
            if ($file->Visibility === "ALL" || (isset($_SESSION["UserID"]) && $file->UserID == $_SESSION["UserID"]))
            {
                $_SESSION["FileID"] = $file->FileID;

                $folder = new FolderModel();
                $folder = $folder->ReadFolderID($file->FolderID);
                
                $childs = $folder->ReadChilds($folder->FolderID);
                $ancestors = $folder->ReadAncestors($folder->FolderID);
                
                $user = new UserModel();
                $user = $user->ReadUserID($file->UserID);
                
                require __VIEW__ . "/file.php";
                return;
            }
        }
        
        require __VIEW__ . "/deny-file.php";
        return;
    }
    public function ShowFileIdentity()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadIdentity($arg[1]);

        if ($file !== null)
        {
            if ($file->Visibility === "ALL" || (isset($_SESSION["UserID"]) && $file->UserID == $_SESSION["UserID"]))
            {
                $_SESSION["FileID"] = $file->FileID;

                $folder = new FolderModel();
                $folder = $folder->ReadFolderID($file->FolderID);
                
                $childs = $folder->ReadChilds($folder->FolderID);
                $ancestors = $folder->ReadAncestors($folder->FolderID);
                
                $user = new UserModel();
                $user = $user->ReadUserID($file->UserID);
                
                require __VIEW__ . "/file.php";
                return;
            }
        }
        
        require __VIEW__ . "/deny-file.php";
        return;
    }
    public function DownloadFile()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadToken($arg[3]);
        
        $path = __FILES__ . "/" . $file->Token;
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$file->Name.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        ob_clean();
        readfile($path);
        exit;
    }
    public function ChangeVisibility()
    {
        $file = new FileModel();
        $file = $file->ReadFileID($_SESSION["FileID"]);
        if ($file->ModifyVisibility($_SESSION["FileID"], $_GET["visibility"]))
        {
            header("Location: /file/$file->Token/visibility/done");
        }
        else
            header("Location: /file/$file->Token/visibility/fail");
    }
    public function RenameFile()
    {
        $file = new FileModel();
        $file = $file->ReadFileID($_SESSION["FileID"]);
        if ($file->ModifyName($_SESSION["FileID"], $_POST["name"]))
        {
            header("Location: /file/$file->Token/rename/done");
        }
        else
            header("Location: /file/$file->Token/rename/fail");
    }
    public function UploadFile()
    {
        
        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($_SESSION["FolderID"]);
        
        if (isset($_SESSION["UserID"]) && $_SESSION["UserID"] === $folder->UserID)
        {
            $user = new UserModel();
            $user = $user->ReadUserID($_SESSION["UserID"]);

            $totalSpace = $user->MaxSize;

            
            $file = new FileModel();
            $totalUsed = $file->ReadSpaceUsed($_SESSION["UserID"]);
            

            if ($_FILES['FilePath']['size'] + $totalUsed <= $totalSpace)
            {
                if ($file->Create($_SESSION["UserID"],$_SESSION["FolderID"],$_FILES['FilePath']['name'],$_FILES['FilePath']['size'],"ME"))
                {
                    copy($_FILES['FilePath']['tmp_name'], __FILES__ . "/" . $file->Token);
                    header("Location: /folder/$folder->Token/file/done");
                }
                else
                    header("Location: /folder/$folder->Token/file/fail");
            }
            else
                header("Location: /folder/$folder->Token/file/exceeded");
        }
        else
            header("Location: /login");
    }
    public function DeleteFile()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadToken($arg[3]);
        
        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($file->FolderID);
        
        if (unlink(__FILES__ . "/" . $file->Token))
        {
            if ($file->DeleteID($file->FileID))
                header("Location: /folder/$folder->Token/file/delete/done");
            else
                header("Location: /folder/$folder->Token/file/delete/db/fail");
        }
        else
        {
            header("Location: /folder/$folder->Token/file/delete/sys/fail");
        }
        
    }
}
