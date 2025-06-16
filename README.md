# Payroll Management System

## Overview

The **Payroll Management System** is a web-based application developed using PHP and MySQL. It is designed to streamline employee management processes such as attendance tracking, payroll generation, and role assignment. The system provides a secure admin interface for managing all core functionalities related to HR and payroll operations.

## Key Features

### 1. Employee Attendance & Attendance Management
- Daily logging of employee attendance
- Record of working hours and attendance status (e.g., Present, Absent, Leave)
- Integrated with salary calculations for accurate payroll generation

### 2. Salary Management
- Auto-calculation of gross and net salaries based on working hours and position rate
- Support for various deductions: Provident Fund (PF), advance salary, loans
- Detailed salary record management and payroll reports

### 3. Position / Role Management
- Create and manage different job positions
- Set hourly rates for each role
- Assign employees to specific positions

### 4. Admin Role on System
- Role-based access control with admin login
- Admin dashboard to view and manage employees, attendance, salaries, and payroll
- Secure CRUD operations for employee, salary, and payroll data

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL  

## Database Design

The system uses a relational database structure to ensure data integrity and easy scalability. The main tables include:

- `EMPLOYEE`: Stores employee personal and job-related details
- `ATTENDANCE`: Logs daily attendance records
- `POSITION`: Holds job roles and their corresponding hourly pay
- `SALARY`: Contains salary breakdowns and calculations
- `DEDUCTION`: Stores all types of deductions
- `PAYROLL`: Tracks payroll transactions and statuses

Refer to the provided database design diagram for more details.

## User Interface

<div align="center">
  <table>
    <tr>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/login.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Login Screen</b></sub>
      </td>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/dashboard.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Dashboard Screen</b></sub>
      </td>
    </tr>
    <tr>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/payroll.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Payroll Screen</b></sub>
      </td>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/deductiom.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Deduction Screen</b></sub>
      </td>
    </tr>
        <tr>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/position.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Role Screen</b></sub>
      </td>
      <td align="center">
        <img src="https://github.com/nareshsuthardev/Payroll-Management-System/blob/main/Screenshots/attendencebook.png" alt="Screenshot 1" height="200px">
        <br>
        <sub><b>Attendance Screen</b></sub>
      </td>
    </tr>
  </table>
</div>

## Setup Instructions

1. Clone or download the project files.
2. Import the MySQL database schema into your local database.
3. Configure database connection settings in the PHP config file (`config.php` or similar).
4. Run the project on a local server (e.g., XAMPP, WAMP).
5. Login using the admin account to begin using the system.

