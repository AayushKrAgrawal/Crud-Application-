MLwebsite - CRUD-Based Machine Learning Resource Management

Overview

MLwebsite is a CRUD-based web application designed to help manage machine learning-related resources and user interactions. The platform provides an admin panel for efficient management of users and content. Built using PHP, MySQL, Tailwind CSS, and HTML, this application ensures seamless data handling and an intuitive user experience.

The system allows users to register, log in, and access ML-related resources, while admins have full control over managing users and resources.

Features

User Authentication

User Registration – New users can sign up.

User Login – Secure authentication with email and password.

Logout – Users can securely log out of their accounts.

CRUD Functionality

Create – Add new ML resources and users.

Read – View existing data and ML-related content.

Update – Modify user profiles and resource details.

Delete – Remove outdated or incorrect information.

Admin Panel

The admin dashboard provides full control over:

User Management – View, add, edit, and delete users.

Resource Management – Handle all ML-related content.

Secure Access – Only authorized admins can modify data.

Installation Guide

Follow these steps to set up and run the MLwebsite project on your local server:

Step 1: Install Prerequisites

Ensure you have the following installed:

XAMPP/WAMP (Local server for PHP & MySQL)

PHP (Latest version recommended)

MySQL (Database for storing user and resource data)

A Web Browser (Chrome, Firefox, Edge, etc.)

Step 2: Set Up the Database

Open phpMyAdmin or any MySQL database management tool.

Create a new database named:

ml_website_db

Import the provided SQL script file (database.sql) to set up tables automatically.

Step 3: Configure the Project

Place the MLwebsite project folder inside the htdocs directory (if using XAMPP) or your local web server directory.

Open the config.php file and update the database credentials if needed.

Step 4: Start the Local Server

Open XAMPP/WAMP and start Apache and MySQL.

Open your browser and enter the following URL:

http://localhost/php/login.php

The application is now ready to use! 🎉


Technologies Used

The project is built using the following technologies:

Backend:

PHP – Server-side scripting language

MySQL – Database for storing user and resource data

Frontend:

HTML5 – Structure of web pages

Tailwind CSS – Modern and responsive UI styling

Security Measures

User input validation to prevent SQL injection and XSS attacks.

Password encryption for securely storing credentials.

Session management for secure login and authentication.

Admin access control to prevent unauthorized actions.

License

This project is created for educational purposes only. You are free to modify and use it, but it should not be used for commercial applications without proper authorization.