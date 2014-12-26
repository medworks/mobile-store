-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2014 at 04:33 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(3, 'نوکیا'),
(4, 'ال جی'),
(5, 'سامسونگ');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qid` tinyint(4) NOT NULL,
  `price` int(11) NOT NULL,
  `mojodi` int(11) NOT NULL,
  `takhfikh` int(11) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `bid`, `gid`, `code`, `name`, `qid`, `price`, `mojodi`, `takhfikh`, `desc`) VALUES
(1, 3, 1, '   1001', '   فلت C7', 1, 150000, 1000, 0, '  5465'),
(2, 4, 2, ' 1002', ' ال سی دی 1250', 3, 150000, 200, 0, ' '),
(3, 3, 1, '1005', ' ملی', 4, 150000, 200, 0, ' '),
(4, 5, 3, '   1003', 'تاچ بالونی', 1, 0, 2000, 0, ' '),
(5, 3, 1, '   1003', ' ملی', 3, 150000, 0, 0, ' '),
(6, 3, 1, '   1003', ' ملی', 3, 150000, 0, 0, ' '),
(7, 3, 1, '   1003', ' ملی', 3, 150000, 0, 0, ' '),
(8, 4, 2, '   1001', ' فلت C7', 4, 150000, 200, 0, ' '),
(9, 3, 2, ' 1001', ' ملی', 2, 150000, 0, 0, ' '),
(10, 3, 2, ' 10001', ' gh', 2, 123500, 150, 0, ' '),
(11, 3, 1, ' 1001', ' ملی', 2, 150000, 0, 0, ' '),
(12, 3, 1, ' 1001', ' ملی', 2, 150000, 0, 0, ' '),
(13, 5, 4, ' 10001', ' bhkj', 4, 123500, 150, 0, ' '),
(14, 4, 4, ' 1002', ' bhkj', 0, 123500, 150, 0, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `pid`, `name`) VALUES
(1, 0, 'فلت'),
(2, 0, 'ال سی دی'),
(3, 0, 'تاچ'),
(4, 0, 'دوربین');

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE IF NOT EXISTS `pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `lvl` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`id`, `gid`, `lvl`, `name`) VALUES
(1, 14, 1, '14-1.jpg'),
(2, 14, 2, '14-2.jpg'),
(3, 14, 3, '14-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE IF NOT EXISTS `quality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quality`
--

INSERT INTO `quality` (`id`, `name`) VALUES
(1, 'اصلی'),
(2, 'ارجینال'),
(3, 'کپی'),
(4, 'متفرقه');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', 'گروه بازرگانی ایرانا با هدف ارائه رهيافت‌های جامع و خدمات تخصصی در زمينه شبكه های رايانه ای ، طراحی سایت ، اعطاء نمایندگی پیشرفته ترین پنل ارسال اس ام اس ، ارائه امنیت شبکه ، ويدئو کنفرانس Polycom ،  بر مبنای متدولوژی‌های نوين انفورماتيك در سال 1388 تأسيس شد. مبنای فعاليت شركت  بر پايه استفاده از متخصصين مجرب و تجهيزات مدرن در انجام پروژه‌های  كامپيوتری استوار است و بر همين اساس با دريافت نمايندگی رسمی از شركتهای معتبر توليد كننده تجهيزات ، به تدريج در سالهاي اوليه فعاليت خود، به پايگاهی مطمئن در ارائه محصولات معتبر و متنوع شبكه های كامپيوتری تبديل گرديد.\r\nهمچنين با عنايت به اعتقاد مديريت شركت مبنی بر استفاده از نيروهای متخصص، كليه كارشناسان اين شركت  در واحدهای فنی  و مهندسی فروش موفق به دريافت مدارك بین المللی مرتبط با راهکارهای مورد استفاده گردیده اند.\r\nگروه بازرگانی ایرانا در سال 1389 با دریافت نمایندگی رسمی فروش، تمدید و شارژ اینترنت مخابرات بر آن شد تا تمام نیاز های مشترکین مخابرات در این حوزه را برآورده نماید که ارتباط ، پاسخ سریع و ارائه راهکارهای نوین گویای این مطلب میباشد.'),
(3, 'Site_Title', 'گروه بازرگانی ایرانا'),
(4, 'Site_KeyWords', 'اینترنت,مخابرات,صبانت,مودم،اس ام اس،رایگان،تخفیف،پول،شارژ،2020،ir،www.ir2020.ir ،شارژ اینترنت مخابرات خراسان رضوی،'),
(5, 'Site_Describtion', 'گروه بازرگانی ایرانا نماینده رسمی تمدید و ثبت محصولات اینترنت مخابرات'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@ir2020.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '38555560'),
(16, 'Fax_Number', '38555560'),
(17, 'Address', 'مشهد- چهارراه لشکر-مجتمع تجاری اداری آسیا-واحد203\r\n'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک'),
(24, 'WellCome_Title', ''),
(25, 'WellCome_Body', ''),
(26, 'Gplus_Add', 'www.googleplus.com'),
(27, 'About_Pic_Name', 'about_pic.jpg'),
(28, 'Percent_Off', '5'),
(29, 'Extra_Tax', '0'),
(30, 'SmsUserName', 'ir2020'),
(31, 'SmsPassWord', '123456'),
(32, 'SmsText', 'آقا/خانم {user} به شماره خط {tel} سفارش شما با مشخصات {order_info} ثبت و اعمال شد.\r\nبا تشکر\r\nگروه بازرگانی ایرانا\r\n051-38555560\r\n\r\n'),
(33, 'SmsLineNumber', '+98100009'),
(34, 'Bank_Terminal_ID', '1144896'),
(35, 'Bank_User_Name', 'irana'),
(36, 'Bank_Pass_Word', '41833070'),
(37, 'Email_Text', '<p style="direction:rtl;">\r\nبا سلام\r\n<br/>\r\nآقا/خانم {user} ، به شماره خط {tel}  و همراه {mobile} \r\n<br/>\r\nدرخواست شما با مشخصات {order_info} \r\n<br/>\r\nدر مورخه {date} با موفقیت ثبت شد.\r\n<br/>\r\n************************************\r\n<br/>\r\nمشخصات پرداخت به شرح ذیل می باشند :\r\n<br/>\r\nبانک : درگاه پرداخت الکترونیک بانک ملت\r\n<br/>\r\nکد پیگیری : {payment_code}\r\n<br/>\r\nتاریخ پرداخت : {date}\r\n<br/>\r\n************************************\r\n<br/>\r\n با تشکر از اعتماد شما - گروه بازرگانی ایرانا\r\n051-38555560\r\n<br/>\r\n</p>'),
(38, 'Is_Send_Order_Sms_For_Admin', '1'),
(39, 'Admin_Mobile_Number', ''),
(40, 'Admin_Sms_Text', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'Media', 'Teq', '', 'admin@mediateq.ir', 'php', '5f93f983524def3dca464469d2cf9f3e', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
