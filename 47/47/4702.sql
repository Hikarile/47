-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-04-09 14:09:28
-- 伺服器版本: 10.1.10-MariaDB
-- PHP 版本： 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `4702`
--

-- --------------------------------------------------------

--
-- 資料表結構 `eat`
--

CREATE TABLE `eat` (
  `id` int(11) NOT NULL,
  `number` text COLLATE utf8_unicode_ci NOT NULL,
  `day` text COLLATE utf8_unicode_ci NOT NULL,
  `mon` text COLLATE utf8_unicode_ci NOT NULL,
  `tp` text COLLATE utf8_unicode_ci NOT NULL,
  `quan` text COLLATE utf8_unicode_ci NOT NULL,
  `menu` text COLLATE utf8_unicode_ci NOT NULL,
  `tab` int(11) NOT NULL,
  `tnum` text COLLATE utf8_unicode_ci NOT NULL,
  `money` text COLLATE utf8_unicode_ci NOT NULL,
  `moneymoney` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `eat`
--

INSERT INTO `eat` (`id`, `number`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `email`, `phone`, `text`) VALUES
(1, '', '', '', '', '', '', 0, '', '', '', '1', '1', '1', '1'),
(2, '201704090004', '30', '30', '30', '30', '30', 30, '30', '', '', 'aa', 'aa', 'aa', 'aa');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `ey` int(11) NOT NULL,
  `py` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `number` text COLLATE utf8_unicode_ci NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `ftime` text COLLATE utf8_unicode_ci NOT NULL,
  `dtime` text COLLATE utf8_unicode_ci NOT NULL,
  `up` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `phone`, `ey`, `py`, `text`, `number`, `time`, `ftime`, `dtime`, `up`) VALUES
(1, 'bbbbb', 'aaa@aa.aa', '0999999999', 1, 1, 'bbbbbb', 'aaa111', '2017/04/08 01:54:49', '2017/04/09 01:39:15', '2017/04/08 02:16:47', 0),
(2, '9999999', 'aaa@aa.aa', '0999999999', 0, 0, '9999999', 'aaa111', '2017/04/08 01:57:12', '2017/04/08 02:20:23', '', 0),
(3, '1', '1', '1', 1, 1, '1', '1', '', '1', '1', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `png`
--

CREATE TABLE `png` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `png` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `reply`
--

INSERT INTO `reply` (`id`, `mid`, `reply`) VALUES
(1, 0, ''),
(2, 3, 'aaaaaaaaaaaaaaa');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `eat`
--
ALTER TABLE `eat`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `png`
--
ALTER TABLE `png`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `eat`
--
ALTER TABLE `eat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `png`
--
ALTER TABLE `png`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
