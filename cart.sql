-- --------------------------------------------------------
-- 主機:                           localhost
-- 伺服器版本:                        10.4.28-MariaDB - mariadb.org binary distribution
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 傾印  資料表 test.buyerdata 結構
CREATE TABLE IF NOT EXISTS `buyerdata` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
  `passwd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0000',
  `realName` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'unknow',
  `nickName` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'buyer',
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- 取消選取資料匯出。

-- 傾印  資料表 test.cart 結構
CREATE TABLE IF NOT EXISTS `cart` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) DEFAULT NULL COMMENT '買家uid',
  `pid` int(11) DEFAULT NULL COMMENT '商品uid',
  `count` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- 取消選取資料匯出。

-- 傾印  資料表 test.sellerdata 結構
CREATE TABLE IF NOT EXISTS `sellerdata` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
  `passwd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0000',
  `realName` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'unknow',
  `nickName` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'seller',
  `ts` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- 取消選取資料匯出。

-- 傾印  資料表 test.shop 結構
CREATE TABLE IF NOT EXISTS `shop` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL COMMENT '賣家id',
  `count` int(11) DEFAULT 1 COMMENT '商品數量',
  `pName` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-' COMMENT '商品名稱',
  `amount` int(11) DEFAULT 0 COMMENT '價格',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- 取消選取資料匯出。

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
