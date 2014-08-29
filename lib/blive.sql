-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2014 at 10:59 AM
-- Server version: 5.5.38-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `goodbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `privacy` varchar(255) NOT NULL,
  `available_list` longtext NOT NULL,
  `highlight` varchar(255) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` longtext NOT NULL,
  `uid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `to_uid` int(255) NOT NULL,
  `to_pid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `likes` longtext NOT NULL,
  `img_url` varchar(30000) NOT NULL,
  `time` varchar(500) NOT NULL,
  `timm` varchar(500) NOT NULL,
  `month` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `type`, `privacy`, `available_list`, `highlight`, `title`, `content`, `uid`, `pid`, `to_uid`, `to_pid`, `iid`, `likes`, `img_url`, `time`, `timm`, `month`) VALUES
(1, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 3, '3', '', '1408091228', '', ''),
(2, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 4, '', '', '1408091228', '', ''),
(3, 'stt', 'public', '', '', '', 'I post somthing~ just a normal status', 3, 0, 3, 0, 0, '3', '', '1408100928', '', ''),
(4, 'new-promise', 'public', '', '', '', '', 1, 0, 1, 0, 1, '', '', '1408091228', '', ''),
(5, 'new-promise', 'public', '', '', '', '', 1, 0, 1, 0, 2, '', '', '1408091228', '', ''),
(6, 'photo', 'public', '', '', '', '<p>Mr. Charming :3</p>', 3, 0, 3, 0, 0, '3', 'data/img/3.jpg', '1408140840', '', ''),
(7, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 6, '', '', '1408140911', '', ''),
(8, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 3, '', '', '1408140913', '', ''),
(9, 'photo', 'public', '', '', '', '<p>Josh Dallas :3</p>', 3, 0, 3, 0, 0, '3, 1', 'data/img/7.jpg', '1408140920', '', ''),
(10, 'stt', 'public', '', '', '', '<p>Crap :</p>', 3, 0, 3, 0, 0, '3, 1', '', '1408140921', '', ''),
(11, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 9, '', '', '1408140923', '', ''),
(15, 'stt', 'public', '', '', '', '<p>status working fine ._.</p>', 3, 0, 3, 0, 0, '1', '', '1408150154', '', ''),
(14, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 10, '', '', '1408150040', '', ''),
(16, 'stt', 'public', '', '', '', '<p>not fine!</p>', 3, 0, 3, 0, 0, '', '', '1408150155', '', ''),
(17, 'stt', 'public', '', '', '', '<p>Check ajax again</p>', 3, 0, 3, 0, 0, '', '', '1408150155', '', ''),
(18, 'photo', 'public', '', '', '', '<p>ajax with image...</p><p>Will be perfect!</p>', 3, 0, 3, 0, 0, '', 'data/img/8.jpg', '1408150156', '', ''),
(19, 'photo', 'public', '', '', '', '', 3, 0, 3, 0, 0, '3', 'data/img/1.jpg', '1408150158', '', ''),
(20, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 19, '', '', '1408150215', '', ''),
(21, 'new-promise', 'public', '', '', '', '', 1, 0, 1, 0, 12, '', '', '1408150702', '', ''),
(22, 'stt', 'public', '', '', '', 'css wrong? :|', 1, 0, 1, 0, 0, '', '', '1408151049', '', ''),
(32, 'new-promise', 'public', '', '', '', '', 2, 0, 2, 0, 13, '', '', '1408171140', '', ''),
(24, 'like', 'public', '', '', '', '', 1, 0, 0, 0, 10, '', '', '1408160715', '', ''),
(25, 'like', 'public', '', '', '', '', 1, 0, 0, 0, 15, '', '', '1408160717', '', ''),
(26, 'like', 'public', '', '', '', '', 1, 0, 0, 0, 9, '', '', '1408160722', '', ''),
(33, 'stt', 'public', '', '', '', '<p>â€œTÃ´i khÃ´ng cáº§n biáº¿t anh cÃ³ tá»™i hay khÃ´ng, nhiá»‡m vá»¥ duy nháº¥t cá»§a tÃ´i lÃ  sá»­ dá»¥ng táº¥t cáº£ nhá»¯ng gÃ¬ cÃ³ thá»ƒ sá»­ dá»¥ng Ä‘Æ°á»£c Ä‘á»ƒ háº¡i anh: cuá»™c sá»‘ng phÃ³ng Ä‘Ã£ng cá»§a anh á»Ÿ khu Montmartre, nhá»¯ng lá»i khai mÃ  cáº£nh sÃ¡t Ä‘Ã£ má»›m cho cÃ¡c nhÃ¢n chá»©ng vÃ  nhá»¯ng bÃ¡o cÃ¡o cá»§a chÃ­nh bá»n cáº£nh sÃ¡t. Vá»›i má»› tÃ i liá»‡u ghÃª tá»Ÿm mÃ  viÃªn dá»± tháº©m Ä‘Ã£ thu tháº­p Ä‘Æ°á»£c, tÃ´i pháº£i tÃ¬m háº¿t cÃ¡ch Ä‘á»ƒ lÃ m cho anh trá»Ÿ thÃ nh xáº¥u xa Ä‘áº¿n má»©c bá»n bá»“i tháº©m pháº£i quyáº¿t Ä‘á»‹nh gáº¡t anh ra ngoÃ i xÃ£ há»™iâ€.</p><p><br></p><p>TÃ´i cÃ³ cáº£m giÃ¡c lÃ  nghe tháº¥y nhá»¯ng cÃ¢u nÃ³i nÃ y ráº¥t rÃµ, trá»« phi tÃ´i náº±m mÆ¡, vÃ¬ quáº£ tÃ¬nh â€œkáº» Äƒn ngÆ°á»iâ€ nÃ y Ä‘Ã£ gÃ¢y Ä‘Æ°á»£c cho tÃ´i má»™t áº¥n tÆ°á»£ng ráº¥t máº¡nh.&lt;br /&gt;<br></p><p><br></p><p>â€œBá»‹ cÃ¡o nhÃ¢n, anh hÃ£y Ä‘á»ƒ máº·c cho ta lÃ m, vÃ  nháº¥t lÃ  Ä‘á»«ng tÃ¬m cÃ¡ch tá»± vá»‡: ta sáº½ dáº«n anh lÃªn con Ä‘Æ°á»ng cá»§a sá»± thá»‘i nÃ¡tâ€!<br></p><p><br></p><p>â€œVÃ  ta mong ráº±ng anh Ä‘á»«ng trÃ´ng mong gÃ¬ vÃ o bá»n bá»“i tháº©m: chá»› cÃ³ áº£o tÆ°á»Ÿng. MÆ°á»i hai con ngÆ°á»i nÃ y cháº³ng hiá»ƒu gÃ¬ vá» cuá»™c sá»‘ng Ä‘Ã¢uâ€.<br></p><p><br></p><p>â€œAnh cá»© thá»­ nhÃ¬n há» mÃ  xem. Há» Ä‘ang ngá»“i trÆ°á»›c máº·t anh thÃ nh má»™t dÃ£y: rÃµ rÃ ng lÃ  mÆ°á»i hai miáº¿ng pho-mÃ¡t tá»« má»™t tá»‰nh láº» nÃ o Ä‘Ã³ má»›i chá»Ÿ vá» Paris. ÄÃ³ lÃ  nhá»¯ng anh chÃ ng tiá»ƒu thá»‹ dÃ¢n, nhá»¯ng anh cÃ´ng chá»©c vá» hÆ°u, nhá»¯ng gÃ£ lÃ¡i buÃ´n. Cháº³ng hÆ¡i Ä‘Ã¢u mÃ  nÃ³i ká»¹ vá» há». DÃ¹ sao thÃ¬ cháº¯c anh cÅ©ng khÃ´ng khá» kháº¡o Ä‘áº¿n ná»—i tÆ°á»Ÿng ráº±ng nhá»¯ng con ngÆ°á»i nhÆ° tháº¿ cÃ³ thá»ƒ hiá»ƒu Ä‘Æ°á»£c quÃ£ng Ä‘á»i hai mÆ°Æ¡i lÄƒm nÄƒm mÃ  anh Ä‘Ã£ sá»‘ng vÃ  cÃ¡ch sinh hoáº¡t cá»§a anh á»Ÿ Montmartre. Äá»‘i vá»›i há», quáº£ng trÆ°á»ng Pigalle vÃ  quÃ£ng trÆ°á»ng Tráº¯ng chÃ­nh lÃ  Äá»‹a ngá»¥c, vÃ  táº¥t cáº£ nhá»¯ng ngÆ°á»i sá»‘ng vá» Ä‘Ãªm Ä‘á»u lÃ  nhá»¯ng káº» thÃ¹ cá»§a xÃ£ há»™i. Táº¥t cáº£ bá»n há» Ä‘á»u vÃ´ cÃ¹ng hÃ£nh diá»‡n vá»›i cÃ¡i chÃ¢n bá»“i tháº©m á»Ÿ TÃ²a Äáº¡i hÃ¬nh. NgoÃ i ra anh cÅ©ng nÃªn biáº¿t ráº±ng há» ráº¥t Ä‘au khá»• vÃ¬ cÃ¡i thÃ¢n pháº­n tiá»ƒu thá»‹ dÃ¢n nhá» bÃ© cá»§a há»â€.<br></p><p><br></p><p>â€œTháº¿ mÃ  anh, anh bÆ°á»›c ra trÆ°á»›c máº·t há», tráº» trung, tuáº¥n tÃº. Cháº¯c anh hiá»ƒu thá»«a ráº±ng ta sáº½ cháº³ng ná»ƒ nang gÃ¬ mÃ  khÃ´ng miÃªu táº£ anh thÃ nh má»™t tÃªn sá»Ÿ khanh cá»§a nhá»¯ng Ä‘Ãªm Montmartre, cho nÃªn ngay tá»« Ä‘áº§u ta sáº½ biáº¿n bá»n bá»“i tháº©m nÃ y thÃ nh nhá»¯ng káº» thÃ¹ cá»§a anh. Anh Äƒn máº·c sang trá»ng quÃ¡: Ä‘áº¿n Ä‘Ã¢y láº½ ra anh pháº£i Äƒn máº·c tháº­t khiÃªm nhÆ°á»ng. á»Ÿ chá»— nÃ y anh Ä‘Ã£ pháº¡m má»™t lá»—i nghiÃªm trá»ng vá» chiáº¿n thuáº­t. Anh khÃ´ng tháº¥y lÃ  há» ganh tá»‹ vá»›i cÃ¡ch Äƒn máº·c cá»§a anh sao? Há» thÃ¬ toÃ n mua Ä‘á»“ may sáºµn á»Ÿ cá»­a hÃ ng Samaritaine, vÃ  dÃ¹ cÃ³ náº±m mÆ¡ há» cÅ©ng khÃ´ng dÃ¡m nghÄ© ráº±ng mÃ¬nh cÃ³ bao giá» Ä‘i may Ä‘o láº¥y Ä‘Æ°á»£c má»™t bá»™â€.<br></p><p><br></p><p>BÃ¢y giá» Ä‘Ã£ mÆ°á»i giá», TÃ²a Ä‘Ã£ sáºµn sÃ ng má»Ÿ Ä‘áº§u cuá»™c tranh luáº­n. TrÆ°á»›c máº¯t tÃ´i lÃ  sÃ¡u viÃªn quan tÃ²a trong Ä‘Ã³ cÃ³ Ã´ng cÃ´ng tá»‘ viÃªn hung hÃ£n sáº½ Ä‘Æ°a háº¿t uy quyá»n ma quÃ¡i cá»§a mÃ¬nh, Ä‘Æ°a háº¿t trÃ­ thÃ´ng minh cá»§a mÃ¬nh ra Ä‘á»ƒ thuyáº¿t phá»¥c mÆ°á»i hai gÃ£ tiá»ƒu thá»‹ dÃ¢n kia ráº±ng tÃ´i lÃ  káº» cÃ³ tá»™i vÃ  báº£n tuyÃªn Ã¡n ngÃ y hÃ´m nay chá»‰ cÃ³ thá»ƒ lÃ  tá»™i lÆ°u Ä‘Ã y hay mÃ¡y chÃ©m.<br></p>', 1, 0, 1, 0, 0, '3, 1', '', '1408171154', '', ''),
(36, 'like', 'public', '', '', '', '', 3, 0, 0, 0, 33, '', '', '1408190802', '', ''),
(37, 'new-promise', 'public', '', '', '', '', 1, 0, 1, 0, 14, '', '', '1408190836', '', ''),
(38, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 15, '', '', '1408191109', '', ''),
(39, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 16, '1', '', '1408191112', '', ''),
(42, 'like', 'public', '', '', '', '', 1, 0, 0, 0, 33, '', '', '1408200923', '', ''),
(41, 'like', 'public', '', '', '', '', 1, 0, 0, 0, 39, '', '', '1408200916', '', ''),
(43, 'photo', 'public', '', '', '', 'ChÃ o má»«ng báº¡n Ä‘áº¿n vá»›i cá»™ng Ä‘á»“ng blive.<div><br></div><div>1. blive lÃ  gÃ¬?</div><div>blive lÃ  1 cá»™ng Ä‘á»“ng máº¡ng xÃ£ há»™i nhÆ° facebook Ä‘Æ¡n giáº£n vá»›i má»™t vÃ i tiá»‡n Ã­ch thÃº vá»‹.</div><div>HÃ£y cÃ¹ng khÃ¡m phÃ¡ nha!</div><div><br></div><div>2. Táº¡i sao sá»­ dá»¥ng blive?</div><div>Well, blah blah blah</div><div>bleh bleh bleh....!</div>', 3, 0, 3, 0, 0, '3', 'data/img/puppy.jpg', '1408210217', '', ''),
(46, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 17, '3', '', '1408240213', '', ''),
(47, 'like', '', '', '', '', '', 3, 0, 0, 0, 43, '', '', '1408290014', '', ''),
(48, 'new-request', 'public', '', '', '', '', 3, 0, 3, 0, 1, '3', '', '1408290053', '', ''),
(49, 'like', '', '', '', '', '', 3, 0, 0, 0, 46, '', '', '1408290207', '', ''),
(52, 'like', '', '', '', '', '', 3, 0, 0, 0, 48, '', '', '1408290218', '', ''),
(53, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 18, '', '', '1408290715', '', ''),
(54, 'new-promise', 'public', '', '', '', '', 3, 0, 3, 0, 19, '', '', '1408290717', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `activity_`
--

CREATE TABLE IF NOT EXISTS `activity_` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activity_`
--

INSERT INTO `activity_` (`id`, `type`, `uid`, `iid`, `content`, `time`) VALUES
(1, '', 1, 0, 'Hello! This is the first content of the community', '1408052143'),
(2, '', 1, 0, 'Hello! This is the second content of the community', '1408052143');

-- --------------------------------------------------------

--
-- Table structure for table `activity_cmt`
--

CREATE TABLE IF NOT EXISTS `activity_cmt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `activity_cmt`
--

INSERT INTO `activity_cmt` (`id`, `uid`, `iid`, `pid`, `content`, `likes`, `time`) VALUES
(1, 1, 10, 0, '<p>hehe</p>', '', '1408141100'),
(2, 1, 10, 0, '<p>hehe</p>', '', '1408141100'),
(3, 1, 10, 0, '<p>shit :&lt;</p>', '', '1408141101'),
(4, 1, 10, 0, '<p>shit :''&lt;</p>', '', '1408141101'),
(5, 1, 10, 0, '<p>shit :''&lt;</p>', '', '1408141101'),
(6, 1, 10, 0, '<p>bored :(</p>', '', '1408141105'),
(7, 1, 10, 0, '<p>bored :(</p>', '', '1408141105'),
(8, 1, 9, 0, '<p>:((</p>', '', '1408141106'),
(9, 1, 9, 0, '<p>:((</p>', '1', '1408141106'),
(10, 1, 9, 0, '<p>should be good!</p>', '', '1408141108'),
(11, 1, 9, 0, '<p>should be good!</p>', '', '1408141108'),
(12, 1, 9, 0, '<p>good now :3</p>', '', '1408141109'),
(13, 1, 9, 0, '<p>great!</p>', '', '1408141109'),
(14, 3, 10, 0, '<p>hey :)</p>', '', '1408150144'),
(15, 3, 10, 0, '<p>hey :)</p>', '', '1408150144'),
(16, 3, 10, 0, '<p>hihi</p>', '', '1408150145'),
(17, 3, 10, 0, '<p>hihi</p>', '', '1408150145'),
(18, 3, 10, 0, '<p>crap</p>', '', '1408150148'),
(19, 3, 10, 0, '<p>:''&gt;</p>', '', '1408150148'),
(20, 3, 19, 0, '<p>love looking him &lt;3</p>', '', '1408150158'),
(21, 1, 9, 0, '<p>Hehe</p>', '', '1408161037'),
(22, 1, 33, 0, 'NgÆ°á»i tÃ¹ khá»• sai! <img src="http://localhost:8080/blive/assets/img/emo/meep/nherang.png" data-sceditor-emoticon=":D" alt=":D" title=":D">', '3', '1408180154'),
(23, 1, 3, 0, '<p>First comment :3<br></p>', '1', '1408180238'),
(24, 1, 3, 0, '<p>other comment :''&gt;</p>', '1, 3', '1408180256'),
(25, 1, 3, 0, '<p>shit :|</p>', '1', '1408180312'),
(26, 1, 3, 0, '<p>dis</p>', '', '1408180312'),
(27, 1, 3, 24, '<p>child comment!</p>', '', '1408180318'),
(28, 1, 3, 23, '<p>Let''s go! :3</p>', '3', '1408180331'),
(29, 1, 3, 23, '<p>ajax like comment!</p>', '1', '1408180332'),
(30, 1, 3, 23, '<p>ajax like comment! working now?</p>', '1', '1408180334'),
(31, 1, 3, 23, 'yes! perfect!', '', '1408180334'),
(32, 1, 3, 23, '<p>comment many times!</p>', '', '1408180339'),
(33, 1, 3, 23, '<p>test other!</p>', '1', '1408180339'),
(34, 1, 3, 23, '<p>test other!</p>', '', '1408180339'),
(35, 1, 3, 23, '<p>test other!</p>', '', '1408180339'),
(36, 1, 3, 23, '<p>test other!</p>', '1', '1408180339'),
(37, 1, 3, 23, '<p>not good!</p>', '', '1408180341'),
(38, 1, 3, 23, 'so not good!', '', '1408180341'),
(39, 1, 3, 23, 'super cool now!', '1', '1408180341'),
(40, 1, 33, 22, '<p>hey child comment!</p>', '1, 3', '1408180343'),
(41, 3, 33, 0, '<p>I''m here :3</p>', '', '1408181159'),
(42, 3, 33, 22, '<p>Other child comment :3</p>', '', '1408181200'),
(43, 3, 33, 22, '<p>MOre comment <img src="http://localhost:8080/blive/assets/img/emo/meep/smile.png" data-sceditor-emoticon=":)" alt=":)" title=":)"></p>', '', '1408181200'),
(44, 3, 33, 22, 'Should be hidden!', '', '1408181200'),
(45, 3, 33, 0, '<p>More child cmt :''&lt;</p>', '', '1408191002'),
(46, 3, 33, 22, '<p><span style="color: rgb(101, 109, 120); font-family: ''Helvetica Neue'', Helvetica, ''Trebuchet Ms'', Tahoma; font-size: 12px; letter-spacing: normal; line-height: 18px; background-color: rgb(249, 249, 249);">More child cmt :''&lt;</span><br></p>', '', '1408191002'),
(47, 3, 33, 22, '<p>More :&gt;</p>', '', '1408191002'),
(48, 1, 33, 0, '<p>many replies!</p>', '', '1408200922'),
(49, 1, 33, 0, 'done?', '', '1408200922'),
(50, 3, 18, 0, '<p>dis</p>', '', '1408240212'),
(51, 3, 43, 0, '<p>crap</p>', '', '1408261030'),
(52, 3, 43, 51, '<p>ddis</p>', '', '1408261047'),
(53, 3, 43, 0, '<p>dis</p>', '', '1408261053'),
(54, 3, 43, 0, '<p>tg</p><p><br></p>', '', '1408261100'),
(55, 3, 43, 0, '<p>+mia </p><p><br></p>', '', '1408261102');

-- --------------------------------------------------------

--
-- Table structure for table `activity_like`
--

CREATE TABLE IF NOT EXISTS `activity_like` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `activity_like`
--

INSERT INTO `activity_like` (`id`, `uid`, `iid`, `time`) VALUES
(1, 3, 10, '1408140852');

-- --------------------------------------------------------

--
-- Table structure for table `ask`
--

CREATE TABLE IF NOT EXISTS `ask` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fr_uid` int(255) NOT NULL,
  `as` varchar(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `did` varchar(255) NOT NULL COMMENT '= answer',
  `money` int(255) NOT NULL,
  `money-type` varchar(255) NOT NULL,
  `lock` varchar(255) NOT NULL,
  `likes` longtext NOT NULL,
  `believe_lock` int(255) NOT NULL,
  `believe_not_lock` int(255) NOT NULL,
  `know_lock` int(255) NOT NULL,
  `know_not_lock` int(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ask`
--

INSERT INTO `ask` (`id`, `fr_uid`, `as`, `uid`, `content`, `did`, `money`, `money-type`, `lock`, `likes`, `believe_lock`, `believe_not_lock`, `know_lock`, `know_not_lock`, `time`) VALUES
(1, 1, '', 3, 'Are you on date?', 'yes', 20, '', '', '', 0, 0, 0, 0, '1408241252');

-- --------------------------------------------------------

--
-- Table structure for table `ask_answer`
--

CREATE TABLE IF NOT EXISTS `ask_answer` (
  `id` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `believe` int(255) NOT NULL,
  `believe_not` int(255) NOT NULL,
  `know_did` int(255) NOT NULL,
  `know_didnot` int(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ask_answer`
--

INSERT INTO `ask_answer` (`id`, `iid`, `uid`, `content`, `believe`, `believe_not`, `know_did`, `know_didnot`, `time`) VALUES
(0, 1, 3, '<p>Yes!</p>', 0, 0, 0, 0, '1408241122');

-- --------------------------------------------------------

--
-- Table structure for table `ask_cmt`
--

CREATE TABLE IF NOT EXISTS `ask_cmt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ask_cmt`
--

INSERT INTO `ask_cmt` (`id`, `uid`, `iid`, `pid`, `content`, `likes`, `time`) VALUES
(1, 3, 1, 0, '<p>okay!</p>', '3', '1408240107');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `read` varchar(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `to_uid` longtext NOT NULL,
  `to_gid` int(255) NOT NULL,
  `content` varchar(50000) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `read`, `uid`, `to_uid`, `to_gid`, `content`, `time`) VALUES
(1, '', 1, '2', 0, 'This is content from admin to mia', ' '),
(2, '', 2, '1', 0, 'This is content', ' '),
(3, '', 1, '2', 0, 'test :v', '18-06-2014 08:30'),
(4, '', 1, '2', 0, 'hi', '21-06-2014 08:24'),
(5, '', 1, '2', 0, 'hi mia :3', '26-06-2014 11:45'),
(6, '', 1, '2', 0, 'chat-submit', '07-07-2014 09:06'),
(7, '', 2, '1', 0, 'hi admin', '10-07-2014 12:54'),
(8, '', 2, '1', 0, 'kay?', '13-07-2014 10:36'),
(9, '', 1, '2', 0, ':(', '18-07-2014 10:57'),
(10, '', 1, '2', 0, 'what''s wrong?', '20-07-2014 10:42'),
(11, '', 1, '3', 0, 'crap', '1408151229'),
(12, '', 1, '2', 0, 'hihi', '1408170116'),
(13, '', 1, '2', 0, 'CÃ´ng tá»‘ viÃªn lÃ  luáº­t sÆ° Pradel. Táº¥t cáº£ cÃ¡c tráº¡ng sÆ° Ä‘á»u ráº¥t sá»£ Ã´ng ta. Ã”ng ta ná»•i tiáº¿ng lÃ  ngÆ°á»i cung cáº¥p Ä‘áº¯c lá»±c nháº¥t cho mÃ¡y chÃ©m vÃ  cho cÃ¡c nhÃ  lao trong nÆ°á»›c cÅ©ng nhÆ° háº£i ngoáº¡i.\r\n\r\nPradel lÃ  biá»ƒu trÆ°ng cá»§a bÃ n tay trá»«ng pháº¡t cá»§a cÃ´ng lÃ½. ÄÃ³ lÃ  ngÆ°á»i buá»™c tá»™i chÃ­nh thá»©c cá»§a xÃ£ há»™i, má»™t sá»©c máº¡nh khÃ´ng cÃ³ chÃºt nhÃ¢n tÃ­nh. Ã”ng Ä‘áº¡i diá»‡n cho PHÃ¡P LUáº­T, cho CÃ¡n cÃ¢n CÃ´ng lÃ½, chÃ­nh Ã´ng cáº§m cÃ¡i cÃ¢n áº¥y vÃ  Ã´ng sáº½ Ä‘em háº¿t sá»©c mÃ¬nh ra Ä‘á»ƒ lÃ m cho nÃ³ nghiÃªng vá» phÃ­a Ã´ng. ÄÃ´i máº¯t ká»n ká»n cá»§a Ã´ng hÆ¡i cá»¥p mi xuá»‘ng nhÃ¬n tÃ´i cháº±m cháº±m tá»« trÃªn cao. TrÆ°á»›c háº¿t Ä‘Ã³ lÃ  chiá»u cao cá»§a cÃ¡i bá»‡ Ã´ng ta Ä‘á»©ng, thá»© Ä‘áº¿n lÃ  chiá»u cao cá»§a vÃ³c ngÆ°á»i Ã´ng, Ã­t ra cÅ©ng pháº£i má»™t thÆ°á»›c tÃ¡m, nÃ³ lÃ m tÄƒng cÃ¡i váº» hÃ¡ch dá»‹ch cá»§a Ã´ng ta lÃªn ráº¥t nhiá»u. Ã”ng ta khÃ´ng bá» táº¥m Ã¡o khoÃ¡c mÃ u Ä‘á», mÃ  chá»‰ Ä‘áº·t cÃ¡i mÅ© xuá»‘ng trÆ°á»›c máº·t. Ã”ng ta chá»‘ng hai tay lÃªn bÃ n, hai bÃ n tay to nhÆ° hai cÃ¡i bá»“ cÃ o. Má»™t chiáº¿c nháº«n vÃ ng cho biáº¿t ráº±ng Ã´ng ta Ä‘Ã£ cÃ³ vá»£, vÃ  á»Ÿ ngÃ³n tay Ãºt Ã´ng Ä‘eo má»™t cÃ¡i Ä‘inh mÃ³ng ngá»±a nháºµn bÃ³ng thay cho nháº«n.', '1408171107'),
(14, '', 1, '3', 0, 'hihi\r\nokay!', '1408171119'),
(15, '', 2, '1', 0, 'dÃ i vá»“n!', '1408171127'),
(16, '', 3, '1', 0, 'I''m here', '1408190123'),
(17, '', 3, '1', 0, 'You okay?', '1408190124'),
(18, '', 1, '3', 0, 'yeah. fine.', '1408200154'),
(19, '', 3, '1', 0, 'hihi', '1408211220');

-- --------------------------------------------------------

--
-- Table structure for table `emo`
--

CREATE TABLE IF NOT EXISTS `emo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cat` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `img` varchar(20000) NOT NULL,
  `icon` varchar(20000) NOT NULL,
  `dot` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `emo`
--

INSERT INTO `emo` (`id`, `order`, `type`, `cat`, `name`, `img`, `icon`, `dot`) VALUES
(1, 0, 'ecat', 'meep', 'Meep', '', '', 'png'),
(2, 0, 'emo', 'meep', 'Laugh', 'smilee', ':))', 'png'),
(3, 0, 'emo', 'meep', 'Smile', 'smile', ':)', 'png'),
(4, 0, 'emo', 'meep', ':D', 'nherang', ':D', 'png'),
(5, 0, 'emo', 'meep', 'Rough', 'laugh', '=))', 'png'),
(6, 0, 'emo', 'meep', 'Shock', 'surprise', ':O', 'png'),
(7, 0, 'emo', 'meep', 'XD', 'aaa', 'XD', 'png'),
(8, 0, 'emo', 'meep', 'Shy', 'macco', ':macco:', 'png'),
(9, 0, 'emo', 'meep', '>_<', 'aaa', ':oa:', 'png'),
(10, 0, 'emo', 'meep', 'Hehe', 'hehe', 'XP', 'png'),
(11, 0, 'emo', 'meep', 'Tongue', 'tongue', ':P', 'png'),
(12, 0, 'emo', 'meep', 'Love', 'luv', '<3', 'png'),
(13, 0, 'emo', 'meep', 'Kiss', 'kiss', ':*', 'png'),
(14, 0, 'emo', 'meep', 'Cool', 'cool', 'B)', 'png'),
(15, 0, 'emo', 'meep', 'Smart', 'smart', '8)', 'png'),
(16, 0, 'emo', 'meep', 'Hum', 'hum', ':??', 'png'),
(17, 0, 'emo', 'meep', 'Huh', 'huh', ':?', 'png'),
(18, 0, 'emo', 'meep', 'á»Œe', 'oe', ':oe:', 'png'),
(19, 0, 'emo', 'meep', 'Sick', 'sick', ':sick:', 'png'),
(20, 0, 'emo', 'meep', 'Cry', 'cry', ':((', 'png'),
(21, 0, 'emo', 'meep', 'Not care', 'notcare', '-_-', 'png'),
(22, 0, 'emo', 'meep', 'Wink', 'wink', ';)', 'png'),
(23, 0, 'emo', 'meep', 'Bored', 'bored', ':(', 'png'),
(24, 0, 'emo', 'meep', 'Angel', 'angel', 'O:)', 'png'),
(25, 0, 'emo', 'meep', 'Phá»¥t', 'cute', ':8', 'png'),
(26, 0, 'emo', 'meep', 'Ar', 'ar', ':ar:', 'png'),
(27, 0, 'emo', 'meep', 'Annoyed', 'annoy', '>:|', 'png'),
(28, 0, 'emo', 'meep', 'Angry', 'angry', '>:O', 'png'),
(29, 0, 'emo', 'meep', 'I like it', 'aa', ':cute:', 'png'),
(30, 0, 'ecat', 'minion', 'Minion - Despicable me', '', '', 'png'),
(31, 0, 'emo', 'minion', '', 'd001', ':d001:', 'png'),
(32, 0, 'emo', 'minion', '', 'd002', ':d002:', 'png'),
(33, 0, 'emo', 'minion', '', 'd003', ':d003:', 'png'),
(34, 0, 'emo', 'minion', '', 'd004', ':d004:', 'png'),
(35, 0, 'emo', 'minion', '', 'd005', ':d005:', 'png'),
(36, 0, 'emo', 'minion', '', 'd006', ':d006:', 'png'),
(37, 0, 'ecat', 'zing', 'Zing', '', '', 'gif'),
(38, 0, 'emo', 'zing', '', '1.jpg', ':]', 'gif'),
(39, 0, 'emo', 'zing', '', '2.jpg', ':~', 'gif'),
(40, 0, 'emo', 'zing', '', '3.jpg', ':luv:', 'gif'),
(41, 0, 'emo', 'zing', '', '4.jpg', ':">', 'gif'),
(42, 0, 'emo', 'zing', '', '5.jpg', '8-]', 'gif'),
(43, 0, 'emo', 'zing', '', '6.jpg', 'T_T', 'gif'),
(44, 0, 'emo', 'zing', '', '9.jpg', ':-zz', 'gif'),
(45, 0, 'emo', 'zing', '', '10.jpg', ':[[', 'gif'),
(46, 0, 'emo', 'zing', '', '16.jpg', ':[', 'gif'),
(47, 0, 'emo', 'zing', '', '11.jpg', ':-|', 'gif'),
(48, 0, 'emo', 'zing', '', '12.jpg', ':-H', 'gif'),
(49, 0, 'emo', 'zing', '', '14.jpg', ':d', 'gif'),
(50, 0, 'emo', 'zing', '', '36.jpg', ':qq', 'gif'),
(51, 0, 'emo', 'zing', '', '19.jpg', ':q', 'gif'),
(52, 0, 'emo', 'zing', '', '20.jpg', ':t', 'gif'),
(53, 0, 'emo', 'zing', '', '31.jpg', ':go:', 'gif'),
(54, 0, 'emo', 'zing', '', '33.jpg', ';?', 'gif'),
(55, 0, 'emo', 'zing', '', '45.jpg', ':gian:', 'gif'),
(56, 0, 'emo', 'zing', '', '43.jpg', ':handclap:', 'gif'),
(57, 0, 'emo', 'zing', '', '49.jpg', ';-|', 'gif'),
(58, 0, 'emo', 'zing', '', '50.jpg', 'p-(', 'gif'),
(59, 0, 'emo', 'zing', '', '35.jpg', ':-f', 'gif'),
(60, 0, 'emo', 'zing', '', '42.jpg', ':-n', 'gif'),
(61, 0, 'emo', 'zing', '', '44.jpg', ':-??', 'gif'),
(62, 0, 'emo', 'zing', '', '53.jpg', ':-*', 'gif'),
(63, 0, 'emo', 'zing', '', '36.jpg', ':army:', 'gif'),
(64, 0, 'emo', 'zing', '', '61.jpg', ':coffee:', 'gif'),
(65, 0, 'emo', 'zing', '', '62.jpg', ':hbbd:', 'gif'),
(66, 0, 'emo', 'zing', '', '66.jpg', ':poop:', 'gif'),
(67, 0, 'emo', 'zing', '', '59.jpg', ':heart:', 'gif'),
(68, 0, 'emo', 'zing', '', '64.jpg', ':boom:', 'gif'),
(69, 0, 'emo', 'zing', '', '65.jpg', ':knife:', 'gif'),
(70, 0, 'emo', 'zing', '', '67.jpg', ':like:', 'gif'),
(71, 0, 'emo', 'zing', '', '68.jpg', ':dislike:', 'gif'),
(72, 0, 'emo', 'zing', '', '69.jpg', ':handshake:', 'gif'),
(73, 0, 'emo', 'zing', '', '70.jpg', ':hi:', 'gif'),
(74, 0, 'emo', 'zing', '', '71.jpg', ':gameon:', 'gif'),
(75, 0, 'emo', 'zing', '', '72.jpg', ':come:', 'gif'),
(76, 0, 'emo', 'zing', '', '73.jpg', ':fighting:', 'gif'),
(77, 0, 'emo', 'zing', '', '74.jpg', ':hitle:', 'gif'),
(78, 0, 'emo', 'zing', '', '75.jpg', ':rule:', 'gif'),
(79, 0, 'emo', 'zing', '', '76.jpg', ':up:', 'gif'),
(80, 0, 'emo', 'zing', '', '77.jpg', ':ok:', 'gif'),
(81, 0, 'emo', 'zing', '', '38.jpg', ':skull:', 'gif'),
(82, 0, 'emo', 'zing', '', '37.jpg', ':black:', 'gif');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `accept` varchar(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `receive_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `accept`, `uid`, `receive_id`) VALUES
(1, 'yes', 1, 3),
(2, 'yes', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `good`
--

CREATE TABLE IF NOT EXISTS `good` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `people` longtext NOT NULL COMMENT 'list người phải thực hiện việc tốt',
  `content` longtext NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `price_type` varchar(255) NOT NULL,
  `did` varchar(255) NOT NULL,
  `time_start` varchar(255) NOT NULL,
  `time_finish` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `good`
--

INSERT INTO `good` (`id`, `uid`, `iid`, `people`, `content`, `instruction`, `price`, `price_type`, `did`, `time_start`, `time_finish`) VALUES
(1, 1, 0, '2, 3, 4, 5', 'Hi! Welcome to the pay for good.<br/>\nWe''re here to help you improve yourself to be a better person!<br/>\nFor good start, please take this one and start acting good!<br/>\n\n<b>Instruction</b>: Help a junior student find a way...<br/>\n\nGood luck! :D', '', 300, 'gold', '', '1408052255', ''),
(2, 1, 0, '2, 3, 4', 'Hello! Have you done the first one?<br/>\nThat\\''s good! Let\\''s get next to this.<br/>\n\n<b>Instruction</b>: Help an old people crossing the street.<br/>\n\nGood luck! :D', '', 100, 'gold', '', '1408052255', '');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `lock` varchar(255) NOT NULL,
  `did` varchar(255) NOT NULL COMMENT 'Was it solved?',
  `helped_id` int(255) NOT NULL,
  `tags` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `uid`, `type`, `title`, `content`, `likes`, `lock`, `did`, `helped_id`, `tags`, `time`) VALUES
(1, 3, 'need', 'The title. Should it be required?', 'The help content!', '3', '', '', 0, 'tag1, tag2, tag3, tag4', '1408290053');

-- --------------------------------------------------------

--
-- Table structure for table `help_cmt`
--

CREATE TABLE IF NOT EXISTS `help_cmt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(2000) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `good_did` varchar(255) NOT NULL,
  `good_todo` varchar(255) NOT NULL,
  `promise_kept` varchar(255) NOT NULL,
  `promise_broke` varchar(255) NOT NULL,
  `gold` int(255) NOT NULL,
  `coin` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notification` int(255) NOT NULL,
  `noti_new` int(255) NOT NULL,
  `fiend_request` int(255) NOT NULL,
  `fr_new` int(255) NOT NULL,
  `message` int(255) NOT NULL,
  `mes_new` int(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `lastlog_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `email`, `name`, `avatar`, `gender`, `good_did`, `good_todo`, `promise_kept`, `promise_broke`, `gold`, `coin`, `status`, `notification`, `noti_new`, `fiend_request`, `fr_new`, `message`, `mes_new`, `time`, `lastlog_time`) VALUES
(1, 'admin', 'admin', '', 'Nguyen Minh Tu', 'http://localhost:8080/blive/data/img/7.jpg', '', '', '', '', '', 0, 0, '', 0, 19, 0, 0, 0, 0, '', ''),
(2, 'abc', 'abc', '', 'Nguyen Minh Tu', 'http://localhost:8080/blive/data/img/1.jpg', '', '', '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', ''),
(3, 'mia', 'abc', '', 'Nguyen Minh Tu', 'http://localhost:8080/blive/data/img/3.jpg', '', '', '', '', '', 0, 0, '', 0, -18, 0, 0, 0, 0, '', ''),
(4, 'miamor', 'abc', '', 'Nguyen Minh Tu', '', '', '', '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', ''),
(5, 'xyz', 'abc', '', 'Nguyen Minh Tu', '', '', '', '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', ''),
(6, 'vyskzi', 'abc', '', 'Nguyen Minh Tu', '', '', '', '', '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `read` varchar(255) NOT NULL,
  `i` int(255) NOT NULL,
  `pi` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `to_uid` int(255) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `read`, `i`, `pi`, `uid`, `to_uid`, `content`, `time`) VALUES
(1, 'to-create-promise', '', 2, 0, 1, 2, '', '1408161118'),
(2, 'like-my-stt', '', 22, 0, 1, 0, '', '1408162340'),
(3, 'like-my-stt', '', 22, 0, 1, 0, '', '1408162341'),
(4, 'like-my-stt', '', 22, 0, 1, 0, '', '1408162344'),
(5, 'like-my-stt', '', 21, 0, 2, 0, '', '1708161130'),
(6, 'like-my-stt', '', 21, 0, 2, 0, '', '1708161132'),
(7, 'like-my-stt', '', 2, 0, 1, 3, '', '1808160325'),
(8, 'like-my-stt', '', 33, 0, 3, 1, '', '1408190802'),
(81, 'likes-promise', '', 14, 0, 2, 1, '', '1408240237'),
(11, 'mention-in-promise', '', 15, 0, 3, 2, '', '1408191109'),
(12, 'mention-in-promise', '', 15, 0, 3, 4, '', '1408191109'),
(13, 'mention-in-promise', '', 15, 0, 3, 5, '', '1408191109'),
(10, 'mention-in-promise', '', 16, 0, 3, 1, '', '1408191112'),
(66, 'encourage-promise', '', 10, 0, 1, 3, '', '1408230932'),
(17, 'encourage-promise', '', 1, 0, 1, 1, '', '1408200144'),
(62, 'believe-promise_did', '', 2, 0, 3, 1, '', '1408201212'),
(61, 'encourage-promise', '', 2, 0, 3, 1, '', '1408201212'),
(21, 'like-my-stt', '', 39, 0, 1, 3, '', '1408200250'),
(85, 'likes-promise_cmt', '', 0, 10, 3, 0, '', '1408240822'),
(84, 'likes-promise_cmt', '', 0, 10, 3, 0, '', '1408240822'),
(83, 'likes-ask_cmt', '', 0, 1, 3, 0, '', '1408240819'),
(82, 'likes-promise_cmt', '', 0, 14, 2, 0, '', '1408240237'),
(80, 'believe-promise_did', '', 10, 0, 1, 3, '', '1408240032'),
(33, 'likes-activity', '', 39, 0, 1, 3, '', '1408200916'),
(34, 'like-my-stt', '', 39, 0, 1, 3, '', '1408200916'),
(51, 'suborner', '', 14, 0, 1, 2, '', '1408201115'),
(52, 'suborner', '', 14, 0, 1, 3, '', '1408201115'),
(53, 'likes-promise_cmt', '', 25, 16, 3, 1, '', '1408201117'),
(69, 'know_did-promise_did', '', 14, 0, 3, 1, '', '1408240023'),
(44, 'likes-promise', '', 16, 0, 1, 3, '', '1408200919'),
(68, 'encourage-promise', '', 14, 0, 3, 1, '', '1408240023'),
(49, 'likes-activity', '', 33, 0, 1, 1, '', '1408200923'),
(87, 'likes-activity_cmt', '', 24, 3, 3, 1, '', '1408260907'),
(93, 'likes-activity_cmt', '', 28, 3, 3, 1, '', '1408260915'),
(94, 'suborner', '', 15, 0, 3, 1, '', '1408260937'),
(95, 'suborner', '', 15, 0, 3, 1, '', '1408260937'),
(96, 'suborner', '', 15, 0, 3, 1, '', '1408260937'),
(97, 'suborner', '', 15, 0, 3, 1, '', '1408260937'),
(98, 'suborner', '', 15, 0, 3, 1, '', '1408260937'),
(103, 'likes-promise_cmt', '', 17, 2, 3, 1, '', '1408270222'),
(102, 'likes-promise_cmt', '', 14, 2, 3, 1, '', '1408270221'),
(104, 'likes-promise_cmt', '', 23, 2, 3, 1, '', '1408270225'),
(105, 'likes-activity_cmt', '', 0, 43, 3, 0, '', '1408290014'),
(106, 'likes-promise_cmt', '', 0, 17, 3, 0, '', '1408290207'),
(107, 'likes-activity_cmt', '', 0, 48, 3, 0, '', '1408290207'),
(108, 'likes-activity_cmt', '', 0, 48, 3, 0, '', '1408290217'),
(109, 'likes-promise_cmt', '', 0, 16, 3, 0, '', '1408290218'),
(110, 'likes-promise_cmt', '', 0, 16, 3, 0, '', '1408290218'),
(111, 'likes-activity_cmt', '', 0, 48, 3, 0, '', '1408290218'),
(112, 'likes-promise_cmt', '', 0, 18, 3, 0, '', '1408290723'),
(113, 'suborner', '', 18, 0, 3, 1, '', '1408290727');

-- --------------------------------------------------------

--
-- Table structure for table `promise`
--

CREATE TABLE IF NOT EXISTS `promise` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `money` int(255) NOT NULL,
  `money-type` varchar(255) NOT NULL,
  `privacy` varchar(255) NOT NULL,
  `available_list` longtext NOT NULL,
  `did` varchar(255) NOT NULL,
  `encourage` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `lock` varchar(255) NOT NULL,
  `believe_lock` int(255) NOT NULL,
  `believe_not_lock` int(255) NOT NULL,
  `know_lock` int(255) NOT NULL,
  `know_not_lock` int(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `promise`
--

INSERT INTO `promise` (`id`, `uid`, `iid`, `content`, `money`, `money-type`, `privacy`, `available_list`, `did`, `encourage`, `likes`, `lock`, `believe_lock`, `believe_not_lock`, `know_lock`, `know_not_lock`, `time`) VALUES
(1, 1, 0, 'I''m passing the final exam with a score higher than 20!', 300, 'gold', 'public', '', 'yes', '1', '2, 3', '', 0, 0, 0, 0, '1408052255'),
(2, 1, 0, 'Im making you a cake @mia Call me hah!<br/>And @abc , how about passing by and get some pieces :3', 100, 'gold', 'public', '', 'yes', '3', '3', '', 0, 0, 0, 0, '1408052255'),
(3, 3, 0, 'I''m building a system which allows everyone to chat and post thing! :3', 30, 'gold', 'public', '', '', '', '', '', 0, 0, 0, 0, '1408052255'),
(4, 3, 0, 'I''m building a brand new E-learning solfware (for ubuntu and windows as my intention) which will allow you:\n<ul>\n<li>Create a course</li>\n<li>Follow a course</li>\n<li>...</li>\n<li>And many many apps to support your studies.</li>\n</ul>\n@abc thanks for new idea :3', 30, 'gold', 'public', '', '', '1, 3', '2, 3, 1', '', 0, 0, 0, 0, '1408052255'),
(7, 3, 0, '<p>Hiu hiu~</p><p>Chá»‰ thá»­ thÃ´i... Thá»­ thÃ´i :3</p><p>Ko tÃ­nh nhÃ© :3</p>', 100, 'coin', 'public', '', '', '', '3', '', 0, 0, 0, 0, '1408131142'),
(8, 3, 0, '<p>Add more promise :3</p>', 10, 'coin', 'public', '', '', '', '3', '', 0, 0, 0, 0, '1408150149'),
(9, 3, 0, '<p>More :3</p><p>With line breaks m/</p><p>And tags :3 @mia @abc @miamor </p>', 0, 'coin', 'public', '', '', '', '3', '', 0, 0, 0, 0, '1408150152'),
(10, 3, 0, '<p>ajax is broken :|</p>', 0, 'coin', 'public', '', 'yes', '3, 1', '', 'yes', 1, 0, 0, 0, '1408150153'),
(11, 3, 0, '<p>It''s all fine now :3</p><p>@miamor @abc @xyz @mnp @mia @admin&nbsp;</p>', 0, 'coin', 'public', '', '', '', '3', '', 0, 0, 0, 0, '1408150156'),
(12, 1, 0, '<p>Add new promise :3 @mia&nbsp;</p><p>It''s all good! :v</p>', 70, 'coin', 'public', '', 'no', '', '1, 2', 'yes', 0, 0, 0, 0, '1408150702'),
(13, 2, 0, '<p>NgÆ°á»i tÃ¹ khá»• sai...</p><p><br></p><p>Pradel lÃ  biá»ƒu trÆ°ng cá»§a bÃ n tay trá»«ng pháº¡t cá»§a cÃ´ng lÃ½. ÄÃ³ lÃ  ngÆ°á»i buá»™c tá»™i chÃ­nh thá»©c cá»§a xÃ£ há»™i, má»™t sá»©c máº¡nh khÃ´ng cÃ³ chÃºt nhÃ¢n tÃ­nh. Ã”ng Ä‘áº¡i diá»‡n cho PHÃ¡P LUáº­T, cho CÃ¡n cÃ¢n CÃ´ng lÃ½, chÃ­nh Ã´ng cáº§m cÃ¡i cÃ¢n áº¥y vÃ  Ã´ng sáº½ Ä‘em háº¿t sá»©c mÃ¬nh ra Ä‘á»ƒ lÃ m cho nÃ³ nghiÃªng vá» phÃ­a Ã´ng. ÄÃ´i máº¯t ká»n ká»n cá»§a Ã´ng hÆ¡i cá»¥p mi xuá»‘ng nhÃ¬n tÃ´i cháº±m cháº±m tá»« trÃªn cao. TrÆ°á»›c háº¿t Ä‘Ã³ lÃ  chiá»u cao cá»§a cÃ¡i bá»‡ Ã´ng ta Ä‘á»©ng, thá»© Ä‘áº¿n lÃ  chiá»u cao cá»§a vÃ³c ngÆ°á»i Ã´ng, Ã­t ra cÅ©ng pháº£i má»™t thÆ°á»›c tÃ¡m, nÃ³ lÃ m tÄƒng cÃ¡i váº» hÃ¡ch dá»‹ch cá»§a Ã´ng ta lÃªn ráº¥t nhiá»u. Ã”ng ta khÃ´ng bá» táº¥m Ã¡o khoÃ¡c mÃ u Ä‘á», mÃ  chá»‰ Ä‘áº·t cÃ¡i mÅ© xuá»‘ng trÆ°á»›c máº·t. Ã”ng ta chá»‘ng hai tay lÃªn bÃ n, hai bÃ n tay to nhÆ° hai cÃ¡i bá»“ cÃ o. Má»™t chiáº¿c nháº«n vÃ ng cho biáº¿t ráº±ng Ã´ng ta Ä‘Ã£ cÃ³ vá»£, vÃ  á»Ÿ ngÃ³n tay Ãºt Ã´ng Ä‘eo má»™t cÃ¡i Ä‘inh mÃ³ng ngá»±a nháºµn bÃ³ng thay cho nháº«n.</p><p>Ã”ng hÆ¡i nghiÃªng vá» phÃ­a tÃ´i Ä‘á»ƒ tÄƒng thÃªm sá»©c Ã¡p Ä‘áº£o Ã´ng cÃ³ váº» nhÆ° Ä‘ang nÃ³i vá»›i tÃ´i: nÃ y anh báº¡n tráº», náº¿u anh nghÄ© ráº±ng anh cÃ³ thá»ƒ thoÃ¡t khá»i tay tÃ´i thÃ¬ anh nháº§m Ä‘áº¥y. NgÆ°á»i ta khÃ´ng tháº¥y tay tÃ´i cÃ³ vuá»‘t nhá»n, nhÆ°ng bá»™ vuá»‘t nÃ y luÃ´n luÃ´n cÃ³ máº·t trong tÃ¢m há»“n tÃ´i, vÃ  nÃ³ sáº½ xÃ© tan anh ra khÃ´ng cÃ³ cÃ¡ch gÃ¬ thoÃ¡t ná»•i. VÃ  sá»Ÿ dÄ© táº¥t cáº£ cÃ¡c tráº¡ng sÆ° Ä‘á»u sá»£ tÃ´i, sá»Ÿ dÄ© trong giá»›i quan tÃ²a tÃ´i ná»•i tiáº¿ng lÃ  má»™t cÃ´ng tá»‘ viÃªn nguy hiá»ƒm, chÃ­nh lÃ  vÃ¬ khÃ´ng bao giá» tÃ´i Ä‘á»ƒ sá»•ng máº¥t má»“i.</p>', 0, 'coin', 'public', '', '', '2', '', '', 0, 0, 0, 0, '1408171140'),
(14, 1, 0, '<p>I''m currently in building this as android app.</p><p>Just started, but will be available soon hope <img src="http://localhost:8080/blive/assets/img/emo/meep/nherang.png" data-sceditor-emoticon=":D" alt=":D" title=":D"></p>', 25, 'coin', 'public', '', 'yes', '1, 3', '1, 2', '', 0, 0, 0, 0, '1408190836'),
(15, 3, 0, '<p>test the tag noti</p><p>+mia @miamor +abc +xyz&nbsp;</p><p>Kay?</p>', 0, 'coin', 'public', '', 'yes', '3', '', '', 0, 0, 0, 0, '1408191109'),
(16, 3, 0, '<p>test more noti :v</p><p>+admin +mia +abc +xyz&nbsp;</p>', 0, 'coin', 'public', '', '', '3', '1', '', 0, 0, 0, 0, '1408191112'),
(17, 3, 0, 'Something to say!', 0, 'coin', 'public', '', '', '', '3', '', 0, 0, 0, 0, '1408240213'),
(18, 3, 0, '<p>hey, test js in new theme~</p>', 0, 'coin', 'public', '', 'yes', '3', '3', '', 0, 0, 0, 0, '1408290715'),
(19, 3, 0, '<p>ok, new js now!</p>', 0, 'coin', 'public', '', '', '', '', '', 0, 0, 0, 0, '1408290717');

-- --------------------------------------------------------

--
-- Table structure for table `promise_cmt`
--

CREATE TABLE IF NOT EXISTS `promise_cmt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `content` longtext NOT NULL,
  `likes` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `promise_cmt`
--

INSERT INTO `promise_cmt` (`id`, `uid`, `iid`, `pid`, `content`, `likes`, `time`) VALUES
(1, 2, 1, 0, 'This is the test comment.', '', '1408080733'),
(2, 2, 1, 0, 'This is the second comment. Hey look! It''s a long comment :3', '1', '1408080733'),
(3, 2, 1, 0, 'Test more comment :3', '', '1408080733'),
(4, 2, 1, 2, 'Test child comment \\m/', '', '1408080733'),
(5, 1, 1, 0, '<p>shit!</p>', '', '1408141059'),
(6, 1, 1, 0, '<p>hey</p>', '', '1408141104'),
(7, 1, 1, 0, '<p>no!</p>', '', '1408141105'),
(8, 3, 7, 0, '<p>Just test the comment</p>', '', '1408150045'),
(9, 3, 7, 0, '<p>great! :3</p>', '', '1408150148'),
(10, 3, 11, 0, '<p>Still cool :3</p>', '', '1408150215'),
(11, 1, 3, 0, '<p>hehe</p>', '', '1408160742'),
(12, 1, 2, 0, '<p>one comment :3</p>', '1', '1408160851'),
(13, 1, 2, 0, '<p>cool :D</p>', '', '1408160913'),
(14, 1, 2, 0, '<p>oh shit!</p>', '3', '1408161131'),
(15, 1, 2, 0, '<p>oh shit!</p>', '', '1408161131'),
(16, 1, 2, 0, '<p>oh shit!</p>', '', '1408161131'),
(17, 1, 2, 0, '<p>jj</p>', '3', '1408161155'),
(18, 1, 2, 0, '<p>broken~</p>', '', '1408161156'),
(19, 1, 2, 0, '<p>._.</p>', '', '1408161203'),
(20, 1, 2, 0, '<p>:((</p>', '', '1408161204'),
(21, 1, 2, 0, '<p>hihi</p>', '', '1408161204'),
(22, 1, 2, 0, '<p>dis</p>', '', '1408161214'),
(23, 1, 2, 0, '<p>nhoi</p>', '3', '1408161215'),
(25, 1, 16, 0, '<p>yeah it''s working fine!</p>', '1, 3', '1408200807'),
(24, 1, 2, 14, '<p>well..</p>', '', '1408181101'),
(26, 1, 16, 0, '<p>yeah it''s working fine!</p>', '', '1408200807'),
(27, 1, 16, 0, '<p>yeah it''s working fine!</p>', '', '1408200807'),
(28, 1, 16, 0, '<p>yeah it''s working fine!</p>', '', '1408200807'),
(29, 1, 16, 0, '<p>shit</p>', '', '1408200809'),
(30, 1, 16, 0, 'ha!', '', '1408200919'),
(31, 1, 1, 0, '<p>worked!</p>', '', '1408200919'),
(32, 3, 1, 0, '<p>jajaja</p>', '', '1408240105'),
(33, 3, 14, 0, '<p>test</p>', '', '1408261007'),
(34, 3, 14, 0, 'oh shit!<br>test?', '', '1408261008'),
(35, 3, 14, 33, '<p>child cmt</p>', '3', '1408261037'),
(36, 3, 14, 34, '<p>child</p>', '', '1408261037'),
(37, 3, 14, 34, 'all good', '', '1408261037'),
(38, 3, 14, 34, 'all good', '', '1408261037'),
(39, 3, 14, 34, 'all good', '', '1408261037'),
(40, 3, 14, 34, 'all good', '', '1408261037'),
(41, 3, 14, 34, '<p>not good</p>', '', '1408261044'),
(42, 3, 14, 34, 'hey', '', '1408261044'),
(43, 3, 14, 34, 'hoho', '', '1408261044'),
(44, 3, 14, 33, '<p>ok</p>', '3', '1408261044'),
(45, 3, 14, 33, 'kay?', '', '1408261045'),
(46, 3, 14, 33, '<p>shit!</p>', '', '1408261047'),
(47, 3, 14, 33, 'break?', '', '1408261047'),
(48, 3, 14, 0, '<p>damn</p><p><br></p>', '', '1408261048'),
(49, 3, 14, 0, 'abc', '3', '1408261049'),
(50, 3, 14, 0, '<p>now!</p>', '', '1408261050'),
(51, 3, 14, 50, '<p>shit</p>', '3', '1408261050'),
(52, 3, 14, 50, 'crap', '', '1408261051'),
(53, 3, 14, 0, '<p>me no</p>', '', '1408261051'),
(54, 3, 14, 0, 'nay', '', '1408261051'),
(55, 3, 14, 53, '<p>oi?</p>', '', '1408261051'),
(56, 3, 14, 54, '<p>huh?</p>', '', '1408261051'),
(57, 3, 14, 54, 'disconmemay', '', '1408261051'),
(58, 1, 15, 0, '<p>ihihi<br>okay?</p>', '', '1408270003'),
(59, 3, 2, 12, '<p>ihihi</p>', '', '1408270221'),
(60, 3, 2, 14, '<p>img <img src="http://localhost:8080/blive/assets/img/emo/meep/smile.png" data-sceditor-emoticon=":)" alt=":)" title=":)"></p>', '3', '1408270221'),
(61, 3, 2, 14, 'test', '3', '1408270221'),
(62, 3, 2, 14, 'good', '', '1408270221'),
(63, 3, 2, 16, '<p>huhm... not good</p>', '3', '1408270222'),
(64, 3, 2, 16, 'not good', '', '1408270222'),
(65, 3, 2, 17, '<p>shit</p>', '', '1408270222'),
(66, 3, 2, 17, 'crap', '', '1408270222'),
(67, 3, 2, 19, '<p>fuck</p>', '', '1408270224'),
(68, 3, 2, 23, '<p>nhui<br><img src="http://localhost:8080/blive/assets/img/emo/meep/nherang.png" data-sceditor-emoticon=":D" alt=":D" title=":D"></p>', '', '1408270224'),
(69, 3, 2, 23, 'hey', '3', '1408270225'),
(70, 3, 2, 23, 'crip', '', '1408270225'),
(71, 3, 2, 0, '<p>huhm</p>', '3', '1408270226'),
(72, 3, 2, 0, 'huh?', '', '1408270226'),
(73, 3, 2, 71, '<p>hic</p>', '3', '1408270227'),
(74, 3, 2, 71, 'hix', '', '1408270228'),
(75, 3, 3, 11, '<p>hihi</p>', '3', '1408270229'),
(76, 3, 3, 11, 'shit', '', '1408270229'),
(77, 3, 3, 11, 'cool!', '', '1408270229'),
(78, 3, 14, 0, '<p>help<br>help<br>help<br></p>', '', '1408290058'),
(79, 3, 17, 0, '<p>hi</p>', '', '1408290207');

-- --------------------------------------------------------

--
-- Table structure for table `promise_did`
--

CREATE TABLE IF NOT EXISTS `promise_did` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `iid` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `suborner` longtext NOT NULL,
  `people` longtext NOT NULL COMMENT 'list người phải thực hiện việc tốt',
  `content` longtext NOT NULL,
  `lock_option` varchar(255) NOT NULL DEFAULT 'default',
  `lock_num` int(255) NOT NULL,
  `believe` longtext NOT NULL,
  `believe_not` longtext NOT NULL,
  `know_did` longtext NOT NULL,
  `know_didnot` longtext NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `promise_did`
--

INSERT INTO `promise_did` (`id`, `iid`, `uid`, `suborner`, `people`, `content`, `lock_option`, `lock_num`, `believe`, `believe_not`, `know_did`, `know_didnot`, `time`) VALUES
(1, 1, 1, '', '2, 3, 5', 'I did it! I finally did it! :3 Such an amazing moment @abc @mia @miamor @vyskzi ', 'default', 0, '2, 3', '', '', '', '1408052255'),
(2, 2, 1, '', '2', '<p>Xong rÃ¹i nÃ¨ ^^</p>', 'default', 10, '3', '', '', '', '1408161058'),
(3, 10, 3, '', '', '<p>Hey hey! I did it :3</p>', 'default', 3, '1', '', '', '', '1408190119'),
(4, 14, 1, '2, 3', '2, 3', '<p>Just wanna be clear.</p><p>I did it!</p><p>[...] should know it.</p>', 'default', 10, '', '', '3', '', '1408201005'),
(5, 12, 1, '', '', '<p>I failed it <img src="http://localhost:8080/blive/assets/img/emo/meep/bored.png" data-sceditor-emoticon=":(" alt=":(" title=":("></p>', 'default', 0, '', '', '', '', '1408201022'),
(6, 15, 3, '1', '1', '<p>hi! test new theme!</p>', '', 0, '', '', '', '', '1408260937'),
(7, 15, 3, '1', '1', '<p>hi! test new theme!</p>', '', 0, '', '', '', '', '1408260937'),
(8, 15, 3, '1', '1', '<p>hi! test new theme!</p>', '', 0, '', '', '', '', '1408260937'),
(9, 15, 3, '1', '1', '<p>hi! test new theme!</p>', '', 0, '', '', '', '', '1408260937'),
(10, 15, 3, '1', '1', '<p>hi! test new theme!</p>', '', 0, '', '', '', '', '1408260937'),
(11, 18, 3, '1', '1', '<p>I say something....</p>', '', 0, '', '', '', '', '1408290727');

-- --------------------------------------------------------

--
-- Table structure for table `promise_like`
--

CREATE TABLE IF NOT EXISTS `promise_like` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) NOT NULL,
  `iid` int(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
