-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 27, 2014 as 04:54 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bmanager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `banco` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `codigo` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=104 ;

--
-- Extraindo dados da tabela `bancos`
--

INSERT INTO `bancos` (`ID`, `banco`, `codigo`) VALUES
(1, 'Banco ABC Brasil S.A.', '246'),
(2, 'Banco ABN AMRO Real S.A.', '356'),
(3, 'Banco Alfa S.A.', '025'),
(4, 'Banco Alvorada S.A.', '641'),
(5, 'Banco Banerj S.A.', '029'),
(6, 'Banco Banestado S.A.', '038'),
(7, 'Banco Barclays S.A.', '740'),
(8, 'Banco BBM S.A.', '107'),
(9, 'Banco Beg S.A.', '031'),
(10, 'Banco Bem S.A.', '036'),
(11, 'Banco BM&F de Serviços de Liquidação e Custódia S.A', '096'),
(12, 'Banco BMC S.A.', '394'),
(13, 'Banco BMG S.A.', '318'),
(14, 'Banco BNP Paribas Brasil S.A.', '752'),
(15, 'Banco Boavista Interatlântico S.A.', '248'),
(16, 'Banco Bradesco S.A.', '237'),
(17, 'Banco Brascan S.A.', '225'),
(18, 'Banco Cacique S.A.', '263'),
(19, 'Banco Calyon Brasil S.A.', '222'),
(20, 'Banco Cargill S.A.', '040'),
(21, 'Banco Citibank S.A.', '745'),
(22, 'Banco Comercial e de Investimento Sudameris S.A.', '215'),
(23, 'Banco Cooperativo do Brasil S.A. – BANCOOB', '756'),
(24, 'Banco Cooperativo Sicredi S.A. – BANSICREDI', '748'),
(25, 'Banco Credit Suisse (Brasil) S.A.', '505'),
(26, 'Banco Cruzeiro do Sul S.A.', '229'),
(27, 'Banco da Amazônia S.A.', '003'),
(28, 'Banco Daycoval S.A.', '707'),
(29, 'Banco de Pernambuco S.A. – BANDEPE', '024'),
(30, 'Banco de Tokyo-Mitsubishi UFJ Brasil S.A.', '456'),
(31, 'Banco Dibens S.A.', '214'),
(32, 'Banco do Brasil S.A.', '001'),
(33, 'Banco do Estado de Santa Catarina S.A.', '027'),
(34, 'Banco do Estado de Sergipe S.A.', '047'),
(35, 'Banco do Estado do Pará S.A.', '037'),
(36, 'Banco do Estado do Rio Grande do Sul S.A.', '041'),
(37, 'Banco do Nordeste do Brasil S.A.', '004'),
(38, 'Banco Fator S.A.', '265'),
(39, 'Banco Fibra S.A.', '224'),
(40, 'Banco Finasa S.A.', '175'),
(41, 'Banco Fininvest S.A.', '252'),
(42, 'Banco GE Capital S.A.', '233'),
(43, 'Banco Gerdau S.A.', '734'),
(44, 'Banco Guanabara S.A.', '612'),
(45, 'Banco Ibi S.A. Banco Múltiplo', '063'),
(46, 'Banco Industrial do Brasil S.A.', '604'),
(47, 'Banco Industrial e Comercial S.A.', '320'),
(48, 'Banco Indusval S.A.', '653'),
(49, 'Banco Intercap S.A.', '630'),
(50, 'Banco Investcred Unibanco S.A.', '249'),
(51, 'Banco Itaú BBA S.A.', '184-8'),
(52, 'Banco Itaú Holding Financeira S.A.', '652'),
(53, 'Banco Itaú S.A.', '341'),
(54, 'Banco ItaúBank S.A', '479'),
(55, 'Banco J. P. Morgan S.A.', '376'),
(56, 'Banco J. Safra S.A.', '074'),
(57, 'Banco Luso Brasileiro S.A.', '600'),
(58, 'Banco Mercantil de São Paulo S.A.', '392'),
(59, 'Banco Mercantil do Brasil S.A.', '389'),
(60, 'Banco Merrill Lynch de Investimentos S.A.', '755'),
(61, 'Banco Nossa Caixa S.A.', '151'),
(62, 'Banco Opportunity S.A.', '045'),
(63, 'Banco Panamericano S.A.', '623'),
(64, 'Banco Paulista S.A.', '611'),
(65, 'Banco Pine S.A.', '643'),
(66, 'Banco Prosper S.A.', '638'),
(67, 'Banco Rabobank International Brasil S.A.', '747'),
(68, 'Banco Rendimento S.A.', '633'),
(69, 'Banco Rural Mais S.A.', '072'),
(70, 'Banco Rural S.A.', '453'),
(71, 'Banco Safra S.A.', '422'),
(72, 'Banco Santander Banespa S.A.', '008'),
(73, 'Banco Schahin S.A.', '250'),
(74, 'Banco Simples S.A.', '749'),
(75, 'Banco Société Générale Brasil S.A.', '366'),
(76, 'Banco Sofisa S.A.', '637'),
(77, 'Banco Sudameris Brasil S.A.', '347'),
(78, 'Banco Sumitomo Mitsui Brasileiro S.A.', '464'),
(79, 'Banco Triângulo S.A.', '634'),
(80, 'Banco UBS Pactual S.A.', '208'),
(81, 'Banco UBS S.A.', '247'),
(82, 'Banco Único S.A.', '116'),
(83, 'Banco Votorantim S.A.', '655'),
(84, 'Banco VR S.A.', '610'),
(85, 'Banco WestLB do Brasil S.A.', '370'),
(86, 'BANESTES S.A. Banco do Estado do Espírito Santo', '021'),
(87, 'Banif-Banco Internacional do Funchal (Brasil)S.A.', '719'),
(88, 'Bankpar Banco Multiplo S.A.', '204'),
(89, 'BB Banco Popular do Brasil S.A.', '073-6'),
(90, 'BPN Brasil Banco Mútiplo S.A.', '069-8'),
(91, 'BRB – Banco de Brasília S.A.', '070'),
(92, 'Caixa Econômica Federal', '104'),
(93, 'Citibank N.A.', '477'),
(94, 'Deutsche Bank S.A. – Banco Alemão', '487'),
(95, 'Dresdner Bank Brasil S.A. – Banco Múltiplo', '751'),
(96, 'Dresdner Bank Lateinamerika Aktiengesellschaft', '210'),
(97, 'Hipercard Banco Múltiplo S.A.', '062'),
(98, 'HSBC Bank Brasil S.A. – Banco Múltiplo', '399'),
(99, 'ING Bank N.V.', '492'),
(100, 'JPMorgan Chase Bank', '488'),
(101, 'Lemon Bank Banco Múltiplo S.A.', '065'),
(102, 'UNIBANCO – União de Bancos Brasileiros S.A.', '409'),
(103, 'Unicard Banco Múltiplo S.A.', '230');

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
  `contaBancariaId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cashflowexpenses`
