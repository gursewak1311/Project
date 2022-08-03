CREATE TABLE `blogs` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `body` varchar (100000) NOT NULL,
  `category` varchar (100) NOT NULL,
  PRIMARY KEY (user_id)
);
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar (100) NOT NULL,
  `email` varchar (100) NOT NULL,
  `username` varchar (100) NOT NULL,
  `password` varchar (255) NOT NULL,
  PRIMARY KEY (user_id)
);
