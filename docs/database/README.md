# Generic User management

## Roles
- `id`: `INT` **PK**
- `permissions`: `TEXT NOT NULL`
- `name`: `VARCHAR(100) NOT NULL`

*Specific roles choose what the user type is and what they can do - e.g. 'ADMIN', 'TEACHER', 'STUDENT', 'PARENT', 'OTHER'*

## ContactInformation
- `id`: `INT` **PK**
- `addressLine1`: `VARCHAR (200) NOT NULL`
- `addressLine2`: `VARCHAR (200)`
- `city`: `VARCHAR(100) NOT NULL`
- `state`: `VARCHAR(100) NOT NULL`
- `country`: `VARCHAR(100) NOT NULL`
- `postcode`: `VARCHAR(20) NOT NULL`

## Users
- `id`: `INT` **PK**
- `name`: `VARCHAR(100) NOT NULL`
- `roleID`: `INT NOT NULL` **FK -> Roles**
- `email`: `VARCHAR(100) UNIQUE NOT NULL`
- `contactID`: `INT` **FK -> ContactInformation**
- `password`: `VARCHAR(500) NOT NULL`
- `avatarURL`: `VARCHAR(1000)`

*Represents all people in the system*

## Groups
- `id`: `INT` **PK**
- `name`: `VARCHAR(100) NOT NULL`

## GroupAssignments
- `id`: `INT` **PK**
- `group`: `INT NOT NULL` **FK -> Group**
- `userID`: `INT MOT NULL` **FK -> Users**

# Job management

## Salaries
- `id`: `INT` **PK**
- `roleID`: `INT` **FK -> Roles**
- `wage`: `DECIMAL NOT NULL`

*Represents a user's salery per hour*

# Student management

## GuardianAssignments
- `id`: `INT` **PK**
- `guardianID`: `INT NOT NULL` **FK -> Users**
- `userID`: `INT MOT NULL` **FK -> Users**
- `relationship`: `ENUM(PARENT, GUARDIAN, CAREER) NOT NULL`

## Classes
- `id`: `INT` **PK**
- `capacity`: `INT NOT NULL`
- `name`: `VARCHAR(100) NOT NULL`
- `startTime`: `TIME NOT NULL`
- `endTime`: `TIME NOT NULL`
- `teacherID`: `INT` **FK -> Users** (only if the User has a TEACHER role)
- `daysOfWeek`: `INT NOT NULL` (actually a bitmask stored as a binary int, eg Monday, Wednesday, and Friday = `0101010`)
- `startDate`: `DATE NOT NULL`
- `endDate`: `DATE NOT NULL`

## ClassAssignments
- `id`: `INT` **PK**
- `classID`: `INT` **FK -> Classes**
- `groupID`: `INT` **FK -> Groups** (only if the User in the group has a STUDENT role)

## Attendance
- `id`: `INT` **PK**
- `userID`: `INT NOT NULL` **FK > Users**
- `classID`: `INT NOT NULL` **FK > Classes**
- `type`: `ENUM(PRESENT, LATE, UNAUTHORISED_ABSENT, AUTHORISED_ABSENT, EXPELLED) NOT NULL`
- `comments`: `TEXT`
- `whenMarked`: `DATETIME NOT NULL`

# Library management

## Books
- `id`: `INT` **PK**
- `isbn`: `VARCHAR(20) NOT NULL`
- `name`: `VARCHAR(100) NOT NULL`
- `author`: `VARCHAR(100) NOT NULL`
- `inStock`: `INT NOT NULL`

## BookAssignments
- `id`: `INT` **PK**
- `bookID`: `INT` **FK -> Books**
- `userID`: `INT` **FK -> Users**
- `whenHandOut`: `DATETIME NOT NULL`
- `whenDueIn`: `DATETIME NOT NULL`