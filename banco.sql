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



-- ==============================
-- Tabela: tb_cliente
-- ==============================
INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES
('Bianca Oliveira', '111.111.111-11', '(11) 99999-1111', 'bianca@email.com', 'Rua das Flores, 100'),
('Marcos Silva', '222.222.222-22', '(11) 98888-2222', 'marcos@email.com', 'Av. Paulista, 200'),
('Ana Souza', '333.333.333-33', '(21) 97777-3333', 'ana@email.com', 'Rua do Sol, 50'),
('Carlos Mendes', '444.444.444-44', '(31) 96666-4444', 'carlos@email.com', 'Rua Minas, 123'),
('Julia Santos', '555.555.555-55', '(41) 95555-5555', 'julia@email.com', 'Av. Brasil, 1500');

-- ==============================
-- Tabela: tb_funcionario
-- ==============================
INSERT INTO tb_funcionario (cpf, email, telefone, data_nascimento, carga_horaria, salario, endereco) VALUES
('666.666.666-66', 'func1@email.com', '(11) 91111-6666', '1990-05-10', 8, 2500.00, 'Rua Verde, 10'),
('777.777.777-77', 'func2@email.com', '(11) 92222-7777', '1985-09-12', 8, 3000.00, 'Rua Azul, 20'),
('888.888.888-88', 'func3@email.com', '(21) 93333-8888', '1992-11-25', 6, 1800.00, 'Rua Amarela, 30'),
('999.999.999-99', 'func4@email.com', '(31) 94444-9999', '1995-01-05', 8, 2200.00, 'Rua Preta, 40'),
('101.010.101-01', 'func5@email.com', '(41) 95555-1010', '1980-07-18', 4, 1500.00, 'Rua Branca, 50');

-- ==============================
-- Tabela: tb_usuario
-- ==============================
INSERT INTO tb_usuario (nome, senha, email, endereco, tipo) VALUES
('Admin', '123456', 'admin@email.com', 'Av. Central, 1', 'A'),
('Cliente1', 'senha1', 'cli1@email.com', 'Rua A, 2', 'C'),
('Cliente2', 'senha2', 'cli2@email.com', 'Rua B, 3', 'C'),
('Funcionario1', 'senha3', 'func1@email.com', 'Rua C, 4', 'F'),
('Funcionario2', 'senha4', 'func2@email.com', 'Rua D, 5', 'F');

-- ==============================
-- Tabela: tb_produto
-- ==============================
INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES
(50, 'Algodão', 79.90, 'Camiseta Básica', 'Preta', 'M', 'Modely', 'camiseta_preta.jpg'),
(30, 'Jeans', 129.90, 'Calça Skinny', 'Azul', '42', 'Modely', 'calca_jeans.jpg'),
(20, 'Couro', 199.90, 'Jaqueta', 'Marrom', 'G', 'Modely', 'jaqueta.jpg'),
(100, 'Poliéster', 59.90, 'Short Esportivo', 'Cinza', 'M', 'Modely', 'short.jpg'),
(15, 'Lã', 249.90, 'Blusa de Frio', 'Vermelha', 'P', 'Modely', 'blusa_frio.jpg');

-- ==============================
-- Tabela: tb_agendamento
-- ==============================
INSERT INTO tb_agendamento (id_cliente, data, horario, status) VALUES
(1, '2025-09-20', '10:00:00', 'Confirmado'),
(2, '2025-09-21', '11:00:00', 'Pendente'),
(3, '2025-09-22', '15:00:00', 'Cancelado'),
(4, '2025-09-23', '09:30:00', 'Confirmado'),
(5, '2025-09-24', '14:00:00', 'Confirmado');

-- ==============================
-- Tabela: tb_carrinho
-- ==============================
INSERT INTO tb_carrinho (id_cliente) VALUES
(1), (2), (3), (4), (5);

-- ==============================
-- Tabela: tb_itens_carrinho
-- ==============================
INSERT INTO tb_itens_carrinho (id_carrinho, id_produto, quantidade) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 2),
(5, 5, 1);

-- ==============================
-- Tabela: tb_vendas
-- ==============================
INSERT INTO tb_vendas (id_cliente, id_funcionario, horario, data, comissao) VALUES
(1, 1, '14:00:00', '2025-09-10', 50.00),
(2, 2, '15:30:00', '2025-09-11', 30.00),
(3, 3, '16:00:00', '2025-09-12', 40.00),
(4, 4, '17:00:00', '2025-09-13', 25.00),
(5, 5, '18:00:00', '2025-09-14', 60.00);

-- ==============================
-- Tabela: tb_itens_vendas
-- ==============================
INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 1),
(3, 4, 3),
(4, 5, 1);

