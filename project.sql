-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 22/10/2015 às 16:43
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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `post_author_id` (`post_author_id`),
  KEY `action_author_id` (`action_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Fazendo dump de dados para tabela `comment`
--

INSERT INTO `comment` (`id`, `content`, `date`, `post_id`, `post_author_id`, `action_author_id`) VALUES
(1, '#tree', '2015-10-05 18:45:32', 22, 1, 1),
(2, '#two', '2015-10-05 18:45:50', 21, 1, 1),
(3, '#tree', '2015-10-05 18:46:11', 22, 1, 1),
(4, 'fdgdfgd', '2015-10-06 15:10:57', 22, 1, 2),
(5, 'kkkkkkkkkkkkkkkkk', '2015-10-07 23:15:04', 23, 2, 1),
(6, 'kkkkkkkkkkk', '2015-10-07 23:22:33', 23, 2, 1),
(7, 'iiiiiiiiiiiiiiii', '2015-10-07 23:28:41', 23, 2, 1),
(8, 'iiiiiiiiiiiiii', '2015-10-07 23:28:50', 23, 2, 1),
(9, 'ffff', '2015-10-07 23:30:05', 23, 2, 1),
(10, 'iop', '2015-10-07 23:46:03', 23, 2, 1),
(11, 'fsdfsdf', '2015-10-07 23:46:16', 23, 2, 1),
(12, 'fsfsdfsfd', '2015-10-07 23:46:25', 23, 2, 1),
(13, 'fsdfsfs', '2015-10-07 23:47:49', 23, 2, 1),
(14, '90', '2015-10-07 23:49:27', 23, 2, 1),
(15, 'kkio', '2015-10-08 23:45:47', 21, 1, 1),
(16, 'oioioi', '2015-10-09 00:07:01', 21, 1, 1),
(17, 'iuiuiu', '2015-10-09 00:08:21', 21, 1, 1),
(18, 'çç', '2015-10-09 00:08:47', 21, 1, 1),
(19, 'fgfgd', '2015-10-09 00:30:35', 21, 1, 1),
(20, 'kokpp', '2015-10-09 00:34:26', 20, 1, 1),
(21, 'inçml', '2015-10-09 00:34:31', 20, 1, 1),
(22, 'oioi', '2015-10-09 00:37:36', 20, 1, 1),
(23, 'sdfsfs', '2015-10-09 00:38:17', 20, 1, 1),
(24, 'ae lemaoo', '2015-10-09 00:38:50', 22, 1, 1),
(25, 'ae jhow fmz?!', '2015-10-09 00:39:30', 20, 1, 2),
(26, 'é nois!', '2015-10-09 00:40:42', 20, 1, 1),
(27, 'sdfsdfsfs', '2015-10-09 00:58:38', 24, 1, 1),
(28, 'oi', '2015-10-14 23:48:32', 25, 1, 1),
(29, 'kkkk', '2015-10-15 00:37:08', 25, 1, 2);

--
-- Gatilhos `comment`
--
DROP TRIGGER IF EXISTS `generate_notification_comment`;
DELIMITER //
CREATE TRIGGER `generate_notification_comment` AFTER INSERT ON `comment`
 FOR EACH ROW BEGIN
INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.action_author_id, post_author_id = NEW.post_author_id, action_id = 2;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `generate_notification_comment_del`;
DELIMITER //
CREATE TRIGGER `generate_notification_comment_del` AFTER DELETE ON `comment`
 FOR EACH ROW BEGIN
	DELETE FROM notification WHERE (post_id = OLD.post_id AND action_user_id = OLD.action_author_id AND action_id = 2);
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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `friend`
--

INSERT INTO `friend` (`user_id`, `friend_id`, `date`) VALUES
(1, 2, '0000-00-00 00:00:00'),
(2, 1, '2015-10-15 00:32:37');

--
-- Gatilhos `friend`
--
DROP TRIGGER IF EXISTS `generate_notification_following`;
DELIMITER //
CREATE TRIGGER `generate_notification_following` AFTER INSERT ON `friend`
 FOR EACH ROW INSERT INTO notification
SET
post_id = 0,
action_author_id = NEW.user_id,
post_author_id = NEW.friend_id,
action_id = 3
//
DELIMITER ;
DROP TRIGGER IF EXISTS `generate_notification_following_del`;
DELIMITER //
CREATE TRIGGER `generate_notification_following_del` AFTER DELETE ON `friend`
 FOR EACH ROW DELETE FROM
notification
WHERE (
    post_id = 0 AND
    action_author_id = OLD.user_id AND
    post_author_id=OLD.friend_id
    AND action_id = 1
)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gostei`
--

CREATE TABLE IF NOT EXISTS `gostei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `post_author_id` (`post_author_id`),
  KEY `action_author_id` (`action_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Fazendo dump de dados para tabela `gostei`
--

INSERT INTO `gostei` (`id`, `post_id`, `post_author_id`, `action_author_id`, `date`) VALUES
(2, 21, 1, 1, '2015-10-05 18:45:40'),
(3, 20, 1, 1, '2015-10-05 18:45:44'),
(4, 22, 1, 2, '2015-10-07 21:58:19'),
(7, 22, 1, 1, '2015-10-08 23:14:57'),
(8, 25, 1, 1, '2015-10-09 00:58:09'),
(14, 24, 1, 1, '2015-10-15 00:07:51'),
(15, 23, 2, 1, '2015-10-15 00:08:15'),
(16, 24, 1, 2, '2015-10-15 00:37:03'),
(17, 25, 1, 2, '2015-10-15 00:37:06');

--
-- Gatilhos `gostei`
--
DROP TRIGGER IF EXISTS `generate_notification_gostei`;
DELIMITER //
CREATE TRIGGER `generate_notification_gostei` AFTER INSERT ON `gostei`
 FOR EACH ROW INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.action_author_id, post_author_id = NEW.post_author_id, action_id = 1
//
DELIMITER ;
DROP TRIGGER IF EXISTS `generate_notification_gostei_del`;
DELIMITER //
CREATE TRIGGER `generate_notification_gostei_del` AFTER DELETE ON `gostei`
 FOR EACH ROW DELETE FROM notification WHERE (post_id = OLD.post_id AND action_author_id = OLD.action_author_id AND post_author_id=OLD.post_author_id AND action_id = 1)
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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '1 = notificacao vista, 0 = notificacao nao vista',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `post_author_id` (`post_author_id`),
  KEY `action_author_id` (`action_author_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Fazendo dump de dados para tabela `notification`
--

INSERT INTO `notification` (`id`, `post_id`, `post_author_id`, `action_author_id`, `action_id`, `date`, `status`) VALUES
(13, 22, 1, 1, 2, '0000-00-00 00:00:00', 0),
(14, 21, 1, 1, 1, '0000-00-00 00:00:00', 0),
(15, 20, 1, 1, 1, '0000-00-00 00:00:00', 0),
(16, 21, 1, 1, 2, '0000-00-00 00:00:00', 0),
(17, 22, 1, 1, 2, '0000-00-00 00:00:00', 0),
(19, 22, 1, 2, 2, '2015-10-06 15:11:14', 1),
(20, 22, 1, 2, 1, '2015-10-07 21:58:43', 1),
(21, 23, 2, 1, 2, '2015-10-15 00:28:02', 1),
(23, 23, 2, 1, 2, '2015-10-15 00:28:02', 1),
(24, 23, 2, 1, 2, '2015-10-15 00:28:01', 1),
(25, 23, 2, 1, 2, '2015-10-15 00:24:35', 1),
(26, 23, 2, 1, 2, '2015-10-15 00:28:01', 1),
(27, 23, 2, 1, 2, '2015-10-15 00:28:01', 1),
(28, 23, 2, 1, 2, '2015-10-15 00:27:31', 1),
(29, 23, 2, 1, 2, '2015-10-15 00:24:33', 1),
(30, 23, 2, 1, 2, '2015-10-15 00:24:22', 1),
(31, 23, 2, 1, 2, '2015-10-15 00:24:22', 1),
(33, 22, 1, 1, 1, '2015-10-08 23:14:57', 0),
(34, 21, 1, 1, 2, '2015-10-08 23:45:47', 0),
(35, 21, 1, 1, 2, '2015-10-09 00:07:01', 0),
(36, 21, 1, 1, 2, '2015-10-09 00:08:21', 0),
(37, 21, 1, 1, 2, '2015-10-09 00:08:47', 0),
(38, 21, 1, 1, 2, '2015-10-09 00:30:35', 0),
(39, 20, 1, 1, 2, '2015-10-09 00:34:26', 0),
(40, 20, 1, 1, 2, '2015-10-09 00:34:31', 0),
(41, 20, 1, 1, 2, '2015-10-09 00:37:36', 0),
(42, 20, 1, 1, 2, '2015-10-09 00:38:17', 0),
(43, 22, 1, 1, 2, '2015-10-09 00:38:50', 0),
(44, 20, 1, 2, 2, '2015-10-09 00:40:26', 1),
(45, 20, 1, 1, 2, '2015-10-09 00:40:42', 0),
(46, 25, 1, 1, 1, '2015-10-09 00:58:09', 0),
(48, 24, 1, 1, 2, '2015-10-09 00:58:38', 0),
(50, 25, 1, 1, 2, '2015-10-14 23:48:32', 0),
(54, 24, 1, 1, 1, '2015-10-15 00:07:51', 0),
(55, 23, 2, 1, 1, '2015-10-15 00:24:22', 1),
(56, 0, 2, 1, 3, '2015-10-15 00:24:22', 1),
(57, 0, 1, 2, 3, '2015-10-15 00:39:47', 1),
(58, 24, 1, 2, 1, '2015-10-15 00:39:47', 1),
(59, 25, 1, 2, 1, '2015-10-15 00:39:47', 1),
(60, 25, 1, 2, 2, '2015-10-15 00:39:45', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications_types`
--

CREATE TABLE IF NOT EXISTS `notifications_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `notifications_types`
--

INSERT INTO `notifications_types` (`id`, `name`, `output`, `icon`) VALUES
(1, 'Gostei', 'gostou do seu', 'fa fa-heart'),
(2, 'Comentário', 'comentou seu', 'fa fa-comment'),
(3, 'Seguindo', 'está seguindo você', 'fa fa-user-plus');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Fazendo dump de dados para tabela `posts`
--

INSERT INTO `posts` (`id`, `content`, `type`, `author_id`, `privacity`, `classification`, `picture`, `date`) VALUES
(20, '#one\r\n', 1, 1, 1, 1, NULL, '2015-10-05 18:42:58'),
(21, '#two', 1, 1, 1, 1, NULL, '2015-10-05 18:44:47'),
(22, '#tree', 2, 1, 1, 1, '5612c53325c80.jpg', '2015-10-05 18:45:07'),
(23, 'kkkkkk', 1, 2, 1, 1, NULL, '2015-10-05 23:34:37'),
(24, 'dfgdfgdgd\r\n', 1, 1, 1, 1, NULL, '2015-10-09 00:47:07'),
(25, 'dghgfhngfhfghf', 1, 1, 1, 1, NULL, '2015-10-09 00:47:24');

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
-- Estrutura stand-in para view `vwcommentcount`
--
CREATE TABLE IF NOT EXISTS `vwcommentcount` (
`post_id` int(11)
,`post_comment_count` bigint(21)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwgosteicount`
--
CREATE TABLE IF NOT EXISTS `vwgosteicount` (
`post_id` int(11)
,`post_gostei_count` bigint(21)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vwnotification`
--
CREATE TABLE IF NOT EXISTS `vwnotification` (
`notification_id` int(11)
,`notification_date` timestamp
,`notification_status` int(11)
,`notification_post_id` int(11)
,`notification_post_author_id` int(11)
,`notification_author_id` int(11)
,`notification_author_name` varchar(100)
,`notification_author_picture` varchar(100)
,`notification_action_name` varchar(100)
,`notification_action_output` varchar(100)
,`notification_action_icon` varchar(50)
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
,`post_comments_count` bigint(21)
,`post_gostei_count` bigint(21)
);
-- --------------------------------------------------------

--
-- Estrutura para view `followers`
--
DROP TABLE IF EXISTS `followers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `followers` AS select `friend`.`friend_id` AS `following_id`,`user`.`id` AS `follower_id`,`user`.`name` AS `follower_name`,`user`.`username` AS `follower_username`,`user`.`picture` AS `follower_picture`,`user`.`email` AS `follower_email` from (`user` join `friend` on((`user`.`id` = `friend`.`user_id`))) group by `user`.`id`;

-- --------------------------------------------------------

--
-- Estrutura para view `following`
--
DROP TABLE IF EXISTS `following`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `following` AS select `friend`.`user_id` AS `follower_id`,`user`.`id` AS `following_id`,`user`.`name` AS `following_name`,`user`.`username` AS `following_username`,`user`.`picture` AS `following_picture`,`user`.`email` AS `following_email` from (`user` left join `friend` on((`user`.`id` = `friend`.`friend_id`))) group by `user`.`id`;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwcomment` AS select `comment`.`id` AS `comment_id`,`comment`.`content` AS `comment_content`,`comment`.`date` AS `comment_date`,`comment`.`post_id` AS `comment_post_id`,`user`.`id` AS `comment_author_id`,`user`.`name` AS `comment_author_name`,`user`.`picture` AS `comment_author_picture` from (`comment` join `user` on((`user`.`id` = `comment`.`action_author_id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vwcommentcount`
--
DROP TABLE IF EXISTS `vwcommentcount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwcommentcount` AS select `posts`.`id` AS `post_id`,count(`comment`.`id`) AS `post_comment_count` from (`posts` left join `comment` on((`comment`.`post_id` = `posts`.`id`))) group by `posts`.`id`;

-- --------------------------------------------------------

--
-- Estrutura para view `vwgosteicount`
--
DROP TABLE IF EXISTS `vwgosteicount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwgosteicount` AS select `posts`.`id` AS `post_id`,count(`gostei`.`id`) AS `post_gostei_count` from (`posts` left join `gostei` on((`gostei`.`post_id` = `posts`.`id`))) group by `posts`.`id`;

-- --------------------------------------------------------

--
-- Estrutura para view `vwnotification`
--
DROP TABLE IF EXISTS `vwnotification`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwnotification` AS select `notification`.`id` AS `notification_id`,`notification`.`date` AS `notification_date`,`notification`.`status` AS `notification_status`,`notification`.`post_id` AS `notification_post_id`,`notification`.`post_author_id` AS `notification_post_author_id`,`user`.`id` AS `notification_author_id`,`user`.`name` AS `notification_author_name`,`user`.`picture` AS `notification_author_picture`,`notifications_types`.`name` AS `notification_action_name`,`notifications_types`.`output` AS `notification_action_output`,`notifications_types`.`icon` AS `notification_action_icon` from ((`notification` join `user` on((`user`.`id` = `notification`.`action_author_id`))) join `notifications_types` on((`notification`.`action_id` = `notifications_types`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vwposts`
--
DROP TABLE IF EXISTS `vwposts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwposts` AS select `posts`.`id` AS `post_id`,`posts`.`content` AS `post_content`,`posts`.`type` AS `post_type`,`posts`.`date` AS `post_date`,`posts`.`classification` AS `post_classification`,`posts`.`privacity` AS `post_privacity`,`posts`.`picture` AS `post_picture`,`user`.`id` AS `user_id`,`user`.`name` AS `user_name`,`user`.`picture` AS `user_picture`,`post_types`.`name` AS `post_type_name`,`post_types`.`id` AS `post_type_id`,`vwcommentcount`.`post_comment_count` AS `post_comments_count`,`vwgosteicount`.`post_gostei_count` AS `post_gostei_count` from ((((`posts` join `user` on((`posts`.`author_id` = `user`.`id`))) join `post_types` on((`posts`.`type` = `post_types`.`id`))) left join `vwcommentcount` on((`vwcommentcount`.`post_id` = `posts`.`id`))) left join `vwgosteicount` on((`vwgosteicount`.`post_id` = `posts`.`id`))) group by `posts`.`id`;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`action_author_id`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
