<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * User class
 */

require_once __DIR__.'/DataBase.php';

class UserModel extends DataBase
{
    public $UserID;

    public $Email;
    public $Username;
    public $Password;
    public $Salt;
    public $MaxSize;
    
	private function FillData($destino, $origen)
	{
		if (isset($origen['UserID']))
			$destino->UserID = $origen['UserID'];

		if (isset($origen['Email']))
			$destino->Email = $origen['Email'];
			
		if (isset($origen['Username']))  
			$destino->Username = $origen['Username'];
		
		if (isset($origen['Password']))  
			$destino->Password = $origen['Password'];
		
		if (isset($origen['Salt']))  
			$destino->Salt = $origen['Salt'];
		
		if (isset($origen['MaxSize']))  
			$destino->MaxSize = $origen['MaxSize'];
	}

	public function Create($Email,$Username,$Password,$MaxSize)
	{
		try
		{
			$query = $this->db->prepare("CALL Users_Create(:Email,:Username,:Password,:MaxSize)");
			$query->bindParam(":Email"   , $Email   , PDO::PARAM_STR);
			$query->bindParam(":Username", $Username, PDO::PARAM_STR);
			$query->bindParam(":Password", $Password, PDO::PARAM_STR);
			$query->bindParam(":MaxSize" , $MaxSize , PDO::PARAM_INT);
			
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

	public function ReadUsernamePassword($Username,$Password)
	{
		try
		{
			$query = $this->db->prepare("CALL Users_Read_UsernamePassword(:Username,:Password)");
			$query->bindParam(":Username", $Username, PDO::PARAM_STR);
			$query->bindParam(":Password", $Password, PDO::PARAM_STR);
			
			if (!$query->execute())
				return null;
				
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if (sizeof($result) == 0)
				return null;
			
			$obj = new UserModel();
			$obj->FillData($obj, $result[0]);
			
			return $obj;
		}
		catch (Exception $e)
		{ return null; }
	}
}

?>