create database WallStreet;
use WallStreet;

create table Perfil(
id 				int primary key not null auto_increment,
Nome 			varchar(255) not null,
DataNascimento 	date,
Sexo 			varchar(10) not null,
CPF				varchar(14) not null,
Telefone 		varchar(15) not null,
Email 			varchar(200) not null,
Usuario			varchar(50) not null,
Senha			varchar(200) not null
);

select * from Perfil;

-- drop database WallStreet;
