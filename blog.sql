CREATE TABLE `blogs` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `body` varchar (100000) NOT NULL,
  `category` varchar (100) NOT NULL,
  PRIMARY KEY (user_id)
);
