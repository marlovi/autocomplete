-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2018 às 21:49
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
(61, 'A22', '222.222.222-22', '', '', '', '', '', ''),
(62, 'A3', '333.333.333-33', '', '', '', '', '', ''),
(63, 'A4', '444.444.444-44', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'A6', '666.666.666-66', '', '', '', '', '', 'TESTE'),
(67, 'TESTE', '111.111.111-11', '', '', '', '', '', 'DADA'),
(68, 'A1', '323.222.233-33', NULL, 'TESTE', 'SDSA', 'DSS', '(33) 33333-33', 'DDASA'),
(69, 'A7', '122.222.222-22', NULL, 'DSADAS', 'DD', 'SDS', '(33) 333', 'DSADSA'),
(70, 'A8', NULL, '11.111.111/1111-11', 'DSADA', 'DSAD', 'DS', '(33) 33333-3322', 'DSDSA'),
(71, 'TESTESS', '555.555.555-55', NULL, 'TESTE', 'EE', 'GD', NULL, 'DSAS'),
(72, 'TESSSSSSSSS', NULL, '22.222.222/2222-22', 'DSAD', 'DAD', 'DSAD', '(33) 33333-3', 'DSAD'),
(73, 'EEE', '322.222.222-22', NULL, 'fdsfds', NULL, NULL, NULL, NULL);

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
(1, 'EMPRESA 1', '111.111.111-11', '', 'TESSTE', 'TESSSETE', 'SD', '(33) 33333-33', 'DSADSA');

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
(1, 'F1', '333.333.333-33', NULL, 'DSDSA', 'S33', 'SAS', '(23) 33333-3333', 'DASDASDS'),
(8, 'TESTE', '111.111.111-11', NULL, 'DDDDDDDDDSSSSSSSSSSSSS', 'fdfs', 'fdfd', '(43) 33333-3333', 'rerwerew'),
(9, 'JAO', '322.222.222-22', '', 'DSDS', 'DSDS', 'DD', '(33) 32222-2222', 'DADASDSA'),
(10, 'F2', '323.322.222-22', NULL, 'dsadsadsadsa', 'dsadsadsadsa', 'ds', '(33) 33333-33', 'dsdsdsadd'),
(11, 'F3', '332.222.222-22', NULL, 'ddssssssss', 'resss', 'gd', '(33) 2322-2222', 'dsasas'),
(12, 'F4', NULL, '33.222.222/2222-22', 'TESTE SSDSD', 'ASSDD', 'DS', '(33) 3333-3333', 'DSADAS'),
(13, 'F9', '433.333.333-33', NULL, 'FDSFSD', 'FDSFS', 'FDSFSD', '(44) 44444', 'FDSF'),
(14, 'TESTESS', '222.222.222-22', NULL, 'DSADSA', 'DSADA', 'D', '(33) 33333-3', 'DSDSADA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesagem`
--

CREATE TABLE `pesagem` (
  `id_pesagem` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 para pesagem de entrada1 para pesagem de saida2 para pesagem avulsa3 para pesagem manual',
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
  `peso_liquido` int(255) DEFAULT NULL,
  `observacao` varchar(1024) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `pesagem`
--

INSERT INTO `pesagem` (`id_pesagem`, `status`, `data`, `motorista`, `fornecedor_id_fornecedor`, `empresa_id_empresa`, `produto_id_produto`, `cliente_id_cliente`, `veiculo_id_veiculo`, `tipo_veiculo`, `peso_1`, `peso_2`, `peso_descontos`, `peso_liquido`, `observacao`) VALUES
(375, 0, '2018-03-05 14:10:33', 'TESTE 1', 1, NULL, 1, 61, 129, 'FDDS', 80, NULL, NULL, NULL, 'DSASD'),
(376, 1, '2018-03-05 14:12:09', 'DDA', 1, NULL, 1, 61, 129, 'FDDS', 80, 60, 0, 20, NULL),
(377, 0, '2018-03-05 14:13:14', 'SDADA', 12, NULL, 22, 63, 129, 'FDDS', 60, NULL, NULL, NULL, 'DA'),
(378, 1, '2018-03-05 14:13:53', 'DSADAS', 12, NULL, 22, 63, 129, 'FDDS', 60, 0, 0, 60, 'DSADA'),
(379, 3, '2018-03-05 14:14:53', 'TESTE', 13, NULL, 22, 63, 129, 'FDDS', 33222, 1222, 212, 31788, 'DSADA'),
(380, 2, '2018-03-05 14:15:31', 'DADA', 10, NULL, 20, 62, 129, 'FDDS', 0, 33233, NULL, 33233, 'DADA'),
(381, 0, '2018-03-05 14:16:10', 'DADA', 1, NULL, 22, 61, 129, 'FDDS', 0, NULL, NULL, NULL, 'DADASDS'),
(382, 1, '2018-03-05 14:16:45', 'DSDAS', 1, NULL, 22, 61, 129, 'FDDS', 0, 80, 0, 80, 'FDSFSDDSADA'),
(383, 0, '2018-03-05 14:19:05', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 60, NULL, NULL, NULL, 'dsada'),
(384, 0, '2018-03-05 14:19:51', 'asda', 12, NULL, 16, 65, 130, 'ASAS', 60, NULL, NULL, NULL, 'dasdas'),
(385, 0, '2018-03-05 14:20:25', 'dada', 13, NULL, 20, 69, 131, 'SSSS', 60, NULL, NULL, NULL, 'dada'),
(386, 1, '2018-03-05 14:21:22', 'dadas', 1, NULL, 20, 61, 129, 'FDDS', 60, 260, 0, 200, 'daasdds'),
(387, 1, '2018-03-05 14:22:06', 'dsada', 12, NULL, 16, 65, 130, 'ASAS', 60, 320, 0, 260, 'dsdasa'),
(388, 3, '2018-03-05 14:22:34', 'dada', 10, NULL, 4, 62, 131, 'SSSS', 33232, 222, 2, 33008, 'dada'),
(389, 2, '2018-03-05 14:23:27', 'dasda', 10, NULL, 20, 63, 131, 'SSSS', 320, 3323, NULL, 3003, 'dsada'),
(390, 1, '2018-03-05 14:24:00', 'dsada', 13, NULL, 20, 69, 131, 'SSSS', 60, 320, 0, 260, 'dasda'),
(391, 0, '2018-03-05 14:53:55', 'SASA', 8, NULL, 21, 67, 129, 'FDDS', 320, NULL, NULL, NULL, 'DSADA'),
(392, 1, '2018-03-06 13:16:44', 'TEST', 8, NULL, 21, 67, 129, 'FDDS', 320, 240, 0, 80, 'TESTE'),
(393, 0, '2018-03-06 13:19:33', 'dsadas', 1, NULL, 1, 61, 129, 'FDDS', 240, NULL, NULL, NULL, 'dsada'),
(394, 1, '2018-03-06 13:20:00', 'dad', 1, NULL, 1, 61, 129, 'FDDS', 240, 340, 0, 100, 'dsad'),
(395, 0, '2018-03-06 13:23:22', 'dada', 1, NULL, 20, 61, 130, 'ASAS', 320, NULL, NULL, NULL, 'dadas'),
(396, 1, '2018-03-06 13:23:59', 'dsada', 1, NULL, 20, 61, 130, 'ASAS', 320, 240, 0, 80, 'dadas'),
(397, 0, '2018-03-06 13:24:55', 'dsada', 1, NULL, 22, 61, 131, 'SSSS', 240, NULL, NULL, NULL, 'dasdas'),
(398, 1, '2018-03-06 13:25:19', 'ddas', 1, NULL, 22, 61, 131, 'SSSS', 240, 340, 0, 100, NULL),
(399, 0, '2018-03-06 13:26:44', 'dasda', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dasda'),
(400, 1, '2018-03-06 13:27:07', 'dasd', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dsada'),
(401, 0, '2018-03-06 13:28:01', 'dada', 10, NULL, 20, 61, 131, 'SSSS', 260, NULL, NULL, NULL, 'dada'),
(402, 1, '2018-03-06 13:28:29', 'da', 10, NULL, 20, 61, 131, 'SSSS', 260, 340, 0, 80, 'dada'),
(403, 0, '2018-03-06 13:30:32', 'dsada', 1, NULL, 20, 61, 131, 'SSSS', 320, NULL, NULL, NULL, 'dadasda'),
(404, 1, '2018-03-06 13:30:44', 'dsada', 1, NULL, 20, 61, 131, 'SSSS', 320, 260, 0, 60, 'dasdas'),
(405, 0, '2018-03-06 13:32:39', 'dasda', 1, NULL, 1, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dada'),
(406, 1, '2018-03-06 13:32:58', 'ada', 1, NULL, 1, 61, 129, 'FDDS', 260, 340, 0, 80, 'dada'),
(407, 0, '2018-03-06 13:33:35', 'fdsfs', 1, NULL, 1, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dada'),
(408, 1, '2018-03-06 13:34:05', 'dsada', 1, NULL, 1, 61, 129, 'FDDS', 320, 260, 0, 60, 'dadsa'),
(409, 0, '2018-03-06 13:34:28', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dasds'),
(410, 1, '2018-03-06 13:34:45', 'dadsa', 1, NULL, 20, 61, 129, 'FDDS', 260, 340, 0, 80, 'dadasda'),
(411, 0, '2018-03-06 13:36:03', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dadasdsa'),
(412, 1, '2018-03-06 13:36:21', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dasda'),
(413, 0, '2018-03-06 13:37:13', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 240, NULL, NULL, NULL, 'dsada'),
(414, 1, '2018-03-06 13:37:37', 'daa', 1, NULL, 20, 61, 129, 'FDDS', 240, 340, 0, 100, 'dad'),
(415, 0, '2018-03-06 13:39:27', 'dad', 10, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dsadadasds'),
(416, 1, '2018-03-06 13:39:42', 'dasda', 10, NULL, 20, 61, 129, 'FDDS', 320, 260, 0, 60, 'dasda'),
(417, 0, '2018-03-06 13:40:51', 'dsadas', 1, NULL, 20, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dsadad'),
(418, 1, '2018-03-06 13:41:05', 'dasda', 1, NULL, 20, 61, 129, 'FDDS', 260, 320, 0, 60, 'dasd'),
(419, 0, '2018-03-06 13:43:58', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dsad'),
(420, 1, '2018-03-06 13:44:20', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'daddsa'),
(421, 0, '2018-03-06 13:45:52', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 240, NULL, NULL, NULL, 'dasda'),
(422, 1, '2018-03-06 13:46:11', 'dasda', 1, NULL, 20, 61, 129, 'FDDS', 240, 340, 0, 100, 'dadasdada'),
(423, 0, '2018-03-06 13:46:55', 'das', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dada'),
(424, 1, '2018-03-06 13:47:14', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dadadasda'),
(425, 0, '2018-03-06 13:48:18', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dsad'),
(426, 1, '2018-03-06 13:48:51', 'dad', 1, NULL, 20, 61, 129, 'FDDS', 260, 320, 0, 60, 'dsada'),
(427, 0, '2018-03-06 13:49:49', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dsa'),
(428, 1, '2018-03-06 13:52:59', 'aaa', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dsa'),
(429, 0, '2018-03-06 13:55:15', 'dada', 1, NULL, 1, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dsaddsada'),
(430, 1, '2018-03-06 13:55:41', 'dasd', 1, NULL, 1, 61, 129, 'FDDS', 260, 320, 0, 60, 'dadadad'),
(431, 0, '2018-03-06 14:00:27', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dasda'),
(432, 1, '2018-03-06 14:01:05', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dadadada'),
(433, 0, '2018-03-06 14:08:12', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dsda'),
(434, 1, '2018-03-06 14:08:37', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 320, 260, 0, 60, 'dsa'),
(435, 0, '2018-03-06 14:10:32', 'dsad', 1, NULL, 20, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dsada'),
(436, 1, '2018-03-06 14:12:02', 'dsadas', 1, NULL, 20, 61, 129, 'FDDS', 260, 340, 0, 80, 'dsadada'),
(437, 0, '2018-03-06 14:14:31', 'dsadsa', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dsasd'),
(438, 1, '2018-03-06 14:15:01', 'dada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'sdada'),
(439, 0, '2018-03-06 14:16:25', 'dsada', 1, NULL, 20, 61, 129, 'FDDS', 240, NULL, NULL, NULL, 'dsada'),
(440, 1, '2018-03-06 14:17:28', 'dsads', 1, NULL, 20, 61, 129, 'FDDS', 240, 320, 0, 80, NULL),
(441, 0, '2018-03-06 14:23:46', 'dsadas', 1, NULL, 20, 61, 129, 'FDDS', 260, NULL, NULL, NULL, 'dsada'),
(442, 1, '2018-03-06 14:24:36', 'dasdas', 1, NULL, 20, 61, 129, 'FDDS', 260, 340, 0, 80, 'dsadada'),
(443, 0, '2018-03-06 14:26:04', 'dsads', 1, NULL, 20, 61, 129, 'FDDS', 320, NULL, NULL, NULL, 'dasdasdsada'),
(444, 1, '2018-03-06 14:26:31', 'dsadada', 1, NULL, 20, 61, 129, 'FDDS', 320, 240, 0, 80, 'dsadadada'),
(445, 0, '2018-03-06 17:24:06', 'teste', 1, NULL, 1, 61, 129, 'FDDS', 260, NULL, NULL, NULL, NULL),
(446, 1, '2018-03-06 17:28:41', 'dsdsa', 1, NULL, 1, 61, 129, 'FDDS', 260, 340, 0, 80, 'fdfs'),
(447, 0, '2018-03-08 12:53:59', 'dsad', 1, NULL, 20, 62, 129, 'FDDS', 220, NULL, NULL, NULL, 'dsadadsada'),
(448, 3, '2018-03-13 21:48:56', 'dsadsa', 1, NULL, 20, 61, 130, 'ASAS', 23220, 12320, 12, 10888, 'teste casa do caralho'),
(449, 3, '2018-03-13 21:49:42', 'dasdsa', 1, NULL, 20, 61, 129, 'FDDS', 33200, 10980, NULL, 22220, 'ddsa'),
(450, 3, '2018-03-13 21:50:52', 'asdsa', 1, NULL, 20, 61, 131, 'SSSS', 21, 11, NULL, 10, 'dsad'),
(451, 3, '2018-03-13 21:50:56', 'asdsa', 1, NULL, 20, 61, 131, 'SSSS', 21, 11, NULL, 10, 'dsad'),
(452, 3, '2018-03-13 21:51:00', 'asdsa', 1, NULL, 20, 61, 131, 'SSSS', 21, 11, NULL, 10, 'dsad'),
(453, 3, '2018-03-13 21:51:00', 'asdsa', 1, NULL, 20, 61, 131, 'SSSS', 21, 11, NULL, 10, 'dsad'),
(454, 3, '2018-05-14 22:10:53', 'fdassads', 1, NULL, 1, 61, 129, 'FDDS', 2222, 1111, 21, 1090, 'dsdsa');

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
(4, 'PRODUTO 4'),
(9, 'PRODUTO 14'),
(10, 'PRODUTO 13'),
(16, 'PRODUTO 5'),
(17, 'PRODUTO 2'),
(18, 'PRODUTO 3'),
(19, 'PRODUTO 6'),
(20, 'A1'),
(21, 'TESTE'),
(22, 'AAAAAASSS'),
(23, 'SSAAASSS');

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
(109, 'CCC-1111', 'DSDS', 'SSSS', NULL, NULL, 62, NULL),
(110, 'CCC-2222', 'DSDS', 'DDDDD', NULL, NULL, 62, NULL),
(111, 'CCC-3333', 'DSD', 'DSDS', NULL, NULL, 62, NULL),
(113, 'DDD-1111', 'SDDSA', 'DSA', NULL, NULL, 63, NULL),
(118, 'BBB-2222', 'DDDS', 'DSDS', NULL, NULL, 61, NULL),
(129, 'AAA-1111', 'TESTE', 'FDDS', NULL, 11, NULL, NULL),
(130, 'AAA-2222', 'DDDSSS', 'ASAS', NULL, 11, NULL, NULL),
(131, 'AAA-3333', 'DSDDD', 'SSSS', NULL, 11, NULL, NULL),
(132, 'BBB-1111', 'DSADSA', '1212', NULL, 12, NULL, NULL),
(133, 'BBB-3333', 'DSDSADA', 'DDDDD', NULL, 12, NULL, NULL),
(134, '', '', '', NULL, NULL, NULL, 1),
(135, 'ASD-1111', 'TESTE', 'STESTE', NULL, NULL, 67, NULL),
(136, 'CCC-3344', 'TRDTR', 'FDSF', NULL, NULL, 61, NULL),
(137, 'ABC-1111', 'DTESTE', 'TEE', NULL, NULL, 69, NULL),
(138, 'QQQ-2222', 'DSDS', 'DSDS', NULL, NULL, 71, NULL),
(139, 'SSS-3333', 'DSAD', 'DSAD', NULL, 14, NULL, NULL),
(140, 'SSS-2333', 'DSDS', 'DSADAS', NULL, 14, NULL, NULL),
(141, 'EWW-3333', 'DSDS', 'DSDS', NULL, NULL, 72, NULL);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_clientes: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pesagem`
--
ALTER TABLE `pesagem`
  MODIFY `id_pesagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=455;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'num_produto: \n-deve ser sequencial ao ultimo numero \nexistente no banco de dados. \n-nao pode ter numero repetido.\n-nao pode ser vazio\n', AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
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
