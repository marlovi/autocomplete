-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jul-2017 às 18:54
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
  `nome` varchar(400) NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) DEFAULT NULL,
  `cnpj` varchar(400) DEFAULT NULL,
  `endereco` varchar(400) DEFAULT NULL,
  `cidade` varchar(400) DEFAULT NULL,
  `estado` varchar(400) DEFAULT NULL,
  `telefone` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(44, 'CLIENTE 3', '005.722.964-36', '', 'RUA CLIENTE 3', 'TESTE', '', '', 'dsadsad@ssddsd'),
(45, 'CLIENTE 20', '007.482.621-21', '', 'DSADA', '', '', '', ''),
(48, 'teste veiculo', '111.111.111-11', '', 'dsadsa', 'dsad', 'dsad', '(22) 22222-2222', 'dsadas'),
(49, 'CLIENTE DEU RUIM', '', '11.111.111/1111-11', 'DSADAS', 'DDDD', '', '', 'DSASD'),
(50, 'a', 's', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio',
  `nome` varchar(400) NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) DEFAULT NULL,
  `cnpj` varchar(400) DEFAULT NULL,
  `endereco` varchar(400) DEFAULT NULL,
  `cidade` varchar(400) DEFAULT NULL,
  `estado` varchar(400) DEFAULT NULL,
  `telefone` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(5, 'EMPRESA 5', '555.555.555-55', NULL, 'SDSAD', 'DSAD', 'SDAD', '(22) 2222-2222', 'DSADSA'),
(7, 'EMPRESA 32', '', '22.222.222/2222-22', '', 'DSAD', 'DSA', '(33) 33333-3333', 'DSADASDASDADASDA'),
(8, 'teste', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id_fornecedor` int(11) NOT NULL COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio',
  `nome` varchar(400) NOT NULL COMMENT 'nom_clientes:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `cpf` varchar(400) DEFAULT NULL,
  `cnpj` varchar(400) DEFAULT NULL,
  `endereco` varchar(400) DEFAULT NULL,
  `cidade` varchar(400) DEFAULT NULL,
  `estado` varchar(400) DEFAULT NULL,
  `telefone` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id_fornecedor`, `nome`, `cpf`, `cnpj`, `endereco`, `cidade`, `estado`, `telefone`, `email`) VALUES
(2, 'FORNECEDOR 2', '005.323.213-21', '', 'TESTE', 'RIO VERDE', 'GO', '(33) 33333-3', 'SDADAdsaddsadas'),
(4, 'FORNECEDOR 233', '', '11.111.111/1111-11', 'DSADSADAD', 'DSADAS', 'DSADAS', '', ''),
(6, 'FORNECEDOR 444', '222.222.222-22', '', 'DSADASD', 'DSADSA', '', '', ''),
(7, 'FORNECEDOR', NULL, '33.333.333/3333-33', 'DSADASDA', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(400) NOT NULL,
  `codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`, `codigo`) VALUES
(1, 'SOJA', NULL),
(3, 'LARANJA', NULL),
(5, 'PRODUTO 2', NULL),
(7, 'JAO', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `placa` varchar(400) NOT NULL COMMENT 'placa_veiculos:\n-nao pode ter nome repetido no banco.\n-nao pode ser vazio',
  `descricao` varchar(400) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL COMMENT 'tipo_veiculos:\n-pode ser repetido no banco\n-nao pode ser vazio',
  `fornecedor_id_fornecedor` int(11) DEFAULT NULL,
  `cliente_id_cliente` int(11) DEFAULT NULL,
  `empresa_id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `placa`, `descricao`, `tipo`, `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa`) VALUES
(26, 'AAQ-1212', 'TESTE', 'TETETE', NULL, 44, NULL),
(29, 'AAA-3333', 'SDADSA', 'DSAD', 2, NULL, NULL),
(31, 'QQQ-3333', 'FDSFDS', 'FDSFS', NULL, 48, NULL),
(33, 'QQQ-3333', 'FDSF', 'FDSSFSD', NULL, NULL, NULL),
(34, 'EEE-3333', 'DSADSA', 'DSADAS', NULL, NULL, 5),
(35, 'RRR-3333', 'DSDSDS', 'FDFG', NULL, NULL, NULL),
(37, 'EEE-2222', 'DSDSAD', 'DSADSADS', NULL, 49, NULL),
(38, 'AAA-2121', 'DSDAS', 'DSADAS', 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nom_fornecedores_UNIQUE` (`nome`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `nom_fornecedores_UNIQUE` (`nome`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id_fornecedor`),
  ADD UNIQUE KEY `nom_fornecedores_UNIQUE` (`nome`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD UNIQUE KEY `Id_produto` (`id_produto`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`),
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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

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
