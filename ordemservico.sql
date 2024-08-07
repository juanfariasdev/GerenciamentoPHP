-- Criando o banco de dados
CREATE DATABASE IF NOT EXISTS `ordemservico`;
USE `ordemservico`;

-- Criando tabela `cliente`
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `perfil` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criando tabela `servico`
CREATE TABLE IF NOT EXISTS `servico` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criando tabela `terceirizado`
CREATE TABLE IF NOT EXISTS `terceirizado` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `status` int NOT NULL,
  `perfil` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criando tabela `ordem`
CREATE TABLE IF NOT EXISTS `ordem` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `cod_cliente` int NOT NULL,
  `cod_terceirizado` int NOT NULL,
  `cod_servico` int NOT NULL,
  `data_servico` date NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `foreign_key_cod_cliente` (`cod_cliente`),
  KEY `foreign_key_cod_servico` (`cod_servico`),
  KEY `foreign_key_cod_terceirizado` (`cod_terceirizado`),
  CONSTRAINT `foreign_key_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`),
  CONSTRAINT `foreign_key_cod_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servico` (`cod`),
  CONSTRAINT `foreign_key_cod_terceirizado` FOREIGN KEY (`cod_terceirizado`) REFERENCES `terceirizado` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Criando tabela `usuario`
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `perfil` int NOT NULL,
  `status` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserindo dados na tabela `cliente`
INSERT INTO `cliente` (`cod`, `nome`, `email`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `status`, `perfil`, `data`) VALUES
(1, 'Maria Silva', 'maria.silva@example.com', 'e10adc3949ba59abbe56e057f20f883e', '12345678', 'Rua das Flores', '123', 'Centro', 'Rio de Janeiro', 'RJ', '21987654321', 1, 1, '2023-08-01'),
(2, 'João Pereira', 'joao.pereira@example.com', 'e10adc3949ba59abbe56e057f20f883e', '87654321', 'Av. Brasil', '456', 'Zona Norte', 'São Paulo', 'SP', '21987654322', 1, 2, '2023-08-02');

-- Inserindo dados na tabela `servico`
INSERT INTO `servico` (`cod`, `nome`, `valor`, `data`) VALUES
(1, 'Serviço de Pintura', 150.00, '2023-08-01'),
(2, 'Serviço de Elétrica', 200.00, '2023-08-02');

-- Inserindo dados na tabela `terceirizado`
INSERT INTO `terceirizado` (`cod`, `nome`, `email`, `telefone`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `status`, `perfil`, `data`) VALUES
(1, 'Carlos Souza', 'carlos.souza@example.com', '21987654323', 'e10adc3949ba59abbe56e057f20f883e', '12345678', 'Rua das Palmeiras', '789', 'Centro', 'Rio de Janeiro', 'RJ', 1, 1, '2023-08-01'),
(2, 'Ana Oliveira', 'ana.oliveira@example.com', '21987654324', 'e10adc3949ba59abbe56e057f20f883e', '87654321', 'Av. das Américas', '101', 'Barra', 'Rio de Janeiro', 'RJ', 1, 2, '2023-08-02');

-- Inserindo dados na tabela `ordem`
INSERT INTO `ordem` (`cod_cliente`, `cod_terceirizado`, `cod_servico`, `data_servico`, `status`, `data`) VALUES
(1, 1, 1, '2023-08-05', 1, '2023-08-01'),
(2, 2, 2, '2023-08-06', 1, '2023-08-02');

-- Inserindo dados na tabela `usuario`
INSERT INTO `usuario` (`nome`, `senha`, `email`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `perfil`, `status`, `data`) VALUES
('Administrador', 'e10adc3949ba59abbe56e057f20f883e', 'admin@example.com', '12345678', 'Rua Admin', '1', 'Centro', 'São Paulo', 'SP', 1, 1, '2023-08-01'),
('Usuário', 'e10adc3949ba59abbe56e057f20f883e', 'user@example.com', '87654321', 'Av. User', '2', 'Zona Norte', 'Rio de Janeiro', 'RJ', 2, 1, '2023-08-02');
