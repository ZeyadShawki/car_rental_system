USE `car_rental_system`;

INSERT INTO Admins (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate)
VALUES 
  ('Sophia', 'Smith', 'sophia.smith@example.com', '555-111-2222', 'admin123', 'female', '1991-08-12'),
  ('Benjamin', 'Turner', 'benjamin.turner@example.com', '555-333-4444', 'admin456', 'male', '1986-02-25'),
  ('Isabella', 'Clark', 'isabella.clark@example.com', '555-555-5555', 'admin789', 'female', '1994-11-05'),
  ('Elijah', 'Brown', 'elijah.brown@example.com', '555-777-8888', 'adminxyz', 'male', '1981-07-20'),
  ('Ava', 'Anderson', 'ava.anderson@example.com', '555-999-0000', 'admin123', 'female', '1995-03-22'),
  ('Jackson', 'Roberts', 'jackson.roberts@example.com', '555-444-6666', 'admin456', 'male', '1988-12-15'),
  ('Mia', 'Davis', 'mia.davis@example.com', '555-666-2222', 'adminxyz', 'female', '1993-06-18'),
  ('Lucas', 'Miller', 'lucas.miller@example.com', '555-123-7890', 'admin123', 'male', '1984-09-30'),
  ('Chloe', 'Johnson', 'chloe.johnson@example.com', '555-888-9999', 'admin456', 'female', '1992-04-05'),
  ('Henry', 'Williams', 'henry.williams@example.com', '555-222-3333', 'admin789', 'male', '1987-01-10'),
  ('Olivia', 'Davis', 'olivia.davis@example.com', '555-222-3333', 'adminxyz', 'female', '1980-07-10'),
  ('Alex', 'Brown', 'alex.brown@example.com', '555-777-8888', 'admin789', 'male', '1992-03-22'),
  ('Emma', 'Anderson', 'emma.anderson@example.com', '555-999-0000', 'adminxyz', 'female', '1983-09-15'),
  ('Nathan', 'Clark', 'nathan.clark@example.com', '555-444-6666', 'admin123', 'male', '1990-04-30'),
  ('Grace', 'Roberts', 'grace.roberts@example.com', '555-666-2222', 'admin456', 'female', '1987-12-05'),
  ('Liam', 'Turner', 'liam.turner@example.com', '555-123-7890', 'adminxyz', 'male', '1982-06-18');


  INSERT INTO Customers (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate, amount)
VALUES 
  ('Daniel', 'Miller', 'daniel.miller@example.com', '555-555-5555', 'customer789', 'male', '1988-02-12', 2000.00),
  ('Olivia', 'Davis', 'olivia.davis@example.com', '555-777-8888', 'customerxyz', 'female', '1993-09-25', 1200.00),
  ('Alex', 'Brown', 'alex.brown@example.com', '555-999-0000', 'customer123', 'male', '1992-08-08', 1800.00),
  ('Emma', 'Anderson', 'emma.anderson@example.com', '555-222-3333', 'customer456', 'female', '1987-04-30', 1300.00),
  ('Nathan', 'Clark', 'nathan.clark@example.com', '555-444-6666', 'customer789', 'male', '1985-12-15', 1600.00),
  ('Grace', 'Roberts', 'grace.roberts@example.com', '555-666-2222', 'customerxyz', 'female', '1990-03-22', 1400.00),
  ('Liam', 'Turner', 'liam.turner@example.com', '555-123-7890', 'customer123', 'male', '1982-11-10', 1100.00),
('Ella', 'Johnson', 'ella.johnson@example.com', '555-111-2222', 'customer123', 'female', '1991-08-12', 1300.00),
  ('Oliver', 'Smith', 'oliver.smith@example.com', '555-333-4444', 'customer456', 'male', '1986-02-25', 900.00),
  ('Ava', 'Taylor', 'ava.taylor@example.com', '555-555-5555', 'customer789', 'female', '1994-11-05', 1800.00),
  ('Noah', 'Turner', 'noah.turner@example.com', '555-777-8888', 'customerxyz', 'male', '1981-07-20', 1100.00),
  ('Mia', 'Williams', 'mia.williams@example.com', '555-999-0000', 'customer123', 'female', '1995-03-22', 2000.00),
  ('Liam', 'Roberts', 'liam.roberts@example.com', '555-444-6666', 'customer456', 'male', '1988-12-15', 1400.00),
  ('Emma', 'Davis', 'emma.davis@example.com', '555-666-2222', 'customerxyz', 'female', '1993-06-18', 1600.00),
  ('Lucas', 'Brown', 'lucas.brown@example.com', '555-123-7890', 'customer123', 'male', '1984-09-30', 1200.00),
  ('Isabella', 'Clark', 'isabella.clark@example.com', '555-888-9999', 'customer456', 'female', '1992-04-05', 1700.00),
  ('Jackson', 'Miller', 'jackson.miller@example.com', '555-222-3333', 'customer789', 'male', '1987-01-10', 1500.00),
  ('Sophie', 'Turner', 'sophie.turner@example.com', '555-666-7777', 'customerxyz', 'female', '1989-11-10', 1900.00);

