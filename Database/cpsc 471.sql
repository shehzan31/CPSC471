CREATE DATABASE cpsc471_database;

USE cpsc471_database;

CREATE TABLE `Admin` (
  `Admin_ID` int NOT NULL,
  `Password` varchar(128) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
);

CREATE TABLE `Appointment` (
  `Appointment_ID` int NOT NULL,
  `location` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(5) NOT NULL,
  PRIMARY KEY (`Appointment_ID`)
) ;

CREATE TABLE `Dashboard` (
  `Dashboard_ID` int NOT NULL,
  `Login_Page` int NOT NULL,
  `Doctor_ID` int DEFAULT NULL,
  `H_Number` int DEFAULT NULL,
  PRIMARY KEY (`Dashboard_ID`),
  KEY `Login_Page` (`Login_Page`),
  KEY `Doctor_ID` (`Doctor_ID`),
  KEY `H_Number` (`H_Number`),
  CONSTRAINT `Dashboard_ibfk_1` FOREIGN KEY (`Login_Page`) REFERENCES `Login` (`Login_Page`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Dashboard_ibfk_2` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Dashboard_ibfk_3` FOREIGN KEY (`H_Number`) REFERENCES `Patient` (`H_Number`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Dependent` (
  `SIN` int NOT NULL,
  `D_SIN` int NOT NULL,
  `Relationship` varchar(20) NOT NULL,
  PRIMARY KEY (`SIN`),
  KEY `D_SIN` (`D_SIN`),
  CONSTRAINT `Dependent_ibfk_1` FOREIGN KEY (`SIN`) REFERENCES `Person` (`SIN`),
  CONSTRAINT `Dependent_ibfk_2` FOREIGN KEY (`D_SIN`) REFERENCES `Person` (`SIN`)
) ;

CREATE TABLE `Diagnosis` (
  `Condition` varchar(50) NOT NULL,
  PRIMARY KEY (`Condition`)
) ;

CREATE TABLE `Doctor` (
  `Doctor_ID` int NOT NULL,
  `SIN` int NOT NULL,
  PRIMARY KEY (`Doctor_ID`),
  UNIQUE KEY `Doctor_ID_UNIQUE` (`Doctor_ID`),
  KEY `SIN` (`SIN`),
  CONSTRAINT `SIN` FOREIGN KEY (`SIN`) REFERENCES `Person` (`SIN`)
) ;

CREATE TABLE `Doctor Account` (
  `Username` int NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`Username`),
  CONSTRAINT `Username` FOREIGN KEY (`Username`) REFERENCES `Doctor` (`Doctor_ID`)
) ;

CREATE TABLE `Doctor_has` (
  `Doctor_ID` int NOT NULL,
  `H_Number` int NOT NULL,
  PRIMARY KEY (`Doctor_ID`,`H_Number`),
  UNIQUE KEY `H_Number_UNIQUE` (`H_Number`),
  UNIQUE KEY `Doctore_ID_UNIQUE` (`Doctor_ID`),
  CONSTRAINT `Doctor_has_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`),
  CONSTRAINT `Doctor_has_ibfk_2` FOREIGN KEY (`H_Number`) REFERENCES `Patient` (`H_Number`)
) ;

CREATE TABLE `Doctor_works` (
  `Doctor_ID` int NOT NULL,
  `Hospital_ID` int NOT NULL,
  PRIMARY KEY (`Doctor_ID`,`Hospital_ID`),
  KEY `Hospital_ID` (`Hospital_ID`),
  CONSTRAINT `Doctor_works_ibfk_1` FOREIGN KEY (`Hospital_ID`) REFERENCES `Hospital` (`Hospital ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Doctor_works_ibfk_2` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Edits` (
  `MR Number` int NOT NULL,
  `Doctor ID` int NOT NULL,
  PRIMARY KEY (`MR Number`,`Doctor ID`),
  KEY `Doctor ID_idx` (`Doctor ID`),
  CONSTRAINT `Doctor_ID` FOREIGN KEY (`Doctor ID`) REFERENCES `Doctor` (`Doctor_ID`),
  CONSTRAINT `MR_Number` FOREIGN KEY (`MR Number`) REFERENCES `Patient` (`MR_Number`)
) ;

CREATE TABLE `Finds` (
  `Doctor_ID` int NOT NULL,
  `H  Number` int NOT NULL,
  `Condition` varchar(45) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Chart` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Doctor_ID`,`H  Number`,`Condition`),
  KEY `H_Number_idx` (`H  Number`),
  KEY `Condition_idx` (`Condition`),
  CONSTRAINT `Finds_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`),
  CONSTRAINT `Finds_ibfk_2` FOREIGN KEY (`H  Number`) REFERENCES `Patient` (`H_Number`),
  CONSTRAINT `Finds_ibfk_3` FOREIGN KEY (`Condition`) REFERENCES `Diagnosis` (`Condition`)
) ;

CREATE TABLE `Hospital` (
  `Hospital ID` int NOT NULL,
  `Location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Hospital ID`)
) ;

