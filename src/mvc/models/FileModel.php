<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * File class
 */

require_once __DIR__ . '/DataBase.php';

class FileModel extends DataBase
{
	public $FileID;

	public $UserID;
	public $FolderID;

	public $Name;
	public $Size;
	public $Token;
	public $Identity;
	public $UploadDate;
	public $Visibility;

	private function FillData($destino, $origen)
	{
		if (isset($origen['FileID']))
			$destino->FileID = $origen['FileID'];

		if (isset($origen['UserID']))
			$destino->UserID = $origen['UserID'];

		if (isset($origen['FolderID']))
			$destino->FolderID = $origen['FolderID'];

		if (isset($origen['Name']))
			$destino->Name = $origen['Name'];

		if (isset($origen['Size']))
			$destino->Size = $origen['Size'];

		if (isset($origen['Token']))
			$destino->Token = $origen['Token'];

		if (isset($origen['Identity']))
			$destino->Identity = $origen['Identity'];

		if (isset($origen['UploadDate']))
			$destino->UploadDate = $origen['UploadDate'];

		if (isset($origen['Visibility']))
			$destino->Visibility = $origen['Visibility'];
	}

	public function Create($UserID, $FolderID, $Name, $Size, $Visibility)
	{
		try {
			$query = $this->db->prepare("CALL Files_Create(:UserID,:FolderID,:Name,:Size,:Visibility)");
			$query->bindParam(":UserID", $UserID, PDO::PARAM_INT);
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);
			$query->bindParam(":Name", $Name, PDO::PARAM_STR);
			$query->bindParam(":Size", $Size, PDO::PARAM_INT);
			$query->bindParam(":Visibility", $Visibility, PDO::PARAM_STR);

			if (!$query->execute())
				return false;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return false;

			$this->FillData($this, $result[0]);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ReadSpaceUsed($UserID)
	{
		try {
			$query = $this->db->prepare("CALL Files_Read_SpaceUsed(:UserID)");
			$query->bindParam(":UserID", $UserID, PDO::PARAM_INT);

			if (!$query->execute())
				return -1;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return -1;

			return $result[0]["SpaceUsed"];
		} catch (Exception $e) {
			return -1;
		}
	}

	public function ReadFolder($FolderID)
	{
		try {
			$query = $this->db->prepare("CALL Files_Read_Folder(:FolderID)");
			$query->bindParam(":FolderID", $FolderID, PDO::PARAM_INT);

			if (!$query->execute())
				return [];

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			$A = [];
			foreach ($result as $row) {
				$obj = new FileModel();
				$obj->FillData($obj, $row);
				$A[$obj->FileID] = $obj;
			}

			return $A;
		} catch (Exception $e) {
			return [];
		}
	}

	public function ReadFileID($FileID)
	{
		try {
			$query = $this->db->prepare("CALL Files_Read_FileID(:FileID)");
			$query->bindParam(":FileID", $FileID, PDO::PARAM_STR);

			if (!$query->execute())
				return null;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return null;

			$obj = new FileModel();
			$obj->FillData($obj, $result[0]);

			return $obj;
		} catch (Exception $e) {
			return null;
		}
	}

	public function ReadToken($Token)
	{
		try {
			$query = $this->db->prepare("CALL Files_Read_Token(:Token)");
			$query->bindParam(":Token", $Token, PDO::PARAM_STR);

			if (!$query->execute())
				return null;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return null;

			$obj = new FileModel();
			$obj->FillData($obj, $result[0]);

			return $obj;
		} catch (Exception $e) {
			return null;
		}
	}

	public function ReadIdentity($Identity)
	{
		try {
			$query = $this->db->prepare("CALL Files_Read_Identity(:Identity)");
			$query->bindParam(":Identity", $Identity, PDO::PARAM_STR);

			if (!$query->execute())
				return null;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return null;

			$obj = new FileModel();
			$obj->FillData($obj, $result[0]);

			return $obj;
		} catch (Exception $e) {
			return null;
		}
	}

	public function ModifyFolder($FileID, $ParentID)
	{
		try {
			$query = $this->db->prepare("CALL Files_Modify_Folder(:FileID,:ParentID)");
			$query->bindParam(":FileID", $FileID, PDO::PARAM_INT);
			$query->bindParam(":ParentID", $ParentID, PDO::PARAM_STR);

			if (!$query->execute())
				return false;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return false;

			$this->FillData($this, $result[0]);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ModifyName($FileID, $Name)
	{
		try {
			$query = $this->db->prepare("CALL Files_Modify_Name(:FileID,:Name)");
			$query->bindParam(":FileID", $FileID, PDO::PARAM_INT);
			$query->bindParam(":Name", $Name, PDO::PARAM_STR);

			if (!$query->execute())
				return false;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return false;

			$this->FillData($this, $result[0]);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ModifyVisibility($FileID, $Visibility)
	{
		try {
			$query = $this->db->prepare("CALL Files_Modify_Visibility(:FileID,:Visibility)");
			$query->bindParam(":FileID", $FileID, PDO::PARAM_INT);
			$query->bindParam(":Visibility", $Visibility, PDO::PARAM_STR);

			if (!$query->execute())
				return false;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if (sizeof($result) == 0)
				return false;

			$this->FillData($this, $result[0]);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function DeleteID($FileID)
	{
		try {
			$query = $this->db->prepare("CALL Files_Delete(:FileID)");
			$query->bindParam(":FileID", $FileID, PDO::PARAM_INT);

			if (!$query->execute())
				return false;

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			return (sizeof($result) == 0);
		} catch (Exception $e) {
			return false;
		}
	}
}
