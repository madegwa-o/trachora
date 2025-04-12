CREATE DATABASE trackstardb;

USE trackstardb;

CREATE TABLE student (
    studentId INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255),
    admNo VARCHAR(50),
    gender VARCHAR(10),
    emergencyContact VARCHAR(50),
    house VARCHAR(50)
);

CREATE TABLE subject (
    subjectId INT AUTO_INCREMENT PRIMARY KEY,
    subjectName VARCHAR(255)
);

CREATE TABLE teacher (
    teacherId INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(255),
    email VARCHAR(100),
    phone VARCHAR(50),
    address VARCHAR(255)
);

CREATE TABLE student_subject (
    studentId INT,
    subjectId INT,
    FOREIGN KEY (studentId) REFERENCES student(studentId),
    FOREIGN KEY (subjectId) REFERENCES subject(subjectId),
    PRIMARY KEY (studentId, subjectId)
);

CREATE TABLE teacher_subject (
    teacherId INT,
    subjectId INT,
    FOREIGN KEY (teacherId) REFERENCES teacher(teacherId),
    FOREIGN KEY (subjectId) REFERENCES subject(subjectId),
    PRIMARY KEY (teacherId, subjectId)
);
