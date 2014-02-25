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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
(10, 'Vendas', 2, 'robertakrug@gmail.com', '2014'),
(11, 'Ingredientes', 1, 'robertakrug@gmail.com', '2014'),
(12, 'Vendas', 2, 'fabioportes@live.com', '2014');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `cashflowexpenses`
--

INSERT INTO `cashflowexpenses` (`id`, `expenseName`, `categoryId`, `userId`, `jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `set`, `out`, `nov`, `dez`, `ano`, `userMaster`) VALUES
(2, 'Parcela carro', 3, 1, 0.00, 642.73, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Seguro', 3, 1, 0.00, 345.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(5, 'Emprestimo Caixa', 5, 1, 0.00, 392.17, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(6, 'Celular', 6, 1, 0.00, 117.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(7, 'Hotel Fazenda SÃ£o JoÃ£o', 7, 1, 0.00, 240.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(8, 'Outros', 9, 1, 0.00, 13.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(9, 'Ingredientes', 11, 2, 0.00, 180.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'robertakrug@gmail.com');

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
(1, 'Adiantamento', 4, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(2, 'Restante salario', 4, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(4, 'Outros', 8, 1, 0.00, 5.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
(5, 'Bolos Decorados', 10, 2, 0.00, 180.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'robertakrug@gmail.com');

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
(1, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2014', 'luis_abeno@hotmail.com'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `tasks`
--

INSERT INTO `tasks` (`id`, `taskName`, `desc`, `dataInicio`, `dataFim`, `horaInicio`, `minutoInicio`, `horaFim`, `minutoFim`, `userId`, `taskStatus`) VALUES
(10, 'Vender vale refeiÃ§Ã£o', 'Vender R$ 310,00\nAlameda Raja Gabaglia, nÂ°??? â€“ passar o Starbucks Coffee', '2014-01-30', '2014-01-31', '9', '0', '18', '0', 1, 1),
(17, 'DecoraÃ§Ã£o Cups', '5 - Alices\n5 - Jardins\n5 - Cartas\n5 - Mesinhas\n5 - RelÃ³gios', '2014-02-04', '2014-02-04', '8', '0', '18', '0', 2, 1),
(16, 'DecoraÃ§Ã£o Bolo', 'ChapÃ©u\nGato\nAlice', '2014-02-03', '2014-02-03', '8', '0', '18', '0', 2, 1),
(6, 'Borracheiro', 'Ir atÃ© o borracheiro para consertar o step.', '2014-02-01', '2014-02-01', '9', '0', '18', '0', 1, 1),
(7, 'Pagar hospedagem Hostgator', 'Pagar hospedagem hostgator trimestral.', '2014-02-01', '2014-02-03', '10', '0', '16', '0', 1, 1),
(8, 'LÃ¢mpada', 'Trocar lÃ¢mpada traseira esquerda do freio.', '2014-02-01', '2014-03-31', '8', '0', '14', '0', 1, 0),
(9, 'Alinhamento', 'Alinhar carro.\nAvenida Antonio C. Costa prÃ³ximo a sorveteria Frutiquello.', '2014-02-01', '2014-02-01', '8', '0', '14', '0', 1, 1),
(11, 'Comprar mochila', 'Comprar uma mochila no shopping Morumbi', '2014-02-02', '2014-02-02', '9', '0', '20', '0', 1, 0),
(12, 'Comprar um tÃªnis', 'Comprar um tÃªnis no shopping morumbi.', '2014-02-02', '2014-02-02', '9', '0', '20', '0', 1, 1),
(13, 'SPTrans', 'Ir atÃ© o SPTrans para verificar a questÃ£o do vale transporte.\nTel.:(11) 3714-5908\nEnd.:Av Mal MÃ¡rio Guedes , 221 , JaguarÃ©, SÃ£o Paulo  -  SP  ', '2014-01-31', '2014-02-07', '8', '0', '16', '0', 1, 1),
(14, 'Pagar carro', 'Pagar parcela do carro referente ao mÃªs de janeiro.', '2014-01-31', '2014-01-31', '9', '0', '20', '0', 1, 1),
(18, 'Massas ', 'Bolo Baunilha \nBolo Chocolate\nGanache', '2014-02-05', '2014-02-05', '8', '0', '18', '0', 2, 1),
(20, 'Massa cupcakes', 'Massas cenoura cupcakes\nRechear e decorar cupcakes\nCobrir, decorar e montar o bolo', '2014-02-07', '2014-02-07', '8', '0', '18', '0', 2, 1),
(21, 'Recheios', 'Brigadeiros', '2014-02-06', '2014-02-06', '8', '0', '18', '0', 2, 1),
(22, 'Pagar celular - Jan', 'Pagar conta de celular referente a janeiro.\nVcto.: 06/02/14\nVlr.: 117,00', '2014-02-05', '2014-02-20', '1', '0', '1', '0', 1, 0),
(27, 'Pagar Roberto', 'ag. 4742 - conta. 010845582 - banco Santander - R$ 241,59 (terceira parcela)', '2014-03-05', '2014-03-10', '1', '0', '1', '0', 1, 0),
(26, 'IdÃ©ia nome sistema', 'GEEPME;\nGEPME;\nBManagement (Business Management);\nBManager (Bussiness Manager);\nCOBMA(Complete business management);', '2014-02-11', '2021-02-09', '1', '0', '1', '0', 1, 0),
(25, 'sdasd', 'asdasd', '2014-02-11', '2014-02-25', '1', '0', '1', '0', 5, 1),
(28, 'Dr. Ricardo', 'Ginecologista ', '2014-03-20', '2014-03-20', '15', '30', '18', '0', 2, 0),
(29, 'Dra. Jackeline', 'Nutricionista - Moema', '2014-03-13', '2014-03-13', '13', '30', '18', '0', 2, 0),
(30, 'Dra. Clarice', 'Dermatologista - Pinheiros', '2014-02-28', '2014-02-28', '14', '30', '18', '0', 2, 0),
(34, 'Buscar carta', 'Buscar habilitaÃ§Ã£o', '2014-03-14', '2014-03-14', '9', '0', '18', '0', 2, 0),
(33, 'Dr. Adriano', 'Oftalmo', '2014-03-17', '2014-03-17', '15', '30', '18', '0', 2, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`, `userType`, `userMaster`) VALUES
(1, 'Luis', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 1, '27/01/2014', '1', 'luis_abeno@hotmail.com'),
(2, 'Roberta', 'Krug', 'robertakrug@gmail.com', '9b538b392c3364579ccde894ccc6c3b8', 2, 1, '26/01/2014', '1', 'robertakrug@gmail.com'),
(5, 'Franklin', 'Bicha', 'bicha@teste.com.br', 'a8f5f167f44f4964e6c998dee827110c', 1, 1, '08/02/2014', '1', 'bicha@teste.com.br'),
(6, 'Fabio', 'Portes', 'fabioportes@live.com', 'ae7f2027fa8a8e8fb0e0b4fb294b6136', 1, 1, '18/02/2014', '1', 'fabioportes@live.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
