# Sem04-Database

### Course Overview
This repository contains the final project for the **Database** course taken in my fourth semester. The course focused on database design principles, SQL queries, and database management using **Oracle** SQL. Key topics included **Entity-Relationship (E-R) modeling**, **SQL CRUD operations**, and **JOIN** operations. This project demonstrates the development of a restaurant management system, covering database structure and backend connectivity, with a rudimentary PHP-based frontend for user interaction.

### Learning Outcomes
Through this course and project, I learned:
- How to design and implement databases from scratch, starting with E-R diagrams and translating them into SQL.
- Writing complex SQL queries, including multi-table JOINS, to handle data efficiently.
- Building a complete CRUD (Create, Read, Update, Delete) system in PHP for database manipulation.
- Exporting data from the database to Excel for reporting purposes.

### Project Overview
The project simulates a database-driven **restaurant management system** with the following features:
- **Database Design**: The database structure was designed using an E-R model to include essential entities such as chefs, menus, managers, dishes (`platillos`), and branches (`sedes`).
- **Backend**: The database was developed in Oracle SQL with full CRUD capabilities for each entity, allowing for the insertion, deletion, viewing, and updating of records.
- **Frontend**: A basic PHP-based interface was created to interact with the database, providing form-based user input and data display.

### Project Structure
- **DBfinal.sql**: Contains the SQL schema and initial setup for the database, with tables and relationships defined based on the E-R model.
- **Oracle_project**:
  - **PHP Files**:
    - **chefs.php**: Provides a CRUD interface for the `chefs` entity, allowing users to insert, delete, view, and update chef records. This file also handles form input for various fields (e.g., DNI, branch code, name, phone number, start date).
    - **chefs_excel.php**: Exports the `chefs` data to an Excel file (`chefs.xls`), allowing easy data extraction and reporting.
    - Other PHP files for additional entities (e.g., `managers`, `dishes`, `branches`) follow a similar structure to `chefs.php`.

### Video Demonstration
A video demonstrating the project’s functionality and design is available on [Google Drive](#) (link). The video covers the initial E-R diagram, database setup, and usage of the PHP-based CRUD interface.

### Group Members
This project was completed as a group effort with the following members:
1. **Dayevska Anabel Caceres Budiel**
2. **Sebastian Gonzalo Postigo Avalos**
3. **Joaquin Casusol Escalante**
4. **Paolo Rafael Delgado Vidal**

### Usage Instructions
1. **Database Setup**:
   - Import the `DBfinal.sql` file into Oracle SQL to create the required tables and relationships.
2. **PHP Interface**:
   - Deploy the `Oracle_project` folder on a server with PHP and connect it to your Oracle database.
   - Use `chefs.php` (and similar files for other entities) to perform CRUD operations.
   - Use `chefs_excel.php` to export data to Excel.