INSERT INTO Offices (country, city)
VALUES 
  ('Canada', 'Toronto'),
  ('Germany', 'Berlin'),
('United States', 'New York'),
  ('France', 'Paris'),
  ('United Kingdom', 'London'),
  ('Australia', 'Sydney'),
  ('Japan', 'Tokyo'),
  ('Brazil', 'Rio de Janeiro'),
  ('South Africa', 'Cape Town'),
  ('India', 'Mumbai'),
  ('China', 'Beijing'),
  ('Russia', 'Moscow');

  INSERT INTO category (carname, brand)
VALUES 
 ('Convertible', 'Chevrolet'),
  ('Compact', 'Honda'),
('SUV', 'Ford'),
  ('Sedan', 'Toyota'),
  ('Hatchback', 'Volkswagen'),
  ('Coupe', 'BMW'),
  ('Truck', 'Chevrolet'),
  ('Minivan', 'Honda'),
  ('Electric', 'Tesla'),
  ('Luxury', 'Mercedes-Benz'),
  ('Crossover', 'Nissan'),
  ('Sports Car', 'Porsche');
  
INSERT INTO Cars (OfficeID, carname, Year, imageUrl, rentvalue, carStatus)
VALUES 
  (2, 'Convertible', 2020, 'convertible_image.jpg', 80.00, 'active'),
  (1, 'Compact', 2023, 'compact_image.jpg', 60.00, 'out of service'),
(1, 'Sedan', 2022, 'sedan_image.jpg', 50.00, 'active'),
  (2, 'SUV', 2021, 'suv_image.jpg', 70.00, 'active'),
  (1, 'Compact', 2023, 'compact_image.jpg', 60.00, 'out of service'),
  (2, 'Hatchback', 2022, 'hatchback_image.jpg', 55.00, 'active'),
  (1, 'Coupe', 2023, 'coupe_image.jpg', 65.00, 'active'),
  (2, 'Truck', 2021, 'truck_image.jpg', 75.00, 'active'),
  (1, 'Minivan', 2022, 'minivan_image.jpg', 60.00, 'active'),
  (2, 'Luxury', 2023, 'luxury_image.jpg', 90.00, 'active'),
  (1, 'Electric', 2022, 'electric_image.jpg', 80.00, 'active'),
  (2, 'Crossover', 2021, 'crossover_image.jpg', 70.00, 'active'),
(1, 'Sedan', 2022, 'sedan_image.jpg', 50.00, 'active'),
  (2, 'SUV', 2021, 'suv_image.jpg', 70.00, 'active'),
  (3, 'Compact', 2023, 'compact_image.jpg', 60.00, 'out of service'),
  (4, 'Hatchback', 2022, 'hatchback_image.jpg', 55.00, 'active'),
  (5, 'Coupe', 2023, 'coupe_image.jpg', 65.00, 'active'),
  (6, 'Truck', 2021, 'truck_image.jpg', 75.00, 'active'),
  (7, 'Minivan', 2022, 'minivan_image.jpg', 60.00, 'active'),
  (8, 'Luxury', 2023, 'luxury_image.jpg', 90.00, 'active'),
  (9, 'Electric', 2022, 'electric_image.jpg', 80.00, 'active'),
  (10, 'Crossover', 2021, 'crossover_image.jpg', 70.00, 'active'),
  (11, 'Convertible', 2020, 'convertible_image.jpg', 80.00, 'active'),
  (12, 'Sports Car', 2023, 'sportscar_image.jpg', 95.00, 'active');

INSERT INTO Payments (PaymentDate, Amount)
VALUES 
  ('2023-03-10', 120.00),
  ('2023-03-15', 80.00),
  ('2023-03-20', 150.00),
  ('2023-03-25', 95.00),
  ('2023-03-30', 110.00),
  ('2023-04-05', 130.00),
  ('2023-04-10', 75.00),
  ('2023-04-15', 105.00),
  ('2023-04-20', 140.00),
  ('2023-04-25', 90.00),
