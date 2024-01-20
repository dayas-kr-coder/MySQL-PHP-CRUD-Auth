CREATE DATABASE student_management;

USE student_management;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
  );

  CREATE TABLE `student` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `regno` INT NOT NULL UNIQUE,
  `sname` VARCHAR(100) NOT NULL,
  `course` VARCHAR(100) NOT NULL,
  `mark1` INT NOT NULL,
  `mark2` INT NOT NULL,
  `mark3` INT NOT NULL,
  `result` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;