use f20_carterjfowler;
DROP TABLE IF EXISTS orders CASCADE;
DROP TABLE IF EXISTS customers CASCADE;
DROP TABLE IF EXISTS products CASCADE;


CREATE TABLE customers (
	FirstName varchar(255) NOT NULL,
	LastName varchar(255) NOT NULL,
	Email varchar(255) NOT NULL,
	CONSTRAINT PK_Customer PRIMARY KEY (FirstName, LastName)
);

CREATE TABLE products (
	Id int AUTO_INCREMENT PRIMARY KEY,
	Name varchar(255) NOT NULL,
	Price int NOT NULL,
	Quantity int NOT NULL,
	Image varchar(255) NOT NULL,
	Inactive boolean NOT NULL
);

CREATE TABLE orders (
	OrderTime bigint PRIMARY KEY,
	Product int NOT NULL,
	Price double NOT NULL,
	CustomerFirstName varchar(255) NOT NULL,
	CustomerLastName varchar(255) NOT NULL,
	Quantity int NOT NULL,
	Tax double NOT NULL,
	Donation double NOT NULL,
	FOREIGN KEY (Product) REFERENCES products(Id),
	FOREIGN KEY (CustomerFirstName, CustomerLastName) REFERENCES customers(FirstName, LastName)
);

INSERT INTO products (Name, Price, Quantity, Image, Inactive)
VALUES ("Cherry Dice Vault", 33, 30, "images/cherry_dice_vault.jpg", false);

INSERT INTO products (Name, Price, Quantity, Image, Inactive)
VALUES ("Black Walnut Dice Vault", 40, 20, "images/black_walnut_dice_vault.jpg", false);

INSERT INTO products (Name, Price, Quantity, Image, Inactive)
VALUES ("Paudauk Dice Vault", 43, 10, "images/paudauk_dice_vault.jpg", false);

INSERT INTO customers (FirstName, LastName, Email)
VALUES ("Carter", "Fowler", "carterjfowler@gmail.com");

INSERT INTO customers (FirstName, LastName, Email)
VALUES ("Aethon", "Misty", "test@gmail.com");