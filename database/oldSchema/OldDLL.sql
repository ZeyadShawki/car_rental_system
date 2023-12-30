CREATE DATABASE car_rental_system ;
USE car_rental_system ; 



CREATE TABLE Admins (
    AdminId INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PhoneNumber VARCHAR(20),
	user_password VARCHAR(50) NOT NULL,
    sex ENUM('male','female'),
    bdate date ,
);


CREATE TABLE Customers (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PhoneNumber VARCHAR(20),
	user_password VARCHAR(50) NOT NULL,
    sex ENUM('male','female'),
    bdate date ,
    amount double(10,2) DEFAULT 0
);

CREATE TABLE Offices (
    OfficeID INT PRIMARY KEY AUTO_INCREMENT,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL
);

CREATE TABLE Cars (
    plateID INT PRIMARY KEY AUTO_INCREMENT,
    OfficeID INT NOT NULL ,
    carname VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    Year INT NOT NULL,
    imageUrl VARCHAR(300) NOT NULL,
    rentvalue DOUBLE(10,2) NOT NULL,
    carStatus ENUM('active', 'out of service', 'rented'),
	FOREIGN KEY (OfficeID) REFERENCES Offices(OfficeID)
);

CREATE TABLE Payments (
    PaymentID INT PRIMARY KEY AUTO_INCREMENT,
    PaymentDate DATE NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Reservations (
    ReservationID INT PRIMARY KEY AUTO_INCREMENT,
    plateID INT NOT NULL ,
    FOREIGN KEY (plateID) REFERENCES Cars(plateID),
    CustomerID INT NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES  Customers(CustomerID),
    PaymentID INT NOT NULL,
    FOREIGN KEY (PaymentID) REFERENCES  Payments(PaymentID),
    ReservationDate DATE NOT NULL,
    PickupDate DATE NOT NULL,
    ReturnDate DATE NOT NULL
);