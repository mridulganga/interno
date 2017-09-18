/*

Hey there!
before you try and import me, why not you follow the steps below?
1. create a database named interno
2. open db.php and change the credentials
3. open func.php and uncomment firstrun(); in the top
4. try opening the website through a server
5. don't even bother to import this file (LOL)

Bye bye!

*/


CREATE DATABASE `interno` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `interno`;

CREATE TABLE `applications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `internship_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `extra_info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `internships` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `submitted_by` int(10) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
