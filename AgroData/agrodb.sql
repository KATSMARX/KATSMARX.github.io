-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 02:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `ID` int(3) NOT NULL,
  `Fullname` varchar(25) NOT NULL,
  `AdminPhoto` varchar(20) NOT NULL,
  `SecretKey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`ID`, `Fullname`, `AdminPhoto`, `SecretKey`) VALUES
(1, 'Kibuuka Emmanuel', '', 'emmanuelk');

-- --------------------------------------------------------

--
-- Table structure for table `advisorupload`
--

CREATE TABLE `advisorupload` (
  `ID` int(3) NOT NULL,
  `AID` int(3) NOT NULL,
  `Utitle` varchar(20) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Uphoto` varchar(20) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agriadvisortbl`
--

CREATE TABLE `agriadvisortbl` (
  `ID` int(3) NOT NULL,
  `Fullname` varchar(25) NOT NULL,
  `AdPhoto` varchar(20) NOT NULL,
  `FRegion` varchar(20) NOT NULL,
  `Company` varchar(20) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Experience` varchar(10) NOT NULL,
  `AcademicDocs` varchar(20) NOT NULL,
  `AAStatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agriadvisortbl`
--

INSERT INTO `agriadvisortbl` (`ID`, `Fullname`, `AdPhoto`, `FRegion`, `Company`, `Contact`, `Experience`, `AcademicDocs`, `AAStatus`) VALUES
(2, 'Mukiibi Dickson', '', 'Lwengo', 'ABC farmers LTD', '0756189702', '', '', 0),
(5, 'Kizito Ahmed', '', 'Kalisizo', 'XYZ farmers ltd', '0756453612', '', '', 0),
(10, 'namaala claire', '', 'masaka', 'NAADS', '0703455775', '', '', 0),
(11, 'kiyimba tiblisio', '', 'entebbe', 'kwewayo ', '0705556778', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cropupload`
--

CREATE TABLE `cropupload` (
  `ID` int(3) NOT NULL,
  `FID` int(3) NOT NULL,
  `CropName` varchar(20) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `CLocation` varchar(20) NOT NULL,
  `Cphoto` varchar(20) NOT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cropupload`
--

INSERT INTO `cropupload` (`ID`, `FID`, `CropName`, `Quantity`, `UnitPrice`, `CLocation`, `Cphoto`, `Status`) VALUES
(1, 4, 'Maize', 19, 15000, 'Bulemeezi', 'Maize.png', 1),
(3, 4, 'Lettuce', 12, 23000, 'Mbiriizi', 'Lettuce.jpg', 1),
(4, 3, 'Cabbages', 30, 8000, 'Masaka', 'Cabbages.jpg', 1),
(5, 3, 'Tomatoes', 25, 12000, 'Nsangi', 'Tomatoes3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmertbl`
--

CREATE TABLE `farmertbl` (
  `ID` int(3) NOT NULL,
  `Fullname` varchar(25) NOT NULL,
  `FarmerPhoto` varchar(20) NOT NULL,
  `SecretKey` varchar(25) NOT NULL,
  `FRegion` varchar(15) NOT NULL,
  `Crop` varchar(15) NOT NULL,
  `Contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmertbl`
--

INSERT INTO `farmertbl` (`ID`, `Fullname`, `FarmerPhoto`, `SecretKey`, `FRegion`, `Crop`, `Contact`) VALUES
(3, 'Mulindwa Alex', '', '', 'Mubende', 'Maize', '0754351287'),
(4, 'Nantambi Angel', '', '', 'Lyantonde', 'Matooke', '0789078727'),
(6, 'kato mark', '', '', 'mbale', 'cotton', '0754868667'),
(7, 'karungi anna', '', '', 'mbarara', 'banana', '0775588659'),
(8, 'nakalema maria', '', '', 'wakiso', 'coffee', '0707978900'),
(9, 'kisaakye ruth', '', '', 'kyankwanzi', 'irish potatos', '0788958554');

-- --------------------------------------------------------

--
-- Table structure for table `logintbl`
--

CREATE TABLE `logintbl` (
  `ID` int(3) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `PSWD` varchar(25) NOT NULL,
  `Role` varchar(15) NOT NULL,
  `UStatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintbl`
--

INSERT INTO `logintbl` (`ID`, `Username`, `PSWD`, `Role`, `UStatus`) VALUES
(1, 'Admin', 'admin01', 'Admin', 0),
(2, 'dickson', 'mukiibi12', 'Advisor', 0),
(3, 'alex', 'alex12', 'Farmer', 0),
(4, 'angel', 'angel12', 'Farmer', 0),
(5, 'Ahmed', 'ahmed01', 'Advisor', 1),
(6, 'kato', 'mark', 'Farmer', 0),
(7, 'ann', 'ann', 'Farmer', 0),
(8, 'maria', 'maria', 'Farmer', 0),
(9, 'ruth', 'ruth', 'Farmer', 0),
(10, 'clara', 'clara', 'Advisor', 0),
(11, 'tibz', 'tibz', 'Advisor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

CREATE TABLE `ordertbl` (
  `ID` int(3) NOT NULL,
  `CropID` int(3) NOT NULL,
  `Qty` int(4) NOT NULL,
  `CustomerName` varchar(25) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Location` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`ID`, `CropID`, `Qty`, `CustomerName`, `Contact`, `Location`) VALUES
(1, 3, 6, 'Musoke Andrew', '0781343373', 'Masaka'),
(2, 1, 4, 'Musoke Andrew', '0781343373', 'Masaka'),
(3, 1, 5, 'Hakim Male', '0754342571', 'Masaka'),
(4, 1, 3, 'Kizito Ronald', '0757809182', 'Lubaga'),
(5, 4, 12, 'Lule Martin', '0789203928', 'Kalongo'),
(6, 4, 13, 'Kirabira Alex', '0752543467', 'Kabaale'),
(7, 5, 10, 'Namulindwa Annet', '0705129817', 'Kyengera'),
(8, 1, 5, 'kiyimba tiblisio', '0754678754', 'entebbe'),
(9, 3, 3, 'kisakye ruth', '0783948574', 'kireka');

-- --------------------------------------------------------

--
-- Table structure for table `queriestbl`
--

CREATE TABLE `queriestbl` (
  `ID` int(3) NOT NULL,
  `FID` int(3) NOT NULL,
  `Query` varchar(500) NOT NULL,
  `QStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queriestbl`
--

INSERT INTO `queriestbl` (`ID`, `FID`, `Query`, `QStatus`) VALUES
(1, 4, 'This is sample test query. Please respond. This is sample test query. Please respond.', 0),
(2, 3, 'Is there any recent information about these rampant bean weevils please?', 0),
(3, 4, 'Can you please advise on how best to grow coffee?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `responsetbl`
--

CREATE TABLE `responsetbl` (
  `ID` int(3) NOT NULL,
  `QID` int(3) NOT NULL,
  `AAID` int(3) NOT NULL,
  `Response` varchar(500) NOT NULL,
  `RStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responsetbl`
--

INSERT INTO `responsetbl` (`ID`, `QID`, `AAID`, `Response`, `RStatus`) VALUES
(2, 1, 2, 'Your sample test query has been received and responded to.', 0),
(3, 2, 2, 'Apparently, there is no news about it.\r\nBut we shall keep you posted in case anything comes up.\r\nGood day.', 1),
(4, 3, 2, 'Will send to you a pdf containing the guidelines.\r\nJust be a little patient.\r\nThanks.', 0),
(5, 1, 5, 'I have seen your query. All is well here.', 1),
(6, 3, 5, 'Share with me your email address or give me a call and then I will relay to you all the information that you need.', 0),
(7, 2, 5, 'I have not heard of any yet. But I will let you know once anything comes up.', 0),
(9, 2, 5, 'There is a lot of information going on around here but that is unheard of.\r\nKeep Safe.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensitizationtbl`
--

CREATE TABLE `sensitizationtbl` (
  `msgID` int(3) NOT NULL,
  `msgTitle` varchar(50) NOT NULL,
  `Details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensitizationtbl`
--

INSERT INTO `sensitizationtbl` (`msgID`, `msgTitle`, `Details`) VALUES
(1, 'Sensitization Test', 'This message is being used only for testing purposes.\r\nHopefully it works out well.'),
(2, 'Corona Virus Alert!', 'Comrades, please protect yourselves against this virus because it is real and can be just about anywhere without us knowing. A healthy farmer is a beneficial one.\r\nGod bless you.'),
(3, 'Greetings', 'Hello Farmers. Hope you are all safe.\r\nLet us hope and pray that this situation normalizes.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `advisorupload`
--
ALTER TABLE `advisorupload`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `agriadvisortbl`
--
ALTER TABLE `agriadvisortbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cropupload`
--
ALTER TABLE `cropupload`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `farmertbl`
--
ALTER TABLE `farmertbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logintbl`
--
ALTER TABLE `logintbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `queriestbl`
--
ALTER TABLE `queriestbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `responsetbl`
--
ALTER TABLE `responsetbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sensitizationtbl`
--
ALTER TABLE `sensitizationtbl`
  ADD PRIMARY KEY (`msgID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisorupload`
--
ALTER TABLE `advisorupload`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cropupload`
--
ALTER TABLE `cropupload`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ordertbl`
--
ALTER TABLE `ordertbl`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `queriestbl`
--
ALTER TABLE `queriestbl`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `responsetbl`
--
ALTER TABLE `responsetbl`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sensitizationtbl`
--
ALTER TABLE `sensitizationtbl`
  MODIFY `msgID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
