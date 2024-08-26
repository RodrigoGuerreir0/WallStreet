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

create table Endereco(
id 				int primary key not null auto_increment,
idUsuario 		int,
Apelido			varchar(100),
Cep				varchar(9),
Rua				varchar(50),
Bairro			varchar(100),
Cidade			varchar(100),
Estado 			varchar(50),
Numero 			int(5),
Referencia		varchar(200)
);

create table Vagas(
id 				int primary key not null auto_increment,
Vaga int,
StatusDaVaga varchar(7)
);

insert into Vagas(Vaga, StatusDaVaga) values("1","Livre"),
											("2","Livre"),
											("3","Livre");

select * from Endereco;

-- drop database WallStreet;
