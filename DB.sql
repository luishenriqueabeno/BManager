-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 13/02/2014 às 21:50:18
-- Versão do Servidor: 5.5.33
-- Versão do PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `luish360_dailyhelper`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cashflowcategories`
--

CREATE TABLE IF NOT EXISTS `cashflowcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryTypeId` int(11) NOT NULL,
  `userMaster` varchar(255) NOT NULL,
  `ano` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `cashflowcategories`
--

INSERT INTO `cashflowcategories` (`id`, `categoryName`, `categoryTypeId`, `userMaster`, `ano`) VALUES
(3, 'Automovel', 1, 'luis_abeno@hotmail.com', '2014'),
(4, 'Salario', 2, 'luis_abeno@hotmail.com', '2014'),
(5, 'Emprestimos', 1, 'luis_abeno@hotmail.com', '2014'),
(6, 'Telefonia', 1, 'luis_abeno@hotmail.com', '2014'),
(7, 'Viagem', 1, 'luis_abeno@hotmail.com', '2014'),
(8, 'Outros', 2, 'luis_abeno@hotmail.com', '2014'),
(9, 'Outros', 1, 'luis_abeno@hotmail.com', '2014');

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
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `cashflowexpenses`
--

INSERT INTO `cashflowexpenses` (`id`, `expenseName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(2, 'Parcela carro', 3, 1, 0.00, 642.73, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Seguro', 3, 1, 0.00, 345.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(5, 'Emprestimo Caixa', 5, 1, 0.00, 392.17, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(6, 'Celular', 6, 1, 0.00, 117.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(7, 'Hotel Fazenda SÃ£o JoÃ£o', 7, 1, 0.00, 240.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(8, 'Outros', 9, 1, 0.00, 4.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com');

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
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `cashflowincome`
--

INSERT INTO `cashflowincome` (`id`, `incomeName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(1, 'Adiantamento', 4, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(2, 'Restante salario', 4, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Outros', 8, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com');

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
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cashflowsaldo`
--

INSERT INTO `cashflowsaldo` (`id`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`id`, `taskName`, `desc`, `dataInicio`, `dataFim`, `horaInicio`, `minutoInicio`, `horaFim`, `minutoFim`, `userId`, `taskStatus`) VALUES
(10, 'Vender vale refeiÃ§Ã£o', 'Vender R$ 310,00\nAlameda Raja Gabaglia, nÂ°??? â€“ passar o Starbucks Coffee', '30/01/2014', '31/01/2014', '09', '00', '18', '00', 1, 1),
(17, 'DecoraÃ§Ã£o Cups', '5 - Alices\n5 - Jardins\n5 - Cartas\n5 - Mesinhas\n5 - RelÃ³gios', '04/02/2014', '04/02/2014', '08', '00', '18', '00', 2, 0),
(16, 'DecoraÃ§Ã£o Bolo', 'ChapÃ©u\nGato\nAlice', '03/02/2014', '03/02/2014', '08', '00', '18', '00', 2, 0),
(6, 'Borracheiro', 'Ir atÃ© o borracheiro para consertar o step.', '01/02/2014', '01/02/2014', '09', '00', '18', '00', 1, 1),
(7, 'Pagar hospedagem Hostgator', 'Pagar hospedagem hostgator trimestral.', '01/02/2014', '03/02/2014', '10', '00', '16', '00', 1, 1),
(8, 'LÃ¢mpada', 'Trocar lÃ¢mpada traseira esquerda do freio.', '01/02/2014', '31/03/2014', '08', '00', '14', '00', 1, 0),
(9, 'Alinhamento', 'Alinhar carro.\nAvenida Antonio C. Costa prÃ³ximo a sorveteria Frutiquello.', '01/02/2014', '01/02/2014', '08', '00', '14', '00', 1, 1),
(11, 'Comprar mochila', 'Comprar uma mochila no shopping Morumbi', '02/02/2014', '02/02/2014', '09', '00', '20', '00', 1, 0),
(12, 'Comprar um tÃªnis', 'Comprar um tÃªnis no shopping morumbi.', '02/02/2014', '02/02/2014', '09', '00', '20', '00', 1, 1),
(13, 'SPTrans', 'Ir atÃ© o SPTrans para verificar a questÃ£o do vale transporte.\nTel.:(11) 3714-5908\nEnd.:Av Mal MÃ¡rio Guedes , 221 , JaguarÃ©, SÃ£o Paulo  -  SP  ', '31/01/2014', '07/02/2014', '08', '00', '16', '00', 1, 1),
(14, 'Pagar carro', 'Pagar parcela do carro referente ao mÃªs de janeiro.', '31/01/2014', '31/01/2014', '09', '00', '20', '00', 1, 1),
(18, 'Massas ', 'Bolo Baunilha \nBolo Chocolate\nGanache', '05/02/2014', '05/02/2014', '08', '00', '18', '00', 2, 0),
(20, 'Massa cupcakes', 'Massas cenoura cupcakes\nRechear e decorar cupcakes\nCobrir, decorar e montar o bolo', '07/02/2014', '07/02/2014', '08', '00', '18', '00', 2, 0),
(21, 'Recheios', 'Brigadeiros', '06/02/2014', '06/02/2014', '08', '00', '18', '00', 2, 0),
(22, 'Pagar celular - Jan', 'Paar conta de celular referente a janeiro.\nVcto.: 06/02/14\nVlr.: 117,00', '05/02/2014', '20/02/2014', '01', '00', '01', '00', 1, 0),
(27, 'Pagar Roberto', 'ag. 4742 - conta. 010845582 - banco Santander - R$ 241,59 (terceira parcela)', '05/03/2014', '10/03/2014', '01', '00', '01', '00', 1, 0),
(26, 'IdÃ©ia nome sistema', 'GEEPME;\nGEPME;\nBManagement (Business Management);\nBManager (Bussiness Manager);\nCOBMA(Complete business management);', '11/02/2014', '09/02/2021', '01', '00', '01', '00', 1, 0),
(25, 'sdasd', 'asdasd', '11/02/2014', '25/02/2014', '01', '00', '01', '00', 5, 1);

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
  `userType` varchar(255) NOT NULL,
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`, `userType`, `userMaster`) VALUES
(1, 'Luis', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 1, '27/01/2014', '1', 'luis_abeno@hotmail.com'),
(2, 'Roberta', 'Krug', 'robertakrug@gmail.com', '9b538b392c3364579ccde894ccc6c3b8', 2, 1, '26/01/2014', '1', 'robertakrug@gmail.com'),
(5, 'Franklin', 'Bicha', 'bicha@teste.com.br', 'a8f5f167f44f4964e6c998dee827110c', 1, 1, '08/02/2014', '1', 'bicha@teste.com.br');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