CREATE TABLE `Locations` (
  `Doctor_ID` int NOT NULL,
  `Locations` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Doctor_ID`),
  CONSTRAINT `Locations_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`)
) ;

CREATE TABLE `Login` (
  `Login_Page` int NOT NULL,
  PRIMARY KEY (`Login_Page`)
) ;

CREATE TABLE `MR_Appointments` (
  `MR_Number` int NOT NULL,
  `Appointment` int NOT NULL,
  PRIMARY KEY (`MR_Number`,`Appointment`),
  KEY `Appointment` (`Appointment`),
  CONSTRAINT `MR_Appointments_ibfk_1` FOREIGN KEY (`MR_Number`) REFERENCES `Patient` (`MR_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `MR_Appointments_ibfk_2` FOREIGN KEY (`Appointment`) REFERENCES `Appointment` (`Appointment_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `MR_Conditions` (
  `MR_Number` int NOT NULL,
  `Conditition` varchar(50) NOT NULL,
  PRIMARY KEY (`MR_Number`,`Conditition`),
  CONSTRAINT `MR_Conditions_ibfk_1` FOREIGN KEY (`MR_Number`) REFERENCES `Patient` (`MR_Number`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `MR_Prescriptions` (
  `MR_Number` int NOT NULL,
  `Prescription` varchar(50) NOT NULL,
  PRIMARY KEY (`MR_Number`,`Prescription`),
  KEY `Prescription` (`Prescription`),
  CONSTRAINT `MR_Prescriptions_ibfk_1` FOREIGN KEY (`MR_Number`) REFERENCES `Patient` (`MR_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `MR_Prescriptions_ibfk_2` FOREIGN KEY (`Prescription`) REFERENCES `Prescription` (`Pname`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `MR_Tests` (
  `MR_Number` int NOT NULL,
  `Test` varchar(50) NOT NULL,
  PRIMARY KEY (`MR_Number`,`Test`),
  KEY `Test` (`Test`),
  CONSTRAINT `MR_Tests_ibfk_1` FOREIGN KEY (`MR_Number`) REFERENCES `Patient` (`MR_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `MR_Tests_ibfk_2` FOREIGN KEY (`Test`) REFERENCES `Test` (`TName`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Orders` (
  `Doctor_ID` int NOT NULL,
  `H_number` int NOT NULL,
  `Test_Name` varchar(45) NOT NULL,
  `Result` varchar(45) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`Doctor_ID`,`H_number`,`Test_Name`),
  UNIQUE KEY `Doctor_ID_UNIQUE` (`Doctor_ID`),
  UNIQUE KEY `H_number_UNIQUE` (`H_number`),
  UNIQUE KEY `Test_Name_UNIQUE` (`Test_Name`),
  CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`),
  CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`H_number`) REFERENCES `Patient` (`H_Number`),
  CONSTRAINT `Orders_ibfk_3` FOREIGN KEY (`Test_Name`) REFERENCES `Test` (`TName`)
) ;

CREATE TABLE `Patient` (
  `H_Number` int NOT NULL,
  `MR_Number` int DEFAULT NULL,
  `SIN` int NOT NULL,
  PRIMARY KEY (`H_Number`),
  UNIQUE KEY `H_Number` (`H_Number`),
  UNIQUE KEY `MR_Number` (`MR_Number`),
  KEY `SIN` (`SIN`),
  CONSTRAINT `Patient_ibfk_1` FOREIGN KEY (`SIN`) REFERENCES `Person` (`SIN`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Patient Account` (
  `Username` int NOT NULL,
  `Password` varchar(128) NOT NULL,
  PRIMARY KEY (`Username`),
  CONSTRAINT `Patient Account_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Patient` (`H_Number`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Patient_Goes` (
  `H_Number` int NOT NULL,
  `Hospital_ID` int NOT NULL,
  PRIMARY KEY (`H_Number`,`Hospital_ID`),
  KEY `Hospital_ID` (`Hospital_ID`),
  CONSTRAINT `Patient_Goes_ibfk_1` FOREIGN KEY (`H_Number`) REFERENCES `Patient` (`H_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Patient_Goes_ibfk_2` FOREIGN KEY (`Hospital_ID`) REFERENCES `Hospital` (`Hospital ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Person` (
  `SIN` int NOT NULL,
  `FName` varchar(20) NOT NULL,
  `MInit` varchar(1) DEFAULT NULL,
  `LName` varchar(20) NOT NULL,
  `Address_line` varchar(100) DEFAULT NULL,
  `Province` varchar(40) DEFAULT NULL,
  `City` varchar(40) DEFAULT NULL,
  `Postal_code` varchar(7) DEFAULT NULL,
  `Gender` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  PRIMARY KEY (`SIN`),
  UNIQUE KEY `SIN` (`SIN`)
) ;

CREATE TABLE `Prescribes` (
  `Doctor_ID` int NOT NULL,
  `H_Number` int NOT NULL,
  `Test Name` varchar(45) NOT NULL,
  `Start Date` datetime DEFAULT NULL,
  `End Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Doctor_ID`,`H_Number`,`Test Name`),
  KEY `Test Name_idx` (`Test Name`),
  KEY `H_Number_idx` (`H_Number`),
  CONSTRAINT `Doctor ID` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`),
  CONSTRAINT `H_Number` FOREIGN KEY (`H_Number`) REFERENCES `Patient` (`H_Number`),
  CONSTRAINT `Test Name` FOREIGN KEY (`Test Name`) REFERENCES `Test` (`TName`)
) ;

CREATE TABLE `Prescription` (
  `Pname` varchar(50) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Field` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Pname`)
) ;

CREATE TABLE `Schedules` (
  `H_Number` int NOT NULL,
  `Appointment_ID` int NOT NULL,
  `Doctor_ID` int NOT NULL,
  PRIMARY KEY (`H_Number`,`Appointment_ID`,`Doctor_ID`),
  KEY `Appointment_ID` (`Appointment_ID`),
  KEY `Doctor_ID` (`Doctor_ID`),
  CONSTRAINT `Schedules_ibfk_1` FOREIGN KEY (`H_Number`) REFERENCES `Patient` (`H_Number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Schedules_ibfk_2` FOREIGN KEY (`Appointment_ID`) REFERENCES `Appointment` (`Appointment_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Schedules_ibfk_3` FOREIGN KEY (`Doctor_ID`) REFERENCES `Doctor` (`Doctor_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

CREATE TABLE `Test` (
  `TName` varchar(50) NOT NULL,
  PRIMARY KEY (`TName`)
) ;
