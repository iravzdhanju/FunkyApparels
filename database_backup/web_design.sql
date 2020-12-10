-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for web_project
CREATE DATABASE IF NOT EXISTS `web_project` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `web_project`;

-- Dumping structure for table web_project.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_Id` char(36) NOT NULL DEFAULT uuid(),
  `first_Name` varchar(20) NOT NULL DEFAULT '',
  `last_Name` varchar(20) NOT NULL DEFAULT '',
  `City` varchar(25) NOT NULL,
  `Province` varchar(25) NOT NULL,
  `postal_Code` char(7) NOT NULL DEFAULT '0',
  `user_Name` varchar(12) NOT NULL DEFAULT '0',
  `user_Password` varchar(255) NOT NULL DEFAULT '0',
  `date_Created` datetime DEFAULT current_timestamp(),
  `date_Modified` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Created by : Ravinderpal Singh\r\nThis table is used to store information of the customers\r\nhere i have used customer_id as a primary key\r\nfirst_name to store the first name of the users\r\nlast_name to store the last name of the users\r\ncity , Province, postal_code to store the adddress of the users\r\nuser_name to store the username of the user\r\nuser_password to store the password of the user';

-- Data exporting was unselected.

-- Dumping structure for view web_project.customer_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `customer_view` (
	`first_Name` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`last_Name` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`City` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`Province` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`postal_Code` CHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for procedure web_project.Filter
DELIMITER //
CREATE PROCEDURE `Filter`(
	IN `P_DateTime` DATETIME
)
    COMMENT 'Filter stored routine is used to select all of the items from purchase table  here i filtered the data through the date time'
BEGIN

IF (P_Datetime='' OR P_Datetime=null)
THEN
SELECT * FROM purchase;

ELSE

SELECT * FROM purchase
WHERE date_CreatedTime >= P_Datetime
ORDER BY date_CreatedTime;

END IF;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.get_Password
DELIMITER //
CREATE PROCEDURE `get_Password`(
	IN `P_user_Name` VARCHAR(25)
)
    COMMENT 'in this stored routine i have stored the passwords from the users'
BEGIN

SELECT user_Password FROM customers 
WHERE user_Name=P_user_Name;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.insert_Customer
DELIMITER //
CREATE PROCEDURE `insert_Customer`(
	IN `P_first_Name` VARCHAR(20),
	IN `P_last_Name` VARCHAR(20),
	IN `P_City` VARCHAR(25),
	IN `P_Province` VARCHAR(25),
	IN `P_postal_Code` VARCHAR(25),
	IN `P_user_Name` VARCHAR(20),
	IN `P_Password` VARCHAR(255)
)
    COMMENT 'in this stored routine i have stored the first name, last name, city, province, postal code, username, password entered by the users'
BEGIN

INSERT INTO customers(first_Name,last_Name,City,Province,postal_Code,user_Name,user_Password)
VALUES (P_first_Name,P_last_Name,P_City,P_Province,P_postal_Code,P_user_Name,P_Password);

END//
DELIMITER ;

-- Dumping structure for procedure web_project.insert_Product
DELIMITER //
CREATE PROCEDURE `insert_Product`(
	IN `P_product_Code` CHAR(36),
	IN `P_Price` DECIMAL(10,2),
	IN `P_Description` VARCHAR(100)
)
    COMMENT 'in this stored routine i have stored the product_code, product_price and discription entered by the users in the products table'
BEGIN

INSERT INTO products (product_Code, product_Price, Description)
VALUES (P_product_Code, P_Price, P_Description);
END//
DELIMITER ;

-- Dumping structure for procedure web_project.insert_Purchase
DELIMITER //
CREATE PROCEDURE `insert_Purchase`(
	IN `P_user_Name` VARCHAR(25),
	IN `P_product_Code` CHAR(36),
	IN `P_Price` DECIMAL(10,2),
	IN `P_Quantity` INT(11),
	IN `P_Comment` VARCHAR(300),
	IN `P_Taxes` DECIMAL(10,2),
	IN `P_Subtotal` DECIMAL(10,2),
	IN `P_grandTotal` DECIMAL(10,2)
)
    COMMENT 'in this stored routine i have stored the username, product code, product price , quantity, subtotal, taxes,comments,  entered by the users in the purchase table'
BEGIN
#in this stored routine i have stored the username, product code, product price , quantity, subtotal, taxes,comments,  entered by the users in the purchase table
INSERT INTO purchase(user_Name,product_Code,product_Price,quantity_Sold,Comments,Subtotal,Taxes,grandTotal)
VALUES(P_user_Name,P_product_Code,P_Price,P_Quantity,P_Comment,P_Subtotal,P_Taxes,P_grandTotal);
END//
DELIMITER ;

-- Dumping structure for table web_project.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_Id` char(36) NOT NULL DEFAULT uuid(),
  `product_Code` char(36) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Price` decimal(7,2) NOT NULL,
  `date_Creation` datetime NOT NULL DEFAULT current_timestamp(),
  `Modified` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_Id`),
  UNIQUE KEY `product_Code` (`product_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Created by : Ravinderpal Singh\r\nThis table is used to store products information\r\nhere i have used product_id as a primary key\r\nproduct_Code to store the product code\r\ndescription  to store the description of the product\r\nprice  to store the price of the products\r\ndate_creation to store the creation date of the product\r\ndate_modified to store the modification date of the product';

-- Data exporting was unselected.

-- Dumping structure for view web_project.product_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `product_view` (
	`product_Code` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`Price` DECIMAL(7,2) NOT NULL,
	`Description` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table web_project.purchase
CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_Id` char(36) NOT NULL DEFAULT uuid(),
  `customer_Id` char(36) NOT NULL DEFAULT uuid(),
  `product_Id` char(36) NOT NULL DEFAULT uuid(),
  `product_Code` char(36) NOT NULL,
  `product_Price` decimal(10,0) NOT NULL,
  `date_CreatedTime` datetime DEFAULT current_timestamp(),
  `modified_Date` datetime DEFAULT current_timestamp(),
  `Comments` varchar(50) DEFAULT '',
  `quantity_Sold` int(11) NOT NULL DEFAULT 0,
  `Taxes` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subTotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grandTotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`purchase_Id`),
  UNIQUE KEY `product_Code` (`product_Code`),
  KEY `customer_Id` (`customer_Id`),
  KEY `product_Id` (`product_Id`),
  CONSTRAINT `F_customer_Id` FOREIGN KEY (`customer_Id`) REFERENCES `customers` (`customer_Id`),
  CONSTRAINT `F_product_Code` FOREIGN KEY (`product_Code`) REFERENCES `products` (`product_Code`),
  CONSTRAINT `F_product_Id` FOREIGN KEY (`product_Id`) REFERENCES `products` (`product_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Created by : Ravinderpal Singh\r\nThis table is used to store purchase information of the product\r\nhere i have used purchase_id as a primary key\r\ncustomer_id as  a foreign key\r\nproduct_id as a foreign key\r\nproduct_code as a unieque key\r\nproduct_price to store the product \r\ncomments to store the comments of the product\r\nquantity_sold to store the solded  products\r\nTaxes subtotal and grand total to store the numeric data of the product\r\n';

-- Data exporting was unselected.

-- Dumping structure for view web_project.purchase_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `purchase_view` (
	`product_Code` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`quantity_Sold` INT(11) NOT NULL,
	`product_Price` DECIMAL(10,0) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure web_project.remove_Customer
DELIMITER //
CREATE PROCEDURE `remove_Customer`(
	IN `P_customer_Id` CHAR(36)
)
    COMMENT 'to remove a customer from table using customer_id'
BEGIN

DELETE FROM customers
WHERE customer_Id = P_customer_Id;

END//
DELIMITER ;

-- Dumping structure for procedure web_project.remove_Product
DELIMITER //
CREATE PROCEDURE `remove_Product`(
	IN `P_product_Code` CHAR(36)
)
    COMMENT 'to remove a product from table using product_code'
BEGIN

DELETE FROM products
WHERE product_Code=P_product_Code;

END//
DELIMITER ;

-- Dumping structure for procedure web_project.remove_Purchase
DELIMITER //
CREATE PROCEDURE `remove_Purchase`(
	IN `P_purchase_Id` CHAR(36)
)
    COMMENT 'to remove a purchase from table using purchase_id'
BEGIN

DELETE FROM purchase
WHERE purchase_Id=P_purchase_Id;

END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_AllCustomers
DELIMITER //
CREATE PROCEDURE `show_AllCustomers`()
    COMMENT 'TO SHOW ALL of the customers IN table'
BEGIN
SELECT * FROM customers;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_AllProducts
DELIMITER //
CREATE PROCEDURE `show_AllProducts`()
    COMMENT 'TO SHOW ALL of the products IN table'
BEGIN
SELECT * FROM products;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_AllPurchases
DELIMITER //
CREATE PROCEDURE `show_AllPurchases`()
    COMMENT 'TO SHOW ALL of the purchases IN table'
BEGIN
SELECT * FROM purchase;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_Customer
DELIMITER //
CREATE PROCEDURE `show_Customer`(
	IN `P_customer_Id` CHAR(36)
)
    COMMENT 'TO SHOW a particular customer using customer_id as a perimeter'
BEGIN

SELECT *
FROM customers
WHERE customer_Id = P_customer_Id;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_Product
DELIMITER //
CREATE PROCEDURE `show_Product`(
	IN `P_product_Id` CHAR(36)
)
    COMMENT 'TO SHOW a particular product using productid as a perimeter'
BEGIN

SELECT *
FROM products
WHERE product_Id = P_product_Id
ORDER BY Description;


END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_Purchase
DELIMITER //
CREATE PROCEDURE `show_Purchase`(
	IN `P_purchase_Id` CHAR(36)
)
    COMMENT 'TO SHOW a purchase using purchaseid as a perimeter'
BEGIN

SELECT *
FROM purchase
WHERE purchase_Id = P_purchase_Id;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.show_Users
DELIMITER //
CREATE PROCEDURE `show_Users`()
BEGIN
SELECT *  FROM customers;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.update_Customer
DELIMITER //
CREATE PROCEDURE `update_Customer`(
	IN `P_City` VARCHAR(25),
	IN `P_Province` VARCHAR(25),
	IN `P_postal_Code` CHAR(7),
	IN `P_Password` VARCHAR(255),
	IN `P_user_Name` CHAR(25),
	IN `P_customer_Id` CHAR(36)
)
    COMMENT 'TO update a customer''s city, province, postalcode passeword and username along with modified date'
BEGIN

UPDATE customers
SET	City=P_City,
		Province=P_Province,
		postal_Code=P_postal_Code,
		user_Password=P_Password,
		ModifeidDate=CURRENT_TIMESTAMP(),
		user_Name=P_user_Name
		
		
		WHERE customer_Id= P_customer_Id ;
END//
DELIMITER ;

-- Dumping structure for procedure web_project.update_Product
DELIMITER //
CREATE PROCEDURE `update_Product`(
	IN `P_updated_Price` DECIMAL(7,2),
	IN `P_product_Code` CHAR(36),
	IN `P_Description` INT
)
    COMMENT 'TO update a product''s price , description along with modified date'
BEGIN

UPDATE products
SET Price=updated_Price,
	Description = p_Description,
	Modified= CURRENT_TIMESTAMP()	
	WHERE product_Code=P_product_Code;

END//
DELIMITER ;

-- Dumping structure for procedure web_project.update_Purchase
DELIMITER //
CREATE PROCEDURE `update_Purchase`(
	IN `P_Quantity` INT(11),
	IN `P_product_Code` VARCHAR(36),
	IN `P_purchase_Id` CHAR(36),
	IN `P_Price` DECIMAL(10,2),
	IN `P_Subtotal` DECIMAL(10,2),
	IN `P_Taxes` DECIMAL(10,2),
	IN `P_grandTotal` DECIMAL(10,2)
)
    COMMENT 'TO update a product''s purchsae , solded items, product code price subtotal and taxes along with modified date'
BEGIN

UPDATE purchase
SET quantity_Sold=P_Quantity,
	 product_Code=P_product_Code,
	 product_Price=P_Price,	
	 subTotal=P_Subtotal,
	 Taxes=P_Taxes,
	 grandTotal=P_grandTotal,
	modified_Date=CURRENT_TIMESTAMP()
	WHERE purchase_Id=P_purchaseId;

END//
DELIMITER ;

-- Dumping structure for view web_project.customer_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `customer_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `customer_view` AS #to view selected fields of the product
SELECT first_Name, last_Name, City, Province, postal_Code
FROM customers ;

-- Dumping structure for view web_project.product_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `product_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `product_view` AS #to view selected fields of the product
SELECT product_Code, Price, Description
FROM products ;

-- Dumping structure for view web_project.purchase_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `purchase_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `purchase_view` AS #to view selected fields of the product
SELECT 
product_Code,quantity_Sold,product_Price
FROM purchase ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
