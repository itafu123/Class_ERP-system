-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-12-09 00:54:25
-- 伺服器版本: 10.1.16-MariaDB
-- PHP 版本： 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `advanceddb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `company`
--

CREATE TABLE `company` (
  `name` varchar(15) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `taxid` varchar(10) NOT NULL,
  `leader` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `company`
--

INSERT INTO `company` (`name`, `tel`, `address`, `taxid`, `leader`) VALUES
('chocolate', '0426324777', 'taiwan', '77974596', 'lvann');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `cid` varchar(13) NOT NULL,
  `cname` varchar(15) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `taxid` varchar(10) NOT NULL,
  `leader` varchar(5) NOT NULL,
  `tcondition` varchar(100) NOT NULL,
  `begin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `department`
--

CREATE TABLE `department` (
  `did` char(4) NOT NULL,
  `dname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `department`
--

INSERT INTO `department` (`did`, `dname`) VALUES
('d001', '會計部'),
('d002', '物流部');

-- --------------------------------------------------------

--
-- 資料表結構 `function`
--

CREATE TABLE `function` (
  `fid` char(4) NOT NULL,
  `fname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `function`
--

INSERT INTO `function` (`fid`, `fname`) VALUES
('f001', '更改各人資料'),
('f002', '註冊員工'),
('f003', '更改權限'),
('f004', '刪除員工');

-- --------------------------------------------------------

--
-- 資料表結構 `manufacturer`
--

CREATE TABLE `manufacturer` (
  `mid` varchar(13) NOT NULL,
  `mname` int(15) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `taxid` varchar(10) NOT NULL,
  `leader` varchar(5) NOT NULL,
  `tcondition` varchar(100) NOT NULL,
  `begin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `permission`
--

CREATE TABLE `permission` (
  `ssid` char(4) NOT NULL,
  `did` char(4) NOT NULL,
  `pid` char(4) NOT NULL,
  `fid` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `permission`
--

INSERT INTO `permission` (`ssid`, `did`, `pid`, `fid`) VALUES
('s001', 'd001', 'p001', 'f001'),
('s002', 'd001', 'p002', 'f001'),
('s003', 'd001', 'p002', 'f002'),
('s004', 'd001', 'p002', 'f003'),
('s005', 'd001', 'p002', 'f004'),
('s006', 'd001', 'p003', 'f001'),
('s007', 'd001', 'p003', 'f002'),
('s008', 'd001', 'p003', 'f003'),
('s009', 'd001', 'p003', 'f004');

-- --------------------------------------------------------

--
-- 資料表結構 `position`
--

CREATE TABLE `position` (
  `pid` char(4) NOT NULL,
  `pname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `position`
--

INSERT INTO `position` (`pid`, `pname`) VALUES
('p001', '中階員工'),
('p002', '高階員工'),
('p003', '老闆');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pid` varchar(13) NOT NULL,
  `pname` varchar(15) NOT NULL,
  `price` varchar(5) NOT NULL,
  `pcid` varchar(13) NOT NULL,
  `mid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `product_class`
--

CREATE TABLE `product_class` (
  `pcid` varchar(13) NOT NULL,
  `level` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uid` char(13) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `uname` varchar(10) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `salary` varchar(6) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `did` char(4) NOT NULL,
  `pid` char(4) NOT NULL,
  `employment` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`uid`, `passwd`, `uname`, `tel`, `salary`, `begin`, `end`, `email`, `did`, `pid`, `employment`) VALUES
('u171124000001', '123456', 'ita', '0983058388', '22000', '0000-00-00', '0000-00-00', 'ita123@gmail.com', 'd001', 'p001', '1'),
('u171124000002', '123456', 'amy', '0965214487', '32000', '0000-00-00', '0000-00-00', 'amy123@gmail.com', 'd001', 'p002', '1'),
('u171124000003', '123456', 'lvanna', '0983690056', '62000', '0000-00-00', '0000-00-00', 'lvanna9786@gmail.com', 'd001', 'p003', '1'),
('u171125000001', '123456', 'gigi', '0918011844', '22000', '0000-00-00', '0000-00-00', 'gigi456@gmail.com', 'd001', 'p001', '1'),
('u171125000002', '654321', 'eva', '0952316689', '22000', '0000-00-00', '0000-00-00', 'eva789@gmail.com', 'd002', 'p001', '1');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- 資料表索引 `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`did`);

--
-- 資料表索引 `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`fid`);

--
-- 資料表索引 `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`mid`);

--
-- 資料表索引 `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`ssid`);

--
-- 資料表索引 `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
