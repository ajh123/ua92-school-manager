-- Create Roles Table
CREATE TABLE Roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    permissions TEXT NOT NULL,
    name VARCHAR(100) NOT NULL
);

-- Create ContactInformation Table
CREATE TABLE ContactInformation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    addressLine1 VARCHAR(200) NOT NULL,
    addressLine2 VARCHAR(200),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    postcode VARCHAR(20) NOT NULL
);

-- Create Users Table
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(500) NOT NULL,
    roleID INT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contactID INT,
    FOREIGN KEY (roleID) REFERENCES Roles(id),
    FOREIGN KEY (contactID) REFERENCES ContactInformation(id)
);

-- Create GuardianAssignments Table
CREATE TABLE GuardianAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guardianID INT NOT NULL,
    userID INT NOT NULL,
    relationship ENUM('PARENT', 'GUARDIAN', 'CAREER') NOT NULL,
    FOREIGN KEY (guardianID) REFERENCES Users(id),
    FOREIGN KEY (userID) REFERENCES Users(id)
);

-- Create Classes Table
CREATE TABLE Classes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    capacity INT,
    name VARCHAR(100),
    startTime TIME,
    endTime TIME,
    teacherID INT,
    FOREIGN KEY (teacherID) REFERENCES Users(id) 
);

-- Create ClassAssignments Table
CREATE TABLE ClassAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    classID INT NOT NULL,
    studentID INT NOT NULL,
    FOREIGN KEY (classID) REFERENCES Classes(id),
    FOREIGN KEY (studentID) REFERENCES Users(id)
);

-- Create Saleries Table
CREATE TABLE Saleries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userID INT NOT NULL,
    wage FLOAT NOT NULL,
    FOREIGN KEY (userID) REFERENCES Users(id)
);

-- Create Books Table
CREATE TABLE Books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(20) NOT NULL,
    name VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    inStock INT NOT NULL
);

-- Create BookAssignments Table
CREATE TABLE BookAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bookID INT NOT NULL,
    userID INT NOT NULL,
    whenHandOut DATETIME,
    whenDueIn DATETIME,
    FOREIGN KEY (bookID) REFERENCES Books(id),
    FOREIGN KEY (userID) REFERENCES Users(id)
);
