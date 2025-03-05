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
- `roleID`: `INT NOT NULL` **FK -> Role**
- `email`: `VARCHAR(100) UNIQUE NOT NULL`
- `contactID`: `INT` **FK -> ContactInformation**
- `password`: `VARCHAR(500) NOT NULL`

*Represents all people in the system*

## GuardianAssignments
- `id`: `INT` **PK**
- `guardianID`: `INT` **FK -> Users**
- `userID`: `INT` **FK -> Users**
- `relationship`: `ENUM(PARENT, GUARDIAN, CAREER) NOT NULL`

## Classes
- `id`: `INT` **PK**
- `capacity`: `INT`
- `name`: `VARCHAR(100)`
- `startTime`: `TIME`
- `endTime`: `TIME`
- `teacherID`: `INT` **FK -> Users** (only if the User has a TEACHER role)

## ClassAssignments
- `id`: `INT` **PK**
- `classID`: `INT` **FK -> Classes**
- `studentID`: `INT` **FK -> Users** (only if the User has a STUDENT role)

## Saleries
- `id`: `INT` **PK**
- `userID`: `INT` **FK -> Users**
- `wage`: `DECIMAL NOT NULL`

*Represents a user's salery per hour*

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
- `whenHandOut`: `DATETIME`
- `whenDueIn`: `DATETIME`