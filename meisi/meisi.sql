-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-01-30 05:28:01
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `meisi`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_post_code` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_added_user` varchar(255) NOT NULL,
  `company_added_date` date NOT NULL,
  `company_updated_user` varchar(255) DEFAULT NULL,
  `company_updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `person_division` varchar(255) NOT NULL,
  `person_phone_number` varchar(255) DEFAULT NULL,
  `person_mail_address` varchar(255) DEFAULT NULL,
  `person_image_pass` varchar(255) DEFAULT NULL,
  `person_added_user` varchar(255) NOT NULL,
  `person_added_date` date NOT NULL,
  `person_updated_user` varchar(255) DEFAULT NULL,
  `person_updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- テーブルのインデックス `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
