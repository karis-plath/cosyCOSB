-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `cs410_final`
--

--
-- Table structure for table `user`
--

CREATE TABLE `` (
  `UserType` enum('admin','employee','guest') NOT NULL,
  `Fname` varchar(64) NOT NULL,
  `Lname` varchar(64) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(64) NOT NULL,
  Primary Key(Email)
);

-- creating users to login
insert into `user` values('admin', "Karis", "Plath", 9525001298, "kPlath@gmail.com");
insert into `user` values('admin', "Ethan", "Imm", 5076019459, "eImm@gmail.com");
insert into `user` values('admin', "Matt", "Garling", 2243451465, "mGarling@gmail.com");
insert into `user` values('admin', "Hunter", "Lee", 5079511622, "hLee@gmail.com");
insert into `user` values('admin', "Colin", "Tolkkinen", 7633311872, "cTolkkinen@gmail.com");

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(11) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  Primary Key(Employee_ID),
  Foreign Key(Email) References user(Email)
);

insert into `employee` values(0001, "1234", "kPlath@gmail.com");
insert into `employee` values(0010, "5678", "eImm@gmail.com");
insert into `employee` values(0011, "9101", "mGarling@gmail.com");
insert into `employee` values(0100, "1121", "hLee@gmail.com");
insert into `employee` values(0101, "3141", "cTolkkinen@gmail.com");

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Ticket_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `Importance` enum(1, 2, 3, 4, 5) NOT NULL,
  `Queue` enum('new','inprogress','closed','important') NOT NULL,
  `Status` enum('new','reopened','closed') NOT NULL,
  `CreateDate` datetime NOT NULL,
  `CloseDate` datetime,
  `TicketDesc` varchar(1000) NOT NULL,
  `Email` varchar(64) NOT NULL,
  Primary Key(Ticket_ID),
  Foreign Key(Email) References user(Email),
  Foreign Key(Employee_ID) References employee(Employee_ID)
);

insert into `ticket` (Employee_ID, Importance, Queue, Status, CreateDate, CloseDate, TicketDesc, Email) values(0001, 5, 'new', 'new', '2024-02-29 13:00:12', NULL, "My computer is glued shut, I tried soaking it in water to soften the glue. Then I put it in rice and tried restarting it. Nothings working??!!!", "kPlath@gmail.com");