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

- Congratulations! You have successfully set up the MySQL database and created a users table for your Student Management application.
