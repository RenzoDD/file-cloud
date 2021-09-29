<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Folder controller
 */

require_once __MODEL__ . "/FileModel.php";
require_once __MODEL__ . "/FolderModel.php";

class FileController
{
    public function DownloadFile()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadToken($arg[2]);
        
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
    public function UploadFile()
    {
        $file = new FileModel();
        
        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($_SESSION["FolderID"]);
        
        if ($file->Create($_SESSION["UserID"],$_SESSION["FolderID"],$_FILES['FilePath']['name'],"ME"))
        {
            copy($_FILES['FilePath']['tmp_name'], __FILES__ . "/" . $file->Token);
            header("Location: /folder/$folder->Token/file/done");
        }
        else
            header("Location: /folder/$folder->Token/file/fail");
    }
    public function DeleteFile()
    {
        $arg = explode("/", __ROUTE__);
        
        $file = new FileModel();
        $file = $file->ReadFileID($arg[3]);
        
        $folder = new FolderModel();
        $folder = $folder->ReadFolderID($_SESSION["FolderID"]);
        
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
?>