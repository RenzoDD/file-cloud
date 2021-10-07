<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Database class
 */
class DataBase
{
    protected $db;
    private $query;
    function __construct()
    {
        $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=UTF8",DB_USER,DB_PASS);
    }
    function ExecuteQuery($sql)
    {
        try 
        {
            $this->query = $this->db->prepare($sql);
            return $this->query->execute();
        }
        catch (Exception $e){ return false; }
    }
    function GetResult()
    {
        try 
        {
            return $this->query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e){ return null; }
    }
}

?>