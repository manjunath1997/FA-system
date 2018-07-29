
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema FA_System
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema FA_System
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `FA_System` DEFAULT CHARACTER SET utf8 ;
USE `FA_System` ;

-- -----------------------------------------------------
-- Table `FA_System`.`Department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Department` (
  `Department_Code` VARCHAR(5) NOT NULL,
  `Department_Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Department_Code`),
  UNIQUE INDEX `Department_Code_UNIQUE` (`Department_Code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Faculty_Advisor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Faculty_Advisor` (
  `Faculty_Code` VARCHAR(5) NOT NULL,
  `Department_Code` VARCHAR(5) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Contact_Number` INT NOT NULL,
  PRIMARY KEY (`Faculty_Code`),
  UNIQUE INDEX `Faculty_Code_UNIQUE` (`Faculty_Code` ASC),
  INDEX `fk_Faculty_Advisor_Department1_idx` (`Department_Code` ASC),
  CONSTRAINT `belongs_to`
    FOREIGN KEY (`Department_Code`)
    REFERENCES `FA_System`.`Department` (`Department_Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Student` (
  `Roll Number` NVARCHAR(9) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Date_of_birth` DATE NULL,
  `Nationality` VARCHAR(45) NULL,
  `Date_of_joining` DATE NOT NULL,
  `Religion` VARCHAR(45) NULL,
  `Date_of_leaving` DATE NULL,
  `Caste` VARCHAR(5) NOT NULL,
  `Contact_number` BIGINT(10) NOT NULL,
  `Email_id` VARCHAR(45) NOT NULL,
  `Permanent_Address` VARCHAR(45) NOT NULL,
  `Present_Address` VARCHAR(45) NULL,
  `Name_of_Local_gaurdian` VARCHAR(45) NULL,
  `Relationship_of_local_gaurdian` VARCHAR(45) NULL,
  `Occupation_of_local_gaurdian` VARCHAR(45) NULL,
  `Contact_number_of_local_gaurdian` BIGINT(10) NULL,
  `Name_of_father` VARCHAR(45) NULL,
  `Address_of_Father` VARCHAR(45) NULL,
  `Contact_number_of_father` BIGINT(10) NULL,
  `Name_of_Mother` VARCHAR(45) NULL,
  `Contact_number_of_mother` BIGINT(10) NULL,
  `Occupation_of_Parent` VARCHAR(45) NULL,
  `Faculty_Advisor_Code` VARCHAR(5) NOT NULL,
  `Entry_Course` VARCHAR(45) NOT NULL,
  `Entry_Period_of_Study` VARCHAR(45) NOT NULL,
  `Entry_Board` VARCHAR(45) NOT NULL,
  `Entry_Institution` VARCHAR(45) NULL COMMENT 'Name of Institution he studied +2',
  `Entry_Marks_Secured` INT NOT NULL,
  `Entry_Marks_Total` INT NOT NULL,
  `Year_of_Graduation` YEAR NULL,
  `Achievements` VARCHAR(45) NULL,
  `Scholarships` VARCHAR(45) NULL,
  `Conduct` VARCHAR(45) NULL,
  `Project` VARCHAR(45) NULL,
  `Project_Guide` VARCHAR(45) NULL,
  `Internship` VARCHAR(45) NULL,
  `Placement` VARCHAR(45) NULL,
  `Condonation_1` VARCHAR(45) NULL,
  `Condonation_2` VARCHAR(45) NULL,
  `Probation` VARCHAR(45) NULL,
  `Medical_Discontinuation` VARCHAR(45) NULL,
  `Department_Code` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Roll Number`),
  UNIQUE INDEX `Roll Number_UNIQUE` (`Roll Number` ASC),
  INDEX `fk_Student_Faculty_Advisor1_idx` (`Faculty_Advisor_Code` ASC),
  INDEX `fk_Student_Department1_idx` (`Department_Code` ASC),
  CONSTRAINT `under`
    FOREIGN KEY (`Faculty_Advisor_Code`)
    REFERENCES `FA_System`.`Faculty_Advisor` (`Faculty_Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `department`
    FOREIGN KEY (`Department_Code`)
    REFERENCES `FA_System`.`Department` (`Department_Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Course` (
  `Course_Code` VARCHAR(6) NOT NULL,
  `Course_Name` VARCHAR(45) NOT NULL,
  `Credits` INT NOT NULL,
  PRIMARY KEY (`Course_Code`),
  UNIQUE INDEX `Course_Code_UNIQUE` (`Course_Code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Section` (
  `Section_id` VARCHAR(45) GENERATED ALWAYS AS () VIRTUAL,
  `Course_Code` VARCHAR(6) NOT NULL,
  `Year` INT NOT NULL,
  `Semester` VARCHAR(45) NOT NULL,
  `Faculty_Code` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Section_id`),
  UNIQUE INDEX `Section_id_UNIQUE` (`Section_id` ASC),
  INDEX `fk_Section_Course1_idx` (`Course_Code` ASC),
  CONSTRAINT `has_course`
    FOREIGN KEY (`Course_Code`)
    REFERENCES `FA_System`.`Course` (`Course_Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Hod`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Hod` (
  `hod_code` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Department_Code` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`hod_code`),
  UNIQUE INDEX `hod_code_UNIQUE` (`hod_code` ASC),
  INDEX `fk_Hod_Department1_idx` (`Department_Code` ASC),
  CONSTRAINT `controls`
    FOREIGN KEY (`Department_Code`)
    REFERENCES `FA_System`.`Department` (`Department_Code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Register`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Register` (
  `Roll Number` NVARCHAR(9) NOT NULL,
  `Section_Section_id` VARCHAR(45) NOT NULL,
  `Marks_T1` INT NULL DEFAULT 0,
  `Marks_T2` INT NULL DEFAULT 0,
  `Assignents` INT NULL DEFAULT 0,
  `Quizes` INT NULL DEFAULT 0,
  `Grade` CHAR(1) NULL,
  `Project` INT NULL DEFAULT 0,
  INDEX `fk_Student_has_Section_Section1_idx` (`Section_Section_id` ASC),
  INDEX `fk_Student_has_Section_Student1_idx` (`Roll Number` ASC),
  CONSTRAINT `enrols`
    FOREIGN KEY (`Roll Number`)
    REFERENCES `FA_System`.`Student` (`Roll Number`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `registers`
    FOREIGN KEY (`Section_Section_id`)
    REFERENCES `FA_System`.`Section` (`Section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FA_System`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `FA_System`.`Login` (
  `id` VARCHAR(15) NOT NULL,
  `type` VARCHAR(10) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `type`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
