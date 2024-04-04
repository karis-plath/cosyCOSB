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

CREATE TABLE if not EXISTS `user`(
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
insert into `user` values(00000006, "ImSoKool420", "Kyle", "Kool", 5403304987, "KoolKyle@testmail.com", 'user');
insert into `user` values(00000007, "Vietnam4Eva", "Kevin", "Hoang", 4082859387, "KHoang@testmail.com", 'user');
insert into `user` values(00000008, "Blacksmithing11!", "Alec", "Steele", 3051932297, "Alec.Steele21@testmail.com", 'user');
insert into `user` values(00000009, "Bikefanz32", "Cole", "Jay", 3395850339, "CJ4444@testmail.com", 'user');
insert into `user` values(00000012, "Ninjago884", "Anna", "Frey", 5750264086, "FreyAnna@testmail.com", 'user');
insert into `user` values(00000013, "ILOVETAYLORSWIFT18!", "Emily", "White", 8888888888, "TayTaySwifty@testmail.com", 'user');
insert into `user` values(00000014, "KanyeIsLordAndSavior", "Wyatt", "Olsen", 6122320800, "KrisJones@testmail.com", 'user');
insert into `user` values(00000015, "WeirdAlHater", "John", "Christian", 2133555595, "ChrisJones@testmail.com", 'user');

insert into `user` values(00000110, "7777", "Billy", "Bob", 5075555639, "bBob@gmail.com", 'tech');
insert into `user` values(00000111, "1278", "Kevin", "Costner", 2105558506, "kCostner@gmail.com", 'tech');
insert into `user` values(00001000, "7856", "Lebron", "James", 5235859854, "lJames@gmail.com", 'tech');
insert into `user` values(00001001, "9283", "Luke", "Skywalker", 5075554444, "lSkywalker@gmail.com", 'tech');
insert into `user` values(00001010, "5778", "Craig", "Imm", 5079519452, "cImm@gmail.com", 'tech');
insert into `user` values(00001011, "0567", "Kanye", "West", 3945550687, "kWest@gmail.com", 'tech');
insert into `user` values(00001100, "4923", "Kirko", "Chainz", 5076178000, "kChainz@gmail.com", 'tech');

insert into `user` values(00000001, "1234","Karis", "Plath", 9525551298,"kPlath@gmail.com", 'admin');
insert into `user` values(00000010, "5678", "Ethan", "Imm", 5075559459, "eImm@gmail.com", 'admin');
insert into `user` values(00000011, "9101", "Matt", "Garling", 2245551465, "mGarling@gmail.com", 'admin');
insert into `user` values(00000100, "1121", "Hunter", "Lee", 5075551622, "hLee@gmail.com", 'admin');
insert into `user` values(00000101, "3141", "Colin", "Tolkkinen", 7635551872, "cTolkkinen@gmail.com", 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE if NOT EXISTS `ticket` (
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

CREATE TABLE if NOT EXISTS `document` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `doc_name` VARCHAR(255) NOT NULL,
    `doc_content` TEXT NOT NULL,
    `public` boolean
);

INSERT INTO `document` (doc_name, doc_content, public) VALUES ("Computer won't connect to printer", "Documentation Type: Connection Issue<br>
Date: 03/21/2024<br>
Initial Problem Description:<br>
I’m unable to connect to the printer. When I’m searching for the printer it doesn’t pop up anymore.<br>
Problem Solutions:<br>
	1. Check the status of the printer<br>
	⁃ make sure there aren’t any errors<br>
	⁃ make sure it is powered on and has no loose connections<br>
	2. Restart your computer and printer<br>
	3. Check network connection (If Applicable)<br>
	⁃ If the printer is over a network, ensure it is connected to the same network as your computer<br>
	4. Update printer drivers<br>
	⁃ Check for and install any available updates for printer driver on your computer", true);
INSERT INTO `document` (doc_name, doc_content, public) VALUES ("Issue connecting to VPN", "Documentation Name: Issue connecting to VPN<br>
Documentation Type: Network Issue<br>
Date: 03/21/2003<br>
Initial Problem Description:<br>
I'm encountering issues connecting to our company's VPN. Whenever I attempt to establish a connection, I receive an error message indicating that the connection was unsuccessful. I've tried multiple times, but each attempt ends with the same result.<br>
Problem Solutions:<br>
	1.	Check internet status<br>
	⁃	Ensure you’re on a stable and active internet connection<br>
	2.	Verify you’re using the correct credentials<br>
	⁃	Ensure you use the correct username and password<br>
	⁃	Verify they haven’t been changed as well<br>
	3.	Try restarting the VPN client<br>
	⁃	Closing and reopening a client can help resolve issues<br>
	4.	Update the VPN client<br>
	⁃	Ensure the VPN client is on the most recent update<br>
	5.	Ensure VPN configuration is correct<br>
	6.	Restart Computer/Device", true);
INSERT INTO `document` (doc_name, doc_content, public) VALUES ("Issue viewing directories", "Documentation Type: Access Permissions Issue<br>
Date: 03/21/2003<br>
Initial Problem Description:<br>
I'm encountering difficulties accessing specific directories crucial for my work tasks. When I attempt to navigate to these directories, I receive error messages indicating 'Access Denied' or 'Permission Denied.'<br>
Problem Solutions:<br>
	1.	Check internet connections<br>
	2.	Verify credentials used are correct<br>
	⁃	Double check that your username and password are correct and haven’t changed<br>
	3.	Restart your device<br>
	4.	Ensure you have the correct level of access for those directories<br>
	⁃	If your position doesn’t have access then you will not be able to access unless permissions have been granted<br>
	5.	Contact IT/Support if the issue persists",true);
INSERT INTO `document` (doc_name, doc_content, public) VALUES ("Email server issues", "Documentation Type: Software Issue<br>
Date: 03/25/2024<br>
Initial Problem Description:<br>
Users are unable to send or receive emails through the company email server. This issue is causing disruptions to communication within the organization, hindering collaboration and workflow.<br>
Problem Solutions:<br>
	1.	Verify Server Status:<br>
	-Check the status of the email server to ensure it is powered on and functioning properly.<br>
	-Monitor server logs for any error messages or warnings that may indicate underlying issues.<br>
	2.	Review Email Client Settings:<br>
	-Confirm that email clients are configured with the correct incoming and outgoing server settings, including server hostname, port numbers, and authentication methods.<br>
	3.	Check DNS Records:<br>
	-Validate MX (Mail Exchange) records in the DNS (Domain Name System) to ensure they point to the correct mail server.<br>
	4.	Assess Firewall and Antivirus Settings:<br>
	-Review firewall configurations to confirm that port 25 (SMTP) and other necessary ports for email communication are open and not blocked by security policies.<br>
	-Check antivirus software settings to ensure they are not interfering with email traffic or quarantining legitimate messages.<br>
	5.	Monitor Mail Queue:<br>
	-Monitor the email server's mail queue to identify any stuck or undelivered messages that may be causing bottlenecks in the email delivery process.<br>
	-Take appropriate action to troubleshoot and resolve issues with queued messages, such as resending or deleting them as needed.<br>
	6.	Investigate Disk Space and Resource Usage:<br>
	-Check available disk space on the email server to ensure there is sufficient storage capacity for incoming and outgoing email messages.<br>
	-Monitor CPU and memory usage to identify any resource constraints that may be impacting the performance of the email server.<br>
	7.	Test Email Connectivity:<br>
	-Use email testing tools or commands (e.g., telnet) to verify connectivity to the email server from both internal and external networks.<br>
	-Send test emails to and from different email addresses to confirm that email delivery is functioning correctly.<br>
	8.	Restart Email Services:<br>
	-Restart email server services to refresh configurations and resolve any transient issues that may be affecting email delivery.<br>
	-Perform a server reboot if necessary to ensure a clean restart of all services.<br>
	9.	Engage Email Service Provider Support:<br>
	-Contact the email service provider's technical support team to report the issue and request assistance in diagnosing and resolving the problem.<br>
	-Provide relevant details and logs to facilitate troubleshooting by the service provider's support staff.<br>
	10.	Document Troubleshooting Steps and Resolutions:<br>
	-Maintain detailed documentation of the troubleshooting process, including steps taken, configuration changes, and resolutions implemented.<br>
	-Update the email server configuration guide with any changes or best practices identified during the troubleshooting process to improve future troubleshooting efforts.",true);
INSERT INTO `document` (doc_name, doc_content, public) VALUES ("Software Installation Issues", "Documentation Type: Software Issues<br>
Date: 03/25/2024<br>
Initial Problem Description:<br>
Users are encountering issues while installing a specific software application on their computers. These installation failures are impeding their ability to use critical tools for their work tasks.<br>
Problem Solutions: <br>
1. Check System Requirements:<br>
   - Verify that the users' computers meet the minimum system requirements specified by the software vendor.<br>
   - Ensure compatibility with the operating system version and architecture (32-bit vs. 64-bit).<br>
2. Download Intact Installation File:<br>
   - Re-download the software installation file from the official vendor's website to ensure it hasn't been corrupted during the initial download.<br>
   - Check the file's integrity by comparing its hash value with the one provided on the vendor's website.<br>
3. Disable Antivirus/Firewall:<br>
   - Temporarily disable antivirus and firewall software on the computer to rule out interference with the installation process.<br>
   - Add the software installation file and installation directory to the antivirus/firewall exclusion list if necessary.<br>
4. Run Installer as Administrator:<br>
   - Right-click on the software installation file and select 'Run as administrator' to execute the installer with elevated privileges.<br>
   - Administrator rights may be required to access certain system locations or modify registry settings during installation.<br>
5. Clean Boot:<br>
   - Perform a clean boot of the operating system to minimize interference from third-party software or services that may be conflicting with the installation.<br>
   - Temporarily disable startup programs and non-Microsoft services using the System Configuration utility (msconfig).<br>
6. Check Disk Space:<br>
   - Ensure that there is sufficient disk space available on the system drive (usually C:) to accommodate the software installation.<br>
   - Clear temporary files and uninstall unnecessary programs to free up disk space if needed.<br>
7. Install Required Dependencies:<br>
   - Install any prerequisite software or libraries that are required by the application for proper operation.<br>
   - Check the software documentation or vendor's website for a list of dependencies and installation instructions.<br>
8. Verify User Permissions:<br>
   - Ensure that the user account attempting to install the software has sufficient permissions to modify system settings and write to the installation directory.<br>
   - Grant necessary permissions or temporarily elevate the user to an administrator role if required.<br>
9. Check Event Viewer Logs:<br>
   - Review the Windows Event Viewer logs for any error messages or warnings related to the software installation process.<br>
   - Look for specific error codes or messages that can provide insights into the root cause of the installation failure.<br>
10. Test Installation on Another System:<br>
    - Attempt to install the software on a different computer to determine if the issue is specific to the user's system or a more widespread problem.<br>
    - If the installation succeeds on another system, focus troubleshooting efforts on the problematic computer.<br>
11. Contact Software Support:<br>
    - If all troubleshooting steps fail to resolve the issue, contact the software vendor's support team for assistance.<br>
    - Provide detailed information about the installation problem, including error messages, system configuration, and troubleshooting steps taken.<br>
12. Document Troubleshooting Process:<br>
    - Document each troubleshooting step performed along with its outcome and any relevant findings.<br>
    - Update the software installation troubleshooting guide with additional tips or solutions discovered during the troubleshooting process for future reference.", true);
  