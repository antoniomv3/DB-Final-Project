Select StudentID, Last_Name, First_Name from Students order by Last_Name asc;

INSERT INTO Students (First_Name, Last_Name, StudentID, Local_Address, Phone, Email, State, Candidate, Bryant_Status, ED_Status, MDPHD_Status, MU_Status, First_status) 
Values ('Nathan', 'Fillion', '14260123', '123 South Street, Columbia, MO', '123-456-7890', 'abc@mail.com', 'Missouri', 'Allopathic Medicine', 'No', 'Yes', 'No', 'Yes', 'Yes');

INSERT INTO Students (First_Name, Last_Name, StudentID, Local_Address, Phone, Email, State, Candidate, Bryant_Status, ED_Status, MDPHD_Status, MU_Status, First_status) 
Values ('Alan', 'Tudyk', '14260777', '456 Northwest Blvd, Columbia, MO', '456-789-1234', 'def@mail.com', 'Illinois', 'Osteopathic Medicine', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes');

INSERT INTO Students (First_Name, Last_Name, StudentID, Local_Address, Phone, Email, State, Candidate, Bryant_Status, ED_Status, MDPHD_Status, MU_Status, First_status) 
Values ('Jewel', 'Staite', '14260512', '3 Rose Lane, Columbia, MO', '923-434-6774', 'ghi@mail.com', 'Kansas', 'Dentistry', 'No', 'No', 'No', 'Yes', 'No');

INSERT INTO Students (First_Name, Last_Name, StudentID, Local_Address, Phone, Email, State, Candidate, Bryant_Status, ED_Status, MDPHD_Status, MU_Status, First_status) 
Values ('Summer', 'Glau', '14260235', '74 Washington Ave, Columbia, MO', '353-896-3322', 'jkl@mail.com', 'Arkansas', 'Podiatry', 'No', 'Yes', 'No', 'Yes', 'No');


INSERT INTO Applications (StudentID, School_Name) VALUES ('14260123', 'Albany Medical College');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260123', 'University of Washington School of Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260777', 'Touro University California College of Osteopathic Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260777', 'Lincoln Memorial University DeBusk College of Osteopathic Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260777', 'Arkansas College of Ostepathic Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260512', 'University of Missouri-Kansas City School of Dentistry');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260512', 'The Dental College of Georgia at Augusta University');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260512', 'University of Alabama School of Dentistry');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260512', 'Howard University College of Dentistry');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260235', 'California School of Podiatric Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260235', 'Kent State University College of Podiatric Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260235', 'Western University College of Podiatric Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260235', 'New York College of Podiatric Medicine');
INSERT INTO Applications (StudentID, School_Name) VALUES ('14260235', 'Barry University School of Podiatric Medicine');


Select School_Name from Students INNER JOIN Applications ON Students.StudentID = Applications.StudentID where Applications.StudentID = '14260777';
UPDATE Students SET First_Name = 'Summer' WHERE StudentID = '14260235';
SELECT * FROM Applications;
Delete from Applications WHERE StudentID = '14260123';