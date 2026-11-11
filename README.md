# Internal Exam Marks Entry System

## 1. Project Description

The Internal Exam Marks Entry System is a web-based application developed to manage and store students' internal examination marks.

The system allows faculty members to select students and subjects, enter examination marks, and view a report containing student and subject details.

## 2. Technologies Used

- Frontend: HTML, CSS
- Backend: PHP
- Database: MySQL
- Server: Apache (XAMPP)
- Database Management Tool: phpMyAdmin
- Code Editor: Visual Studio Code

## 3. Database Details

**Database Name:** `marks_db`

The database contains three tables:

### Student Table
Stores student information:
- student_id (Primary Key)
- name
- programme
- semester

### Subject Table
Stores subject information:
- subject_code (Primary Key)
- subject_name
- max_marks
- faculty_name

### Marks Table
Stores examination marks:
- marks_id (Primary Key, Auto Increment)
- student_id (Foreign Key)
- subject_code (Foreign Key)
- exam_date
- marks_obtained

## 4. Project Files

- `db.php` – Establishes the connection between PHP and MySQL.
- `marks.php` – Provides a form to select students and subjects and enter examination marks.
- `report.php` – Displays the marks report using SQL JOIN operations.
- `marks_db.sql` – Database export containing the database structure and records.

## 5. Main Features

1. Student selection through a dropdown list.
2. Subject selection through a dropdown list.
3. Entry of examination date and marks obtained.
4. Validation of marks against maximum marks.
5. Storage of marks in the MySQL database.
6. Display of all examination records in an HTML report table.
7. Retrieval of data using INNER JOIN operations across three tables.

## 6. How to Run the Project

1. Install and open XAMPP.
2. Start Apache and MySQL.
3. Place the project folder inside `C:\xampp\htdocs`.
4. Open phpMyAdmin.
5. Create a database named `marks_db` and import `marks_db.sql`.
6. Open the browser.
7. Visit `http://localhost/marks_project/marks.php`.

## 7. Report Page

The report page retrieves the following information by joining the student, subject, and marks tables:

- Student Name
- Subject Name
- Max Marks
- Marks Obtained
- Exam Date

## 8. Conclusion

The Internal Exam Marks Entry System provides a simple way to enter, store, and retrieve students' internal examination marks. It demonstrates PHP-MySQL connectivity, relational database design, foreign-key relationships, data validation, and SQL JOIN operations.