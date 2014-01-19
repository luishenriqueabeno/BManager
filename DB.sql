-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Geração: Jan 19, 2014 as 03:41 PM
-- Versão do Servidor: 5.0.45
-- Versão do PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Banco de Dados: `dailyhelper`
-- 

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `products`
-- 

CREATE TABLE `products` (
  `productId` int(11) NOT NULL auto_increment,
  `productName` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY  (`productId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `products`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `tasks`
-- 

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL auto_increment,
  `taskName` varchar(80) NOT NULL,
  `desc` text NOT NULL,
  `dataInicio` varchar(10) NOT NULL,
  `dataFim` varchar(10) NOT NULL,
  `horaInicio` varchar(10) NOT NULL,
  `minutoInicio` varchar(10) NOT NULL,
  `horaFim` varchar(10) NOT NULL,
  `minutoFim` varchar(10) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

-- 
-- Extraindo dados da tabela `tasks`
-- 

INSERT INTO `tasks` (`id`, `taskName`, `desc`, `dataInicio`, `dataFim`, `horaInicio`, `minutoInicio`, `horaFim`, `minutoFim`, `userId`) VALUES 
(55, 'Pagar IPVA', 'Pagar IPVA', '16/01/2014', '21/01/2014', '10', '00', '16', '00', 2),
(60, 'SPTrans', 'Verificar recarga de vale transporte.\nEnd: Rua CatÃ£o, 50 - Term. Lapa', '16/01/2014', '16/01/2014', '08', '00', '09', '00', 3),
(39, 'Pagar Roberto', 'Pagar R$240,00 para o Roberto referente ao Hotel Fazenda SÃ£o JoÃ£o.\nDados:\nAg: 4742\nCC: 010845582\nCPF: 66680093872\n\n 1Âº Parcela paga dia 15/01/2014 TransaÃ§Ã£o: 671466', '12/01/2014', '12/05/2014', '10', '00', '16', '00', 0);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `signupDate` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Extraindo dados da tabela `users`
-- 

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `gender`, `productId`, `signupDate`) VALUES 
(3, 'Roberta', 'Krug', 'robs@robs.com.br', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, '19/01/2014'),
(2, 'Luis', 'Abeno', 'luis_abeno@hotmail.com', '4aafd190adfeb9477899840deae6c370', 1, 1, '19/01/2014');
