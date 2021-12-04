CREATE DATABASE if not exists bugme;
USE bugme;

CREATE table Users(
	id        INT AUTO_INCREMENT NOT NULL,
	firstname VARCHAR(15),
	lastname  VARCHAR(15),
	password  VARCHAR(255),
	email     VARCHAR(40),
	date_joined DATETIME,
	PRIMARY KEY(id)
);

CREATE table Issues(
	id     INT AUTO_INCREMENT NOT NULL,
	title  VARCHAR(40),
	description   text,
	type   VARCHAR(10),
	priority VARCHAR(40),
	status   VARCHAR(40),
	assigned_to    INT,
	created_by     INT,
	created   DATETIME,
	updated   DATETIME,
	PRIMARY KEY(id),
	FOREIGN KEY(created_by) REFERENCES Users(id)
);
INSERT INTO Users VALUES('00','David','Luiz',old_password('password123'),'admin@project2.com',CURRENT_DATE());
