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

CREATE TABLE `user` (
  `UserID` int (8) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Fname` varchar(64) NOT NULL,
  `Lname` varchar(64) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `UserType` enum ('user','tech','admin') NOT NULL,
  Primary Key(UserID)
);

-- creating users to login
insert into `user` values(00000002, "Floop4Prez", "Robert", "California", 5955551496, "robcali@testmail.com", 'user');
insert into `user` values(00000003, "SerialNum23", "Jared", "Ross", 5235550123, "jross@testmail.com", 'user');
insert into `user` values(00000004, "Pass098", "Sophia", "Smith", 4565551233, "Sophia.Smith@testmail.com", 'user');
insert into `user` values(00000005, "WeirdAlFan32", "Kristi", "Jones", 5955553312, "KrisJones@testmail.com", 'user');

insert into `user` values(00000001, "1234","Karis", "Plath", 9525551298,"kPlath@gmail.com", 'admin');
insert into `user` values(00000010, "5678", "Ethan", "Imm", 5075559459, "eImm@gmail.com", 'admin');
insert into `user` values(00000011, "9101", "Matt", "Garling", 2245551465, "mGarling@gmail.com", 'admin');
insert into `user` values(00000100, "1121", "Hunter", "Lee", 5075551622, "hLee@gmail.com", 'admin');
insert into `user` values(00000101, "3141", "Colin", "Tolkkinen", 7635551872, "cTolkkinen@gmail.com", 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `Ticket_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Importance` enum('High', 'Medium', 'Low') NOT NULL,
  `Queue` enum('new','inprogress','closed','important') NOT NULL,
  `Status` enum('new','reopened','closed') NOT NULL,
  `CreateDate` datetime NOT NULL,
  `CloseDate` datetime,
  `TicketDesc` varchar(1000) NOT NULL,
  `Email` varchar(64) NOT NULL,
  Primary Key(Ticket_ID),
  Foreign Key(UserID) References user(UserID)
);

insert into `ticket` (UserID, Importance, Queue, Status, CreateDate, CloseDate, TicketDesc, Email) values(00000001, 'High', 'new', 'new', '2024-02-29 13:00:12', NULL, "My computer is glued shut, I tried soaking it in water to soften the glue. Then I put it in rice and tried restarting it. Nothings working??!!!", "kPlath@gmail.com");

-- --------------------------------------------------------------

--
-- Table structure for table 'document'
--

CREATE TABLE 'document' (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'doc_name' VARCHAR(255) NOT NULL,
    'doc_content' TEXT NOT NULL
);

INSERT INTO 'document' (doc_name, doc_content) VALUES ('example', 'This is the content of the text file.');
