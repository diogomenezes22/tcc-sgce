SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE  TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `status` TINYINT(1)  NOT NULL ,
  `perfil` VARCHAR(20) NOT NULL ,
  `prestacao_servico` VARCHAR(50) NOT NULL ,
  `nome` VARCHAR(60) NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `senha` VARCHAR(100) NOT NULL ,
  `cpf` VARCHAR(14) NOT NULL ,
  `rg` VARCHAR(10) NULL ,
  `endereco` VARCHAR(100) NULL ,
  `numero` VARCHAR(7) NULL ,
  `complemento` VARCHAR(7) NULL ,
  `bairro` VARCHAR(40) NULL ,
  `cidade` VARCHAR(40) NULL ,
  `uf` VARCHAR(2) NULL ,
  `cep` VARCHAR(10) NULL ,
  `telefone` VARCHAR(13) NULL ,
  `celular` VARCHAR(13) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logs` ;

CREATE  TABLE IF NOT EXISTS `logs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `data` DATETIME NOT NULL ,
  `descricao` VARCHAR(45) NULL ,
  `usuario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_logs_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_logs_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mantimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mantimentos` ;

CREATE  TABLE IF NOT EXISTS `mantimentos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tipo` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `quantidade` INT NOT NULL ,
  `medida` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estoques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estoques` ;

CREATE  TABLE IF NOT EXISTS `estoques` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `descricao` VARCHAR(120) NOT NULL ,
  `mantimento_id` INT NOT NULL ,
  `data_entrada` DATE NOT NULL ,
  `data_vencimento` DATE NOT NULL ,
  `data_saida` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_estoques_mantimentos1` (`mantimento_id` ASC) ,
  CONSTRAINT `fk_estoques_mantimentos1`
    FOREIGN KEY (`mantimento_id` )
    REFERENCES `mantimentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `familias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `familias` ;

CREATE  TABLE IF NOT EXISTS `familias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cidade` VARCHAR(50) NOT NULL ,
  `endereco` VARCHAR(200) NOT NULL ,
  `numero` VARCHAR(7) NOT NULL ,
  `complemento` VARCHAR(7) NULL ,
  `bairro` VARCHAR(20) NOT NULL ,
  `telefone` VARCHAR(13) NULL ,
  `referencia` VARCHAR(100) NULL ,
  `renda_familiar` FLOAT NULL ,
  `renda_percapta` FLOAT NULL ,
  `status` TINYINT(1)  NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cestas` ;

CREATE  TABLE IF NOT EXISTS `cestas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `data_gerado` DATETIME NOT NULL ,
  `familia_id` INT NULL ,
  `data_saida` DATE NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cestas_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_cestas_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `encontros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encontros` ;

CREATE  TABLE IF NOT EXISTS `encontros` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `data` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `questionarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `questionarios` ;

CREATE  TABLE IF NOT EXISTS `questionarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(45) NULL ,
  `descricao` TEXT NULL ,
  `parent_id` INT NULL ,
  `lft` INT NULL ,
  `rght` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `frequencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `frequencias` ;

CREATE  TABLE IF NOT EXISTS `frequencias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `encontro_id` INT NOT NULL ,
  `familia_id` INT NOT NULL ,
  `codigo` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_frequencias_encontros1` (`encontro_id` ASC) ,
  INDEX `fk_frequencias_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_frequencias_encontros1`
    FOREIGN KEY (`encontro_id` )
    REFERENCES `encontros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequencias_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `familias_questionarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `familias_questionarios` ;

CREATE  TABLE IF NOT EXISTS `familias_questionarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `familia_id` INT NOT NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `familia_id`, `questionario_id`) ,
  INDEX `fk_familias_has_questionarios_familias1` (`familia_id` ASC) ,
  INDEX `fk_familias_has_questionarios_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_familias_has_questionarios_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_familias_has_questionarios_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `pessoas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pessoas` ;

CREATE  TABLE IF NOT EXISTS `pessoas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `familia_id` INT NOT NULL ,
  `tipo` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `cpf` VARCHAR(14) NULL ,
  `telefone` VARCHAR(45) NULL ,
  `nascimento` DATE NULL ,
  `parentesco` VARCHAR(45) NULL ,
  `escolaridade` VARCHAR(45) NULL ,
  `estuda` TINYINT(1)  NOT NULL ,
  `nome_escola` VARCHAR(45) NULL ,
  `profissao` VARCHAR(45) NULL ,
  `trabalha` TINYINT(1)  NOT NULL ,
  `nome_empresa` VARCHAR(45) NULL ,
  `manequim` VARCHAR(45) NULL ,
  `situacao_nutricional` TINYINT(1)  NOT NULL ,
  `altura` DOUBLE NULL ,
  `peso` DOUBLE NULL ,
  `renda` FLOAT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pessoas_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_pessoas_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cestas_estoques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cestas_estoques` ;

CREATE  TABLE IF NOT EXISTS `cestas_estoques` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cesta_id` INT NOT NULL ,
  `estoque_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `cesta_id`, `estoque_id`) ,
  INDEX `fk_cestas_has_estoques_cestas1` (`cesta_id` ASC) ,
  INDEX `fk_cestas_has_estoques_estoques1` (`estoque_id` ASC) ,
  CONSTRAINT `fk_cestas_has_estoques_cestas1`
    FOREIGN KEY (`cesta_id` )
    REFERENCES `cestas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cestas_has_estoques_estoques1`
    FOREIGN KEY (`estoque_id` )
    REFERENCES `estoques` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `voluntarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `voluntarios` ;

CREATE  TABLE IF NOT EXISTS `voluntarios` (
  `id` INT NOT NULL ,
  `status` TINYINT(1)  NOT NULL ,
  `prestacao_servico` VARCHAR(50) NOT NULL ,
  `nome` VARCHAR(60) NOT NULL ,
  `email` VARCHAR(50) NULL ,
  `endereco` VARCHAR(100) NULL ,
  `complemento` VARCHAR(7) NULL ,
  `numero` VARCHAR(7) NULL ,
  `bairro` VARCHAR(40) NULL ,
  `cidade` VARCHAR(40) NULL ,
  `uf` VARCHAR(2) NULL ,
  `cep` VARCHAR(9) NULL ,
  `telefone` VARCHAR(13) NULL ,
  `celular` VARCHAR(13) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
