USE DevData;

CREATE TABLE `DevData`.`Projects` (
ProjectID INT AUTO_INCREMENT,
ProjectName VARCHAR(255),
ProjectDescription VARCHAR(500),
Company INT,
Website VARCHAR(500),
CONSTRAINT pk_Projects_ProjectID PRIMARY KEY (ProjectID)
);

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_Load`
(
	 IN paramProjectID INT
)
BEGIN
	SELECT
		`Projects`.`ProjectID` AS `ProjectID`,
    `Projects`.`ProjectName` AS `ProjectName`,
    `Projects`.`ProjectDescription` AS `ProjectDescription`,
    `Projects`.`Company` AS `Company`,
    `Projects`.`Website` AS `Website`

	FROM `Projects`
	WHERE `Projects`.`ProjectID` = paramProjectID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_LoadAll`()
BEGIN
	SELECT
  `Projects`.`ProjectID` AS `ProjectID`,
  `Projects`.`ProjectName` AS `ProjectName`,
  `Projects`.`ProjectDescription` AS `ProjectDescription`,
  `Projects`.`Company` AS `Company`,
  `Projects`.`Website` AS `Website`
	FROM `Projects`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_Add`
(
	 IN paramProjectName VARCHAR(255),
	 IN paramProjectDescription VARCHAR(500),
	 IN paramCompany INT,
	 IN paramWebsite VARCHAR(500),
)
BEGIN
	INSERT INTO `Projects` (ProjectName,ProjectDescription,Company,Website)
	VALUES (paramProjectName, paramProjectDescription, paramCompany, paramWebsite);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_Update`
(
IN paramProjectName VARCHAR(255),
IN paramProjectDescription VARCHAR(500),
IN paramCompany INT,
IN paramWebsite VARCHAR(500)
)
BEGIN
	UPDATE `Projects`
	SET ProjectName = paramProjectName
		,ProjectDescription = paramProjectDescription
		,Company = paramCompany
		,Website = paramWebsite
	WHERE		`Projects`.`ProjectID` = paramProjectID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_Delete`
(
	IN paramProjectID INT
)
BEGIN
	DELETE FROM `Projects`
	WHERE		`Projects`.`ProjectID` = paramProjectID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `DevData`.`usp_Projects_Search`
(
IN paramProjectName VARCHAR(255),
IN paramProjectDescription VARCHAR(500),
IN paramCompany INT,
IN paramWebsite VARCHAR(500)
)
BEGIN
	SELECT
  `Projects`.`ProjectID` AS `ProjectID`,
  `Projects`.`ProjectName` AS `ProjectName`,
  `Projects`.`ProjectDescription` AS `ProjectDescription`,
  `Projects`.`Company` AS `Company`,
  `Projects`.`Website` AS `Website`
	FROM `Projects`
	WHERE
		COALESCE(Projects.`ProjectID`,0) = COALESCE(paramProjectID,Projects.`ProjectID`,0)
		AND COALESCE(Projects.`ProjectName`,'') = COALESCE(paramProjectName,Projects.`ProjectName`,'')
		AND COALESCE(Projects.`ProjectDescription`,'') = COALESCE(paramProjectDescription,Projects.`ProjectDescription`,'')
		AND COALESCE(Projects.`Company`,0) = COALESCE(paramCompany,Projects.`Company`,0)
		AND COALESCE(Projects.`Website`,'') = COALESCE(paramWebsite,Projects.`Website`,'');
END //
DELIMITER ;
