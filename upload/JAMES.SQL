CREATE TABLE Login_Table(
Login_Id INT(20),
Login_Username VARCHAR(255),
Login_Password VARCHAR(255),
Login_Rank VARCHAR(255)
);


CREATE TABLE User_Table(
User_Id INT(20),
User_Name VARCHAR(255),
User_Contact VARCHAR(255),
User_Gender VARCHAR(255),
User_DOB VARCHAR(255),
User_Photo VARCHAR(255),
User_Certificate VARCHAR(255),
User_Document_type VARCHAR(255)
);


CREATE TABLE Application_Table(
Application_Id INT(20),
Application_DateTime VARCHAR(255),
Application_Type VARCHAR(255)
);

CREATE TABLE Payment_Table(
Payment_Id INT(20),
Payment_Amount INT(20),
Payment_DateTime VARCHAR(255),
Payment_Mode VARCHAR(255)
);


CREATE TABLE Application_Payment_Table(
Application_Payment_Id INT(20),
Application_Payment_Application_Id INT(20),
Application_Payment_Payment_Id INT(20)
);


CREATE TABLE Notification_Table(
Notification_Id INT(20),
Notification_DateTime VARCHAR(255),
Notification_Message VARCHAR(255)
);


CREATE TABLE User_Notification_Table(
User_Notification_Id INT(20),
User_Notification_User_Id INT(20),
User_Notification_Notification_Id INT(20)
);