('2023-05-01', 100.00),
  ('2023-05-05', 120.00),
  ('2023-05-10', 85.00),
  ('2023-05-15', 130.00),
  ('2023-05-20', 110.00),
  ('2023-05-25', 95.00),
  ('2023-05-30', 150.00),
  ('2023-06-05', 120.00),
  ('2023-06-10', 80.00),
  ('2023-06-15', 135.00);



INSERT INTO Reservations (plateID, CustomerID, PaymentID, ReservationDate, PickupDate, ReturnDate)
VALUES 
(3, 16, 3, '2023-03-10', '2023-03-15', '2023-03-20'),
  (4, 17, 4, '2023-03-12', '2023-03-18', '2023-03-25'),
  (5, 18, 5, '2023-04-01', '2023-04-05', '2023-04-10'),
  (6, 9, 6, '2023-04-03', '2023-04-08', '2023-04-15'),
  (7, 10, 7, '2023-04-05', '2023-04-10', '2023-04-17'),
  (8, 7, 8, '2023-04-08', '2023-04-13', '2023-04-20'),
  (9, 8, 9, '2023-04-10', '2023-04-15', '2023-04-22'),
  (10, 3, 10, '2023-04-12', '2023-04-17', '2023-04-24'),
  (11, 4, 11, '2023-04-15', '2023-04-20', '2023-04-27'),
  (12, 5, 12, '2023-04-18', '2023-04-23', '2023-04-30'),
  (13, 2, 13, '2023-04-20', '2023-04-25', '2023-05-02'),
  (14, 1, 14, '2023-04-23', '2023-04-28', '2023-05-05');









UPDATE `cars`
SET `imageUrl` = 
    CASE 
        WHEN `plateID` = 1 THEN 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg'
        WHEN `plateID` = 2 THEN 'http://localhost/final_db_admin/backend/uploaded_images/2.jpg'
        WHEN `plateID` = 3 THEN 'http://localhost/final_db_admin/backend/uploaded_images/3.jpg'
        WHEN `plateID` = 4 THEN 'http://localhost/final_db_admin/backend/uploaded_images/4.jpg'
        WHEN `plateID` = 5 THEN 'http://localhost/final_db_admin/backend/uploaded_images/5.jpg'
        WHEN `plateID` = 6 THEN 'http://localhost/final_db_admin/backend/uploaded_images/6.jpg'
        WHEN `plateID` = 7 THEN 'http://localhost/final_db_admin/backend/uploaded_images/7.jpg'
        WHEN `plateID` = 8 THEN 'http://localhost/final_db_admin/backend/uploaded_images/8.jpg'
        WHEN `plateID` = 9 THEN 'http://localhost/final_db_admin/backend/uploaded_images/9.jpg'
        WHEN `plateID` = 10 THEN 'http://localhost/final_db_admin/backend/uploaded_images/10.jpg'
        WHEN `plateID` = 11 THEN 'http://localhost/final_db_admin/backend/uploaded_images/11.jpg'
        WHEN `plateID` = 12 THEN 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg'
        -- ... Continue this for each plateID value ...
        ELSE `imageUrl` -- This keeps the current value if the plateID does not match any of the above
    END;


UPDATE `cars`
SET `imageUrl` = 
    CASE 
        WHEN `plateID` = 13 THEN 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg'
        WHEN `plateID` = 14 THEN 'http://localhost/final_db_admin/backend/uploaded_images/2.jpg'
        WHEN `plateID` = 15 THEN 'http://localhost/final_db_admin/backend/uploaded_images/3.jpg'
        WHEN `plateID` = 16 THEN 'http://localhost/final_db_admin/backend/uploaded_images/4.jpg'
        WHEN `plateID` = 17 THEN 'http://localhost/final_db_admin/backend/uploaded_images/5.jpg'
        WHEN `plateID` = 18 THEN 'http://localhost/final_db_admin/backend/uploaded_images/6.jpg'
        WHEN `plateID` = 19 THEN 'http://localhost/final_db_admin/backend/uploaded_images/7.jpg'
        WHEN `plateID` = 20 THEN 'http://localhost/final_db_admin/backend/uploaded_images/8.jpg'
        WHEN `plateID` = 21 THEN 'http://localhost/final_db_admin/backend/uploaded_images/9.jpg'
        WHEN `plateID` = 22 THEN 'http://localhost/final_db_admin/backend/uploaded_images/10.jpg'
        WHEN `plateID` = 23 THEN 'http://localhost/final_db_admin/backend/uploaded_images/11.jpg'
        WHEN `plateID` = 24 THEN 'http://localhost/final_db_admin/backend/uploaded_images/1.jpg'
        ELSE `imageUrl` -- This will keep the current value if the plateID does not match any of the above
    END
WHERE `plateID` BETWEEN 13 AND 24;
