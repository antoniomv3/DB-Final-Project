CREATE TABLE Students (
    First_Name varchar(35) NOT NULL,
    Last_Name varchar(35) NOT NULL,
    StudentID varchar(10) NOT NULL,
    Local_Address varchar(255) NOT NULL,
    Phone varchar(20),
    Email varchar(64),
    State varchar(64),
    Candidate varchar(32),
    Bryant_Status varchar(5),
    ED_Status varchar(5),
    MDPHD_Status varchar(5),
	MU_Status varchar(5),
    First_Status varchar(5),
    PRIMARY KEY (StudentID)
);

CREATE TABLE Schools (
	School_Name varchar(255) NOT NULL,
    City varchar(35) NOT NULL,
    State varchar(35) NOT NULL,
    School_Type varchar(15) NOT NULL,
    PRIMARY KEY (School_Name)
);

CREATE TABLE Applications (
	StudentID varchar(10) NOT NULL,
    School_Name varchar(255) NOT NULL,
    
    FOREIGN KEY (StudentID) REFERENCES Students (StudentID),
    FOREIGN KEY (School_Name) REFERENCES Schools (School_Name)
);

CREATE TABLE Users (
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (username)
);

drop table Students;
drop table Schools;
drop table Applications;
