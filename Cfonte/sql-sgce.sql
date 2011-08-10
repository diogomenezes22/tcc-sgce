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
  `voluntario` TINYINT(1)  NOT NULL ,
  `prestacao_servico` VARCHAR(50) NOT NULL ,
  `nome` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(40) NOT NULL ,
  `senha` VARCHAR(20) NOT NULL ,
  `cpf` VARCHAR(11) NOT NULL ,
  `rg` VARCHAR(10) NULL ,
  `endereco` VARCHAR(60) NULL ,
  `numero` VARCHAR(7) NULL ,
  `complemento` VARCHAR(7) NULL ,
  `bairro` VARCHAR(20) NULL ,
  `cidade` VARCHAR(20) NULL ,
  `uf` VARCHAR(2) NULL ,
  `cep` VARCHAR(8) NULL ,
  `telefone` VARCHAR(10) NULL ,
  `celular` VARCHAR(10) NULL ,
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
  `nome` VARCHAR(45) NOT NULL ,
  `tipo` VARCHAR(30) NOT NULL ,
  `data_entrada` DATE NOT NULL ,
  `validade` DATE NOT NULL ,
  `usuario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_mantimentos_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_mantimentos_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cestas` ;

CREATE  TABLE IF NOT EXISTS `cestas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `quantidade` INT NOT NULL ,
  `saida` DATE NOT NULL ,
  `usuario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cestas_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_cestas_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
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
  `status` TINYINT(1)  NOT NULL ,
  `nome` VARCHAR(30) NOT NULL ,
  `cpf` VARCHAR(11) NULL ,
  `dt_nasc` DATE NOT NULL ,
  `endereco` VARCHAR(60) NOT NULL ,
  `numero` VARCHAR(7) NOT NULL ,
  `complemento` VARCHAR(7) NULL ,
  `bairro` VARCHAR(20) NOT NULL ,
  `referencia` VARCHAR(20) NULL ,
  `cidade` VARCHAR(20) NOT NULL ,
  `telefone` VARCHAR(10) NULL ,
  `escolaridade` VARCHAR(20) NULL ,
  `ocupacao` VARCHAR(40) NULL ,
  `trabalha` TINYINT(1)  NULL ,
  `companheiro` TINYINT(1)  NULL ,
  `dependente` TINYINT(1)  NULL ,
  `pai_mae` TINYINT(1)  NULL ,
  `renda_familia` DOUBLE NULL ,
  `renda_percapta` DOUBLE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `companheiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `companheiros` ;

CREATE  TABLE IF NOT EXISTS `companheiros` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(50) NOT NULL ,
  `escolaridade` VARCHAR(40) NOT NULL ,
  `profissao` VARCHAR(50) NOT NULL ,
  `ocupacao` VARCHAR(60) NOT NULL ,
  `trabalha` TINYINT(1)  NOT NULL ,
  `local_trabalho` VARCHAR(50) NULL ,
  `familia_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_companheiros_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_companheiros_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dependentes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dependentes` ;

CREATE  TABLE IF NOT EXISTS `dependentes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(30) NOT NULL ,
  `dt_nasc` DATE NOT NULL ,
  `parentesco` VARCHAR(10) NOT NULL ,
  `escolaridade` VARCHAR(20) NULL ,
  `escola` VARCHAR(30) NULL ,
  `manequim` VARCHAR(10) NOT NULL ,
  `ocupacao` VARCHAR(20) NOT NULL ,
  `renda` DOUBLE NULL ,
  `familia_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dependentes_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_dependentes_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `situacoes_nutricionais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `situacoes_nutricionais` ;

CREATE  TABLE IF NOT EXISTS `situacoes_nutricionais` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `peso` DOUBLE NULL ,
  `altura` DOUBLE NULL ,
  `situacao_nutricional` TINYINT(1)  NOT NULL ,
  `dependente_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_situacoes_nutricionais_dependentes1` (`dependente_id` ASC) ,
  CONSTRAINT `fk_situacoes_nutricionais_dependentes1`
    FOREIGN KEY (`dependente_id` )
    REFERENCES `dependentes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `questionarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `questionarios` ;

