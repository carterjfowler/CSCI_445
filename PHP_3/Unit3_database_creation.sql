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
	Name varchar(255) PRIMARY KEY,
	Price float NOT NULL,
	Quantity int NOT NULL,
	Image varchar(255) NOT NULL
);

CREATE TABLE orders (
	OrderTime bigint PRIMARY KEY,
	Product varchar(255) NOT NULL,
	Price double NOT NULL,
	CustomerFirstName varchar(255) NOT NULL,
	CustomerLastName varchar(255) NOT NULL,
	Quantity int NOT NULL,
	Tax double NOT NULL,
	Donation double NOT NULL,
	FOREIGN KEY (Product) REFERENCES products(Name),
	FOREIGN KEY (CustomerFirstName, CustomerLastName) REFERENCES customers(FirstName, LastName)
);

INSERT INTO products (Name, Price, Quantity, Image)
VALUES ("Cherry Dice Vault", 33.0, 30, "images/cherry_dice_vault.jpg");

INSERT INTO products (Name, Price, Quantity, Image)
VALUES ("Black Walnut Dice Vault", 40.0, 20, "images/black_walnut_dice_vault.jpg");

INSERT INTO products (Name, Price, Quantity, Image)
VALUES ("Paudauk Dice Vault", 43.0, 10, "images/paudauk_dice_vault.jpg");

INSERT INTO customers (FirstName, LastName, Email)
VALUES ("Carter", "Fowler", "carterjfowler@gmail.com");

INSERT INTO customers (FirstName, LastName, Email)
VALUES ("Aethon", "Misty", "test@gmail.com");