-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-04-29 13:01:01
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
  `new` text COLLATE utf8_unicode_ci NOT NULL COMMENT '訂餐當天',
  `day` text COLLATE utf8_unicode_ci NOT NULL,
  `mon` text COLLATE utf8_unicode_ci NOT NULL,
  `tp` text COLLATE utf8_unicode_ci NOT NULL,
  `quan` int(11) NOT NULL,
  `menu` text COLLATE utf8_unicode_ci NOT NULL,
  `tab` int(11) NOT NULL,
  `tnum` text COLLATE utf8_unicode_ci NOT NULL,
  `money` text COLLATE utf8_unicode_ci NOT NULL,
  `moneymoney` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `dd` text COLLATE utf8_unicode_ci NOT NULL COMMENT '訂餐的當週一'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `eat`
--

INSERT INTO `eat` (`id`, `number`, `new`, `day`, `mon`, `tp`, `quan`, `menu`, `tab`, `tnum`, `money`, `moneymoney`, `name`, `email`, `phone`, `text`, `dd`) VALUES
(1, '201704240001', '20170424', '2017-04-26', '星期三', '午餐', 20, 'aaa', 1, '05,', '2000', '200', 'bbb', 'bbbb', 'bbb', 'bbb', '20170424'),
(2, '201704240002', '20170424', '2017-04-26', '星期三', '午餐', 1, 'xzczxczxczxc', 1, '01,', '600', '60', 'asdasd', 'asdasd', 'asdasd', 'asdasd', '20170424');

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` text COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `menu`
--

INSERT INTO `menu` (`id`, `menu`, `money`) VALUES
(2, 'aaa', 100),
(3, 'bbb', 200),
(8, 'xzczxczxczxc', 600),
(10, '0000', 505050505);

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
(1, 'aaa', 'aa@aa.aa', '0123456789', 1, 1, 'aaa', 'aaa111', '2017/04/24 11:09:44', '2017/04/24 13:36:34', '', 0),
(2, 'ccccb2', 'bbb@bb.bb', '000000', 0, 1, 'ccccccc', 'bbb222', '2017/04/24 12:20:50', '2017/04/24 13:34:44', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `png`
--

CREATE TABLE `png` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `png` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `png`
--

INSERT INTO `png` (`id`, `mid`, `png`) VALUES
(2, 1, 'Koala.jpg'),
(5, 2, 'Lighthouse.jpg'),
(6, 2, 'Tulips.jpg'),
(7, 2, 'Jellyfish.jpg'),
(8, 1, 'Penguins.jpg');

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
-- 已匯出資料表的索引
--

--
-- 資料表索引 `eat`
--
ALTER TABLE `eat`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
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
-- 使用資料表 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用資料表 AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `png`
--
ALTER TABLE `png`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用資料表 AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
