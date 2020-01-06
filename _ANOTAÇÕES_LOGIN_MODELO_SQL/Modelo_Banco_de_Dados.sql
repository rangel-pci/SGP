CREATE DATABASE lanchonete;
USE lanchonete;

CREATE TABLE if not exists itens(
   id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nome varchar(255) NOT NULL,
   preco double NOT NULL,
   img varchar(255) NOT NULL,
   descricao varchar(255) NOT NULL,
   categoria varchar(255) NOT NULL
);
CREATE TABLE if not exists usuario(
    login varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    admin int NOT NULL
);
CREATE TABLE if not exists pedido(
    id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
    cpf varchar(255) NOT NULL,
    itens varchar(255) NOT NULL,
    total double NOT NULL,
    data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status varchar(255) NOT NULL DEFAULT 'aberto'
);
INSERT INTO usuario (login, senha, admin) VALUES ('admin','bc1decbe538cf2bc5c3f62fca66f30e3',1);
INSERT INTO usuario (login, senha, admin) VALUES ('user','7ff3da9bd1a47965c0d6499afeb2ccde',0);