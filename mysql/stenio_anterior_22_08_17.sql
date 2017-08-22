-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Ago-2017 às 15:16
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stenio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio',
  `nome` varchar(400) COLLATE utf8_bin NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cnpj` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `endereco` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `estado` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(1, 'CLIENTE 1', '111.111.111-11', NULL, 'RUA 1', 'CIDADE 1', 'ESTADO 1', '(11) 11111-1111', 'SDASD@FSA.COOM'),
(2, 'CLIENTE 2', NULL, '11.111.111/1111-11', 'RUA 2', 'CIDADE 2', 'ESTADO 2', '(44) 44444-4444', 'SDSADADS@GMAIL.COM'),
(3, 'CLIENTE 3', NULL, '23.333.333/3333-33', 'RUA 3', 'CIDADE', 'ESTAD', '(21) 22222-2222', 'SDADASD@DMSM.COM'),
(4, 'CIDADE 4', '542.322.222-22', NULL, 'RUA 4', 'CIDADE 4', 'ESTADO 4', '(43) 21111-1132', 'DASDA@DSDAS,COM'),
(5, 'CLIENTE 5', '213.431.111-11', NULL, 'RUA 5', 'CIDADE 5', 'ESTADO 5', '(32) 31111-1111', 'SDADA@DSADSA.COM'),
(6, 'CLIEENTE', '000.111.111-11', NULL, 'DDSADS', NULL, NULL, NULL, NULL),
(7, 'CLIENTE23', '111.212.111-11', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio',
  `nome` varchar(400) COLLATE utf8_bin NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cnpj` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `endereco` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `estado` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(1, 'EMPRESA 1', '111.111.111-11', NULL, 'RUA 1', 'CIDADE 1', 'ESTADO 1', '(11) 11111-1111', 'DSADSAD@GMAIL.COM'),
