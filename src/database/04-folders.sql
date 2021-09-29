/*
 * Copyright 2021 (c) Renzo Diaz
 * 
 * Folders table
 */
 
DELIMITER //

DROP TABLE IF EXISTS Folders //
CREATE TABLE Folders (
	FolderID    INTEGER 	AUTO_INCREMENT,
	
	UserID      INTEGER     NOT NULL,
	ParentID    INTEGER,
	
	Name        TEXT        NOT NULL,
	Token       VARCHAR(64) NOT NULL    UNIQUE,
	CreateDate  DATETIME    NOT NULL,
	Visibility  TEXT        NOT NULL, -- ALL, ME
	
	PRIMARY KEY (FolderID),
	FOREIGN KEY (UserID)    REFERENCES Users       (UserID),
	FOREIGN KEY (ParentID)  REFERENCES Folders (FolderID)
) //

DROP PROCEDURE IF EXISTS Folders_Create //
CREATE PROCEDURE Folders_Create (IN UserID INTEGER, IN ParentID INTEGER, IN Name TEXT, IN Visibility TEXT)
BEGIN
    SET @token = Nonce();
    SET @create_date = LocalDateTime();
    
	INSERT INTO Folders (UserID, ParentID, Name, Token, CreateDate, Visibility)
	VALUES 	(UserID, ParentID, Name, @token, @create_date, Visibility);

	SELECT 	D.*
	FROM 	Folders AS D
	WHERE 	D.UserID = UserID
	        AND D.ParentID = ParentID
			AND D.Name = Name
			AND D.Token = @token
			AND D.CreateDate = @create_date
			AND D.Visibility = Visibility;
END //

DROP PROCEDURE IF EXISTS Folders_Read_Token //
CREATE PROCEDURE Folders_Read_Token ( IN Token TEXT )
BEGIN
	SELECT 	D.*
	FROM 	Folders AS D
	WHERE 	D.Token = Token;
END //

DROP PROCEDURE IF EXISTS Folders_Read_Childs //
CREATE PROCEDURE Folders_Read_Childs ( IN FolderID INTEGER )
BEGIN
	SELECT 	D.*
	FROM 	Folders AS D 
	WHERE 	D.ParentID = FolderID;
END //

DROP PROCEDURE IF EXISTS Folders_Read_FolderID //
CREATE PROCEDURE Folders_Read_FolderID ( IN FolderID INTEGER )
BEGIN
	SELECT 	D.*
	FROM 	Folders AS D
	WHERE 	D.FolderID = FolderID;
END //

DROP PROCEDURE IF EXISTS Folders_Read_User_Root //
CREATE PROCEDURE Folders_Read_User_Root( IN UserID INTEGER)
BEGIN
	SELECT 	F.*
	FROM	Folders AS F
	WHERE 	F.UserID = UserID AND F.ParentID IS NULL;
END //

DROP PROCEDURE IF EXISTS Folders_Modify_Parent //
CREATE PROCEDURE Folders_Modify_Parent ( IN FolderID INTEGER, IN ParentID INTEGER )
BEGIN
	UPDATE  Folders AS D
	SET     D.ParentID = ParentID
	WHERE 	D.FolderID = FolderID;
	
	SELECT  *
	FROM    Folders AS D
	WHERE   D.FolderID = FolderID
	        AND D.ParentID = ParentID;
END //

DROP PROCEDURE IF EXISTS Folders_Modify_Name //
CREATE PROCEDURE Folders_Modify_Name ( IN FolderID INTEGER, IN Name TEXT )
BEGIN
	UPDATE  Folders AS D
	SET     D.Name = Name
	WHERE 	D.FolderID = FolderID;
	
	SELECT  *
	FROM    Folders AS D
	WHERE   D.FolderID = FolderID
	        AND D.Name = Name;
END //

DROP PROCEDURE IF EXISTS Folders_Modify_Visibility //
CREATE PROCEDURE Folders_Modify_Visibility ( IN FolderID INTEGER, IN Visibility TEXT )
BEGIN
	UPDATE  Folders AS D
	SET     D.Visibility = Visibility
	WHERE 	D.FolderID = FolderID;
	
	SELECT  *
	FROM    Folders AS D
	WHERE   D.FolderID = FolderID
	        AND D.Visibility = Visibility;
END //

DROP PROCEDURE IF EXISTS Folders_Delete //
CREATE PROCEDURE Folders_Delete ( IN ID INTEGER )
BEGIN
	DELETE FROM Folders
	WHERE 	FolderID = ID;
END //