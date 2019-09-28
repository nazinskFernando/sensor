-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 14-Set-2019 às 01:03
-- Versão do servidor: 5.6.41-84.1
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tedsu687_hidrometro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracaohidrometro`
--

CREATE TABLE `configuracaohidrometro` (
  `id` int(11) NOT NULL,
  `usuario_Id` int(11) NOT NULL,
  `hidrometro_Tag` varchar(50) NOT NULL,
  `valorHidrometroAtual` int(11) NOT NULL,
  `valorPulso` int(11) NOT NULL,
  `nomeHidrometro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracaohidrometro`
--

INSERT INTO `configuracaohidrometro` (`id`, `usuario_Id`, `hidrometro_Tag`, `valorHidrometroAtual`, `valorPulso`, `nomeHidrometro`) VALUES
(15, 7, '123a123', 1, 1, 'jhgkj'),
(20, 8, '123a123', 25899, 1000, 'Hidrometro 1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hidrometro`
--

CREATE TABLE `hidrometro` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `hidrometro`
--

INSERT INTO `hidrometro` (`id`, `tag`) VALUES
(1, 'ere3432323'),
(2, '123b123'),
(3, '123a123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicohidrometro`
--

CREATE TABLE `historicohidrometro` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `valorPulso` double NOT NULL,
  `dtPulso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicohidrometro`
--

INSERT INTO `historicohidrometro` (`id`, `usuario_id`, `tag`, `valorPulso`, `dtPulso`) VALUES
(1, 8, '123a123', 1, '2019-01-24 00:00:00'),
(2, 8, '123a123', 3, '2019-01-24 02:00:00'),
(3, 8, '123a123', 1, '2019-03-24 03:00:00'),
(4, 8, '123a123', 3, '2019-01-24 23:00:00'),
(5, 8, '123a123', 1, '2019-01-25 03:00:00'),
(6, 8, '123a123', 8, '2019-01-25 06:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dtUltimoLogin` datetime NOT NULL,
  `dtCadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nome`, `senha`, `status`, `dtUltimoLogin`, `dtCadastro`) VALUES
(6, 'teste@teste', 'teste', '111111', '', '0000-00-00 00:00:00', '2019-01-19 15:46:40'),
(7, 'fps.edhddeddddo@gmail.com', 'Ferndddddando', '111111', 'ativo', '0000-00-00 00:00:00', '2019-01-19 16:46:39'),
(8, 'c@1', 'Fernando Peixoto dos', '111111', '', '0000-00-00 00:00:00', '2019-01-19 16:57:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuracaohidrometro`
--
ALTER TABLE `configuracaohidrometro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hidrometro`
--
ALTER TABLE `hidrometro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historicohidrometro`
--
ALTER TABLE `historicohidrometro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuracaohidrometro`
--
ALTER TABLE `configuracaohidrometro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hidrometro`
--
ALTER TABLE `hidrometro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `historicohidrometro`
--
ALTER TABLE `historicohidrometro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
