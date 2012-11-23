-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2012 年 11 月 23 日 17:24
-- サーバのバージョン: 5.5.23
-- PHP のバージョン: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `oryzias_blog`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `Blog`
--

CREATE TABLE IF NOT EXISTS `Blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyImageId` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `bodyMarkdown` text NOT NULL,
  `bodyHtmlPc` text NOT NULL,
  `bodyHtmlSp` text NOT NULL,
  `isPublic` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `createdAt` (`createdAt`),
  KEY `keyImageId` (`keyImageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


-- --------------------------------------------------------

--
-- テーブルの構造 `BlogTag`
--

CREATE TABLE IF NOT EXISTS `BlogTag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blogId` int(10) unsigned NOT NULL,
  `TagId` int(10) unsigned NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogId` (`blogId`,`TagId`),
  KEY `blogId_2` (`blogId`),
  KEY `TagId` (`TagId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;


-- --------------------------------------------------------

--
-- テーブルの構造 `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ext` varchar(255) NOT NULL,
  `urlForPc` varchar(255) NOT NULL,
  `urlForSp` varchar(255) NOT NULL,
  `urlForThumbnail` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createdAt` (`createdAt`),
  KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


-- --------------------------------------------------------

--
-- テーブルの構造 `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `createdAt` (`createdAt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `Blog`
--
ALTER TABLE `Blog`
  ADD CONSTRAINT `Blog_ibfk_1` FOREIGN KEY (`keyImageId`) REFERENCES `Image` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- テーブルの制約 `BlogTag`
--
ALTER TABLE `BlogTag`
  ADD CONSTRAINT `BlogTag_ibfk_2` FOREIGN KEY (`TagId`) REFERENCES `Tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BlogTag_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `Blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
