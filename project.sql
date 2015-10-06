-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Out-2015 às 22:07
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
-- Estrutura da tabela `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comment`
--

INSERT INTO `comment` (`id`, `content`, `date`, `post_id`, `post_author_id`, `action_author_id`) VALUES
(1, '#tree', '2015-10-05 18:45:32', 22, 1, 1),
(2, '#two', '2015-10-05 18:45:50', 21, 1, 1),
(3, '#tree', '2015-10-05 18:46:11', 22, 1, 1),
(4, 'fdgdfgd', '2015-10-06 15:10:57', 22, 1, 2);

--
-- Acionadores `comment`
--
DELIMITER $$
CREATE TRIGGER `generate_notification_comment` AFTER INSERT ON `comment`
 FOR EACH ROW BEGIN
INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.action_author_id, post_author_id = NEW.post_author_id, action_id = 2;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_notification_comment_del` AFTER DELETE ON `comment`
 FOR EACH ROW BEGIN
	DELETE FROM notification WHERE (post_id = OLD.post_id AND action_user_id = OLD.action_author_id AND action_id = 2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `followers`
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
-- Stand-in structure for view `following`
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
-- Estrutura da tabela `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `friend`
--

INSERT INTO `friend` (`user_id`, `friend_id`) VALUES
(1, 2),
(1, 2),
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gostei`
--

CREATE TABLE IF NOT EXISTS `gostei` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gostei`
--

INSERT INTO `gostei` (`id`, `post_id`, `post_author_id`, `action_author_id`, `date`) VALUES
(2, 21, 1, 1, '2015-10-05 18:45:40'),
(3, 20, 1, 1, '2015-10-05 18:45:44');

--
-- Acionadores `gostei`
--
DELIMITER $$
CREATE TRIGGER `generate_notification_gostei` AFTER INSERT ON `gostei`
 FOR EACH ROW INSERT INTO notification SET post_id = NEW.post_id, action_author_id = NEW.action_author_id, post_author_id = NEW.post_author_id, action_id = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_notification_gostei_del` AFTER DELETE ON `gostei`
 FOR EACH ROW DELETE FROM notification WHERE (post_id = OLD.post_id AND action_author_id = OLD.action_author_id AND post_author_id=OLD.post_author_id AND action_id = 1)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `action_author_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '1 = notificacao vista, 0 = notificacao nao vista'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notification`
--

INSERT INTO `notification` (`id`, `post_id`, `post_author_id`, `action_author_id`, `action_id`, `date`, `status`) VALUES
(13, 22, 1, 1, 2, '0000-00-00 00:00:00', 0),
(14, 21, 1, 1, 1, '0000-00-00 00:00:00', 0),
(15, 20, 1, 1, 1, '0000-00-00 00:00:00', 0),
(16, 21, 1, 1, 2, '0000-00-00 00:00:00', 0),
(17, 22, 1, 1, 2, '0000-00-00 00:00:00', 0),
(19, 22, 1, 2, 2, '2015-10-06 15:11:14', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications_types`
--

CREATE TABLE IF NOT EXISTS `notifications_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notifications_types`
--

INSERT INTO `notifications_types` (`id`, `name`, `output`) VALUES
(1, 'Gostei', 'gostou do seu'),
(2, 'Comentar', 'comentou seu');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `content`, `type`, `author_id`, `privacity`, `classification`, `picture`, `date`) VALUES
(20, '#one\r\n', 1, 1, 1, 1, NULL, '2015-10-05 18:42:58'),
(21, '#two', 1, 1, 1, 1, NULL, '2015-10-05 18:44:47'),
(22, '#tree', 2, 1, 1, 1, '5612c53325c80.jpg', '2015-10-05 18:45:07'),
(23, 'kkkkkk', 1, 2, 1, 1, NULL, '2015-10-05 23:34:37');

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
  `password` varchar(255) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `picture`, `salt`) VALUES
