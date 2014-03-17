SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `gregjoy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gregjoy` ;

-- -----------------------------------------------------
-- Table `gregjoy`.`Content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gregjoy`.`Content` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `record_name` VARCHAR(255) NOT NULL,
  `zone_id` INT(1) NOT NULL DEFAULT 1,
  `date_published` DATETIME NOT NULL,
  `content` TEXT NOT NULL,
  `is_blog` TINYINT(1) NOT NULL DEFAULT false,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `record_name_UNIQUE` (`record_name` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gregjoy`.`Comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gregjoy`.`Comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `conent_id` INT NOT NULL,
  `date_published` DATETIME NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email_address` VARCHAR(25) NOT NULL,
  `content` TEXT NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `show_email` TINYINT(1) NOT NULL DEFAULT false,
  `zone_id` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
