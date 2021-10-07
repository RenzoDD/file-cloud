/*
 * Copyright 2021 (c) Renzo Diaz
 * 
 * Files table
 */
 
DELIMITER //

DROP TABLE IF EXISTS Files //
CREATE TABLE Files (
	FileID INTEGER 	AUTO_INCREMENT,
	
	UserID      INTEGER     NOT NULL,
	FolderID INTEGER     NOT NULL,
	
	Name        TEXT        NOT NULL,
	Token       VARCHAR(64) NOT NULL    UNIQUE,
	UploadDate  DATETIME    NOT NULL,
	Visibility  TEXT        NOT NULL, -- ALL, ME
	
	PRIMARY KEY (FileID),
	FOREIGN KEY (UserID)    REFERENCES Users       (UserID),
	FOREIGN KEY (FolderID)  REFERENCES Folders (FolderID)
) //

DROP PROCEDURE IF EXISTS Files_Create //
CREATE PROCEDURE Files_Create (IN UserID INTEGER, IN FolderID INTEGER, IN Name TEXT, IN Visibility TEXT)
BEGIN
    SET @token = Nonce();
    SET @upload_date = LocalDateTime();
	INSERT INTO Files (UserID, FolderID, Name , Token, UploadDate, Visibility)
	VALUES 	(UserID, FolderID, Name, @token, @upload_date, Visibility);

	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.UserID = UserID
	        AND F.FolderID = FolderID
			AND F.Name = Name
			AND F.Token = @token
			AND F.UploadDate = @upload_date
			AND F.Visibility = Visibility;
END //

DROP PROCEDURE IF EXISTS Files_Read_Folder //
CREATE PROCEDURE Files_Read_Folder ( IN FolderID TEXT )
BEGIN
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FolderID = FolderID;
END //

DROP PROCEDURE IF EXISTS Files_Read_FileID //
CREATE PROCEDURE Files_Read_FileID ( IN FileID TEXT )
BEGIN
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FileID = FileID;
END //

DROP PROCEDURE IF EXISTS Files_Read_Token //
CREATE PROCEDURE Files_Read_Token ( IN Token TEXT )
BEGIN
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.Token = Token;
END //

DROP PROCEDURE IF EXISTS Files_Modify_Folder //
CREATE PROCEDURE Files_Modify_Folder ( IN FileID INTEGER, IN FolderID INTEGER )
BEGIN
	UPDATE  Files AS F
	SET     F.FolderID = FolderID
	WHERE 	F.FileID = FileID;
	
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FileID = FileID
			AND F.FolderID = FolderID;
END //

DROP PROCEDURE IF EXISTS Files_Modify_Name //
CREATE PROCEDURE Files_Modify_Name ( IN FileID INTEGER, IN Name TEXT )
BEGIN
	UPDATE  Files AS F
	SET     F.Name = Name
	WHERE 	F.FileID = FileID;
	
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FileID = FileID
			AND F.Name = Name;
END //

DROP PROCEDURE IF EXISTS Files_Modify_Visibility //
CREATE PROCEDURE Files_Modify_Visibility ( IN FileID INTEGER, IN Visibility TEXT )
BEGIN
	UPDATE  Files AS F
	SET     F.Visibility = Visibility
	WHERE 	F.FileID = FileID;
	
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FileID = FileID
			AND F.Visibility = Visibility;
END //

DROP PROCEDURE IF EXISTS Files_Delete //
CREATE PROCEDURE Files_Delete ( IN ID INTEGER )
BEGIN
	DELETE FROM Files
	WHERE 	FileID = ID;
	
	SELECT 	F.*
	FROM 	Files AS F
	WHERE 	F.FileID = ID;
END //

