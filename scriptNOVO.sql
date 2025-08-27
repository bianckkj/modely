-- MySQL Script corrigido
-- Model: Loja e Confecção de Roupas

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema modely
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `modely` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `modely`;

-- -----------------------------------------------------
-- Table `tb_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_agendamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_agendamento` (
  `id_agendamento` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `status` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_agendamento`),
  INDEX `id_cliente_idx` (`id_cliente` ASC),
  CONSTRAINT `fk_agendamento_cliente`
    FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_carrinho` (
  `id_carrinho` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  INDEX `id_cliente_idx` (`id_cliente` ASC),
  CONSTRAINT `fk_carrinho_cliente`
    FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_funcionario` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `cargo` VARCHAR(100) NOT NULL,
  `carga_horaria` DECIMAL(4,2) NOT NULL, -- Exemplo: 44.00 horas semanais
  `salario` DECIMAL(10,2) NOT NULL,
  `endereco` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NOT NULL,
  `material` VARCHAR(100) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `modelo` VARCHAR(100) NOT NULL,
  `cor` VARCHAR(50) NOT NULL,
  `tamanho` VARCHAR(50) NOT NULL,
  `marca` VARCHAR(50) NOT NULL,
  `imagem` VARCHAR(255) NOT NULL, -- caminho da imagem
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(250) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_vendas` (
  `id_vendas` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `comissao` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_vendas`),
  INDEX `id_cliente_idx` (`id_cliente` ASC),
  INDEX `id_funcionario_idx` (`id_funcionario` ASC),
  CONSTRAINT `fk_vendas_cliente`
    FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`),
  CONSTRAINT `fk_vendas_funcionario`
    FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id_funcionario`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_itens_vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_itens_vendas` (
  `id_vendas` INT NOT NULL,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id_vendas`, `id_produto`),
  INDEX `id_produto_idx` (`id_produto` ASC),
  CONSTRAINT `fk_itens_venda_venda`
    FOREIGN KEY (`id_vendas`) REFERENCES `tb_vendas` (`id_vendas`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_itens_venda_produto`
    FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id_produto`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `tb_itens_carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_itens_carrinho` (
  `id_carrinho` INT NOT NULL,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id_carrinho`, `id_produto`),
  INDEX `id_produto_idx` (`id_produto` ASC),
  CONSTRAINT `fk_itens_carrinho_carrinho`
    FOREIGN KEY (`id_carrinho`) REFERENCES `tb_carrinho` (`id_carrinho`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_itens_carrinho_produto`
    FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id_produto`)
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
