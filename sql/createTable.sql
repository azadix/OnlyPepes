CREATE TABLE `pepelist` (
	`id` INT(8) NOT NULL AUTO_INCREMENT,
	`name` TEXT(60) NOT NULL,
	`voteCount` SMALLINT DEFAULT NULL,
	`uploaderId` INT(6) UNSIGNED NOT NULL,
	`uploadTime` TIMESTAMP NOT NULL,
	`fileName` TEXT(60) NOT NULL,
	`extension` TEXT(5) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;