--

INSERT INTO `cashflowexpenses` (`id`, `expenseName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`, `contaBancariaId`) VALUES
(1, 'teste', 3, 1, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2014', 'luis_abeno@hotmail.com', 1);

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
  `contaBancariaId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cashflowincome`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `contasbancarias`
--

CREATE TABLE IF NOT EXISTS `contasbancarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banco` varchar(255) NOT NULL,
  `agencia` varchar(255) NOT NULL,
  `conta` varchar(255) NOT NULL,
  `nomeGerente` varchar(255) NOT NULL,
  `telGerente` varchar(255) NOT NULL,
  `emailGerente` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `contasbancarias`
--

INSERT INTO `contasbancarias` (`id`, `banco`, `agencia`, `conta`, `nomeGerente`, `telGerente`, `emailGerente`, `userId`, `userMaster`) VALUES
(1, '237 - Banco Bradesco S.A.', '12312312', '3123123', '', '', '', 1, 'luis_abeno@hotmail.com'),
(2, '008 - Banco Santander Banespa S.A.', '123', '4333', '', '', '', 1, 'luis_abeno@hotmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

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
(48, 'Material divulgaÃ§Ã£o - Natal', 'Testar receitas, tirar fotos e criar material de divulgaÃ§Ã£o da campanha que comeÃ§a dia 25/11.\n\nFlyers â€“ facebook â€“ email â€“ elo7', '--2014-11-', '--2014-11-', '09', '00', '18', '00', 2, 0),
(51, 'asdas', 'dasd', '--', '--', '01', '00', '01', '00', 1, 0);

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
-- Estrutura da tabela `userlogo`
--

CREATE TABLE IF NOT EXISTS `userlogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logoName` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `userMaster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `userlogo`
--

INSERT INTO `userlogo` (`id`, `logoName`, `userId`, `userMaster`) VALUES
(8, 'image_2014-03-27_53342cb19a536_Koala.jpg', 1, 'luis_abeno@hotmail.com');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`, `userType`, `userMaster`) VALUES
(1, 'Luis Henrique', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 1, '27/01/2014', '1', 'luis_abeno@hotmail.com'),
(2, 'Roberta', 'Krug', 'robertakrug@gmail.com', '9b538b392c3364579ccde894ccc6c3b8', 2, 2, '26/01/2014', '1', 'robertakrug@gmail.com'),
(8, 'Francisco', 'costa', 'fec_costa@hotmail.com.br', 'f32facdc82cea53133cfc6808af56b6b', 2, 1, '18/02/2014', '1', 'fec_costa@hotmail.com.br'),
(6, 'Fabio', 'Portes', 'fabioportes@live.com', 'ae7f2027fa8a8e8fb0e0b4fb294b6136', 1, 1, '18/02/2014', '1', 'fabioportes@live.com'),
(7, 'Daniel', 'Zanella', 'dsz.zanella@gmail.com', '92fcdcad8839e1077f3870f966d238fe', 1, 1, '18/02/2014', '1', 'dsz.zanella@gmail.com'),
(9, 'Luis', 'Abeno', 'luis.abeno@cakersfestas.com.br', '4aafd190adfeb9477899840deae6c370', 1, 2, '05/03/2014', '2', 'robertakrug@gmail.com'),
(10, 'teste', 'teste', 'teste@teste.com.br', 'a8f5f167f44f4964e6c998dee827110c', 1, 2, '13/03/2014', '', 'luis_abeno@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usersurvey`
--

CREATE TABLE IF NOT EXISTS `usersurvey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `survey` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usersurvey`
--

INSERT INTO `usersurvey` (`id`, `userId`, `survey`, `report`, `date`) VALUES
(1, 1, ' Teste', ' Teste', '2014-03-24'),
(2, 1, ' ', ' ', '2014-03-24'),
(3, 1, ' asdas', ' dasd', '2014-03-24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