CREATE  TABLE IF NOT EXISTS `questionarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `qt_comodo` INT NULL ,
  `qt_banheiro` INT NULL ,
  `risco_terreno` TINYINT(1)  NULL ,
  `esgoto` TINYINT(1)  NULL ,
  `energia` TINYINT(1)  NULL ,
  `horta` TINYINT(1)  NULL ,
  `vulnerabilidade` VARCHAR(25) NULL ,
  `documento` TINYINT(1)  NULL ,
  `nome_nao_doc` VARCHAR(30) NULL ,
  `certidao_nasc` TINYINT(1)  NULL ,
  `nome_nao_certidao` VARCHAR(30) NULL ,
  `vacinacao` TINYINT(1)  NULL ,
  `nome_vacinacao` VARCHAR(30) NULL ,
  `dt_posto_saude` DATE NULL ,
  `frequencia_aula` TINYINT(1)  NULL ,
  `motivo_falta_aula` VARCHAR(70) NULL ,
  `idade_doente` INT NULL ,
  `tratamento` TINYINT(1)  NULL ,
  `cuidado_animal` TINYINT(1)  NULL ,
  `providencia_animal` VARCHAR(50) NULL ,
  `gravidez_adolescencia` TINYINT(1)  NULL ,
  `contraceptivo` TINYINT(1)  NULL ,
  `tipo_contraceptivo` VARCHAR(20) NULL ,
  `orientacao_medica` TINYINT(1)  NULL ,
  `acompanhamento_medico` DATE NULL ,
  `psicologia` TINYINT(1)  NULL ,
  `nome_necessitado` VARCHAR(30) NULL ,
  `motivo_psicologia` VARCHAR(45) NULL ,
  `dt_psicologia` DATE NULL ,
  `conselho` TINYINT(1)  NULL ,
  `nome_aconcelhado` VARCHAR(30) NULL ,
  `motivo_aconcelhado` VARCHAR(70) NULL ,
  `curso_tecnico` VARCHAR(45) NULL ,
  `fazer_curso_tecnico` VARCHAR(45) NULL ,
  `organizacao_comunitaria` VARCHAR(30) NULL ,
  `tipo_organizacao` VARCHAR(30) NULL ,
  `importancia_familia` TEXT NULL ,
  `oferecido_instituicao` TEXT NULL ,
  `bolsa_familia` TINYINT(1)  NULL ,
  `recebe_ajuda_outra_instituicao` TINYINT(1)  NULL ,
  `qual_instituicao` VARCHAR(30) NULL ,
  `observacao` TEXT NULL ,
  `emcasa` TINYINT(1)  NULL ,
  `familia_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_questionarios_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_questionarios_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `habitacionais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `habitacionais` ;

CREATE  TABLE IF NOT EXISTS `habitacionais` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aluguel` TINYINT(1)  NULL ,
  `casa_propria` TINYINT(1)  NULL ,
  `cedida` TINYINT(1)  NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_habitacionais_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_habitacionais_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `construcoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `construcoes` ;

CREATE  TABLE IF NOT EXISTS `construcoes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `alvenaria` TINYINT(1)  NULL ,
  `madeira` TINYINT(1)  NULL ,
  `outro` VARCHAR(20) NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_construcoes_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_construcoes_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `limpezas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `limpezas` ;

CREATE  TABLE IF NOT EXISTS `limpezas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `bom` TINYINT(1)  NULL ,
  `regular` TINYINT(1)  NULL ,
  `pessimo` TINYINT(1)  NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_limpezas_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_limpezas_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `doencas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `doencas` ;

CREATE  TABLE IF NOT EXISTS `doencas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `obesidade` TINYINT(1)  NULL ,
  `pressao_alta` TINYINT(1)  NULL ,
  `diabetes` TINYINT(1)  NULL ,
  `dependencia_quimica` TINYINT(1)  NULL ,
  `deficiencia_mental` TINYINT(1)  NULL ,
  `deficiencia_locomocao` TINYINT(1)  NULL ,
  `em_tratamento` TINYINT(1)  NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_doencas_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_doencas_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `animais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `animais` ;

CREATE  TABLE IF NOT EXISTS `animais` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cachorro` TINYINT(1)  NULL ,
  `gato` TINYINT(1)  NULL ,
  `galinha` TINYINT(1)  NULL ,
  `porco` TINYINT(1)  NULL ,
  `cabrito` TINYINT(1)  NULL ,
  `cavalo` TINYINT(1)  NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_animais_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_animais_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `equipamentos_sociais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `equipamentos_sociais` ;

CREATE  TABLE IF NOT EXISTS `equipamentos_sociais` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `saude` TINYINT(1)  NULL ,
  `lazer` TINYINT(1)  NULL ,
  `atencao_adolescente` TINYINT(1)  NULL ,
  `atencao_idoso` TINYINT(1)  NULL ,
  `creche` TINYINT(1)  NULL ,
  `ensino` VARCHAR(30) NULL ,
  `questionario_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_equipamentos_sociais_questionarios1` (`questionario_id` ASC) ,
  CONSTRAINT `fk_equipamentos_sociais_questionarios1`
    FOREIGN KEY (`questionario_id` )
    REFERENCES `questionarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cestas_familias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cestas_familias` ;

CREATE  TABLE IF NOT EXISTS `cestas_familias` (
  `cesta_id` INT NOT NULL ,
  `familia_id` INT NOT NULL ,
  PRIMARY KEY (`cesta_id`, `familia_id`) ,
  INDEX `fk_cestas_has_familias_familias1` (`familia_id` ASC) ,
  INDEX `fk_cestas_has_familias_cestas1` (`cesta_id` ASC) ,
  CONSTRAINT `fk_cestas_has_familias_cestas1`
    FOREIGN KEY (`cesta_id` )
    REFERENCES `cestas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cestas_has_familias_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mantimentos_cestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mantimentos_cestas` ;

CREATE  TABLE IF NOT EXISTS `mantimentos_cestas` (
  `cesta_id` INT NOT NULL ,
  `mantimento_id` INT NOT NULL ,
  PRIMARY KEY (`cesta_id`, `mantimento_id`) ,
  INDEX `fk_mantimentos_cestas_mantimentos1` (`mantimento_id` ASC) ,
  CONSTRAINT `fk_mantimentos_cestas_cestas1`
    FOREIGN KEY (`cesta_id` )
    REFERENCES `cestas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mantimentos_cestas_mantimentos1`
    FOREIGN KEY (`mantimento_id` )
    REFERENCES `mantimentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `frequencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `frequencias` ;

CREATE  TABLE IF NOT EXISTS `frequencias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(2) NOT NULL ,
  `data` DATE NOT NULL ,
  `familia_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_frequencias_familias1` (`familia_id` ASC) ,
  CONSTRAINT `fk_frequencias_familias1`
    FOREIGN KEY (`familia_id` )
    REFERENCES `familias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
