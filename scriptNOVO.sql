-- Script corrigido do banco de dados `modely`
-- Ajustes feitos:
-- - Corrigido tipo de `quantidade` em `tb_produto` para INT
-- - Corrigido `preco` para DECIMAL(10,2)
-- - Ajustado `cpf` e `telefone` para tamanhos mais adequados
-- - Corrigido `carga_horaria` de TIME para INT
-- - Ajustado tamanho de `imagem` para 255
-- - Adicionados UNIQUE em campos importantes
-- - ON DELETE CASCADE em relacionamentos críticos
-- - Alterado COLLATE para utf8mb4_unicode_ci (compatível com MySQL < 8.0)

CREATE SCHEMA IF NOT EXISTS `modely` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `modely`;

-- Clientes
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` CHAR(14) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `endereco` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Funcionários
CREATE TABLE IF NOT EXISTS `tb_funcionario` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `cpf` CHAR(14) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `carga_horaria` INT NOT NULL, -- em horas
  `salario` DECIMAL(10,2) NOT NULL,
  `endereco` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `cpf_UNIQUE_func` (`cpf`),
  UNIQUE KEY `email_UNIQUE_func` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Produtos
CREATE TABLE IF NOT EXISTS `tb_produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NOT NULL,
  `material` VARCHAR(45) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `modelo` VARCHAR(100) NOT NULL,
  `cor` VARCHAR(100) NOT NULL,
  `tamanho` VARCHAR(50) NOT NULL,
  `marca` VARCHAR(50) NOT NULL,
  `imagem` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuários (para login/sistema)
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(250) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `endereco` VARCHAR(300) NOT NULL,
  `tipo` CHAR(1) NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_UNIQUE_user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Agendamentos
CREATE TABLE IF NOT EXISTS `tb_agendamento` (
  `id_agendamento` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `data` DATE NOT NULL,
  `horario` TIME NOT NULL,
  `status` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_agendamento`),
  CONSTRAINT `fk_agendamento_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Carrinho
CREATE TABLE IF NOT EXISTS `tb_carrinho` (
  `id_carrinho` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  CONSTRAINT `fk_carrinho_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Itens do carrinho
CREATE TABLE IF NOT EXISTS `tb_itens_carrinho` (
  `id_carrinho` INT NOT NULL,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id_carrinho`, `id_produto`),
  CONSTRAINT `fk_item_carrinho` FOREIGN KEY (`id_carrinho`) REFERENCES `tb_carrinho` (`id_carrinho`) ON DELETE CASCADE,
  CONSTRAINT `fk_item_produto_carrinho` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id_produto`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Vendas
CREATE TABLE IF NOT EXISTS `tb_vendas` (
  `id_vendas` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `horario` TIME NOT NULL,
  `data` DATE NOT NULL,
  `comissao` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_vendas`),
  CONSTRAINT `fk_vendas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE RESTRICT,
  CONSTRAINT `fk_vendas_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tb_funcionario` (`id_funcionario`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Itens de venda
CREATE TABLE IF NOT EXISTS `tb_itens_vendas` (
  `id_vendas` INT NOT NULL,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`id_vendas`, `id_produto`),
  CONSTRAINT `fk_item_venda` FOREIGN KEY (`id_vendas`) REFERENCES `tb_vendas` (`id_vendas`) ON DELETE CASCADE,
  CONSTRAINT `fk_item_produto_venda` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id_produto`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
