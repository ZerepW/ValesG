CREATE DATABASE VALES;
USE VALES;

CREATE TABLE vale(
	idVale int NOT NULL AUTO_INCREMENT,
	folioVale varchar(30) UNIQUE,
	mes int,
	yearV int,
	emisor varchar(30),
	receptor varchar(30),
	cantidad int,
	bomba int,
	PRIMARY KEY(idVale)
);