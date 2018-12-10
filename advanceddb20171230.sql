-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-12-30 09:11:26
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
-- 資料表結構 `bom`
--

CREATE TABLE `bom` (
  `father_id` varchar(5) NOT NULL,
  `son_id` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `bom`
--

INSERT INTO `bom` (`father_id`, `son_id`, `quantity`) VALUES
('b001', 'po001', 10),
('b002', 'po001', 2),
('b002', 'po003', 1),
('b003', 'po002', 4),
('b003', 'po003', 2),
('po001', 'ch001', 10),
('po002', 'ch001', 5),
('po002', 'ch002', 5),
('po003', 'ch004', 10),
('po004', 'ch001', 7),
('po004', 'ch003', 7);

-- --------------------------------------------------------

--
-- 資料表結構 `box`
--

CREATE TABLE `box` (
  `bid` varchar(4) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `reserve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `box`
--

INSERT INTO `box` (`bid`, `bname`, `price`, `reserve`) VALUES
('b001', 'mm箱', 2500, 5),
('b002', '冬季mm箱', 1500, 3),
('b003', '冬季大波mm箱', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `box_pouch`
--

CREATE TABLE `box_pouch` (
  `bid` varchar(4) NOT NULL,
  `poid` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `box_pouch`
--

INSERT INTO `box_pouch` (`bid`, `poid`, `quantity`) VALUES
('b001', 'po001', 10),
('b002', 'po001', 2),
('b002', 'po003', 1),
('b003', 'po003', 2),
('b003', 'po002', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `chocolate`
--

CREATE TABLE `chocolate` (
  `chid` varchar(5) NOT NULL,
  `chname` varchar(20) NOT NULL,
  `mid` varchar(13) NOT NULL,
  `price` int(11) NOT NULL,
  `reserve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `chocolate`
--

INSERT INTO `chocolate` (`chid`, `chname`, `mid`, `price`, `reserve`) VALUES
('ch001', 'mm巧克力', 'm201712250001', 25, 3),
('ch002', '大波露', 'm201712250001', 10, 3),
('ch003', '德芙', 'm201712250002', 35, 4),
('ch004', '冬季戀人', 'm201712250002', 100, 5),
('ch005', '跳跳糖巧克力', 'm201712250001', 0, 0);

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
('chocolate', '0426324777', 'taiwan', '7797459', 'lvann');

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
  `begin` date NOT NULL,
  `usingg` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `customer`
--

INSERT INTO `customer` (`cid`, `cname`, `tel`, `address`, `taxid`, `leader`, `tcondition`, `begin`, `usingg`) VALUES
('c000001', '555', '66', '66', '22', '22', '???', '2017-12-26', 0),
('c201712260000', '33', '33', '33', '33', '33', '???', '2017-12-26', 1);

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
('f004', '刪除員工'),
('f005', '新增部門'),
('f006', '新增職位'),
('f007', '修改員工資料'),
('f008', '新增商品資料');

-- --------------------------------------------------------

--
-- 資料表結構 `manufacturer`
--

CREATE TABLE `manufacturer` (
  `mid` varchar(13) NOT NULL,
  `mname` varchar(15) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `taxid` varchar(10) NOT NULL,
  `leader` varchar(5) NOT NULL,
  `tcondition` varchar(100) NOT NULL,
  `begin` date NOT NULL,
  `usingg` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `manufacturer`
--

INSERT INTO `manufacturer` (`mid`, `mname`, `tel`, `address`, `taxid`, `leader`, `tcondition`, `begin`, `usingg`) VALUES
('m201712250001', '統一企業', '0900000000', '台灣統一路', '56821302', '陳統2', '先付款', '2017-12-25', 0),
('m201712250002', '明治', '0231111100', '台灣台北忠孝東路', '465897112', '木村拓哉', '分期付款', '2017-12-25', 0);

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
('s006', 'd000', 'p000', 'f001'),
('s007', 'd000', 'p000', 'f002'),
('s008', 'd000', 'p000', 'f003'),
('s009', 'd000', 'p000', 'f004'),
('s010', 'd002', 'p004', 'f001'),
('s011', 'd000', 'p000', 'f005'),
('s012', 'd000', 'p000', 'f006'),
('s013', 'd000', 'p000', 'f007'),
('s014', 'd000', 'p000', 'f008');

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
('p000', '老闆'),
('p001', '中階員工'),
('p002', '高階員工'),
('p004', '物流低層員工');

-- --------------------------------------------------------

--
-- 資料表結構 `pouch`
--

CREATE TABLE `pouch` (
  `poid` varchar(5) NOT NULL,
  `poname` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `reserve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `pouch`
--

INSERT INTO `pouch` (`poid`, `poname`, `price`, `reserve`) VALUES
('po001', 'mm袋', 250, 2),
('po002', '大波mm袋', 175, 4),
('po003', '冬季戀人袋', 1000, 2),
('po004', '德芙mm袋', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `pouch_chocolate`
--

CREATE TABLE `pouch_chocolate` (
  `poid` varchar(5) NOT NULL,
  `chid` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `pouch_chocolate`
--

INSERT INTO `pouch_chocolate` (`poid`, `chid`, `quantity`) VALUES
('po001', 'ch001', 10),
('po002', 'ch001', 5),
('po002', 'ch002', 5),
('po003', 'ch004', 10),
('po004', 'ch001', 7),
('po004', 'ch003', 7);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uid` char(13) NOT NULL,
  `passwd` varchar(80) NOT NULL,
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
('u171124000000', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'boss', '0983690056', '62000', '0000-00-00', '0000-00-00', 'lvanna9786@gmail.com', 'd000', 'p000', '1'),
('u171124000002', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'amy', '0965214487', '32000', '0000-00-00', '0000-00-00', 'amy123@gmail.com', 'd001', 'p002', '1'),
('u171125000002', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'eva', '0952316689', '22000', '0000-00-00', '0000-00-00', 'eva789@gmail.com', 'd002', 'p004', '1'),
('u171215000000', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ita', '0258888888', '10000', '2017-12-01', '2017-12-28', 'ita123@gmail.com', 'd001', 'p001', '1'),
('u201712280000', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'julia', '021546875', '0', '2017-12-28', '0000-00-00', 'julia@gmail.com', 'd001', 'p001', '1');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`father_id`,`son_id`);

--
-- 資料表索引 `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`bid`);

--
-- 資料表索引 `chocolate`
--
ALTER TABLE `chocolate`
  ADD PRIMARY KEY (`chid`);

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
-- 資料表索引 `pouch`
--
ALTER TABLE `pouch`
  ADD PRIMARY KEY (`poid`);

--
-- 資料表索引 `pouch_chocolate`
--
ALTER TABLE `pouch_chocolate`
  ADD PRIMARY KEY (`poid`,`chid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
