# Suprression et recréation de la base de données
DROP DATABASE IF EXISTS RandoAddict;
CREATE DATABASE IF NOT EXISTS RandoAddict;


# Ouverture de la base de données
USE RandoAddict;


# Suppression de toutes les tables
DROP TABLE IF EXISTS Necessaire;
DROP TABLE IF EXISTS Participation;
DROP TABLE IF EXISTS Correspondance_Type;
DROP TABLE IF EXISTS Escale;
DROP TABLE IF EXISTS Traversee;
DROP TABLE IF EXISTS Photo;
DROP TABLE IF EXISTS Type;
DROP TABLE IF EXISTS Materiel;
DROP TABLE IF EXISTS Terrain;
DROP TABLE IF EXISTS Marcheur;
DROP TABLE IF EXISTS Programme;
DROP TABLE IF EXISTS Excursion;



# TABLES DE BASE (Entités du MCD)


# Table Excursion: Une randonnée incluant son chemin précis et son prix
#	Liaisons:
#		Photo (0,n)
#		Traversee (1,n) (liant avec Terrain)
#		Escale (0,n) (liant avec Programme)
CREATE TABLE IF NOT EXISTS Excursion(
	idExcursion int not null primary key auto_increment,					# identifiant unique de l'excursion
	labelExcursion varchar(128) not null,									# label (ou nom) de l'excursion
	descExcursion text not null,											# description de l'excursion
	departExcursion text not null,											# point de départ de l'excursion sur google maps
	arriveeExcursion text not null,											# point d'arrivée de l'excursion sur google maps
	prixExcursion decimal(10,2) not null CHECK(									# prix de l'excursion en euros
		prixExcursion >= 0														# on vérifie que le prix de l'excursion est positif ou nul
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Programme: Un programme avec une date et une heure de départ et d'arrivée, pouvant inclure une ou plusieurs Excursions
#	Liaisons:
#		Escale (1,n) (liant avec Excursion)
#		Correspondance_Type (1,n) (liant avec Type)
#		Participation (0,n) (liant avec Marcheur)
#		Necessaire (0,n) (liant avec materiel)
CREATE TABLE IF NOT EXISTS Programme(
	idProgramme int not null primary key auto_increment,					# identifiant unique du programme
	labelProgramme varchar(128) not null,									# label (ou nom) du programme
	descProgramme text not null,											# description du programme
	dateDepartProgramme datetime not null,									# date et heure de départ du programme
	dateArriveeProgramme datetime not null,									# date et heure d'arrivée du programme
	capaciteProgramme int not null CHECK(									# nombre de marcheurs pouvant participer au programme
		capaciteProgramme > 0													# on vérifie que le nombre de marcheurs pouvant participer au programme est strictement positif
	),
	difficulteProgramme int not null CHECK(									# difficulté du programme
		difficulteProgramme > 0
		AND																		# on vérifie que la difficulté du programme est comprise entre 1 et 9
		difficulteProgramme < 10
	),
	valideProgramme varchar(32) not null CHECK(								# paramètre vérifiant la validité du programme
		valideProgramme = 'En attente'
		OR
		valideProgramme = 'Valide'
		OR																		# on vérifie que le paramètre vérifiant la validité du programme est égal à l'une de ces 4 valeurs
		valideProgramme = 'Annule'
		OR
		valideProgramme = 'Termine'
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Marcheur: Un marcheur (ou utilisateur) avec une adresse e-mail, un pseudo, un mot de passe, un numéro de téléphone et un rôle
#	Liaisons:
#		Participation (0,n) (liant avec Programme)
CREATE TABLE IF NOT EXISTS Marcheur(
	mailMarcheur varchar(320) not null primary key,							# adresse e-mail de l'utilisateur/marcheur, lui servant également d'identifiant unique
	pseudoMarcheur varchar(128) not null,									# pseudo de l'utilisateur/marcheur
	telMarcheur varchar(12) not null,										# numéro de téléphone de l'utilisateur/marcheur
	mdpMarcheur varchar(128) not null,										# mot de passe de l'utilisateur/marcheur
	roleMarcheur varchar(128) not null CHECK (								# role de l'utilisateur/marcheur (s'il est simple marcheur ou s'il est guide)
		roleMarcheur = 'Marcheur'
		OR																		# on vérifie que le rôle de l'utilisateur/marcheur est bien "Marcheur", "Guide" ou "Admin"
		roleMarcheur = 'Guide'
		OR
		roleMarcheur = 'Admin'
	)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Terrain: Un type de terrain pouvant être parcouru lors d'une excursion, avec un label et une description
#	Liaisons:
#		Traversée (0,n) (liant avec Excursion)
CREATE TABLE IF NOT EXISTS Terrain(
	labelTerrain varchar(128) not null primary key,							# label (ou nom) du type de terrain, lui servant également d'identifiant unique
	descTerrain text not null												# description du type de terrain
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Materiel: Un materiel pouvant être nécessaire pour un ou plusieurs programme(s), avec un label et une description
#	Liaisons:
#		Necessaire (0,n) (liant avec Programme)
CREATE TABLE IF NOT EXISTS Materiel(
	labelMateriel varchar(128) not null primary key,						# label (ou nom) du matériel, lui servant également d'identifiant unique
	descMateriel text not null												# description du matériel
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Type: Un type de programme, avec un label et une description
#	Liaisons:
#		Correspondance_Type (0,n) (liant avec Programme)
CREATE TABLE IF NOT EXISTS Type(
	labelType varchar(128) not null primary key,							# label (ou nom) du type de programme, lui servant également d'identifiant unique
	descType text not null													# description du type de programme
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


# Table Photo: Une photo servant à présenter une excursion
#	Liaisons:
#		Excursion (0,n)
CREATE TABLE IF NOT EXISTS Photo(
	idPhoto int not null primary key auto_increment,						# identifiant unique de la photo
	lienPhoto varchar(256) not null,										# lien vers le fichier de la photo
	labelPhoto varchar(128) not null,										# label (ou nom) de la photo, pouvant servir également de placeholder
	idExcursion int not null,												# identifiant unique de l'excursion à laquelle la photo est liée
	CONSTRAINT fk_PhotoExcursion											# contrainte de clé étrangère pour l'identifiant de l'excursion
		FOREIGN KEY(idExcursion)
		REFERENCES Excursion(idExcursion)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;



# TABLES DE LIAISON (générées lors de la création du MLD)


CREATE TABLE IF NOT EXISTS Traversee(
	idExcursion int not null,												# identifiant unique de l'excursion à laquelle la traversée est liée
	labelTerrain varchar(128) not null,										# identifiant unique du type de terrain auquel la traversée est liée
	CONSTRAINT pk_Traversee 												# création de l'identifiant unique de la traversée à partir des identifiants de l'excursion et du terrain
		PRIMARY KEY(idExcursion, labelTerrain),
	CONSTRAINT fk_TraverseeExcursion										# contrainte de clé étrangère pour l'identifiant de l'excursion
		FOREIGN KEY(idExcursion)
		REFERENCES Excursion(idExcursion),
	CONSTRAINT fk_TraverseeTerrain											# contrainte de clé étrangère pour l'identifiant du terrain
		FOREIGN KEY(labelTerrain)
		REFERENCES Terrain(labelTerrain)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Escale(
	idExcursion int not null,												# identifiant unique de l'excursion à laquelle l'escale est liée
	idProgramme int not null,												# identifiant unique du programme auquel l'escale est liée
	ordreEscale int not null,												# definit l'ordre dans lequel les escales se font au sein d'un programme
	CONSTRAINT pk_Escale													# création de l'identifiant unique de l'escale à partir des identifiants de l'excursion et du programme
		PRIMARY KEY(idExcursion, idProgramme),
	CONSTRAINT fk_EscaleExcursion											# contrainte de clé étrangère pour l'identifiant de l'excursion
		FOREIGN KEY(idExcursion)
		REFERENCES Excursion(idExcursion),
	CONSTRAINT fk_EscaleProgramme											# contrainte de clé étrangère pour l'identifiant du programme
		FOREIGN KEY(idProgramme)
		REFERENCES Programme(idProgramme)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Correspondance_Type(
	idProgramme int not null,												# identifiant unique du programme auquel la correspondance de type est liée
	labelType varchar(128) not null,										# identifiant unique du type de programme auquel la correspondance de type est liée
	CONSTRAINT pk_CorresType												# création de l'identifiant unique de la correspondance de type à partir des identifiants du programme et du type de programme
		PRIMARY KEY(idProgramme, labelType),
	CONSTRAINT fk_CorresTypeProgramme										# contrainte de clé étrangère pour l'identifiant du programme
		FOREIGN KEY(idProgramme)
		REFERENCES Programme(idProgramme),
	CONSTRAINT fk_CorresTypeType											# contrainte de clé étrangère pour l'identifiant du type de programme
		FOREIGN KEY(labelType)
		REFERENCES Type(labelType)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Participation(
	idProgramme int not null,												# identifiant unique du programme auquel la participation est liée
	mailMarcheur varchar(320) not null,										# identifiant unique du marcheur auquel la participation est liée
	roleMarcheur varchar(128) not null CHECK(								# le role du marcheur pour sa participation
		roleMarcheur = 'Marcheur'
		OR
		roleMarcheur = 'Guide'
	),
	CONSTRAINT pk_Participation												# création de l'identifiant unique de la participation à partir des identifiants du programme et du marcheur
		PRIMARY KEY(idProgramme, mailMarcheur),
	CONSTRAINT fk_ParticipationProgramme									# contrainte de clé étrangère pour l'identifiant du programme
		FOREIGN KEY(idProgramme)
		REFERENCES Programme(idProgramme),
	CONSTRAINT fk_ParticipationMarcheur										# contrainte de clé étrangère pour l'identifiant du marcheur
		FOREIGN KEY(mailMarcheur)
		REFERENCES Marcheur(mailMarcheur)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


CREATE TABLE IF NOT EXISTS Necessaire(
	idProgramme int not null,												# identifiant unique du programme auquel le nécessaire est lié
	labelMateriel varchar(128) not null,									# identifiant unique du matériel auquel le nécessaire est lié
	CONSTRAINT pk_Necessaire												# création de l'identifiant unique du nécessaire à partir des identifiants du programme et du matériel
		PRIMARY KEY(idProgramme, labelMateriel),
	CONSTRAINT fk_NecessaireProgramme										# contrainte de clé étrangère pour l'identifiant du programme
		FOREIGN KEY(idProgramme)
		REFERENCES Programme(idProgramme),
	CONSTRAINT fk_NecessaireMateriel										# contrainte de clé étrangère pour l'identifiant du matériel
		FOREIGN KEY(labelMateriel)
		REFERENCES Materiel(labelMateriel)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
