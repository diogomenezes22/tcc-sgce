SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estados` ;

CREATE  TABLE IF NOT EXISTS `estados` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL COMMENT 'nome do estado por extenso' ,
  `uf` VARCHAR(2) NOT NULL COMMENT 'sigla do estado' ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `i_nome` (`nome` ASC) ,
  UNIQUE INDEX `i_sigla` (`uf` ASC) ,
  INDEX `i_modified` (`modified` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cidades` ;

CREATE  TABLE IF NOT EXISTS `cidades` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL COMMENT 'nome da cidade' ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `estado_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) ,
  INDEX `i_modified` (`modified` ASC) ,
  INDEX `fk_cidades_estados1` (`estado_id` ASC) ,
  CONSTRAINT `fk_cidades_estados1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `estados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'Tabela que contém todas as cidades do brasil' ;


-- -----------------------------------------------------
-- Table `clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clientes` ;

CREATE  TABLE IF NOT EXISTS `clientes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aniversario` VARCHAR(4) NOT NULL ,
  `nome` VARCHAR(60) NOT NULL ,
  `endereco` VARCHAR(60) NULL ,
  `bairro` VARCHAR(45) NOT NULL ,
  `cep` VARCHAR(8) NOT NULL ,
  `telefone` VARCHAR(13) NOT NULL ,
  `celular` VARCHAR(45) NULL ,
  `email` VARCHAR(90) NOT NULL ,
  `obs` VARCHAR(45) NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `cidade_id` INT NOT NULL DEFAULT 2302 ,
  `estado_id` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) ,
  INDEX `i_email` (`email` ASC) ,
  INDEX `i_modified` (`modified` ASC) ,
  INDEX `i_endereco` (`endereco` ASC) ,
  INDEX `i_tel` (`celular` ASC, `telefone` ASC) ,
  INDEX `fk_clientes_cidades1` (`cidade_id` ASC) ,
  INDEX `fk_clientes_estados1` (`estado_id` ASC) ,
  CONSTRAINT `fk_clientes_cidades1`
    FOREIGN KEY (`cidade_id` )
    REFERENCES `cidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_estados1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `estados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'tabela de clientes' ;


-- -----------------------------------------------------
-- Table `grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `grupos` ;

CREATE  TABLE IF NOT EXISTS `grupos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `i_nome` (`nome` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'grupos de usuários' ;


-- -----------------------------------------------------
-- Table `clientes_grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clientes_grupo` ;

CREATE  TABLE IF NOT EXISTS `clientes_grupo` (
  `cliente_id` INT NOT NULL ,
  `grupo_id` INT NOT NULL ,
  PRIMARY KEY (`cliente_id`, `grupo_id`) ,
  INDEX `fk_clientes_has_grupos_grupos1` (`grupo_id` ASC) ,
  INDEX `fk_clientes_has_grupos_clientes1` (`cliente_id` ASC) ,
  CONSTRAINT `fk_clientes_has_grupos_clientes1`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_has_grupos_grupos1`
    FOREIGN KEY (`grupo_id` )
    REFERENCES `grupos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'Tabela de relacionamentos com clientes e grupos' ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
