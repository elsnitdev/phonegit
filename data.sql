

-- Tạo bảng Users
CREATE TABLE Users (
    UserID INT  AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50),
    Password VARCHAR(32),
    Email VARCHAR(30),
    Fullname VARCHAR(30),
    Address VARCHAR(100),
    Phone VARCHAR(11),
    Sex VARCHAR(7)
    Active BOOLEAN
);

-- Tạo bảng Products
CREATE TABLE Products (
    ProductID INT PRIMARY KEY,
    Name VARCHAR(30),
    Description VARCHAR(250),
    Price DECIMAL(10,2),
    Brand VARCHAR(30),
    Category INT,
    Image VARCHAR(300)
);

-- Tạo bảng Orders
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    UserID INT,
    OrderDate DATETIME,
    TotalAmount DECIMAL(10,2),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Tạo bảng OrderDetails
CREATE TABLE OrderDetails (
    OrderDetailID INT PRIMARY KEY,
    OrderID INT,
    ProductID INT,
    Quantity INT,
    Price DECIMAL(10,2),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);