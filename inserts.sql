-- Inserindo clientes
INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES
('Bianca Oliveira', '123.456.789-00', '(11) 99999-1111', 'bianca@email.com', 'Rua das Flores, 100'),
('Marcos Silva', '987.654.321-00', '(11) 98888-2222', 'marcos@email.com', 'Av. Paulista, 200'),
('Ana Costa', '111.222.333-44', '(11) 97777-3333', 'ana@email.com', 'Rua Central, 300');

-- Inserindo funcionários
INSERT INTO tb_funcionario (nome, cpf, email, telefone, data_nascimento, cargo, carga_horaria, salario, endereco) VALUES
('João Santos', '555.666.777-88', 'joao@email.com', '(11) 96666-4444', '1990-05-10', 'Vendedor', 44.00, 2500.00, 'Rua A, 10'),
('Carla Pereira', '999.888.777-66', 'carla@email.com', '(11) 95555-5555', '1988-03-22', 'Gerente', 44.00, 4500.00, 'Rua B, 20');

-- Inserindo produtos
INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES
(50, 'Algodão', 79.90, 'Camiseta Básica', 'Preta', 'M', 'Modely', 'img/camiseta_preta.jpg'),
(30, 'Jeans', 129.90, 'Calça Skinny', 'Azul', '38', 'Modely', 'img/calca_jeans.jpg'),
(20, 'Couro Sintético', 199.90, 'Jaqueta', 'Marrom', 'G', 'Modely', 'img/jaqueta.jpg');

-- Inserindo usuários (exemplo: clientes com login)
INSERT INTO tb_usuario (nome, senha, email, endereco) VALUES
('Bianca Oliveira', '12345', 'bianca@email.com', 'Rua das Flores, 100'),
('Marcos Silva', '12345', 'marcos@email.com', 'Av. Paulista, 200');

-- Inserindo carrinho para clientes
INSERT INTO tb_carrinho (id_cliente) VALUES
(1), (2);

-- Inserindo itens no carrinho
INSERT INTO tb_itens_carrinho (id_carrinho, id_produto, quantidade) VALUES
(1, 1, 2), -- Cliente 1 comprando 2 camisetas
(1, 2, 1), -- Cliente 1 comprando 1 calça
(2, 3, 1); -- Cliente 2 comprando 1 jaqueta

-- Inserindo agendamento
INSERT INTO tb_agendamento (id_cliente, data_hora, status) VALUES
(1, '2025-08-30 14:00:00', 'Confirmado'),
(2, '2025-08-31 10:30:00', 'Pendente');

-- Inserindo vendas
INSERT INTO tb_vendas (id_cliente, id_funcionario, data_hora, comissao) VALUES
(1, 1, '2025-08-27 15:00:00', 25.00),
(2, 2, '2025-08-27 16:00:00', 50.00);

-- Inserindo itens das vendas
INSERT INTO tb_itens_vendas (id_vendas, id_produto, quantidade) VALUES
(1, 1, 2), -- Venda 1: 2 camisetas
(1, 2, 1), -- Venda 1: 1 calça
(2, 3, 1); -- Venda 2: 1 jaqueta
