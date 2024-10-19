create database WallStreet;
use WallStreet;

create table Perfil(
id 				int primary key not null auto_increment,
Nome 			varchar(255) not null,
DataNascimento 	date,
Genero 			varchar(10) not null,
CPF				varchar(14) not null,
Telefone 		varchar(15) not null,
Email 			varchar(200) not null,
Usuario			varchar(50) not null,
Senha			varchar(200) not null,
Funcao			varchar(20) not null
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
Numero 			int(5)
);

CREATE TABLE Vagas (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Vaga INT NOT NULL,
    StatusDaVaga VARCHAR(10) NOT NULL CHECK (StatusDaVaga IN ('Livre', 'Ocupado')),
    Latitude DECIMAL(9, 6), -- Usado para geocoding
    Longitude DECIMAL(9, 6) -- Usado para geocoding
);


INSERT INTO Vagas (Vaga, StatusDaVaga, Latitude, Longitude) VALUES
							(1, 'Livre', -22.757002, -47.383958),
							(2, 'Ocupado', -22.758082, -47.383189),
							(3, 'Livre', -22.757866, -47.384484);
							
INSERT INTO Perfil(Nome, Email, Usuario, Senha, Funcao) VALUES("Rodrigo", "admim@gmail.com", "ADMINISTRADOR", "admim", "AdministradorGERAL");


select * from Perfil;
select * from Endereco;
select * from Vagas;

-- drop table Perfil;
-- drop table Endereco;
-- drop table Vagas;

-- drop database WallStreet;
