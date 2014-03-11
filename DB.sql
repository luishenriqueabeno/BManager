-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 11/03/2014 às 10:07:45
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(9, 'Outros', 1, 'luis_abeno@hotmail.com', '2014'),
(12, 'Vendas', 2, 'fabioportes@live.com', '2014'),
(13, 'Banco', 1, 'luis_abeno@hotmail.com', '2014');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `cashflowexpenses`
--

INSERT INTO `cashflowexpenses` (`id`, `expenseName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(2, 'Parcela carro', 3, 1, 0.00, 642.73, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Seguro', 3, 1, 0.00, 345.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(5, 'Emprestimo Caixa', 5, 1, 0.00, 392.18, 392.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(6, 'Celular', 6, 1, 0.00, 117.78, 113.61, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(7, 'Hotel Fazenda SÃ£o JoÃ£o', 7, 1, 0.00, 240.00, 245.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(8, 'Outros', 9, 1, 0.00, 105.00, 40.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(11, 'Taxas bancarias', 13, 1, 0.00, 42.66, 173.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(12, 'CartÃ£o de crÃ©dito', 13, 1, 0.00, 1270.07, 552.51, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(13, 'Hospedagem', 9, 1, 0.00, 56.97, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(14, 'ManutenÃ§Ã£o Carro', 3, 1, 0.00, 15.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(15, 'Emprestimo Bradesco', 13, 1, 0.00, 608.96, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cashflowincome`
--

INSERT INTO `cashflowincome` (`id`, `incomeName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(1, 'Adiantamento', 4, 1, 0.00, 1600.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(2, 'Restante salario', 4, 1, 0.00, 1511.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Outros', 8, 1, 0.00, 510.00, 1180.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cashflowsaldo`
--

INSERT INTO `cashflowsaldo` (`id`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(1, 1, 0.00, -2218.36, -2080.61, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(2, 2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'robertakrug@gmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`id`, `taskName`, `desc`, `dataInicio`, `dataFim`, `horaInicio`, `minutoInicio`, `horaFim`, `minutoFim`, `userId`, `taskStatus`) VALUES
(17, 'DecoraÃ§Ã£o Cups', '5 - Alices\n5 - Jardins\n5 - Cartas\n5 - Mesinhas\n5 - RelÃ³gios', '2014-02-04', '2014-02-04', '8', '0', '18', '0', 2, 1),
(16, 'DecoraÃ§Ã£o Bolo', 'ChapÃ©u\nGato\nAlice', '2014-02-03', '2014-02-03', '8', '0', '18', '0', 2, 1),
(7, 'Pagar hospedagem Hostgator', 'Pagar hospedagem hostgator trimestral.', '2014-2-1', '2014-2-3', '10', '18', '16', '17', 1, 1),
(8, 'LÃ¢mpada', 'Trocar lÃ¢mpada traseira esquerda do freio.', '2014-2-1', '2014-3-31', '08', '00', '14', '00', 1, 0),
(18, 'Massas ', 'Bolo Baunilha \nBolo Chocolate\nGanache', '2014-02-05', '2014-02-05', '8', '0', '18', '0', 2, 1),
(20, 'Massa cupcakes', 'Massas cenoura cupcakes\nRechear e decorar cupcakes\nCobrir, decorar e montar o bolo', '2014-02-07', '2014-02-07', '8', '0', '18', '0', 2, 1),
(21, 'Recheios', 'Brigadeiros', '2014-02-06', '2014-02-06', '8', '0', '18', '0', 2, 1),
(22, 'Pagar celular - Jan', 'Pagar conta de celular referente a janeiro.\nVcto.: 06/02/14\nVlr.: 117,00', '2014-2-5', '2014-2-20', '09', '09', '10', '12', 1, 1),
(27, 'Pagar Roberto', 'ag. 4742 - conta. 010845582 - banco Santander - R$ 241,59 (quarta parcela)', '2014-04-01', '2014-04-07', '09', '00', '16', '00', 1, 0),
(25, 'sdasd', 'asdasd', '2014-02-11', '2014-02-25', '1', '0', '1', '0', 5, 1),
(28, 'Dr. Ricardo', 'Ginecologista ', '2014-03-20', '2014-03-20', '15', '30', '18', '0', 2, 0),
(29, 'Dra. Jackeline', 'Nutricionista - Moema', '2014-03-13', '2014-03-13', '13', '30', '18', '0', 2, 0),
(30, 'Dra. Clarice', 'Dermatologista - Pinheiros', '2014-02-28', '2014-02-28', '14', '30', '18', '0', 2, 0),
(34, 'Buscar carta', 'Buscar habilitaÃ§Ã£o', '2014-03-14', '2014-03-14', '9', '0', '18', '0', 2, 0),
(33, 'Dr. Adriano', 'Oftalmo', '2014-03-17', '2014-03-17', '15', '30', '18', '0', 2, 0),
(35, 'comprar coisas', 'Bla', '2014-02-18', '2014-02-25', '16', '07', '06', '03', 7, 0),
(37, 'Pagar dominio', 'Pagar dominio no registroBR\nbmanager.com.br - R$ 30,00', '2014-02-20', '2014-02-28', '09', '00', '20', '00', 1, 0),
(39, 'DivulgaÃ§Ã£o prÃ©dio', '- Distribuir pequenas amostras no prÃ©dio divulgando os serviÃ§os. \n\n-  Data de entrega: 10 atÃ© 22/03.\n\n- ComeÃ§ar a fazer apÃ³s o carnaval', '2014-03-10', '2014-03-22', '08', '00', '18', '00', 2, 0),
(40, 'Material divulgaÃ§Ã£o - PÃ¡scoa', 'Criar material de divulgaÃ§Ã£o e tirar fotos para campanha de pÃ¡scoa que comeÃ§a dia 01/04.\n\nFlyers â€“ facebook â€“ email â€“ elo7', '----2014-0', '----2014-0', '09', '00', '18', '00', 2, 0),
(41, 'Material dilvulgaÃ§Ã£o - Dia das mÃ£es', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 01/05.\n\nFacebook â€“ email â€“ elo7', '--2014-04-', '--2014-04-', '09', '00', '18', '00', 2, 0),
(42, 'Material divulgaÃ§Ã£o - dia dos namorados e copa', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o das campanhas que comeÃ§am dia 02/06\n\n- procurar material na 25 de marÃ§o\n\nFlyers â€“ facebook â€“ email â€“ elo7', '--2014-05-', '--2014-05-', '09', '00', '18', '00', 2, 0),
(43, 'Material divulgaÃ§Ã£o - Dia mundial do rock', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 30/06\n\nFacebook â€“ email â€“ elo7', '--2014-07-', '--2014-07-', '09', '00', '18', '00', 2, 0),
(44, 'Material DivulgaÃ§Ã£o dia dos pais', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 01/08.\n\nFacebook â€“ email â€“ elo7', '--2014-07-', '--2014-07-', '09', '00', '18', '00', 2, 0),
(45, 'Material divulgaÃ§Ã£o - dia do professor', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 08/09\n\nFacebook â€“ email â€“ elo7', '--2014-09-', '--2014-09-', '08', '00', '18', '00', 2, 0),
(46, 'Material de divulgaÃ§Ã£o- dia das bruxas', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 20/10.\n\nFacebook â€“ email â€“ elo7', '--2014-10-', '--2014-10-', '09', '00', '18', '00', 2, 0),
(47, 'Material divulgaÃ§Ã£o - black friday', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 28/11\n\nFacebook â€“ email â€“ elo7', '--2014-11-', '--2014-11-', '09', '00', '18', '00', 2, 0),
(48, 'Material divulgaÃ§Ã£o - Natal', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 25/11.\n\nFlyers â€“ facebook â€“ email â€“ elo7', '--2014-11-', '--2014-11-', '09', '00', '18', '00', 2, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`, `userType`, `userMaster`) VALUES
(1, 'Luis Henrique', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 2, '27/01/2014', '1', 'luis_abeno@hotmail.com'),
(2, 'Roberta', 'Krug', 'robertakrug@gmail.com', '9b538b392c3364579ccde894ccc6c3b8', 2, 2, '26/01/2014', '1', 'robertakrug@gmail.com'),
(8, 'Francisco', 'costa', 'fec_costa@hotmail.com.br', 'f32facdc82cea53133cfc6808af56b6b', 2, 1, '18/02/2014', '1', 'fec_costa@hotmail.com.br'),
(6, 'Fabio', 'Portes', 'fabioportes@live.com', 'ae7f2027fa8a8e8fb0e0b4fb294b6136', 1, 1, '18/02/2014', '1', 'fabioportes@live.com'),
(7, 'Daniel', 'Zanella', 'dsz.zanella@gmail.com', '92fcdcad8839e1077f3870f966d238fe', 1, 1, '18/02/2014', '1', 'dsz.zanella@gmail.com'),
(9, 'Luis', 'Abeno', 'luis.abeno@cakersfestas.com.br', '4aafd190adfeb9477899840deae6c370', 1, 2, '05/03/2014', '2', 'robertakrug@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
