# Setting Up MySQL Database and Table for Student Management

## Step 1: Create Database

```sql
CREATE DATABASE student_management;
```

## Step 2: Use the Database

```sql
USE student_management;
```

## Step 3: Create Users Table

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
  );
```

## Step 4: Create Student Table

```sql
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
```

- Congratulations! You have successfully set up the MySQL database and created a users table for your Student Management application.
