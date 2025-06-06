# DICT-Intern-Monitoring-System-Via-Barcode

DICT-FRONTEND/
│
├── Admin/
│ ├── Components/
│ │ ├── Header.php
│ │ └── Sidebar.php
│ │
│ ├── CSS/
│ │ ├── All_Page.css
│ │ ├── Apprentice.css
│ │ ├── Dashboard.css
│ │ ├── Header.css
│ │ ├── Intern_Information.css
│ │ └── Intern_Record.css
│ │
│ └── Modals/
│ │ └── Add_Intern.php
│ │
│ ├── Apprentice.php
│ ├── Dashboard.php
│ ├── Intern_Information.php
│ └── Intern_Record.php
│
├── handler/
│ └── login.php
│
├── img/
│  
│
├── Intern/
│ ├── Components/
│ │ └── InternSidebar.php
│ │
│ ├── CSS/
│ │ ├── Intern_All_Page.css
│ │ ├── Intern_Dashboard.css
│ │ ├── New_Comer.css
│ │ ├── Profile.css
│ │ └── Weekly_Reflection.css
│ │
│ ├── Modals/
│ │ └── Add_Reflection.php
│ │
│ ├── Intern_Dashboard.php
│ ├── New_Comer.php
│ ├── Profile.php
│ └── Weekly_Reflection.php
│
├── profile_pictures/
│ └── profiledefault.jpg
│
├── db_connect.php
├── Forgot_Pass_Modal.php
├── index.php
├── README.md
└── styles.css

CREATE TABLE ADMIN_TABLE (
ADMIN_ID INT PRIMARY KEY IDENTITY(1,1),
Username VARCHAR(50) NOT NULL,
Password VARCHAR(100) NOT NULL
);

CREATE TABLE OJT_TABLE_STATUS_CREDENTIAL (
OJT_ID INT PRIMARY KEY IDENTITY(1,1),
Username VARCHAR(50) NOT NULL,
Password VARCHAR(100) NOT NULL,
Barcode VARCHAR(100) NOT NULL,
Time_Complete TIME NULL,
Required_Time VARCHAR(50) NULL
Barcode_lmage_Path VARCHAR(255) NOT NULL,
Status VARCHAR(20) DEFAULT 'Absent',
Connect VARCHAR(20) DEFAULT 'Offline'
);

CREATE TABLE OJT_TABLE_ATTENDANCE_RESETS (
RESET_ID INT PRIMARY KEY IDENTITY(1,1),
Reset_Date DATE NULL,
Reset_Time TIME NULL,
Reset_Type VARCHAR(10)
);

CREATE TABLE OJT_TABLE_ATTENDANCE_LOGBOOK (
ATTENDANCE_ID INT PRIMARY KEY IDENTITY(1,1),
OJT_ID INT NOT NULL,
User_Kind VARCHAR(20) DEFAULT 'Intern',
Date DATE,
Time_In DATETIME,
Time_Out DATETIME,
Total_Duration TIME,
AM_PM VARCHAR(2),
Attendance_Validation VARCHAR(50) NULL,
Real_Time_In DATETIME,
Real_Time_Out DATETIME,
FOREIGN KEY (OJT_ID) REFERENCES OJT_TABLE_STATUS_CREDENTIAL(OJT_ID)
);

CREATE TABLE OJT_TABLE_PERSONAL_DATA (
PERSONAL_DATA_ID INT PRIMARY KEY IDENTITY(1,1),
OJT_ID INT NOT NULL,
Profile_lmage_Path VARCHAR(255),
First_Name VARCHAR(50),
Middle_Initial VARCHAR(5),
Last_Name VARCHAR(50),
Date_Birth DATE,
Gender VARCHAR(20),
Civil_Status VARCHAR(20),
Address VARCHAR(255),
Signature VARCHAR(255),
Phone_Number VARCHAR(20),
Email VARCHAR(100),
School VARCHAR(100),
Course VARCHAR(100),
Contact_Person_Name VARCHAR(100),
Contact_Person_Contact_No VARCHAR(20),
Contact_Person_Relation VARCHAR(50),
Contact_Person_Address VARCHAR(255),
FOREIGN KEY (OJT_ID) REFERENCES OJT_TABLE_STATUS_CREDENTIAL(OJT_ID)
);

CREATE TABLE OJT_TABLE_WEEKLY_REFLECTION (
WEEKLY_REFLECTION_ID INT PRIMARY KEY IDENTITY(1,1),
OJT_ID INT NOT NULL,
Week_No VARCHAR(20),
Description VARCHAR(MAX),
Skill_Learned VARCHAR(MAX),
FOREIGN KEY (OJT_ID) REFERENCES OJT_TABLE_STATUS_CREDENTIAL(OJT_ID)
);

CREATE TABLE NOTIFICATION_TABLE (
NOTIFICATION_ID INT PRIMARY KEY IDENTITY(1,1),
OJT_ID INT NOT NULL,
User_Position VARCHAR(50),
Is_Read BIT DEFAULT 0,
Timestamp DATETIME,
Notification_Type VARCHAR(50) NULL,
Message VARCHAR(MAX) NULL,
FOREIGN KEY (OJT_ID) REFERENCES OJT_TABLE_STATUS_CREDENTIAL(OJT_ID)
);
