CREATE DATABASE equipment_management_db;
use equipment_management_db;
CREATE TABLE `equipment` (
`ID` INT(11) NOT NULL AUTO_INCREMENT,
`code` varchar(50) NOT NULL,
`device_name` varchar(50) NOT NULL,
`device_type` varchar(50) NOT NULL,
`quantity` int DEFAULT 0,
`brand` varchar(30) DEFAULT NULL,
`device_image` varchar(50) DEFAULT NULL,
`purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
`createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
`updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
`deletedAt` timestamp NULL DEFAULT NULL,

PRIMARY KEY (`ID`),
UNIQUE KEY `UQ_Equipment_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `accounts` (
`ID` INT(11) NOT NULL AUTO_INCREMENT,
`account_name` varchar(50) NOT NULL,
`password` varchar(50) NOT NULL,
PRIMARY KEY (`ID`),
UNIQUE KEY `UQ_Equipment_accountName` (`account_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