(2, 'EMPRESA 2', '222.222.222-22', NULL, 'RUA 2', 'CIDADE 2', 'ESTADO 2', '(22) 22222-2222', 'EGASDDFA@GMAIL.C'),
(3, 'EMPRESA3', NULL, '33.333.333/3333-33', 'RUA 3', 'CIDADE 3', 'ESTADO 3', '(33) 33333-3333', 'TESTE@DSADSA'),
(4, 'EMPRESA 4', NULL, '44.444.444/4444-44', 'RUA 4', 'CIDADE 4', 'ESTADO 4', '(33) 3333-3333', 'SDSADSA@DASDSA.COM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio',
  `nome` varchar(400) COLLATE utf8_bin NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cnpj` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `endereco` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `estado` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(1, 'FORNECEDOR 1', '333.333.333-33', NULL, 'ERUA 1', 'CIDADE 1', 'ESTADO 2', '(34) 32432', 'SDSSADASD@DSDSADAS'),
(2, 'FORNECEDOR 2', NULL, '43.222.311/1111-11', 'RUA 2', 'CIDADE 2', 'ESTADO 2', '(43) 11200-0000', 'SDADA@DSADSA.COM'),
(3, 'FORNECEDOR 3', '324.050.111-11', NULL, 'RUA 3', 'CIDADE 3', 'ESTADO 3', '(43) 2330-0003', 'DASDAS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesagem`
--

CREATE TABLE `pesagem` (
  `id_pesagem` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 para pesagem de entrada1 para pesagem de saida2 para pesagem avulsa3 para pesagem manual',
  `placa` varchar(500) COLLATE utf8_bin NOT NULL,
  `data` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `motorista` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `fornecedor_id_fornecedor` int(11) DEFAULT NULL,
  `empresa_id_empresa` int(11) DEFAULT NULL,
  `produto_id_produto` int(11) DEFAULT NULL,
  `cliente_id_cliente` int(11) DEFAULT NULL,
  `veiculo_id_veiculo` int(11) DEFAULT NULL,
  `tipo_veiculo` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `peso_1` int(255) DEFAULT NULL,
  `peso_2` int(255) DEFAULT NULL,
  `peso_descontos` int(255) DEFAULT NULL,
  `peso_liquido` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `pesagem`
--

INSERT INTO `pesagem` (`id_pesagem`, `status`, `placa`, `data`, `motorista`, `fornecedor_id_fornecedor`, `empresa_id_empresa`, `produto_id_produto`, `cliente_id_cliente`, `veiculo_id_veiculo`, `tipo_veiculo`, `peso_1`, `peso_2`, `peso_descontos`, `peso_liquido`) VALUES
(28, 3, 'SOS-0000', '22/08/2017 14:16:35 ', 'EU', 1, NULL, 1, 1, NULL, 'TESTE1', 1000, 100, 10, 890),
(29, 3, 'AAA-2222', '22/08/2017 14:56:15 ', NULL, NULL, NULL, 7, NULL, NULL, NULL, 1222, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL COMMENT 'num_produto: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio\n',
  `nome` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'nom_produto:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`) VALUES
(1, 'PRODUTO 1'),
(2, 'PRODUTO 2'),
(3, 'PRODUTO 3'),
(4, 'PRODUTO 4'),
(5, 'DSA'),
(6, 'DSADSA'),
(7, 'TESTE3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `placa` varchar(400) COLLATE utf8_bin NOT NULL COMMENT 'placa_veiculos:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `descricao` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'tipo_veiculos:\n-pode ser repetido no banco\n-nao pode ser vazio',
  `motorista` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'motorista_veiculos:\n-pode ser repetido no banco\n-pode ser vazio',
  `fornecedor_id_fornecedor` int(11) DEFAULT NULL,
  `cliente_id_cliente` int(11) DEFAULT NULL,
  `empresa_id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `placa`, `descricao`, `tipo`, `motorista`, `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa`) VALUES
(1, 'AAA-1212', 'TESTE', 'MOTORISTA', NULL, NULL, NULL, 1),
(2, 'SSS-1212', 'TESTE', 'SSSAAA', NULL, NULL, NULL, 2),
(3, 'EEE-1212', 'TESTE', 'SSSAAA', NULL, NULL, NULL, 3),
(4, 'AAA-1222', 'FFDS', 'FSDF', NULL, NULL, 1, NULL),
(5, 'SDE-1111', 'TESTE', 'TESTETETE', NULL, NULL, 5, NULL),
(6, 'QWE-1212', 'TESTE', 'TETETES', NULL, 3, NULL, NULL),
(7, 'SOS-0000', 'TESTE', 'CAMINHÃƒO', NULL, NULL, 7, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Indexes for table `pesagem`
--
ALTER TABLE `pesagem`
  ADD PRIMARY KEY (`id_pesagem`),
  ADD KEY `fk_pesagem_fornecedor1_idx` (`fornecedor_id_fornecedor`),
  ADD KEY `fk_pesagem_empresa1_idx` (`empresa_id_empresa`),
  ADD KEY `fk_pesagem_cliente1_idx` (`cliente_id_cliente`),
  ADD KEY `fk_pesagem_veiculo1_idx` (`veiculo_id_veiculo`),
  ADD KEY `fk_pesagem_produto1_idx` (`produto_id_produto`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD UNIQUE KEY `id_veiculo_UNIQUE` (`id_veiculo`),
  ADD KEY `fk_veiculo_fornecedor1_idx` (`fornecedor_id_fornecedor`),
  ADD KEY `fk_veiculo_cliente1_idx` (`cliente_id_cliente`),
  ADD KEY `fk_veiculo_empresa1_idx` (`empresa_id_empresa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pesagem`
--
ALTER TABLE `pesagem`
  MODIFY `id_pesagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_produto: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio\n', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pesagem`
--
ALTER TABLE `pesagem`
  ADD CONSTRAINT `fk_pesagem_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesagem_empresa1` FOREIGN KEY (`empresa_id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesagem_fornecedor1` FOREIGN KEY (`fornecedor_id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesagem_produto1` FOREIGN KEY (`produto_id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pesagem_veiculo1` FOREIGN KEY (`veiculo_id_veiculo`) REFERENCES `veiculo` (`id_veiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_veiculo_cliente1` FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_veiculo_empresa1` FOREIGN KEY (`empresa_id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_veiculo_fornecedor1` FOREIGN KEY (`fornecedor_id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