(1, 'Diego Mi Campos', 'diegomi', 'diegomister@gmail.com', '1234', '560a914bb9ae5.jpg', ''),
(2, 'User Test', 'test', 'test@gmail.com', 'test', NULL, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwcomment`
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
-- Stand-in structure for view `vwfriend`
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
-- Stand-in structure for view `vwfriendflrs`
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
-- Stand-in structure for view `vwnotification`
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
,`notification_action_output` varchar(100)
);

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
,`post_comments_count` bigint(21)
,`post_gostei_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `followers`
--
DROP TABLE IF EXISTS `followers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `followers` AS select `friend`.`friend_id` AS `following_id`,`user`.`id` AS `follower_id`,`user`.`name` AS `follower_name`,`user`.`username` AS `follower_username`,`user`.`picture` AS `follower_picture`,`user`.`email` AS `follower_email` from (`user` join `friend` on((`user`.`id` = `friend`.`user_id`)));

-- --------------------------------------------------------

--
-- Structure for view `following`
--
DROP TABLE IF EXISTS `following`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `following` AS select `friend`.`user_id` AS `follower_id`,`user`.`id` AS `following_id`,`user`.`name` AS `following_name`,`user`.`username` AS `following_username`,`user`.`picture` AS `following_picture`,`user`.`email` AS `following_email` from (`user` join `friend` on((`user`.`id` = `friend`.`friend_id`)));

-- --------------------------------------------------------

--
-- Structure for view `profile`
--
DROP TABLE IF EXISTS `profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile` AS select `user`.`id` AS `id`,`user`.`name` AS `name`,`user`.`username` AS `username`,`user`.`picture` AS `picture`,`user`.`email` AS `email` from `user`;

-- --------------------------------------------------------

--
-- Structure for view `vwcomment`
--
DROP TABLE IF EXISTS `vwcomment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwcomment` AS select `comment`.`id` AS `comment_id`,`comment`.`content` AS `comment_content`,`comment`.`date` AS `comment_date`,`comment`.`post_id` AS `comment_post_id`,`user`.`id` AS `comment_author_id`,`user`.`name` AS `comment_author_name`,`user`.`picture` AS `comment_author_picture` from (`comment` join `user` on((`user`.`id` = `comment`.`action_author_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vwfriend`
--
DROP TABLE IF EXISTS `vwfriend`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwfriend` AS select `friend`.`user_id` AS `user_id`,`user`.`id` AS `friend_id`,`user`.`name` AS `friend_name`,`user`.`username` AS `friend_username`,`user`.`picture` AS `friend_picture`,`user`.`email` AS `friend_email` from (`user` join `friend` on((`user`.`id` = `friend`.`friend_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vwfriendflrs`
--
DROP TABLE IF EXISTS `vwfriendflrs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwfriendflrs` AS select `friend`.`friend_id` AS `user_id`,`friend`.`user_id` AS `friend_id`,`user`.`name` AS `friend_name`,`user`.`username` AS `friend_username`,`user`.`picture` AS `friend_picture`,`user`.`email` AS `friend_email` from (`user` join `friend` on((`user`.`id` = `friend`.`user_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vwnotification`
--
DROP TABLE IF EXISTS `vwnotification`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwnotification` AS select `notification`.`id` AS `notification_id`,`notification`.`date` AS `notification_date`,`notification`.`status` AS `notification_status`,`notification`.`post_id` AS `notification_post_id`,`notification`.`post_author_id` AS `notification_post_author_id`,`user`.`id` AS `notification_author_id`,`user`.`name` AS `notification_author_name`,`user`.`picture` AS `notification_author_picture`,`notifications_types`.`output` AS `notification_action_output` from ((`notification` join `user` on((`user`.`id` = `notification`.`action_author_id`))) join `notifications_types` on((`notification`.`action_id` = `notifications_types`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vwposts`
--
DROP TABLE IF EXISTS `vwposts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwposts` AS select `posts`.`id` AS `post_id`,`posts`.`content` AS `post_content`,`posts`.`type` AS `post_type`,`posts`.`date` AS `post_date`,`posts`.`classification` AS `post_classification`,`posts`.`privacity` AS `post_privacity`,`posts`.`picture` AS `post_picture`,`user`.`id` AS `user_id`,`user`.`name` AS `user_name`,`user`.`picture` AS `user_picture`,`post_types`.`name` AS `post_type_name`,`post_types`.`id` AS `post_type_id`,count(`comment`.`id`) AS `post_comments_count`,count(`gostei`.`id`) AS `post_gostei_count` from ((((`posts` join `user` on((`posts`.`author_id` = `user`.`id`))) join `post_types` on((`posts`.`type` = `post_types`.`id`))) left join `comment` on((`comment`.`post_id` = `posts`.`id`))) left join `gostei` on((`gostei`.`post_id` = `posts`.`id`))) group by `posts`.`id`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`), ADD KEY `post_id` (`post_id`), ADD KEY `post_author_id` (`post_author_id`), ADD KEY `action_author_id` (`action_author_id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD KEY `user_id` (`user_id`), ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `gostei`
--
ALTER TABLE `gostei`
  ADD PRIMARY KEY (`id`), ADD KEY `post_id` (`post_id`), ADD KEY `post_author_id` (`post_author_id`), ADD KEY `action_author_id` (`action_author_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`), ADD KEY `post_id` (`post_id`), ADD KEY `post_author_id` (`post_author_id`), ADD KEY `action_author_id` (`action_author_id`), ADD KEY `action_id` (`action_id`);

--
-- Indexes for table `notifications_types`
--
ALTER TABLE `notifications_types`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gostei`
--
ALTER TABLE `gostei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `notifications_types`
--
ALTER TABLE `notifications_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
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
-- Limitadores para a tabela `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`action_author_id`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `friend`
--
ALTER TABLE `friend`
ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
