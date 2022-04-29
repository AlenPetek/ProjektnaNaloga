
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projekt` DEFAULT CHARACTER SET utf8 ;
USE `projekt` ;
-- -----------------------------------------------------
-- Table `projekt`.`Lokacija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Lokacija` (
  `idLokacija` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `koordinati_od` VARCHAR(45) NOT NULL,
  `koordinati_do` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idLokacija`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projekt`.`Zgradba`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Zgradba` (
  `idZgradba` INT NOT NULL,
  `Lokacija_idLokacija` INT NOT NULL,
  `koordinati_od` VARCHAR(45) NOT NULL,
  `koordinati_do` VARCHAR(45) NOT NULL,
  `odprto_od` TIME NOT NULL,
  `odprto_do` TIME NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `funkcionalnost` VARCHAR(200) NOT NULL,
  `višina` FLOAT NULL,
  `št_nadstropij` INT NULL,
  PRIMARY KEY (`idZgradba`),
  INDEX `fk_Zgradba_Lokacija1_idx` (`Lokacija_idLokacija` ASC) VISIBLE,
  CONSTRAINT `fk_Zgradba_Lokacija1`
    FOREIGN KEY (`Lokacija_idLokacija`)
    REFERENCES `projekt`.`Lokacija` (`idLokacija`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projekt`.`Žival`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Žival` (
  `idŽival` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `starost` INT NULL,
  `tel` INT NOT NULL,
  `opis` VARCHAR(200) NOT NULL,
  `vrsta_živali` VARCHAR(20) NOT NULL,
  `pasma` VARCHAR(45) NOT NULL,
  `Zgradba_idZgradba` INT NOT NULL,
  PRIMARY KEY (`idŽival`),
  INDEX `fk_Žival_Zgradba1_idx` (`Zgradba_idZgradba` ASC) VISIBLE,
  CONSTRAINT `fk_Žival_Zgradba1`
    FOREIGN KEY (`Zgradba_idZgradba`)
    REFERENCES `projekt`.`Zgradba` (`idZgradba`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projekt`.`Priča`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Priča` (
  `idPriča` VARCHAR(45) NOT NULL,
  `Žival_idŽival` INT NOT NULL,
  `Lokacija_idLokacija` INT NOT NULL,
  `datum` DATETIME NOT NULL,
  `zap_št` INT NOT NULL,
  `koordinati` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPriča`, `Žival_idŽival`, `Lokacija_idLokacija`),
  INDEX `fk_Žival_has_Lokacija_Lokacija1_idx` (`Lokacija_idLokacija` ASC) VISIBLE,
  INDEX `fk_Žival_has_Lokacija_Žival_idx` (`Žival_idŽival` ASC) VISIBLE,
  CONSTRAINT `fk_Žival_has_Lokacija_Žival`
    FOREIGN KEY (`Žival_idŽival`)
    REFERENCES `projekt`.`Žival` (`idŽival`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Žival_has_Lokacija_Lokacija1`
    FOREIGN KEY (`Lokacija_idLokacija`)
    REFERENCES `projekt`.`Lokacija` (`idLokacija`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projekt`.`Cesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Cesta` (
  `idCesta` INT NOT NULL,
  `koordinati_od` VARCHAR(45) NOT NULL,
  `koordinati_do` VARCHAR(45) NOT NULL,
  `izbočenost` FLOAT NOT NULL,
  `širina` FLOAT NOT NULL,
  `dvosmerna` TINYINT(1) NOT NULL,
  `št_prehodov` INT NULL,
  `Lokacija_idLokacija` INT NOT NULL,
  PRIMARY KEY (`idCesta`),
  INDEX `fk_Cesta_Lokacija1_idx` (`Lokacija_idLokacija` ASC) VISIBLE,
  CONSTRAINT `fk_Cesta_Lokacija1`
    FOREIGN KEY (`Lokacija_idLokacija`)
    REFERENCES `projekt`.`Lokacija` (`idLokacija`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projekt`.`Krožišče`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projekt`.`Krožišče` (
  `idKrožišče` INT NOT NULL,
  `koordinati_od` VARCHAR(45) NOT NULL,
  `koordinati_do` VARCHAR(45) NOT NULL,
  `Lokacija_idLokacija` INT NOT NULL,
  PRIMARY KEY (`idKrožišče`),
  INDEX `fk_Krožišče_Lokacija1_idx` (`Lokacija_idLokacija` ASC) VISIBLE,
  CONSTRAINT `fk_Krožišče_Lokacija1`
  FOREIGN KEY (`Lokacija_idLokacija`)
  REFERENCES `projekt`.`Lokacija` (`idLokacija`)
  ON DELETE CASCADE
  ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;