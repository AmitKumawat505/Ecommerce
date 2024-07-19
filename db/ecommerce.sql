-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2024 at 06:23 AM
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8mb4;

--
-- Database: ecommerce
--

-- --------------------------------------------------------

--
-- Table structure for table categories
--

CREATE TABLE categories (
  Id int(11) NOT NULL,
  Name varchar(250) DEFAULT NULL,
  Alias varchar(200) NOT NULL,
  PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table categories
--

INSERT INTO categories (Id, Name, Alias) VALUES
(1, 'BOTTOM', 'bottom'),
(2, 'TOP', 'top'),
(3, 'SHOES', 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table orders
--

CREATE TABLE orders (
  Id int(11) NOT NULL,
  Uid int(11) NOT NULL,
  Address varchar(200) NOT NULL,
  Phone varchar(20) NOT NULL,
  Cart_total float NOT NULL,
  Description varchar(500) NOT NULL,
  Created_at datetime DEFAULT current_timestamp(),
  PRIMARY KEY (Id),
  KEY user_orders (Uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table orders
--

INSERT INTO orders (Id, Uid, Address, Phone, Cart_total, Description, Created_at) VALUES
(2, 28, 'a', '37800', 44.55, '1', '2024-05-08 18:34:55'),
(3, 27, 'hanoi', '39665', 7.50, '', '2024-05-08 18:47:15'),
(4, 28, 'hanoi', '39665', 12.00, 'abc', '2024-05-08 19:02:19'),
(5, 28, 'hanoi', '39665', 4.50, '', '2024-05-08 22:04:25'),
(6, 27, 'dai hoc back khoa hanoi', '39665', 82.90, 'abc xyc', '2024-05-09 11:22:28');

-- --------------------------------------------------------

--
-- Table structure for table order_detail
--

CREATE TABLE order_detail (
  Id int(11) NOT NULL,
  OrderId int(11) NOT NULL,
  ProductId int(11) NOT NULL,
  Quantity int(11) NOT NULL,
  Price float NOT NULL,
  Size varchar(5) NOT NULL,
  Color varchar(10) NOT NULL,
  PRIMARY KEY (Id),
  KEY FK_order_detail_od1 (OrderId),
  KEY FK_order_detail_od2 (ProductId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table order_detail
--

INSERT INTO order_detail (Id, OrderId, ProductId, Quantity, Price, Size, Color) VALUES
(35, 2, 16, 99, 4.50, 'L', 'White'),
(36, 3, 2, 1, 5.50, 'L', 'White'),
(37, 3, 19, 2, 3.50, 'L', 'White'),
(38, 4, 2, 1, 5.50, 'L', 'White'),
(39, 4, 19, 2, 3.50, 'L', 'White'),
(40, 4, 16, 1, 4.50, 'L', 'White'),
(41, 5, 16, 1, 4.50, 'M', 'Black'),
(42, 6, 35, 2, 15.60, 'S', 'White'),
(43, 6, 26, 4, 14.50, 'M', 'Black');

-- --------------------------------------------------------

--
-- Table structure for table product
--

CREATE TABLE product (
  Id int(11) NOT NULL,
  Name varchar(550) DEFAULT NULL,
  CategoryId int(11) DEFAULT NULL,
  SubCategoryId int(11) DEFAULT NULL,
  Description longtext DEFAULT NULL,
  Price float NOT NULL,
  Color varchar(250) DEFAULT NULL,
  Material varchar(250) DEFAULT NULL,
  Size varchar(20) NOT NULL,
  Createdate date DEFAULT NULL,
  EditDate date DEFAULT NULL,
  isSaleOff tinyint(1) DEFAULT NULL,
  Percent_off int(11) NOT NULL,
  Image1 varchar(250) DEFAULT NULL,
  Image2 varchar(250) DEFAULT NULL,
  Image3 varchar(260) NOT NULL,
  Image4 varchar(260) NOT NULL,
  Alias varchar(200) NOT NULL,
  PRIMARY KEY (Id),
  KEY FK_Product_Categories (CategoryId),
  KEY FK_Product_Subcategory (SubCategoryId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table product
--

INSERT INTO product (Id, Name, CategoryId, SubCategoryId, Description, Price, Color, Material, Size, Createdate, EditDate, isSaleOff, Percent_off, Image1, Image2, Image3, Image4, Alias) VALUES
(1, 'WARM COAT T1', 2, 3, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 4.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 1, 40, 'coat2.jpeg', 'coat.jpeg', 'coat3.jpeg', 'coat4.jpeg', 'warm-coat-t1'),
(2, 'WARM COAT T2', 2, 3, 'Feels smooth to the touch and provides comfortable coverage.<br>AIRism with quick-drying and Cool-Touch features.</br>AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 5.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 1, 40, 'coat.jpeg', 'coat2.jpeg', 'coat3.jpeg', 'coat4.jpeg', 'warm-coat-t2'),
(3, 'WARM COAT T3', 2, 3, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 6.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 1, 40, 'coat3.jpeg', 'coat2.jpeg', 'coat.jpeg', 'coat4.jpeg', 'warm-coat-t3'),
(4, 'WARM COAT T4', 2, 3, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 4.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 1, 40, 'coat4.jpeg', 'coat2.jpeg', 'coat3.jpeg', 'coat.jpeg', 'warm-coat-t4'),
(5, 'COTTON SHIRT C5', 2, 1, 'Feels smooth to the touch and provides comfortable coverage.</br>AIRism with quick-drying and Cool-Touch features.</br>AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 14.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 1, 40, 'shirt.jpeg', 'shirt.jpeg', 'shirt.jpeg', 'shirt.jpeg', 'cotton-shirt-t5'),
(6, 'COTTON SHIRT C6', 2, 1, 'Feels smooth to the touch and provides comfortable coverage.</br>AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 6.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 6.50, 10, 'shirt2.jpeg', 'shirt2.jpeg', 'shirt2.jpeg', 'shirt2.jpeg', 'cotton-shirt-t6'),
(7, 'COTTON SHIRT C7', 2, 1, 'Feels smooth to the touch and provides comfortable coverage.</br>AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 'shirt3.jpeg', 'shirt3.jpeg', 'shirt3.jpeg', 'shirt3.jpeg', 'cotton-shirt-t7'),
(8, 'COTTON SHIRT C8', 2, 1, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.90, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.90, 10, 'shirt4.jpeg', 'shirt4.jpeg', 'shirt4.jpeg', 'shirt4.jpeg', 'cotton-shirt-t8'),
(9, 'BERKIN T-SHIRT T9', 2, 2, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 7.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 7.50, 40, 't-shirt.jpeg', 't-shirt.jpeg', 't-shirt.jpeg', 't-shirt.jpeg', 'berkin-t-shirt-t9'),
(10, 'BERKIN T-SHIRT T10', 2, 2, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 10, 't-shirt2.jpeg', 't-shirt2.jpeg', 't-shirt2.jpeg', 't-shirt2.jpeg', 'berkin-t-shirt-t10'),
(13, 'BERKIN T-SHIRT T13', 2, 2, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 5.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 5.50, 40, 't-shirt3.jpeg', 't-shirt3.jpeg', 't-shirt3.jpeg', 't-shirt3.jpeg', 'berkin-t-shirt-t13'),
(14, 'BERKIN T-SHIRT T14', 2, 2, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 7.00, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 7.00, 10, 't-shirt4.jpeg', 't-shirt4.jpeg', 't-shirt4.jpeg', 't-shirt4.jpeg', 'berkin-t-shirt-t14'),
(15, 'BERKIN T-SHIRT T15', 2, 2, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 't-shirt5.jpeg', 't-shirt5.jpeg', 't-shirt5.jpeg', 't-shirt5.jpeg', 'berkin-t-shirt-t15'),
(16, 'JEANS FIT J16', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 'jeans.jpeg', 'jeans.jpeg', 'jeans.jpeg', 'jeans.jpeg', 'jeans-fit-j16'),
(17, 'JEANS FIT J17', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 'jeans2.jpeg', 'jeans2.jpeg', 'jeans2.jpeg', 'jeans2.jpeg', 'jeans-fit-j17'),
(18, 'JEANS FIT J18', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.00, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.00, 10, 'jeans3.jpeg', 'jeans3.jpeg', 'jeans3.jpeg', 'jeans3.jpeg', 'jeans-fit-j18'),
(19, 'JEANS FIT J19', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 3.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 3.50, 40, 'jeans4.jpeg', 'jeans4.jpeg', 'jeans4.jpeg', 'jeans4.jpeg', 'jeans-fit-j19'),
(20, 'JEANS FIT J20', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 4.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 'jeans5.jpeg', 'jeans5.jpeg', 'jeans5.jpeg', 'jeans5.jpeg', 'jeans-fit-j20'),
(21, 'JEANS FIT J21', 1, 4, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 7.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 7.50, 40, 'jeans6.jpeg', 'jeans6.jpeg', 'jeans6.jpeg', 'jeans6.jpeg', 'jeans-fit-j21'),
(22, 'ACTIVE SHORT J22', 1, 5, 'Feels smooth to the touch and provides comfortable coverage.</br.AIRism with quick-drying and Cool-Touch features.</br.AIRism that maintains a cool and comfortable feel.</br.The longer length flatters the waist.</br.The loose, tape-sewn V-neck accentuates the collarbone.</br.The tops length easily matches with leggings.', 14.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 14.50, 40, 'short.jpeg', 'short2.jpeg', 'short3.jpeg', 'short4.jpeg', 'active-short-j22'),
(23, 'ACTIVE SHORT J23', 1, 5, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 11.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 11.50, 40, 'short2.jpeg', 'short1.jpeg', 'short3.jpeg', 'short4.jpeg', 'active-short-j23'),
(24, 'ACTIVE SHORT J24', 1, 5, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 4.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.50, 40, 'short3.jpeg', 'short2.jpeg', 'short.jpeg', 'short4.jpeg', 'active-short-j24'),
(25, 'ACTIVE SHORT J25', 1, 5, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 4.00, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 4.00, 10, 'short4.jpeg', 'short2.jpeg', 'short3.jpeg', 'short.jpeg', 'active-short-j25'),
(26, 'SPORT SHOES S26', 3, 6, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 14.50, 'Black', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 14.50, 40, 'shoes.jpeg', 'shoes2.jpeg', 'shoes3.jpeg', 'shoes4.jpeg', 'sport-shoes-s26'),
(27, 'SPORT SHOES S27', 3, 6, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 24.50, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'M, L, XL', '2024-05-25', '2024-05-26', 24.50, 40, 'shoes2.jpeg', 'shoes.jpeg', 'shoes3.jpeg', 'shoes4.jpeg', 'sport-shoes-s27'),
(35, 'SPORT SHOES S28', 3, 6, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 15.60, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'S, M, L', '2024-05-09', '2024-05-09', 15.60, 20, 'shoes3.jpeg', 'shoes2.jpeg', 'shoes.jpeg', 'shoes4.jpeg', 'sport-shoes-s28'),
(36, 'SPORT SHOES S29', 3, 6, 'Feels smooth to the touch and provides comfortable coverage.&lt;/br&gt;AIRism with quick-drying and Cool-Touch features.&lt;/br&gt;AIRism that maintains a cool and comfortable feel.&lt;/br&gt;The longer length flatters the waist.&lt;/br&gt;The loose, tape-sewn V-neck accentuates the collarbone.&lt;/br&gt;The tops length easily matches with leggings.', 25.40, 'Black, White', '78% Polyester, 16% Lyocell, 6% Spandex', 'S, M, L', '2024-05-09', '2024-05-09', 25.40, 15, 'shoes4.jpeg', 'shoes2.jpeg', 'shoes3.jpeg', 'shoes.jpeg', 'sport-shoes-s29');


-- --------------------------------------------------------

--
-- Table structure for table subcategory
--

CREATE TABLE subcategory (
  Id int(11) NOT NULL,
  Name varchar(250) DEFAULT NULL,
  CategoryId int(11) DEFAULT NULL,
  Alias varchar(100) NOT NULL,
  PRIMARY KEY (Id),
  KEY FK_Id_Category1 (CategoryId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table subcategory
--

INSERT INTO subcategory (Id, Name, CategoryId, Alias) VALUES
(1, 'Shirt', 2, 'shirt'),
(2, 'T-Shirt', 2, 't-shirt'),
(3, 'Coat', 2, 'coat'),
(4, 'Jeans', 1, 'jeans'),
(5, 'Short', 1, 'short'),
(6, 'Shoes', 3, 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table user
--

CREATE TABLE user (
  Id int(11) NOT NULL,
  Username varchar(50) DEFAULT NULL,
  Password varchar(50) DEFAULT NULL,
  is_admin int(11) NOT NULL,
  PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table user
--

INSERT INTO user (Id, Username, Password, is_admin) VALUES
(27, 'hangtt', 'c4ca4238a0b92dcc509a6f75849b', 1),
(28, 'hoang', 'c4ca4238a0b92dcc509a6f75849b', 1),
(29, 'testname', 'f129a5d0b1ceab27f4e77c0c5d68', 0),
(32, 'testusername', '96e7921eb72c92a549dd5a33', 0);

-- --------------------------------------------------------

--
-- Table structure for table product_quantity
--

CREATE TABLE product_quantity (
  Id int(11) NOT NULL AUTO_INCREMENT,
  ProductId int(11) NOT NULL,
  Color varchar(250) DEFAULT NULL,
  Size varchar(20) NOT NULL,
  Quantity int(11) NOT NULL,
  PRIMARY KEY (Id),
  FOREIGN KEY (ProductId) REFERENCES product(Id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table product_quantity
--

INSERT INTO product_quantity (ProductId, Color, Size, Quantity) VALUES
(1, 'White', 'L', 100),
(1, 'Black', 'M', 150),
(1, 'Black', 'L', 150),
(2, 'White', 'L', 98),
(2, 'Black', 'M', 150),
(2, 'Black', 'L', 150),
(3, 'White', 'L', 100),
(3, 'Black', 'M', 150),
(3, 'Black', 'L', 150),
(4, 'White', 'L', 100),
(4, 'Black', 'M', 150),
(4, 'Black', 'L', 150),
(5, 'White', 'L', 100),
(5, 'Black', 'M', 150),
(5, 'Black', 'L', 150),
(6, 'White', 'L', 100),
(6, 'Black', 'M', 150),
(6, 'Black', 'L', 150),
(7, 'White', 'L', 100),
(7, 'Black', 'M', 150),
(7, 'Black', 'L', 150),
(8, 'White', 'L', 100),
(8, 'Black', 'M', 150),
(8, 'Black', 'L', 150),
(9, 'White', 'L', 100),
(9, 'Black', 'M', 150),
(9, 'Black', 'L', 150),
(10, 'White', 'L', 100),
(10, 'Black', 'M', 150),
(10, 'Black', 'L', 150),
(13, 'White', 'L', 100),
(13, 'Black', 'M', 150),
(13, 'Black', 'L', 150),
(14, 'White', 'L', 100),
(14, 'Black', 'M', 150),
(14, 'Black', 'L', 150),
(15, 'White', 'L', 100),
(15, 'Black', 'M', 150),
(15, 'Black', 'L', 150),
(16, 'White', 'L', 0),
(16, 'Black', 'M', 149),
(16, 'Black', 'L', 150),
(17, 'White', 'L', 100),
(17, 'Black', 'M', 150),
(17, 'Black', 'L', 150),
(18, 'White', 'L', 100),
(18, 'Black', 'M', 150),
(18, 'Black', 'L', 150),
(19, 'White', 'L', 96),
(19, 'Black', 'M', 150),
(19, 'Black', 'L', 150),
(20, 'White', 'L', 100),
(20, 'Black', 'M', 150),
(20, 'Black', 'L', 150),
(21, 'White', 'L', 100),
(21, 'Black', 'M', 150),
(21, 'Black', 'L', 150),
(22, 'White', 'L', 100),
(22, 'Black', 'M', 150),
(22, 'Black', 'L', 150),
(23, 'White', 'L', 100),
(23, 'Black', 'M', 150),
(23, 'Black', 'L', 150),
(24, 'White', 'L', 100),
(24, 'Black', 'M', 150),
(24, 'Black', 'L', 150),
(25, 'White', 'L', 100),
(25, 'Black', 'M', 150),
(25, 'Black', 'L', 150),
(26, 'White', 'L', 2),
(26, 'Black', 'M', 146),
(26, 'Black', 'L', 150),
(27, 'White', 'L', 100),
(27, 'Black', 'M', 150),
(27, 'Black', 'L', 150),
(35, 'White', 'S', 98),
(35, 'White', 'L', 100),
(35, 'Black', 'M', 150),
(35, 'Black', 'L', 150),
(36, 'White', 'S', 100),
(36, 'White', 'L', 100),
(36, 'Black', 'M', 150),
(36, 'Black', 'L', 150);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table categories
--
ALTER TABLE categories
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table orders
--
ALTER TABLE orders
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table order_detail
--
ALTER TABLE order_detail
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table product
--
ALTER TABLE product
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table subcategory
--
ALTER TABLE subcategory
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table user
--
ALTER TABLE user
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;


--
-- Constraints for table orders
--
ALTER TABLE orders
  ADD CONSTRAINT user_orders FOREIGN KEY (Uid) REFERENCES user (Id);

--
-- Constraints for table order_detail
--
ALTER TABLE order_detail
  ADD CONSTRAINT FK_order_detail_od1 FOREIGN KEY (OrderId) REFERENCES orders (Id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_order_detail_od2 FOREIGN KEY (ProductId) REFERENCES product (Id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table product
--
ALTER TABLE product
  ADD CONSTRAINT FK_Product_Categories FOREIGN KEY (CategoryId) REFERENCES categories (Id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT FK_Product_Subcategory FOREIGN KEY (SubCategoryId) REFERENCES subcategory (Id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table subcategory
--
ALTER TABLE subcategory
  ADD CONSTRAINT FK_Id_Category1 FOREIGN KEY (CategoryId) REFERENCES categories (Id) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;