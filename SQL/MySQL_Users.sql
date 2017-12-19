/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen
Date:			11/11/2017
Description:	Creates the Users table and respective stored procedures

*/


USE DevData;






CREATE TABLE `DevData`.`Users` (
UserID INT AUTO_INCREMENT,
Email VARCHAR(40),
Username VARCHAR(40),
Password VARCHAR(255),
FirstName VARCHAR(40),
LastName VARCHAR(40),
RoleID INT,
ImgURL VARCHAR(1025),
CONSTRAINT pk_Users_UserID PRIMARY KEY (UserID)
);




DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_Load`
(
	 IN paramUserID INT
)
BEGIN
	SELECT
		`Users`.`UserID` AS `UserID`,
		`Users`.`Email` AS `Email`,
		`Users`.`Username` AS `Username`,
		`Users`.`Password` AS `Password`,
		`Users`.`FirstName` AS `FirstName`,
		`Users`.`LastName` AS `LastName`,
		`Users`.`RoleID` AS `RoleID`,
		`Users`.`ImgURL` AS `ImgURL`
	FROM `Users`
	WHERE 		`Users`.`UserID` = paramUserID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_LoadAll`()
BEGIN
	SELECT
		`Users`.`UserID` AS `UserID`,
		`Users`.`Email` AS `Email`,
		`Users`.`Username` AS `Username`,
		`Users`.`Password` AS `Password`,
		`Users`.`FirstName` AS `FirstName`,
		`Users`.`LastName` AS `LastName`,
		`Users`.`RoleID` AS `RoleID`,
		`Users`.`ImgURL` AS `ImgURL`
	FROM `Users`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_Add`
(
	 IN paramEmail VARCHAR(40),
	 IN paramUsername VARCHAR(40),
	 IN paramPassword VARCHAR(255),
	 IN paramFirstName VARCHAR(40),
	 IN paramLastName VARCHAR(40),
	 IN paramRoleID INT,
	 IN paramImgURL VARCHAR(1025)
)
BEGIN
	INSERT INTO `Users` (Email,Username,Password,FirstName,LastName,RoleID,ImgURL)
	VALUES (paramEmail, paramUsername, paramPassword, paramFirstName, paramLastName, paramRoleID, paramImgURL);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_Update`
(
	IN paramUserID INT,
	IN paramEmail VARCHAR(40),
	IN paramUsername VARCHAR(40),
	IN paramPassword VARCHAR(255),
	IN paramFirstName VARCHAR(40),
	IN paramLastName VARCHAR(40),
	IN paramRoleID INT,
	IN paramImgURL VARCHAR(1025)
)
BEGIN
	UPDATE `Users`
	SET Email = paramEmail
		,Username = paramUsername
		,Password = paramPassword
		,FirstName = paramFirstName
		,LastName = paramLastName
		,RoleID = paramRoleID
		,ImgURL = paramImgURL
	WHERE		`Users`.`UserID` = paramUserID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_Delete`
(
	IN paramUserID INT
)
BEGIN
	DELETE FROM `Users`
	WHERE		`Users`.`UserID` = paramUserID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Users_Search`
(
	IN paramUserID INT,
	IN paramEmail VARCHAR(40),
	IN paramUsername VARCHAR(40),
	IN paramPassword VARCHAR(255),
	IN paramFirstName VARCHAR(40),
	IN paramLastName VARCHAR(40),
	IN paramRoleID INT,
	IN paramImgURL VARCHAR(1025)
)
BEGIN
	SELECT
		`Users`.`UserID` AS `UserID`,
		`Users`.`Email` AS `Email`,
		`Users`.`Username` AS `Username`,
		`Users`.`Password` AS `Password`,
		`Users`.`FirstName` AS `FirstName`,
		`Users`.`LastName` AS `LastName`,
		`Users`.`RoleID` AS `RoleID`,
		`Users`.`ImgURL` AS `ImgURL`
	FROM `Users`
	WHERE
		COALESCE(Users.`UserID`,0) = COALESCE(paramUserID,Users.`UserID`,0)
		AND COALESCE(Users.`Email`,'') = COALESCE(paramEmail,Users.`Email`,'')
		AND COALESCE(Users.`Username`,'') = COALESCE(paramUsername,Users.`Username`,'')
		AND COALESCE(Users.`Password`,'') = COALESCE(paramPassword,Users.`Password`,'')
		AND COALESCE(Users.`FirstName`,'') = COALESCE(paramFirstName,Users.`FirstName`,'')
		AND COALESCE(Users.`LastName`,'') = COALESCE(paramLastName,Users.`LastName`,'')
		AND COALESCE(Users.`RoleID`,0) = COALESCE(paramRoleID,Users.`RoleID`,0)
		AND COALESCE(Users.`ImgURL`,'') = COALESCE(paramImgURL,Users.`ImgURL`,'');
END //
DELIMITER ;
