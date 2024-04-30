-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 06:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seed_management_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteemployeeOrfarm` (IN `tableName` VARCHAR(50), IN `columnName` VARCHAR(50), IN `conditionValue` VARCHAR(100))   BEGIN
    DECLARE tableNameLowercase VARCHAR(50);
    SET tableNameLowercase = LOWER(tableName);
    SET @deleteQuery = CONCAT('DELETE FROM ', tableNameLowercase, ' WHERE ', columnName, ' = ?');
    PREPARE stmt FROM @deleteQuery;
    EXECUTE stmt USING conditionValue;
    DEALLOCATE PREPARE stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplayAllTablesData` ()   BEGIN
select*from crop;
select*from farm;
select*from employee;
select*from seed_lot;
select*from login;
select*from seed;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DisplaySeedData` ()   BEGIN
    SELECT * FROM seed;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetseedInseed_lot` (IN `seed_lot_name` VARCHAR(100))   BEGIN
    SELECT Seed_type,quantity 
    FROM seed
    WHERE seed_id IN (
        SELECT seed_id
        FROM seed_lot
        WHERE seed_lot_id = (SELECT seed_lot_id FROM seed_lot WHERE seed_lot = seed_lot)
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertcrop` (IN `crop_name` VARCHAR(255), IN `seed_id` INT, IN `variety` VARCHAR(255), IN `planting_date` DATE, IN `harvest_date` DATE, IN `yield` INT, IN `market_value` DOUBLE, IN `pest_resistance` VARCHAR(255))   BEGIN
INSERT INTO crop (crop_name, seed_id,variety, planting_date, harvest_date, yield, market_value, pest_resistance)
VALUES(cropname, seedid,variety, plantingdate, harvestdate, yield, marketvalue, pestresistance);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertemployee` (`employee_id` INT, IN `employee_name` VARCHAR(255), IN `job_title` VARCHAR(255), IN `phone_number` VARCHAR(255), IN `email_address` VARCHAR(255), IN `address` VARCHAR(255), IN `date_of_birth` DATE, IN `education` VARCHAR(255), IN `training` VARCHAR(255), IN `role` VARCHAR(255), IN `permissions` VARCHAR(255))   BEGIN
INSERT INTO employee (employee_name, job_title, phone_number, email_address, address, date_of_birth, education, training, role, permissions)
VALUES (employeename, jobtitle, phonenumber, emailaddress, address, dateofbirth, education, training, role, permissions);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertfarm` (IN `farm_id` INT, IN `farm_name` VARCHAR(255), IN `location` VARCHAR(255), IN `owner` VARCHAR(255), IN `size` INT, IN `employee_id` INT, IN `soil_type` VARCHAR(255), IN `irrigation_system` VARCHAR(255), IN `crop_rotation_schedule` VARCHAR(255))   BEGIN
INSERT INTO farm (farm_id ,farm_name, location, owner, size,employee_id ,
 soil_type, irrigation_system, crop_rotation_schedule)
VALUES (farm_id ,farm_name, location, owner, size,employee_id ,
 soil_type, irrigation_system, crop_rotation_schedule);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertlogin` (IN `login_id` INT, IN `username` VARCHAR(255), IN `password` VARCHAR(255), IN `role` VARCHAR(255), IN `permissions` VARCHAR(255), IN `employee_id` INT)   BEGIN
INSERT INTO login ( login_id,username, password, role, permissions,employee_id)
VALUES (001,'pierre', 'password123', 'Farmer', 'All',1);

    INSERT INTO login ( login_id,username, password, role, permissions,employee_id) 
    VALUES (loginid,username, password, role, permissions,employeeid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSEED_LOT` (IN `seed_lot_number` INT, IN `seed_id` INT, IN `production_date` DATE, IN `supplier` VARCHAR(255), IN `lot_size` INT)   BEGIN
INSERT INTO seed_lot (seed_lot_number, seed_id, production_date, supplier, lot_size)
VALUES (seed_lotnumber, seedid, productiondate, supplier, lotsize);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateFarmData` (IN `farmId` INT, IN `newFarmName` VARCHAR(255), IN `newLocation` VARCHAR(255))   BEGIN
    UPDATE farm
    SET farm_name = newFarmName, location = newLocation
    WHERE farm_id = farmId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSeedData` (IN `seedId` INT, IN `newGerminationRate` DOUBLE, IN `newQuantity` INT)   BEGIN
    UPDATE seed
    SET germination_rate = newGerminationRate, quantity = newQuantity
    WHERE seed_id = seedId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `crop_id` int(11) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_price` int(11) NOT NULL,
  `crop_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`crop_id`, `crop_name`, `crop_price`, `crop_description`) VALUES
(4, 'avocadoes', 1, 'Roundup Ready'),
(5, 'Soybeans', 2, 'Incredible'),
(6, 'Wheat', 3, 'Hard Red Spring');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `education` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `job_title`, `phone_number`, `email_address`, `address`, `date_of_birth`, `education`) VALUES
(1, 'ndayiringiye', 'Farmer', '0785551212', 'ndayir@gmail.com', 'huye', '1970-01-01', 'High school diploma'),
(2, 'Jane', 'Seed sales representative', '0795552323', 'jane@gmail.com', 'musanze', '1980-02-02', 'Bachelors degree in agriculture'),
(3, 'John', 'Farmer', '0725551212', 'john@gmail.com', 'burera', '1970-01-01', 'High school diploma');

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `AfterDeleteemployee` AFTER DELETE ON `employee` FOR EACH ROW BEGIN
    INSERT INTO employee_audit (employee_id, action, action_date)
    VALUES (OLD.employee_id, 'DELETE', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AfterUpdateemployee` AFTER UPDATE ON `employee` FOR EACH ROW BEGIN
    INSERT INTO employee_audit (employee_id, action, action_date)
    VALUES (NEW.employee_id, 'UPDATE', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `farm_id` int(11) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` int(11) NOT NULL,
  `Phone Number` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `soil_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`farm_id`, `farm_name`, `location`, `email`, `Phone Number`, `employee_id`, `soil_type`) VALUES
(1, 'byumba', 'rwanda', 0, 0, 1, 'Sand'),
(2, 'ngoma', 'rwanda', 0, 0, 2, 'Loam'),
(3, 'kabale', 'uganda', 0, 0, 3, 'Clay');

--
-- Triggers `farm`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertfarm` AFTER INSERT ON `farm` FOR EACH ROW BEGIN
    INSERT INTO farm_audit (farm_id, action, action_date)
    VALUES (NEW.farm_id, 'INSERT', NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Username` varchar(250) NOT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Telephone` int(20) NOT NULL,
  `Passowrd` varchar(250) DEFAULT NULL,
  `Activation_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seed`
--

CREATE TABLE `seed` (
  `seed_id` int(11) NOT NULL,
  `seed_type` varchar(255) NOT NULL,
  `variety` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `country_of_origin` varchar(255) NOT NULL,
  `breeder` varchar(255) NOT NULL,
  `date_harvested` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seed`
--

INSERT INTO `seed` (`seed_id`, `seed_type`, `variety`, `quantity`, `location`, `country_of_origin`, `breeder`, `date_harvested`) VALUES
(1, 'Corn', 'Roundup Ready', 10000, 'bugesera', 'rwanda', 'RAB', '2023-08-29'),
(2, 'Soybeans', 'Incredible', 20000, 'rwamagana', 'rwanda', 'RAB', '2023-08-30'),
(3, 'Wheat', 'Hard Red Spring', 30000, 'musanze', 'rwanda', 'MINAGRI', '2023-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `seed_lot`
--

CREATE TABLE `seed_lot` (
  `lot_number` int(11) NOT NULL,
  `seed_id` int(11) NOT NULL,
  `production_date` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `lot_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seed_lot`
--

INSERT INTO `seed_lot` (`lot_number`, `seed_id`, `production_date`, `supplier`, `lot_size`) VALUES
(1, 1, '2023-08-29', 'NYAMATA  Seed Company', 10000),
(2, 2, '2023-08-28', 'GISHARI  CropScience', 20000),
(3, 3, '2023-08-27', ' NYAKINAMA', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `view_crop`
--

CREATE TABLE `view_crop` (
  `crop_id` int(11) DEFAULT NULL,
  `crop_name` varchar(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `planting_date` date DEFAULT NULL,
  `harvest_date` date DEFAULT NULL,
  `Ttransation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
