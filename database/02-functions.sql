/*
 * Copyright 2021 (c) Renzo Diaz
 * 
 * Funciones de control básicas
 * URL: http://localhost/phpmyadmin/
 */

DELIMITER //

DROP FUNCTION IF EXISTS HashSalt //
CREATE FUNCTION HashSalt (DATA TEXT, SALT TEXT) 
RETURNS TEXT
BEGIN
	DECLARE result TEXT;
	SET result = CAST(SHA2( CONCAT(DATA, SALT) , 256 ) AS CHAR);
	RETURN result;
END //

DROP FUNCTION IF EXISTS Nonce //
CREATE FUNCTION Nonce() 
RETURNS TEXT
BEGIN
	RETURN MD5(CAST(FLOOR(RAND()*(999999999999)) AS CHAR));
END //

DROP FUNCTION IF EXISTS LocalDateTime //
CREATE FUNCTION LocalDateTime()
RETURNS DATETIME
BEGIN
	RETURN CONVERT_TZ(NOW(), 'SYSTEM', '-05:00');
END //

DROP FUNCTION IF EXISTS RandStr //
CREATE FUNCTION RandStr(SIZE INTEGER)
RETURNS TEXT
BEGIN
	DECLARE chars TEXT;
	DECLARE charLen INTEGER;
	DECLARE randomPassword TEXT;

	SET chars = 'ABCDEFGHIJKMNOPQRTUVWXYZabcdefghijkmnopqrtuvwxyz0123456789';
	SET charLen = CHAR_LENGTH(chars);
	SET randomPassword = '';

	WHILE CHAR_LENGTH(randomPassword) < SIZE
	DO
		SET randomPassword = CONCAT(randomPassword, SUBSTRING(chars,CEILING(RAND() * charLen),1));
	END WHILE;

	RETURN randomPassword;
END //