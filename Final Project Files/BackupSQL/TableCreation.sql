CREATE TABLE Students (
	StudentID int NOT NULL,
    First_Name varchar(35) NOT NULL,
    Last_Name varchar(35) NOT NULL,
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
	StudentID int NOT NULL,
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
drop table Users;