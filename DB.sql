-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Fev 05, 2014 as 05:50 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `dailyhelper`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowcategories`
--

CREATE TABLE IF NOT EXISTS `cashflowcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryTypeId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `cashflowcategories`
--

INSERT INTO `cashflowcategories` (`id`, `categoryName`, `categoryTypeId`, `userid`) VALUES
(1, 'Vendas', 2, 1),
(2, 'Imovel', 1, 1),
(3, 'Teste', 2, 1),
(4, 'Teste', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowcategorytypes`
--

CREATE TABLE IF NOT EXISTS `cashflowcategorytypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cashflowcategorytypes`
--

INSERT INTO `cashflowcategorytypes` (`id`, `name`) VALUES
(1, 'expense'),
(2, 'income');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowexpenses`
--

CREATE TABLE IF NOT EXISTS `cashflowexpenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expenseName` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `jan` decimal(10,2) NOT NULL,
  `fev` decimal(10,2) NOT NULL,
  `mar` decimal(10,2) NOT NULL,
  `abr` decimal(10,2) NOT NULL,
  `mai` decimal(10,2) NOT NULL,
  `jun` decimal(10,2) NOT NULL,
  `jul` decimal(10,2) NOT NULL,
  `ago` decimal(10,2) NOT NULL,
  `set` decimal(10,2) NOT NULL,
  `out` decimal(10,2) NOT NULL,
  `nov` decimal(10,2) NOT NULL,
  `dez` decimal(10,2) NOT NULL,
  `ano` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cashflowexpenses`
--

INSERT INTO `cashflowexpenses` (`id`, `expenseName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`) VALUES
(1, 'IPTU', 0, 1, '5.00', '12.00', '123.00', '14.56', '16.00', '12.45', '45.65', '930.25', '930.25', '930.25', '930.25', '4.00', '2014'),
(2, 'Testeeeeewwwwwwwwwwww', 0, 1, '2.00', '34.00', '12.33', '12.33', '12.33', '12.33', '12.33', '12.33', '12.33', '12.33', '12.33', '12.33', '2014');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowincome`
--

CREATE TABLE IF NOT EXISTS `cashflowincome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incomeName` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `jan` decimal(10,2) NOT NULL,
  `fev` decimal(10,2) NOT NULL,
  `mar` decimal(10,2) NOT NULL,
  `abr` decimal(10,2) NOT NULL,
  `mai` decimal(10,2) NOT NULL,
  `jun` decimal(10,2) NOT NULL,
  `jul` decimal(10,2) NOT NULL,
  `ago` decimal(10,2) NOT NULL,
  `set` decimal(10,2) NOT NULL,
  `out` decimal(10,2) NOT NULL,
  `nov` decimal(10,2) NOT NULL,
  `dez` decimal(10,2) NOT NULL,
  `ano` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cashflowincome`
--

INSERT INTO `cashflowincome` (`id`, `incomeName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`) VALUES
(1, 'XBOX', 0, 1, '10.00', '45.00', '123.00', '12.34', '12.45', '10.00', '7689.00', '15.00', '856.00', '85.12', '12.34', '12.45', '2014'),
(2, 'PS3', 0, 1, '10.00', '99999.99', '99999.99', '25.00', '99999.99', '1000.00', '15.00', '15.00', '75.00', '15.00', '15.00', '12.00', '2014');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowsaldo`
--

CREATE TABLE IF NOT EXISTS `cashflowsaldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `jan` decimal(10,2) NOT NULL,
  `fev` decimal(10,2) NOT NULL,
  `mar` decimal(10,2) NOT NULL,
  `abr` decimal(10,2) NOT NULL,
  `mai` decimal(10,2) NOT NULL,
  `jun` decimal(10,2) NOT NULL,
  `jul` decimal(10,2) NOT NULL,
  `ago` decimal(10,2) NOT NULL,
  `set` decimal(10,2) NOT NULL,
  `out` decimal(10,2) NOT NULL,
  `nov` decimal(10,2) NOT NULL,
  `dez` decimal(10,2) NOT NULL,
  `ano` varchar(10) NOT NULL,
  `empresaId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cashflowsaldo`
--

INSERT INTO `cashflowsaldo` (`id`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `empresaId`) VALUES
(1, 1, '12.00', '45.00', '22.22', '0.00', '50.00', '99.99', '0.00', '0.00', '99999.99', '0.00', '0.00', '0.00', '2014', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `products`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskName` varchar(80) NOT NULL,
  `desc` text NOT NULL,
  `dataInicio` varchar(10) NOT NULL,
  `dataFim` varchar(10) NOT NULL,
  `horaInicio` varchar(10) NOT NULL,
  `minutoInicio` varchar(10) NOT NULL,
  `horaFim` varchar(10) NOT NULL,
  `minutoFim` varchar(10) NOT NULL,
  `userId` int(11) NOT NULL,
  `taskStatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`id`, `taskName`, `desc`, `dataInicio`, `dataFim`, `horaInicio`, `minutoInicio`, `horaFim`, `minutoFim`, `userId`, `taskStatus`) VALUES
(30, 'asd', 'asdasdasdasdasdsadasd', '16/01/2014', '01/02/2014', '17', '18', '19', '18', 6, 1),
(33, 'Teste', '', '', '', '01', '00', '01', '00', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `taskstatus`
--

CREATE TABLE IF NOT EXISTS `taskstatus` (
  `taskStatusId` int(11) NOT NULL AUTO_INCREMENT,
  `taskStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`taskStatusId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `taskstatus`
--

INSERT INTO `taskstatus` (`taskStatusId`, `taskStatus`) VALUES
(1, 'Done'),
(2, 'Undone');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `signupDate` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`) VALUES
(1, 'Luis', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 1, '27/01/2014');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
