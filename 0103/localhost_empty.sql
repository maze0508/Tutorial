-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Mar 21, 2011, 11:03 AM
-- 伺服器版本: 5.1.46
-- PHP 版本: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `chou`
--
CREATE DATABASE `chou` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `chou`;

-- --------------------------------------------------------

--
-- 資料表格式： `answer_room`
--

CREATE TABLE IF NOT EXISTS `answer_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_media_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `speak` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `user_media_id` (`user_media_id`,`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;


--
-- 資料表格式： `ccdescript`
--

CREATE TABLE IF NOT EXISTS `ccdescript` (
  `ccdescript_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccdescript_code` int(3) NOT NULL,
  `ccdescript_catalog` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ccdescript_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 列出以下資料庫的數據： `ccdescript`
--

INSERT INTO `ccdescript` (`ccdescript_id`, `ccdescript_code`, `ccdescript_catalog`) VALUES
(1, 1, '創用 CC 姓名標示 2.0 台灣'),
(2, 2, '創用 CC 姓名標示-非商業性 2.0 台灣'),
(3, 3, '創用 CC 姓名標示-非商業性-相同方式分享 2.0 台灣'),
(4, 4, '創用 CC 姓名標示-禁止改作 2.0 台灣'),
(5, 5, '創用 CC 姓名標示-非商業性-禁止改作 2.0 台灣'),
(6, 6, '創用 CC 姓名標示-相同方式分享 2.0 台灣');

-- --------------------------------------------------------

--
-- 資料表格式： `children`
--

CREATE TABLE IF NOT EXISTS `children` (
  `children_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_media_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `children_content` text COLLATE utf8_unicode_ci NOT NULL,
  `children_area` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`children_id`),
  KEY `user_media_id` (`user_media_id`,`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 資料表格式： `children_relate`
--

CREATE TABLE IF NOT EXISTS `children_relate` (
  `children_relate_id` int(11) NOT NULL AUTO_INCREMENT,
  `children_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `relate` text COLLATE utf8_unicode_ci NOT NULL,
  `children_relate_date` date NOT NULL,
  PRIMARY KEY (`children_relate_id`),
  KEY `children_id` (`children_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- 資料表格式： `children_room`
--

CREATE TABLE IF NOT EXISTS `children_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_media_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `speak` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `user_media_id` (`user_media_id`,`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- 資料表格式： `common`
--

CREATE TABLE IF NOT EXISTS `common` (
  `common_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `common_account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `common_unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `common_email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`common_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 資料表格式： `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_year` int(11) NOT NULL,
  `course_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_start` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `course_end` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `course_info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;


--
-- 資料表格式： `course_stu`
--

CREATE TABLE IF NOT EXISTS `course_stu` (
  `course_stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`course_stu_id`),
  UNIQUE KEY `index` (`course_id`,`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=118 ;

--
-- 資料表格式： `course_team`
--

CREATE TABLE IF NOT EXISTS `course_team` (
  `course_team_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`course_team_id`),
  KEY `buffer` (`team_id`,`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;


--
-- 資料表格式： `density`
--

CREATE TABLE IF NOT EXISTS `density` (
  `density_id` int(11) NOT NULL AUTO_INCREMENT,
  `density_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `density_catalog` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`density_id`),
  KEY `density_code` (`density_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 列出以下資料庫的數據： `density`
--

INSERT INTO `density` (`density_id`, `density_code`, `density_catalog`) VALUES
(1, 'very low', '非常低'),
(2, 'low', '低'),
(3, 'medium', '中等'),
(4, 'high', '高'),
(5, 'very high', '非常高');

-- --------------------------------------------------------

--
-- 資料表格式： `difficulty`
--

CREATE TABLE IF NOT EXISTS `difficulty` (
  `difficulty_id` int(11) NOT NULL AUTO_INCREMENT,
  `difficulty_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `difficulty_catalog` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`difficulty_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 列出以下資料庫的數據： `difficulty`
--

INSERT INTO `difficulty` (`difficulty_id`, `difficulty_code`, `difficulty_catalog`) VALUES
(1, 'very easy', '非常簡單'),
(2, 'easy', '簡單'),
(3, 'medium', '中等'),
(4, 'difficult', '困難'),
(5, 'very difficult', '非常困難');

-- --------------------------------------------------------

--
-- 資料表格式： `edit_books`
--

CREATE TABLE IF NOT EXISTS `edit_books` (
  `edit_books_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_media_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT '教材製作者',
  `density_id` int(11) DEFAULT NULL COMMENT '語意密度',
  `difficulty_id` int(11) DEFAULT NULL COMMENT '困難度',
  `subject` text COLLATE utf8_unicode_ci,
  `slesson` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '學級',
  `learn_source` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT '學習資源類型',
  `context` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '情境',
  `intended_user` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '適用對象',
  `learn_time` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '基本教學時數',
  `books_target` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '學習目標',
  `books_content` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '學習內容',
  `books_concept` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '學習概念',
  `books_step` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '學習步驟',
  PRIMARY KEY (`edit_books_id`),
  KEY `member_id` (`member_id`),
  KEY `density_id` (`density_id`),
  KEY `difficulty_id` (`difficulty_id`),
  KEY `slesson_id` (`slesson`),
  KEY `user_media_id` (`user_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- 資料表格式： `identifier`
--

CREATE TABLE IF NOT EXISTS `identifier` (
  `ident_id` int(11) NOT NULL AUTO_INCREMENT,
  `ident_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ident_catalog` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ident_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- 列出以下資料庫的數據： `identifier`
--

INSERT INTO `identifier` (`ident_id`, `ident_code`, `ident_catalog`) VALUES
(1, 'LEA', '學習加油站'),
(2, 'CHC', '彰化縣'),
(3, 'TNC', '台南縣'),
(4, 'TPE', '台北市'),
(5, 'ECC', '亞卓市'),
(6, 'ILC', '宜蘭縣'),
(7, 'HCC', '新竹縣'),
(8, 'TPC', '台北縣'),
(9, 'SCA', '思摩特'),
(10, 'HLC', '花蓮縣'),
(11, 'CYK', '嘉義市'),
(12, 'KHC', '高雄市'),
(13, 'TCH', '台中市'),
(14, 'CIP', '原民會'),
(15, 'DAR', '數位典藏學習資源網'),
(16, 'ANC', '網路錨式教學網');

-- --------------------------------------------------------

--
-- 資料表格式： `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `language_catalog` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 列出以下資料庫的數據： `language`
--

INSERT INTO `language` (`language_id`, `language_code`, `language_catalog`) VALUES
(1, 'zh-TW', '中文'),
(2, 'zh-TW', '閩南語'),
(3, 'zh-TW', '客家語'),
(4, 'zh-TW', '原住民語'),
(5, 'en', '英文');

-- --------------------------------------------------------

--
-- 資料表格式： `learning`
--

CREATE TABLE IF NOT EXISTS `learning` (
  `learning_id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `learning_start` date NOT NULL,
  `learning_end` date NOT NULL,
  `learning_content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `edit_books_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`learning_id`),
  KEY `edit_books_id` (`edit_books_id`,`subject_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- 資料表格式： `learning_team`
--

CREATE TABLE IF NOT EXISTS `learning_team` (
  `learning_team_id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`learning_team_id`),
  KEY `learning_id` (`learning_id`,`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- 資料表格式： `learning_think`
--

CREATE TABLE IF NOT EXISTS `learning_think` (
  `learning_think_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_media_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `think` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`learning_think_id`),
  KEY `member_id` (`member_id`),
  KEY `user_media_id` (`user_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 資料表格式： `media_anchor`
--

CREATE TABLE IF NOT EXISTS `media_anchor` (
  `media_anchor_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `user_media_id` int(11) NOT NULL,
  `anchor_descript` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `anchor_time` int(5) NOT NULL,
  `anchor_date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`media_anchor_id`),
  KEY `member_id` (`member_id`,`user_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- 資料表格式： `media_favorite`
--

CREATE TABLE IF NOT EXISTS `media_favorite` (
  `media_favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `user_media_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`media_favorite_id`),
  KEY `member_id` (`member_id`,`user_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 資料表格式： `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `iclass` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compet` int(11) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- 資料表格式： `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role_catalog` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `role`
--

INSERT INTO `role` (`role_id`, `role_code`, `role_catalog`) VALUES
(1, 'author', '作者'),
(2, 'provider', '提供者'),
(3, 'validator', '教育確認者');

-- --------------------------------------------------------

--
-- 資料表格式： `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `user_media_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `speak` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `user_media_id` (`user_media_id`,`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- 資料表格式： `slesson`
--

CREATE TABLE IF NOT EXISTS `slesson` (
  `slesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `slesson_code` int(11) NOT NULL,
  `slesson_catalog` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`slesson_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 列出以下資料庫的數據： `slesson`
--

INSERT INTO `slesson` (`slesson_id`, `slesson_code`, `slesson_catalog`) VALUES
(1, 1, '國小一年級'),
(2, 2, '國小二年級'),
(3, 3, '國小三年級'),
(4, 4, '國小四年級'),
(5, 5, '國小五年級'),
(6, 6, '國小六年級'),
(7, 7, '國中一年級'),
(8, 8, '國中二年級'),
(9, 9, '國中三年級');

-- --------------------------------------------------------

--
-- 資料表格式： `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `source_catalog` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 列出以下資料庫的數據： `source`
--

INSERT INTO `source` (`source_id`, `source_code`, `source_catalog`) VALUES
(1, 'A', '教學設計'),
(2, 'B', '教材'),
(3, 'C', '素材'),
(4, 'D', '學習單'),
(5, 'E', '教學活動');

-- --------------------------------------------------------

--
-- 資料表格式： `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject_catalog` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- 列出以下資料庫的數據： `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_code`, `subject_catalog`) VALUES
(1, '語文', '國語'),
(2, '語文', '閩南語'),
(3, '語文', '客家語'),
(4, '語文', '原住民語'),
(5, '語文', '英文'),
(6, '健康與體育', '健康與體育'),
(7, '數學', '數學'),
(8, '社會', '社會'),
(9, '藝術與人文', '藝術與人文'),
(10, '自然與生活科技', '自然與生活科技'),
(11, '綜合活動', '綜合活動'),
(12, '生活', '生活'),
(13, '資訊教育', '資訊教育'),
(14, '環境教育', '環境教育'),
(15, '兩性教育', '性別平等教育'),
(16, '人權教育', '人權教育'),
(17, '生涯發展教育', '生涯發展教育'),
(18, '家政教育', '家政教育'),
(19, '其他', '其他');

-- --------------------------------------------------------

--
-- 資料表格式： `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- 資料表格式： `team_member`
--

CREATE TABLE IF NOT EXISTS `team_member` (
  `team_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`team_member_id`),
  KEY `team_id` (`team_id`,`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- 資料表格式： `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 資料表格式： `user_media`
--

CREATE TABLE IF NOT EXISTS `user_media` (
  `user_media_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier_id` int(11) DEFAULT '16',
  `source_id` int(11) DEFAULT '1',
  `title` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `keyword` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coverage` text COLLATE utf8_unicode_ci,
  `version` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT '1',
  `common_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL COMMENT '使用者編號',
  `design_date` date DEFAULT NULL COMMENT '影片製作日期',
  `public_date` date NOT NULL,
  `cost` varchar(4) COLLATE utf8_unicode_ci DEFAULT 'no' COMMENT '是否付費',
  `copyright` varchar(4) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `ccdescription_id` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_media_id`),
  KEY `buffer` (`identifier_id`,`source_id`,`role_id`,`member_id`,`ccdescription_id`,`keyword`),
  KEY `common_id` (`common_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
