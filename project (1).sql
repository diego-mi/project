-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Set-2015 às 22:16
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `content` longtext,
  `type` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `privacity` int(11) DEFAULT '1' COMMENT '1=publico, 2=amigos',
  `classification` int(11) DEFAULT '1' COMMENT '1=free,2=18a',
  `picture` varchar(200) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `content`, `type`, `author_id`, `privacity`, `classification`, `picture`, `date`) VALUES
(1, 'post texto', 1, 1, 1, 1, NULL, '2015-09-28 16:42:51'),
(2, 'post foto', 2, 1, 1, 1, '56096e25ce42a.jpg', '2015-09-28 16:43:17'),
(3, 'test in perfil', 1, 1, 2, 1, NULL, '2015-09-28 18:54:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_types`
--

CREATE TABLE IF NOT EXISTS `post_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post_types`
--

INSERT INTO `post_types` (`id`, `name`, `icon`) VALUES
(1, 'Texto', 'fa-file-text'),
(2, 'Foto', 'fa-picture-o'),
(3, 'Vídeo', 'fa-film');

-- --------------------------------------------------------

--
-- Stand-in structure for view `profile`
--
CREATE TABLE IF NOT EXISTS `profile` (
`id` int(11)
,`name` varchar(100)
,`username` varchar(40)
,`picture` varchar(100)
,`email` varchar(60)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `picture`) VALUES
(1, 'Diego Mi Campos', 'diegomi', 'diegomister@gmail.com', '1234', '560996544cd6e.jpg'),
(2, 'User Test', 'test', 'test@gmail.com', 'test', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwposts`
--
CREATE TABLE IF NOT EXISTS `vwposts` (
`post_id` int(11)
,`post_content` longtext
,`post_type` int(11)
,`post_date` timestamp
,`post_classification` int(11)
,`post_privacity` int(11)
,`post_picture` varchar(200)
,`user_id` int(11)
,`user_name` varchar(100)
,`user_picture` varchar(100)
,`post_type_name` varchar(50)
,`post_type_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `profile`
--
DROP TABLE IF EXISTS `profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile` AS select `user`.`id` AS `id`,`user`.`name` AS `name`,`user`.`username` AS `username`,`user`.`picture` AS `picture`,`user`.`email` AS `email` from `user`;

-- --------------------------------------------------------

--
-- Structure for view `vwposts`
--
DROP TABLE IF EXISTS `vwposts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwposts` AS select `posts`.`id` AS `post_id`,`posts`.`content` AS `post_content`,`posts`.`type` AS `post_type`,`posts`.`date` AS `post_date`,`posts`.`classification` AS `post_classification`,`posts`.`privacity` AS `post_privacity`,`posts`.`picture` AS `post_picture`,`user`.`id` AS `user_id`,`user`.`name` AS `user_name`,`user`.`picture` AS `user_picture`,`post_types`.`name` AS `post_type_name`,`post_types`.`id` AS `post_type_id` from ((`posts` join `user` on((`posts`.`author_id` = `user`.`id`))) join `post_types` on((`posts`.`type` = `post_types`.`id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`), ADD KEY `posts` (`author_id`), ADD KEY `type` (`type`);

--
-- Indexes for table `post_types`
--
ALTER TABLE `post_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post_types`
--
ALTER TABLE `post_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`type`) REFERENCES `post_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
