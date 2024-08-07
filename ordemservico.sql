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

-- Copiando estrutura para tabela ordemservico.usuario
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
(4, 'Danilo Alves Alvarenga', 'danilo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '37950000', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', 'MG', '(35) 99984-9594', 1, 2, '2022-07-22'),
(5, 'Mariany Alves', 'mary@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '37950000', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', 'MG', '(35) 99984-9594', 1, 2, '2022-07-22');

-- Inserindo dados na tabela `ordem`
INSERT INTO `ordem` (`cod`, `cod_cliente`, `cod_terceirizado`, `cod_servico`, `data_servico`, `status`, `data`) VALUES
(10, 5, 8, 5, '2022-07-16', 2, '2022-07-15'),
(11, 4, 7, 4, '2022-07-17', 1, '2022-07-14'),
(12, 5, 8, 5, '2022-07-21', 3, '2022-07-15'),
(13, 4, 7, 4, '2022-07-19', 1, '2022-07-15');

-- Inserindo dados na tabela `servico`
INSERT INTO `servico` (`cod`, `nome`, `valor`, `data`) VALUES
(4, 'Lavar Carro', '50', '2022-07-14'),
(5, 'Limpar Piscina', '70', '2022-07-14');

-- Inserindo dados na tabela `terceirizado`
INSERT INTO `terceirizado` (`cod`, `nome`, `email`, `telefone`, `senha`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `status`, `perfil`, `data`) VALUES
(7, 'Dalyla Alvarenga', 'dalylalvarenga@gmail.com', '(35) 99984-9594', 'e10adc3949ba59abbe56e057f20f883e', '37950000', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', 'MG', 1, 3, '2022-07-15'),
(8, 'Maria Aparecida', 'maria@gmail.com', '(35) 99984-9594', 'e10adc3949ba59abbe56e057f20f883e', '37950000', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', 'MG', 1, 3, '2022-07-14');

-- Inserindo dados na tabela `usuario`
INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `uf`, `perfil`, `status`, `data`) VALUES
(25, 'Fábio Junior Alves', 'e10adc3949ba59abbe56e057f20f883e', 'faguanil@gmail.com', '37950000', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', 'MG', 1, 1, '2022-07-15'),
(26, 'Juliana Costa', 'e10adc3949ba59abbe56e057f20f883e', 'juliana@gmail.com', '37950000', 'Rua das Flores', '100', 'Jardim das Flores', 'Aguanil', 'MG', 2, 1, '2022-07-16'),
(27, 'Carlos Silva', 'e10adc3949ba59abbe56e057f20f883e', 'carlos@gmail.com', '37950000', 'Rua das Acácias', '250', 'Jardim Acácia', 'Aguanil', 'MG', 3, 2, '2022-07-17'),
(28, 'Ana Paula', 'e10adc3949ba59abbe56e057f20f883e', 'ana@gmail.com', '37950000', 'Rua das Palmeiras', '450', 'Jardim Palmeiras', 'Aguanil', 'MG', 1, 2, '2022-07-18');