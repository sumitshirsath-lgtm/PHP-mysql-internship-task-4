# Student CRUD System with Authentication

## Project Overview
This project is a **Student Management CRUD System** built with **PHP, MySQL, and HTML/CSS**, extended with **user authentication**.  

It allows users to:  
- Add, edit, delete, and view student records.  
- Search student records by name, email, or phone.  
- Navigate records using pagination.  
- Secure the system with **login/logout functionality**, so only registered users can access the CRUD system.  

---

## Features

### Task 3 – CRUD System
- **Create:** Add new students with name, email, and phone.  
- **Read:** View student list in a paginated table.  
- **Update:** Edit existing student records.  
- **Delete:** Remove students from the database.  
- **Search:** Search students by name, email, or phone.  
- **Pagination:** Display limited records per page with navigation links.  

### Task 4 – Authentication System
- **Login:** Users can log in using username and password.  
- **Logout:** Users can log out, ending the session.  
- **Session Protection:** All CRUD pages are protected using PHP sessions.  
- **Database Users Table:** Stores registered users with hashed passwords (MD5).  
- **Test User:**
- 
---

## Installation Instructions
1. Clone this repository:  
2. Move the folder to your **XAMPP `htdocs` directory**.  
3. Open **phpMyAdmin** and import the provided `database.sql` or manually create tables:  

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(15)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', MD5('12345'));
http://localhost/student_crud/login.php

