-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 04:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elemgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GradeID` int(11) NOT NULL,
  `TeacherID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `Quarter` int(11) DEFAULT 0,
  `English` int(11) DEFAULT NULL,
  `Math` int(11) DEFAULT NULL,
  `Science` int(11) DEFAULT NULL,
  `Filipino` int(11) DEFAULT NULL,
  `PE` int(11) DEFAULT NULL,
  `Average` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`GradeID`, `TeacherID`, `StudentID`, `Quarter`, `English`, `Math`, `Science`, `Filipino`, `PE`, `Average`) VALUES
(1910, 5, 27, 1, 76, 78, 78, 79, 86, 79),
(1911, 5, 27, 2, 80, 84, 90, 85, 88, 85),
(1912, 5, 27, 3, 80, 80, 80, 80, 80, 80),
(1913, 5, 27, 4, 76, 79, 80, 83, 86, 81),
(1914, 5, 28, 1, 80, 80, 80, 87, 87, 83),
(1915, 5, 28, 2, 80, 84, 82, 82, 89, 83),
(1916, 5, 28, 3, 80, 88, 89, 90, 90, 87),
(1917, 5, 28, 4, 80, 80, 80, 80, 80, 80),
(1918, 5, 29, 1, 85, 80, 87, 84, 86, 84),
(1919, 5, 29, 2, 80, 84, 82, 89, 90, 85),
(1920, 5, 29, 3, 88, 80, 87, 86, 90, 86),
(1921, 5, 29, 4, 88, 89, 89, 90, 90, 89),
(1922, 5, 30, 1, 80, 85, 80, 84, 86, 83),
(1923, 5, 30, 2, 80, 84, 89, 84, 90, 85),
(1924, 5, 30, 3, 85, 80, 80, 70, 70, 77),
(1925, 5, 30, 4, 87, 85, 86, 84, 89, 86),
(1926, 5, 31, 1, 80, 87, 85, 80, 86, 84),
(1927, 5, 31, 2, 80, 84, 89, 82, 90, 85),
(1928, 5, 31, 3, 85, 80, 70, 80, 70, 77),
(1929, 5, 31, 4, 85, 88, 82, 84, 87, 85),
(1930, 5, 32, 1, 88, 80, 84, 85, 80, 83),
(1931, 5, 32, 2, 80, 84, 86, 82, 84, 83),
(1932, 5, 32, 3, 85, 87, 70, 70, 80, 78),
(1933, 5, 32, 4, 88, 89, 90, 90, 90, 89),
(1934, 5, 33, 1, 87, 88, 80, 80, 85, 84),
(1935, 5, 33, 2, 80, 84, 81, 80, 80, 81),
(1936, 5, 33, 3, 85, 87, 85, 80, 85, 84),
(1937, 5, 33, 4, 78, 78, 74, 74, 74, 76),
(1938, 5, 34, 1, 82, 83, 88, 80, 85, 84),
(1939, 5, 34, 2, 80, 84, 86, 81, 80, 82),
(1940, 5, 34, 3, 85, 89, 80, 70, 70, 79),
(1941, 5, 34, 4, 89, 79, 79, 90, 89, 85),
(1942, 5, 35, 1, 89, 83, 90, 88, 80, 86),
(1943, 5, 35, 2, 80, 84, 90, 86, 84, 85),
(1944, 5, 35, 3, 83, 80, 70, 70, 70, 75),
(1945, 5, 35, 4, 78, 75, 75, 75, 75, 76),
(1946, 5, 36, 1, 78, 90, 86, 89, 89, 86),
(1947, 5, 36, 2, 80, 70, 70, 70, 70, 72),
(1948, 5, 36, 3, 80, 78, 78, 78, 90, 81),
(1949, 5, 36, 4, 70, 70, 70, 70, 70, 70),
(1950, 5, 37, 1, 90, 90, 90, 90, 90, 90),
(1951, 5, 37, 2, 80, 78, 78, 78, 86, 80),
(1952, 5, 37, 3, 80, 80, 74, 74, 73, 76),
(1953, 5, 37, 4, 80, 80, 80, 80, 80, 80),
(1954, 5, NULL, 1, 90, 90, 0, 0, 0, 36),
(1955, 5, NULL, 2, 0, 0, 0, 0, 0, 0),
(1956, 5, NULL, 3, 0, 0, 0, 0, 0, 0),
(1957, 5, NULL, 4, 0, 0, 0, 0, 0, 0),
(1958, 5, 39, 1, 72, 78, 73, 74, 70, 73),
(1959, 5, 39, 2, 70, 70, 70, 70, 70, 70),
(1960, 5, 39, 3, 80, 70, 80, 70, 70, 74),
(1961, 5, 39, 4, 72, 71, 71, 74, 70, 72),
(1962, 5, 40, 1, 73, 70, 70, 70, 70, 71),
(1963, 5, 40, 2, 70, 73, 73, 70, 70, 71),
(1964, 5, 40, 3, 83, 80, 80, 80, 80, 81),
(1965, 5, 40, 4, 71, 72, 74, 71, 74, 72),
(1966, 5, 41, 1, 73, 70, 73, 70, 70, 71),
(1967, 5, 41, 2, 70, 78, 73, 74, 74, 74),
(1968, 5, 41, 3, 83, 87, 80, 90, 80, 84),
(1969, 5, 41, 4, 71, 73, 72, 70, 71, 71),
(1970, 5, 42, 1, 70, 70, 70, 70, 70, 70),
(1971, 5, 42, 2, 80, 70, 74, 70, 70, 73),
(1972, 5, 42, 3, 80, 70, 70, 80, 80, 76),
(1973, 5, 42, 4, 71, 73, 70, 72, 72, 72),
(1974, 7, NULL, 1, 0, 0, 0, 0, 0, 0),
(1975, 7, NULL, 2, 0, 0, 0, 0, 0, 0),
(1976, 7, NULL, 3, 0, 0, 0, 0, 0, 0),
(1977, 7, NULL, 4, 0, 0, 0, 0, 0, 0),
(1978, 7, 44, 1, 70, 72, 71, 75, 76, 73),
(1979, 7, 44, 2, 76, 70, 70, 76, 76, 74),
(1980, 7, 44, 3, 78, 70, 74, 76, 75, 75),
(1981, 7, 44, 4, 79, 70, 72, 76, 77, 75),
(1982, 7, 45, 1, 78, 80, 80, 85, 89, 82),
(1983, 7, 45, 2, 80, 89, 90, 84, 84, 85),
(1984, 7, 45, 3, 77, 80, 89, 90, 90, 85),
(1985, 7, 45, 4, 85, 79, 0, 90, 89, 69),
(1986, 7, 46, 1, 78, 80, 80, 85, 89, 82),
(1987, 7, 46, 2, 80, 87, 89, 90, 84, 86),
(1988, 7, 46, 3, 79, 78, 80, 89, 90, 83),
(1989, 7, 46, 4, 85, 0, 90, 87, 89, 70),
(1990, 7, 47, 1, 72, 73, 70, 83, 84, 76),
(1991, 7, 47, 2, 70, 79, 78, 74, 90, 78),
(1992, 7, 47, 3, 79, 89, 90, 80, 90, 86),
(1993, 7, 47, 4, 85, 90, 79, 87, 89, 86),
(1994, 7, 48, 1, 82, 80, 78, 78, 90, 82),
(1995, 7, 48, 2, 80, 84, 79, 87, 89, 84),
(1996, 7, 48, 3, 89, 90, 78, 88, 80, 85),
(1997, 7, 48, 4, 86, 86, 87, 79, 88, 85),
(1998, 7, 49, 1, 83, 80, 78, 77, 90, 82),
(1999, 7, 49, 2, 80, 84, 79, 87, 90, 84),
(2000, 7, 49, 3, 90, 89, 89, 88, 90, 89),
(2001, 7, 49, 4, 90, 87, 87, 88, 89, 88);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `LRN_Number` bigint(15) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MidInitial` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `TeacherID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `LRN_Number`, `FirstName`, `MidInitial`, `LastName`, `GradeLevel`, `Section`, `TeacherID`) VALUES
(27, 116200180046, 'Firstianel', 'Paradeo', 'Ausa', 1, 'Kahel', 5),
(28, 116200180002, 'Jaybee', 'Alozo', 'Bacason', 1, 'Kahel', 5),
(29, 116200190063, 'Alexander', 'Alonzo', 'Binasbas', 1, 'Kahel', 5),
(30, 116200180005, 'Albenson', 'Hontiveros', 'Bordo', 1, 'Kahel', 5),
(31, 116200190064, 'Vinz Ian', 'Santos', 'Dela Cruz', 1, 'Kahel', 5),
(32, 116200180011, 'Joseph', 'Ochoco', 'Desabelle', 1, 'Kahel', 5),
(33, 116200180053, 'Khen Roland', 'Espinosa', 'Despi', 1, 'Kahel', 5),
(34, 116200180054, 'Michael Jr', 'Colongon', 'Edano', 1, 'Kahel', 5),
(35, 116200180013, 'Dens', 'Escano', 'Gabay', 1, 'Kahel', 5),
(36, 116200190070, 'John Carlo', 'Bitoon', 'Grutas', 1, 'Kahel', 5),
(37, 116200180056, 'Charles Adam', 'Jesalva', 'Hung', 1, 'Kahel', 5),
(39, 116200180018, 'John Paul', 'Pepito', 'Placambo', 1, 'Kahel', 5),
(40, 116200180028, 'Micah', 'Longno', 'Alboro', 1, 'Kahel', 5),
(41, 116200180030, 'Princess Erika', 'Cagado', 'Alonzo', 1, 'Kahel', 5),
(42, 116200180031, 'Daniella', 'Alonzo', 'Alutaya', 1, 'Kahel', 5),
(44, 116217180049, 'Eden', 'Lozada', 'Esparago', 6, 'Amber', 7),
(45, 116200190073, 'Joana Diane', 'Montibon', 'Jalandoni', 6, 'Amber', 7),
(46, 116200180092, 'Bebyren', 'Marfil', 'Ompad', 6, 'Amber', 7),
(47, 116200180036, 'Jeniviv Roselle', 'Santos', 'Magallanes', 6, 'Amber', 7),
(48, 116200190068, 'Paulo', 'Saludaga', 'Regala', 6, 'Amber', 7),
(49, 116200190065, 'Baby Boy', 'Magallanes', 'Montibon', 6, 'Amber', 7);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeacherID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MidName` varchar(15) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Position` varchar(50) NOT NULL,
  `SchoolName` varchar(100) NOT NULL,
  `SchoolAddress` varchar(150) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `DateJoined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherID`, `FirstName`, `MidName`, `LastName`, `GradeLevel`, `Section`, `Username`, `Password`, `Position`, `SchoolName`, `SchoolAddress`, `EmailAddress`, `DateJoined`) VALUES
(5, 'Gemma', 'Bernal', 'Biason', 1, 'Kahel', 'gemma', 'test1', 'Teacher I', 'Asluman Elementary School', 'Brgy. Dayhagan Carles Iloilo', 'gemma@gmail.com', '2020-05-25'),
(7, 'Gabriella', 'Villarias', 'Maningas', 6, 'Amber', 'babygab', 'test2', 'Edit info here', 'Edit info here', 'Edit info here', 'Edit info here', '2020-05-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GradeID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `grades_ibfk_2` (`StudentID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `students_ibfk_1` (`TeacherID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2002;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
