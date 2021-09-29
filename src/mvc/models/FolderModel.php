<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Folder class
 */

require_once __DIR__.'/DataBase.php';

class FolderModel extends DataBase
{
    public $FolderID;

    public $UserID;
    public $ParentID;

    public $Name;
    public $Token;
    public $CreateDate;
    public $Visibility;
    
	private function FillData($destino, $origen)
	{
		if (isset($origen['FolderID']))
			$destino->FolderID = $origen['FolderID'];

		if (isset($origen['UserID']))
			$destino->UserID = $origen['UserID'];
			
		if (isset($origen['ParentID']))  
			$destino->ParentID = $origen['ParentID'];
		
		if (isset($origen['Name']))  
			$destino->Name = $origen['Name'];
			
		if (isset($origen['Token']))
			$destino->Token = $origen['Token'];

		if (isset($origen['CreateDate']))
			$destino->CreateDate = $origen['CreateDate'];
			
		if (isset($origen['Visibility']))  
			$destino->Visibility = $origen['Visibility'];
	}

	public function Create($UserID,$ParentID,$Name,$Visibility)
	{
		try
		{
			$query = $this->db->prepare("CALL Folders_Create(:UserID,:ParentID,:Name,:Visibility)");
			$query->bindParam(":UserID"    , $UserID    , PDO::PARAM_INT);
			$query->bindParam(":ParentID"  , $ParentID  , PDO::PARAM_INT);
			$query->bindParam(":Name"      , $Name      , PDO::PARAM_STR);
			$query->bindParam(":Visibility", $Visibility, PDO::PARAM_STR);
			
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; }
	}

	public function ReadToken($Token)
	{
		try
		{
			$query = $this->db->prepare("CALL Folders_Read_Token(:Token)");
			$query->bindParam(":Token", $Token, PDO::PARAM_STR);
			
			if (!$query->execute())
				return null;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return null;
			
			$obj = new FolderModel();
			$obj->FillData($obj, $result[0]);
			
			return $obj;
		}
		catch (Exception $e)
		{ return null; }
	}

    public function ReadChilds($FolderID)
    {
        try
        {
            $query = $this->db->prepare("CALL Folders_Read_Childs(:FolderID)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
            
            if (!$query->execute())
                return [];
                
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $A = [];
            foreach ($result as $row)
            {
                $obj = new FolderModel();
                $obj->FillData($obj, $row);
                $A[$obj->FolderID] = $obj;
            }

            return $A;
        }
        catch (Exception $e)
        { return []; }
    }

	public function ReadFolderID($FolderID)
	{
		try
		{
			$query = $this->db->prepare("CALL Folders_Read_FolderID(:FolderID)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_STR);
			
			if (!$query->execute())
				return null;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return null;
			
			$obj = new FolderModel();
			$obj->FillData($obj, $result[0]);
			
			return $obj;
		}
		catch (Exception $e)
		{ return null; }
	}

	public function ReadUserRoot($UserID)
	{
		try
		{
			$query = $this->db->prepare("CALL Folders_Read_User_Root(:UserID)");
			$query->bindParam(":UserID", $UserID, PDO::PARAM_STR);
			
			if (!$query->execute())
				return null;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return null;
			
			$obj = new FolderModel();
			$obj->FillData($obj, $result[0]);
			
			return $obj;
		}
		catch (Exception $e)
		{ return null; }
	}    
	
	public function ReadAncestors($FolderID)
    {
        $folder = $this->ReadFolderID($FolderID);
        
        $ancestors = []; $i = 0;
        while ($folder->ParentID !== null)
        {
            $folder = $this->ReadFolderID($folder->ParentID);
            $ancestors[$i++] = $folder;
        }
        
        return array_reverse($ancestors);
    }


    public function ModifyParent($FolderID,$ParentID)
    {
		try
		{
			$query = $this->db->prepare("CALL Folders_Modify_Parent(:FolderID,:ParentID)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
			$query->bindParam(":ParentID"   , $ParentID   , PDO::PARAM_STR);
	
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; } 
    }

    public function ModifyName($FolderID,$Name)
    {
		try
		{
			$query = $this->db->prepare("CALL Folders_Modify_Name(:FolderID,:Name)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
			$query->bindParam(":Name"       , $Name       , PDO::PARAM_STR);
	
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; } 
    }

    public function ModifyVisibility($FolderID,$Visibility)
    {
		try
		{
			$query = $this->db->prepare("CALL Folders_Modify_Visibility(:FolderID,:Visibility)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
			$query->bindParam(":Visibility" , $Visibility , PDO::PARAM_STR);
	
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return false;
			
			$this->FillData($this, $result[0]);
			
			return true;
		}
		catch (Exception $e)
		{ return false; } 
    }

	public function DeleteID($FolderID)
	{
		try
		{
			$query = $this->db->prepare("CALL Folders_Delete(:FolderID)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
			
			if (!$query->execute())
				return false;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return (sizeof($result) == 0);
		}
		catch (Exception $e)
		{ return false; }
	}
}

?>