-- Inserir clientes
INSERT INTO tb_cliente (nome, cpf, telefone, email, endereco) VALUES
('Carlos Silva', '111.222.333-44', '(11)91234-5678', 'carlos@email.com', 'Rua das Palmeiras, 150'),
('Ana Souza', '222.333.444-55', '(11)92345-6789', 'ana@email.com', 'Av. Brasil, 200'),
('João Lima', '333.444.555-66', '(11)93456-7890', 'joao@email.com', 'Rua das Flores, 78'),
('Maria Santos', '444.555.666-77', '(11)94567-8901', 'maria@email.com', 'Travessa Verde, 50'),
('Pedro Oliveira', '555.666.777-88', '(11)95678-9012', 'pedro@email.com', 'Alameda das Árvores, 300');

-- Inserir funcionários
INSERT INTO tb_funcionario (cpf, email, telefone, data_nascimento, carga_horaria, salario, endereco) VALUES
('777.888.999-00', 'func1@email.com', '(11)91200-0001', '1990-05-10', '08:00:00', 2500.00, 'Rua A, 100'),
('888.999.000-11', 'func2@email.com', '(11)91300-0002', '1988-09-15', '08:00:00', 3000.00, 'Rua B, 200'),
('999.000.111-22', 'func3@email.com', '(11)91400-0003', '1995-12-20', '06:00:00', 2200.00, 'Rua C, 300'),
('000.111.222-33', 'func4@email.com', '(11)91500-0004', '1992-03-30', '08:00:00', 2800.00, 'Rua D, 400'),
('111.222.333-44', 'func5@email.com', '(11)91600-0005', '1985-07-25', '07:00:00', 2600.00, 'Rua E, 500');

-- Inserir produtos
INSERT INTO tb_produto (quantidade, material, preco, modelo, cor, tamanho, marca, imagem) VALUES
('10', 'Algodão', 59.90, 'Camiseta Básica', 'Branco', 'M', 'MarcaX', 'Imagem1'),
('20', 'Jeans', 120.00, 'Calça Skinny', 'Azul', '42', 'MarcaY', 'Imagem2'),
('15', 'Couro', 250.00, 'Jaqueta', 'Preto', 'G', 'MarcaZ', 'Imagem3'),
('30', 'Poliéster', 80.00, 'Camisa Social', 'Azul Claro', 'P', 'MarcaW', 'Imagem4'),
('25', 'Lã', 150.00, 'Blusa de Frio', 'Cinza', 'M', 'MarcaQ', 'Imagem5');

-- Inserir usuários
INSERT INTO tb_usuario (nome, senha, email, endereco) VALUES
('Admin1', 'senha123', 'admin1@email.com', 'Rua do Sistema, 100'),
('Admin2', 'senha456', 'admin2@email.com', 'Rua do Sistema, 200'),
('Admin3', 'senha789', 'admin3@email.com', 'Rua do Sistema, 300'),
('Admin4', 'senhaabc', 'admin4@email.com', 'Rua do Sistema, 400'),
('Admin5', 'senhadef', 'admin5@email.com', 'Rua do Sistema, 500');

-- Inserir vendas
INSERT INTO tb_vendas (tb_cliente_id_cliente, tb_funcionario_id_funcionario, horario, data, comissao) VALUES
(1, 1, '10:30:00', '2025-07-01', 25.00),
(2, 2, '11:00:00', '2025-07-02', 30.00),
(3, 3, '15:45:00', '2025-07-03', 20.00),
(4, 4, '09:15:00', '2025-07-04', 28.00),
(5, 5, '12:00:00', '2025-07-05', 22.00);

-- Inserir itens da venda
INSERT INTO tb_itens_venda (tb_vendas_id_vendas, tb_produto_id_produto, quantidade) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 1),
(4, 4, 3),
(5, 5, 2);

-- Inserir itens do carrinho
INSERT INTO tb_itens_carrinho (tb_carrinho_id_carrinho, tb_produto_id_produto, quantidade) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 5, 2);
