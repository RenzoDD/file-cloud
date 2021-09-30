/*
 * Copyright 2021 (c) Renzo Diaz
 * 
 * Users table
 */
 
DELIMITER //

DROP TABLE IF EXISTS Users //
CREATE TABLE Users (
	UserID 		INTEGER 	AUTO_INCREMENT,

	Email       VARCHAR(50) NOT NULL    UNIQUE,
	Username    VARCHAR(50) NOT NULL    UNIQUE,
	Password    TEXT		NOT NULL,
	Salt        TEXT		NOT NULL,
	MaxSize     INTEGER		NOT NULL,
	
	PRIMARY KEY (UserID)
) //

DROP PROCEDURE IF EXISTS Users_Create //
CREATE PROCEDURE Users_Create (IN Email VARCHAR(50), IN Username VARCHAR(50), IN Password TEXT, IN MaxSize INTEGER)
BEGIN
	SET @salt = Nonce();

	INSERT INTO Users (Email, Username, Password, Salt, MaxSize)
	VALUES 	(Email, Username, HashSalt( Password, @salt ), @salt, MaxSize);

	SELECT 	U.*
	FROM 	Users AS U
	WHERE 	U.Email = Email
	        AND U.Username = Username
			AND U.Password = HashSalt( Password, @salt ) 
			AND U.Salt = @salt 
			AND U.MaxSize = MaxSize;
END //

DROP PROCEDURE IF EXISTS Users_Read_UserID //
CREATE PROCEDURE Users_Read_UserID ( IN UserID TEXT )
BEGIN
	SELECT 	U.*
	FROM 	Users AS U
	WHERE 	U.UserID = UserID;
END //

DROP PROCEDURE IF EXISTS Users_Read_UsernamePassword //
CREATE PROCEDURE Users_Read_UsernamePassword ( IN Username TEXT, IN Password TEXT )
BEGIN
	SELECT 	U.*
	FROM 	Users AS U
	WHERE 	(U.Username = Username OR U.Email = Username)
			AND U.Password = HashSalt( Password, U.Salt );
END //