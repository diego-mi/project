-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 05/10/2015 às 07:22
-- Versão do servidor: 5.5.44-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `project`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Gatilhos `comment`
--
DROP TRIGGER IF EXISTS `generate_notification_comment`;
DELIMITER //
CREATE TRIGGER `generate_notification_comment` AFTER INSERT ON `comment`
 FOR EACH ROW BEGIN
    INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.user_id, action_type = 2;
  END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `generate_notification_comment_del`;
DELIMITER //
CREATE TRIGGER `generate_notification_comment_del` AFTER DELETE ON `comment`
 FOR EACH ROW BEGIN
    DELETE FROM comment WHERE (post_id = OLD.post_id AND action_user_id = OLD.user_id AND action_type = 2);
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `followers`
--
CREATE TABLE IF NOT EXISTS `followers` (
`following_id` int(11)
,`follower_id` int(11)
,`follower_name` varchar(100)
,`follower_username` varchar(40)
,`follower_picture` varchar(100)
,`follower_email` varchar(60)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `following`
--
CREATE TABLE IF NOT EXISTS `following` (
`follower_id` int(11)
,`following_id` int(11)
,`following_name` varchar(100)
,`following_username` varchar(40)
,`following_picture` varchar(100)
,`following_email` varchar(60)
);
-- --------------------------------------------------------

--
-- Estrutura para tabela `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `friend`
--

INSERT INTO `friend` (`user_id`, `friend_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gostei`
--

CREATE TABLE IF NOT EXISTS `gostei` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `post_author_id` (`post_author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gatilhos `gostei`
--
DROP TRIGGER IF EXISTS `generate_notification_gostei`;
DELIMITER //
CREATE TRIGGER `generate_notification_gostei` AFTER INSERT ON `gostei`
 FOR EACH ROW BEGIN
    INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.user_id, action_type = 1;
  END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `generate_notification_gostei_del`;
DELIMITER //
CREATE TRIGGER `generate_notification_gostei_del` AFTER DELETE ON `gostei`
 FOR EACH ROW BEGIN
    DELETE FROM notification WHERE (post_id = OLD.post_id AND action_author_id = OLD.user_id AND action_type = 1);
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `post_author_id` (`post_author_id`),
  KEY `action_author_id` (`action_author_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications_types`
--

CREATE TABLE IF NOT EXISTS `notifications_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `notifications_types`
--

INSERT INTO `notifications_types` (`id`, `name`) VALUES
(1, 'Gostei'),
(2, 'Comentar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `type` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `privacity` int(11) DEFAULT '1' COMMENT '1=publico, 2=amigos',
  `classification` int(11) DEFAULT '1' COMMENT '1=free,2=18a',
  `picture` varchar(200) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `posts` (`author_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Fazendo dump de dados para tabela `posts`
--

INSERT INTO `posts` (`id`, `content`, `type`, `author_id`, `privacity`, `classification`, `picture`, `date`) VALUES
(16, '#frist', 1, 1, 1, 1, NULL, '2015-10-04 22:19:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `post_types`
--

CREATE TABLE IF NOT EXISTS `post_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `post_types`
--

INSERT INTO `post_types` (`id`, `name`, `icon`) VALUES
(1, 'Texto', 'fa-file-text'),
(2, 'Foto', 'fa-picture-o'),
(3, 'Vídeo', 'fa-film');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `profile`
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
-- Estrutura para tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `picture`, `salt`) VALUES
(1, 'Diego Mi Campos', 'diegomi', 'diegomister@gmail.com', '1234', '560a914bb9ae5.jpg', ''),
(2, 'User Test', 'test', 'test@gmail.com', 'test', NULL, '');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwcomment`
--
CREATE TABLE IF NOT EXISTS `vwcomment` (
`comment_id` int(11)
,`comment_content` longtext
,`comment_date` timestamp
,`comment_post_id` int(11)
,`comment_author_id` int(11)
,`comment_author_name` varchar(100)
,`comment_author_picture` varchar(100)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwfriend`
--
CREATE TABLE IF NOT EXISTS `vwfriend` (
`user_id` int(11)
,`friend_id` int(11)
,`friend_name` varchar(100)
,`friend_username` varchar(40)
,`friend_picture` varchar(100)
,`friend_email` varchar(60)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwfriendflrs`
--
CREATE TABLE IF NOT EXISTS `vwfriendflrs` (
`user_id` int(11)
,`friend_id` int(11)
,`friend_name` varchar(100)
,`friend_username` varchar(40)
,`friend_picture` varchar(100)
,`friend_email` varchar(60)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwposts`
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
-- Estrutura para view `followers`
--
DROP TABLE IF EXISTS `followers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `followers` AS select `friend`.`friend_id` AS `following_id`,`user`.`id` AS `follower_id`,`user`.`name` AS `follower_name`,`user`.`username` AS `follower_username`,`user`.`picture` AS `follower_picture`,`user`.`email` AS `follower_email` from (`user` join `friend` on((`user`.`id` = `friend`.`user_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `following`
--
DROP TABLE IF EXISTS `following`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `following` AS select `friend`.`user_id` AS `follower_id`,`user`.`id` AS `following_id`,`user`.`name` AS `following_name`,`user`.`username` AS `following_username`,`user`.`picture` AS `following_picture`,`user`.`email` AS `following_email` from (`user` join `friend` on((`user`.`id` = `friend`.`friend_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `profile`
--
DROP TABLE IF EXISTS `profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile` AS select `user`.`id` AS `id`,`user`.`name` AS `name`,`user`.`username` AS `username`,`user`.`picture` AS `picture`,`user`.`email` AS `email` from `user`;

-- --------------------------------------------------------

--
-- Estrutura para view `vwcomment`
--
DROP TABLE IF EXISTS `vwcomment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwcomment` AS select `comment`.`id` AS `comment_id`,`comment`.`content` AS `comment_content`,`comment`.`date` AS `comment_date`,`comment`.`post_id` AS `comment_post_id`,`comment`.`user_id` AS `comment_author_id`,`user`.`name` AS `comment_author_name`,`user`.`picture` AS `comment_author_picture` from (`comment` join `user` on((`user`.`id` = `comment`.`user_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vwfriend`
--
DROP TABLE IF EXISTS `vwfriend`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwfriend` AS select `friend`.`user_id` AS `user_id`,`user`.`id` AS `friend_id`,`user`.`name` AS `friend_name`,`user`.`username` AS `friend_username`,`user`.`picture` AS `friend_picture`,`user`.`email` AS `friend_email` from (`user` join `friend` on((`user`.`id` = `friend`.`friend_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vwfriendflrs`
--
DROP TABLE IF EXISTS `vwfriendflrs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwfriendflrs` AS select `friend`.`friend_id` AS `user_id`,`friend`.`user_id` AS `friend_id`,`user`.`name` AS `friend_name`,`user`.`username` AS `friend_username`,`user`.`picture` AS `friend_picture`,`user`.`email` AS `friend_email` from (`user` join `friend` on((`user`.`id` = `friend`.`user_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vwposts`
--
DROP TABLE IF EXISTS `vwposts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwposts` AS select `posts`.`id` AS `post_id`,`posts`.`content` AS `post_content`,`posts`.`type` AS `post_type`,`posts`.`date` AS `post_date`,`posts`.`classification` AS `post_classification`,`posts`.`privacity` AS `post_privacity`,`posts`.`picture` AS `post_picture`,`user`.`id` AS `user_id`,`user`.`name` AS `user_name`,`user`.`picture` AS `user_picture`,`post_types`.`name` AS `post_type_name`,`post_types`.`id` AS `post_type_id` from ((`posts` join `user` on((`posts`.`author_id` = `user`.`id`))) join `post_types` on((`posts`.`type` = `post_types`.`id`)));

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Restrições para tabelas `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `gostei`
--
ALTER TABLE `gostei`
  ADD CONSTRAINT `gostei_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `gostei_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `gostei_ibfk_3` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`action_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`action_id`) REFERENCES `notifications_types` (`id`);

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`type`) REFERENCES `post_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
