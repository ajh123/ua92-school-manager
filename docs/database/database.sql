CREATE TABLE Roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    permissions TEXT NOT NULL,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE ContactInformation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    addressLine1 VARCHAR(200) NOT NULL,
    addressLine2 VARCHAR(200),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    postcode VARCHAR(20) NOT NULL
);

CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    roleID INT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contactID INT,
    password VARCHAR(500) NOT NULL,
    avatarURL VARCHAR(1000),
    FOREIGN KEY (roleID) REFERENCES Roles(id),
    FOREIGN KEY (contactID) REFERENCES ContactInformation(id)
);

CREATE TABLE Groups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE GroupAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    groupID INT NOT NULL,
    userID INT NOT NULL,
    FOREIGN KEY (groupID) REFERENCES Groups(id),
    FOREIGN KEY (userID) REFERENCES Users(id)
);

CREATE TABLE Salaries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    roleID INT,
    wage DECIMAL NOT NULL,
    FOREIGN KEY (roleID) REFERENCES Roles(id)
);

CREATE TABLE GuardianAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guardianID INT NOT NULL,
    userID INT NOT NULL,
    relationship ENUM('PARENT', 'GUARDIAN', 'CAREER') NOT NULL,
    FOREIGN KEY (guardianID) REFERENCES Users(id),
    FOREIGN KEY (userID) REFERENCES Users(id)
);

CREATE TABLE Classes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    capacity INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    startTime TIME NOT NULL,
    endTime TIME NOT NULL,
    teacherID INT,
    daysOfWeek INT NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    FOREIGN KEY (teacherID) REFERENCES Users(id)
);

CREATE TABLE ClassAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    classID INT NOT NULL,
    groupID INT NOT NULL,
    FOREIGN KEY (classID) REFERENCES Classes(id),
    FOREIGN KEY (groupID) REFERENCES Groups(id)
);

CREATE TABLE Attendance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userID INT NOT NULL,
    classID INT NOT NULL,
    type ENUM('PRESENT', 'LATE', 'UNAUTHORISED_ABSENT', 'AUTHORISED_ABSENT', 'EXPELLED') NOT NULL,
    comments TEXT,
    whenMarked DATETIME NOT NULL,
    FOREIGN KEY (userID) REFERENCES Users(id),
    FOREIGN KEY (classID) REFERENCES Classes(id)
);

CREATE TABLE Books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(20) NOT NULL,
    name VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    inStock INT NOT NULL
);

CREATE TABLE BookAssignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bookID INT NOT NULL,
    userID INT NOT NULL,
    whenHandOut DATETIME NOT NULL,
    whenDueIn DATETIME NOT NULL,
    FOREIGN KEY (bookID) REFERENCES Books(id),
    FOREIGN KEY (userID) REFERENCES Users(id)
);
