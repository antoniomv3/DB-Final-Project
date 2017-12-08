# DB Final Project
**Group Members:** Tony Vazquez, Joey Bertolino, Carson Bradley, Kristyn Long

## Description
***The username and password to login as an admin are listed below!
***Username: test  Password: pass
  The purpose of this website is to gather student information for the MedOpp program committee interview and store it in a database. Students will fill out the application then the information for each student will be stored for the admin to view and update. The "Home" tab gives an overview of the application process. The "School Info" tab explains each type of medical school and provides a video at the bottom of the page on "How to choose your Medical School". The "Application" tab takes you to the applicant information form for students to fill out. The students enter their personal and school information then select up to 5 schools from a list of 148. The "Login" tab allows the admin to login and view an application master list. This list allows the admin to view, update, and delete student information throughout the application process in case a student changes their mind at any time.
## Schema
finalDatabase
  1. Applications
     * StudentID
     * School_Name
  2. Schools
     * School_Name
     * City
     * State
     * School_Type
  3. Students
     * First_Name
     * Last_Name
     * StudentID
     * Local_Address
     * Phone
     * Email
     * State
     * Candidate
     * Bryant_Status
     * ED_Status
     * MDPHD_Status
     * MU_Status
     * First_Status
  4. Users
     * username
     * password
      
## Entity Relationship Diagram
![ERD](https://github.com/antoniomv3/DB-Final-Project/blob/master/Final%20Project%20Files/Images/EDR.PNG)

## CRUD Explanation
  All of the create, read, update, and delete functions are happening within the admin's application master list and the application itself. You can find details on each of these functions and how they work in finalModel.php around line 200.
  1. **Create)** A student is being created in the 'Students' table after they enter their information and click 'Submit', also, information is added to the 'Applications' table if a school is chosen. 
  2. **Read)** When the admin clicks on a student's ID number, they are taken to a separate page to view all of their information. This page is reading all of the information from the 'Students' and 'Applications' tables. 
  3. **Update)** The admin can update the student information by clicking on the gear on the application master list or in the top right corner of a student's individual information page. This updates the 'Student' and 'Applications' table according to the new application submitted by the admin.
  4. **Delete)** The admin is also allowed to completely delete a student's information from the application master list by clicking on the trash can icon next to a student. This deletes the student from the 'Student' and 'Applications' table.
## Video Tutorial
[![YouTube Demo](http://img.youtube.com/vi-jwNe-E82rE&feature=youtu.be/0.jpg)](https://www.youtube.com/watch?v=-jwNe-E82rE&feature=youtu.be)
