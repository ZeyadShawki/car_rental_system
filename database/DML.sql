-- Insert data into Customers table
INSERT INTO Customers (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate, amount)
VALUES
('John', 'Doe', 'john.doe@example.com', '123-456-7890', 'password123', 'male', '1990-01-01', 1000.00),
('Jane', 'Smith', 'jane.smith@example.com', '987-654-3210', 'securepass', 'female', '1985-05-15', 800.50),
('Bob', 'Johnson', 'bob.johnson@example.com', '555-123-4567', 'pass123', 'male', '1982-11-30', 1200.75);

-- Insert data into Offices table
INSERT INTO Offices (country, city)
VALUES
('USA', 'New York'),
('Canada', 'Toronto'),
('UK', 'London');

-- Insert data into Cars table
INSERT INTO Cars (OfficeID, carname, brand, Year, imageUrl, rentvalue, carStatus)
VALUES
(1, 'Sedan 1', 'Toyota', 2022, 'https://example.com/toyota.jpg', 50.00, 'active'),
(2, 'SUV 1', 'Ford', 2021, 'https://example.com/ford.jpg', 70.00, 'active'),
(3, 'Compact 1', 'Honda', 2023, 'https://example.com/honda.jpg', 40.00, 'active');

-- Insert data into Payments table
INSERT INTO Payments (PaymentDate, Amount)
VALUES
('2023-01-15', 50.00),
('2023-02-20', 70.00),
('2023-03-10', 40.00);

-- Insert data into Reservations table
INSERT INTO Reservations (plateID, CustomerID, PaymentID, ReservationDate, PickupDate, ReturnDate)
VALUES
(1, 1, 1, '2023-01-10', '2023-01-15', '2023-01-20'),
(2, 2, 2, '2023-02-15', '2023-02-20', '2023-02-25'),
(3, 3, 3, '2023-03-05', '2023-03-10', '2023-03-15');



-- Insert more data into Customers table
INSERT INTO Customers (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate, amount)
VALUES
('Alice', 'Johnson', 'alice.j@example.com', '111-222-3333', 'pass456', 'female', '1995-06-20', 900.00),
('Charlie', 'Brown', 'charlie.b@example.com', '444-555-6666', 'secure456', 'male', '1988-09-12', 1100.25),
('Eva', 'Miller', 'eva.m@example.com', '777-888-9999', 'pass789', 'female', '1992-03-28', 950.50);

-- Insert more data into Offices table
INSERT INTO Offices (country, city)
VALUES
('Germany', 'Berlin'),
('France', 'Paris'),
('Japan', 'Tokyo');

-- Insert more data into Cars table
INSERT INTO Cars (OfficeID, carname, brand, Year, imageUrl, rentvalue, carStatus)
VALUES
(1, 'Luxury 1', 'Mercedes', 2022, 'https://example.com/mercedes.jpg', 80.00, 'active'),
(2, 'Sedan 2', 'Chevrolet', 2021, 'https://example.com/chevrolet.jpg', 55.00, 'active'),
(3, 'SUV 2', 'Nissan', 2023, 'https://example.com/nissan.jpg', 65.00, 'active');

-- Insert more data into Payments table
INSERT INTO Payments (PaymentDate, Amount)
VALUES
('2023-04-10', 80.00),
('2023-05-15', 55.00),
('2023-06-20', 65.00);

-- Insert more data into Reservations table
INSERT INTO Reservations (plateID, CustomerID, PaymentID, ReservationDate, PickupDate, ReturnDate)
VALUES
(4, 4, 4, '2023-04-05', '2023-04-10', '2023-04-15'),
(5, 5, 5, '2023-05-10', '2023-05-15', '2023-05-20'),
(6, 6, 6, '2023-06-15', '2023-06-20', '2023-06-25');



-- Update Cars table to mark some cars as "rented"
UPDATE Cars SET carStatus = 'rented' WHERE plateID IN (1, 3);

-- Insert more data into Reservations table for rented cars
INSERT INTO Reservations (plateID, CustomerID, PaymentID, ReservationDate, PickupDate, ReturnDate)
VALUES
    (1, 1, 1, '2023-12-02', '2023-12-05', '2023-12-10'),
    (3, 3, 3, '2023-12-01', '2023-12-04', '2023-12-09');


ALTER TABLE Customers
ADD ImageLink VARCHAR(255); 