USE DevData;

CREATE TABLE `DevData`.`NotificationTypes` (

NotificationTypesID INT AUTO_INCREMENT,
NotificationTypesName VARCHAR(255),

CONSTRAINT pk_NotificationTypes_NotificationTypesID PRIMARY KEY (NotificationTypesID)
)

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_Load`
(
	 IN paramNotificationTypesID INT
)
BEGIN
	SELECT
		`NotificationTypes`.`NotificationTypesID` AS `NotificationTypesID`,
    `NotificationTypes`.`NotificationTypesName` AS `NotificationTypesName`


	FROM `NotificationTypes`
	WHERE `NotificationTypes`.`NotificationTypesID` = paramNotificationTypesID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_LoadAll`()
BEGIN
	SELECT
  `NotificationTypes`.`NotificationTypesID` AS `NotificationTypesID`,
  `NotificationTypes`.`NotificationTypesName` AS `NotificationTypesName`

	FROM `NotificationTypes`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_Add`
(
	 IN paramNotificationTypesName VARCHAR(255)

)
BEGIN
	INSERT INTO `NotificationTypes` (NotificationTypesName,ProjectDescription,Company,Website)
	VALUES (paramNotificationTypesName, paramProjectDescription, paramCompany, paramWebsite);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_Update`
(
IN paramNotificationTypesName VARCHAR(255)

)
BEGIN
	UPDATE `NotificationTypes`
	SET NotificationTypesName = paramNotificationTypesName
	WHERE		`NotificationTypes`.`NotificationTypesID` = paramNotificationTypesID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_Delete`
(
	IN paramNotificationTypesID INT
)
BEGIN
	DELETE FROM `NotificationTypes`
	WHERE		`NotificationTypes`.`NotificationTypesID` = paramNotificationTypesID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_NotificationTypes_Search`
(
IN paramNotificationTypesName VARCHAR(255)

)
BEGIN
	SELECT
  `NotificationTypes`.`NotificationTypesID` AS `NotificationTypesID`,
  `NotificationTypes`.`NotificationTypesName` AS `NotificationTypesName`

	FROM `NotificationTypes`
	WHERE
		COALESCE(NotificationTypes.`NotificationTypesID`,0) = COALESCE(paramNotificationTypesID,NotificationTypes.`NotificationTypesID`,0)
		AND COALESCE(NotificationTypes.`NotificationTypesName`,'') = COALESCE(paramNotificationTypesName,NotificationTypes.`NotificationTypesName`,'');
END //
DELIMITER ;
