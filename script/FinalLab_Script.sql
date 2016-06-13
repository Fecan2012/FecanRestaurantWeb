CREATE DATABASE wp_eatery;
GRANT USAGE ON *.* TO wp_eatery@localhost IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON wp_eatery.* TO wp_eatery@localhost;
FLUSH PRIVILEGES;

USE wp_eatery;

CREATE TABLE mailingList(
	_id int not null AUTO_INCREMENT,
	customerName VARCHAR(50) NOT NULL,
	phoneNumber VARCHAR(15) NOT NULL,
	emailAddress VARCHAR(100) NOT NULL,
	referrer VARCHAR(15) NOT NULL,
	PRIMARY KEY (_id)
	);

CREATE TABLE adminusers(
	AdminID INT NOT NULL AUTO_INCREMENT,
	Username VARCHAR(50),
	Password VARCHAR(50),
	Lastlogin DATE,
	primary key(AdminID)
);

INSERT INTO adminusers (Username, Password) VALUES ('admin', 'passme');

ALTER TABLE mailinglist MODIFY COLUMN emailAddress VARCHAR(70) NOT NULL;