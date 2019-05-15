/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     15/05/2019 11:10:14                          */
/*==============================================================*/

drop database moza;
create database moza;
use moza;

/*==============================================================*/
/* Table: client                                                */
/*==============================================================*/
create table client
(
   id_client            int(25) not null auto_increment,
   nom                  varchar(25),
   prenom               varchar(25),
   adresse              varchar(25),
   num_telephone        varchar(25),
   primary key (id_client)
);

/*==============================================================*/
/* Table: client_commande                                       */
/*==============================================================*/
create table client_commande
(
   id_client_commande   int(25) not null auto_increment,
   id_journee           int(25),
   id_client            int(25),
   primary key (id_client_commande)
);

/*==============================================================*/
/* Table: commande_detail                                       */
/*==============================================================*/
create table commande_detail
(
   id_commande_detail   int(25) not null auto_increment,
   id_journee           int(25),
   qte_initiale         int,
   qte_sortie           int,
   id_produit_prix_dd   int(25),
   qte_vendue_dd        int,
   id_produit_prix_dg   int(25),
   qte_vendue_dg        int,
   id_produit_prix_sg   int(25),
   qte_vendue_sg        int,
   primary key (id_commande_detail)
);

/*==============================================================*/
/* Table: journne                                               */
/*==============================================================*/
create table journee
(
   id_journee           int(25) not null auto_increment,
   id_vendeur           int(25),
   date                 date,
   recette              int,
   primary key (id_journee)
);

/*==============================================================*/
/* Table: produit                                               */
/*==============================================================*/
create table produit
(
   id_produit           int(25) not null auto_increment,
   id_produit_marge     int(25),
   nom                  varchar(25),
   primary key (id_produit)
);
INSERT INTO `produit` (`id_produit`, `nom`) VALUES
(1, 'EAU 1.5'),
(2, 'EAU 0,5'),
(3, 'VICHY NATURE 1,25'),
(5, 'BGA VICHY NATURE 0.25'),
(6, 'BGA MONTHE 0.25'),
(7, 'BAG CITRON 0.25'),
(8, 'BGA GRENADINE 0.25'),
(9, 'BGA CIT MONTHE 0.25'),
(10, 'BAG ORANGE 0.25'),
(11, 'BAG ZESTE 0.25'),
(12, 'BAG BITTER 0.25'),
(14, 'FARD NATURE 0.25'),
(15, 'FARD MONTHE 0.25'),
(16, 'FARD CITRON 0.25'),
(17, 'FARD GRENADINE 0.25'),
(18, 'FARD CIT MONTHE 0.25'),
(19, 'FARD ORANGE 0.25'),
(20, 'FARD ZESTE 0.25'),
(21, 'FARD BITTER 0.25'),
(23, 'Vichy Aromatisee 1.25');

/*==============================================================*/
/* Table: produit_marge                                         */
/*==============================================================*/
create table produit_marge
(
   id_produit_marge     int(25) not null auto_increment,
   nom                  varchar(30),
   benefice             int,
   primary key (id_produit_marge)
);

insert into produit_marge(nom,benefice) value ('Eau',5),('Vichy',10),('BGA / FARD',20);

/*==============================================================*/
/* Table: produit_prix                                          */
/*==============================================================*/
create table produit_prix
(
   id_produit_prix      int(25) not null auto_increment,
   id_produit           int(25),
   id_produit_prix_type int(25),
   prix                 int,
   date                 date,
   primary key (id_produit_prix)
);
INSERT INTO `produit_prix` (`id_produit_prix`, `id_produit`, `id_produit_prix_type`, `prix`, `date`) VALUES
(1, 1, 1, 150, '2019-05-11'),
(2, 1, 2, 0, '2019-05-11'),
(3, 1, 3, 0, '2019-05-11'),
(4, 2, 1, 140, '2019-05-11'),
(5, 2, 2, 0, '2019-05-11'),
(6, 2, 3, 0, '2019-05-11'),
(7, 3, 1, 150, '2019-05-11'),
(8, 3, 2, 0, '2019-05-11'),
(9, 3, 3, 0, '2019-05-11'),
(10, 5, 1, 370, '2019-05-11'),
(11, 5, 2, 0, '2019-05-11'),
(12, 5, 3, 0, '2019-05-11'),
(13, 6, 1, 630, '2019-05-11'),
(14, 6, 2, 0, '2019-05-11'),
(15, 6, 3, 0, '2019-05-11'),
(16, 7, 1, 630, '2019-05-11'),
(17, 7, 2, 0, '2019-05-11'),
(18, 7, 3, 0, '2019-05-11'),
(19, 8, 1, 630, '2019-05-11'),
(20, 8, 2, 0, '2019-05-11'),
(21, 8, 3, 0, '2019-05-11'),
(22, 9, 1, 630, '2019-05-11'),
(23, 9, 2, 0, '2019-05-11'),
(24, 9, 3, 0, '2019-05-11'),
(25, 10, 1, 630, '2019-05-11'),
(26, 10, 2, 0, '2019-05-11'),
(27, 10, 3, 0, '2019-05-11'),
(28, 11, 1, 630, '2019-05-11'),
(29, 11, 2, 0, '2019-05-11'),
(30, 11, 3, 0, '2019-05-11'),
(31, 12, 1, 630, '2019-05-11'),
(32, 12, 2, 0, '2019-05-11'),
(33, 12, 3, 0, '2019-05-11'),
(37, 14, 1, 260, '2019-05-11'),
(38, 14, 2, 0, '2019-05-11'),
(39, 14, 3, 0, '2019-05-11'),
(40, 16, 1, 435, '2019-05-11'),
(41, 16, 2, 0, '2019-05-11'),
(42, 16, 3, 0, '2019-05-11'),
(43, 15, 1, 435, '2019-05-11'),
(44, 15, 2, 0, '2019-05-11'),
(45, 15, 3, 0, '2019-05-11'),
(46, 17, 1, 435, '2019-05-11'),
(47, 17, 2, 0, '2019-05-11'),
(48, 17, 3, 0, '2019-05-11'),
(49, 18, 1, 435, '2019-05-11'),
(50, 18, 2, 0, '2019-05-11'),
(51, 18, 3, 0, '2019-05-11'),
(52, 19, 1, 435, '2019-05-11'),
(53, 19, 2, 0, '2019-05-11'),
(54, 19, 3, 0, '2019-05-11'),
(55, 20, 1, 435, '2019-05-11'),
(56, 20, 2, 0, '2019-05-11'),
(57, 20, 3, 0, '2019-05-11'),
(58, 21, 1, 435, '2019-05-11'),
(59, 21, 2, 0, '2019-05-11'),
(60, 21, 3, 0, '2019-05-11'),
(61, 14, 1, 260, '2019-05-11'),
(62, 14, 2, 0, '2019-05-11'),
(63, 14, 3, 0, '2019-05-11'),
(64, 1, 1, 160, '2019-05-11'),
(65, 1, 1, 150, '2019-05-11'),
(69, 6, 2, 610, '2019-05-13'),
(70, 6, 3, 590, '2019-05-13'),
(71, 1, 1, 130, '2019-05-13'),
(72, 1, 2, 124, '2019-05-13'),
(73, 1, 3, 119, '2019-05-13'),
(74, 2, 1, 150, '2019-05-13'),
(75, 2, 2, 145, '2019-05-13'),
(76, 2, 3, 140, '2019-05-13'),
(77, 3, 1, 160, '2019-05-13'),
(78, 3, 2, 155, '2019-05-13'),
(79, 3, 3, 150, '2019-05-13'),
(80, 5, 2, 350, '2019-05-13'),
(81, 5, 3, 328, '2019-05-13'),
(82, 7, 2, 610, '2019-05-13'),
(83, 7, 3, 590, '2019-05-13'),
(84, 8, 2, 610, '2019-05-13'),
(85, 8, 3, 590, '2019-05-13'),
(86, 9, 2, 610, '2019-05-13'),
(87, 9, 3, 590, '2019-05-13'),
(88, 10, 2, 610, '2019-05-13'),
(89, 10, 3, 590, '2019-05-13'),
(90, 11, 2, 610, '2019-05-13'),
(91, 11, 3, 590, '2019-05-13'),
(92, 12, 2, 610, '2019-05-13'),
(93, 12, 3, 590, '2019-05-13'),
(96, 14, 2, 230, '2019-05-13'),
(97, 14, 3, 205, '2019-05-13'),
(98, 15, 2, 410, '2019-05-13'),
(99, 15, 3, 395, '2019-05-13'),
(100, 16, 2, 410, '2019-05-13'),
(101, 16, 3, 395, '2019-05-13'),
(102, 17, 2, 410, '2019-05-13'),
(103, 17, 3, 395, '2019-05-13'),
(104, 18, 2, 410, '2019-05-13'),
(105, 18, 3, 395, '2019-05-13'),
(106, 19, 2, 410, '2019-05-13'),
(107, 19, 3, 395, '2019-05-13'),
(108, 20, 2, 410, '2019-05-13'),
(109, 20, 3, 395, '2019-05-13'),
(110, 21, 2, 410, '2019-05-13'),
(111, 21, 3, 395, '2019-05-13'),
(112, 23, 1, 320, '2019-05-13'),
(113, 23, 2, 310, '2019-05-13'),
(114, 23, 3, 300, '2019-05-13');

/*==============================================================*/
/* Table: produit_prix_type                                     */
/*==============================================================*/
create table produit_prix_type
(
   id_produit_prix_type int(25) not null auto_increment,
   nom                  varchar(25),
   primary key (id_produit_prix_type)
);
INSERT INTO `produit_prix_type` (`id_produit_prix_type`, `nom`) VALUES
(1, 'D.D'),
(2, 'Demi - Gros'),
(3, 'Super-gros');
/*==============================================================*/
/* Table: stock_vehicule                                        */
/*==============================================================*/
create table stock_vehicule
(
   id_vehicule          int(25) not null,
   id_produit           int(25) not null,
   quantite             int,
   primary key (id_vehicule, id_produit)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   id_user              int(25) not null,
   nom                  varchar(30),
   prenom               varchar(30),
   profession           varchar(30),
   email                varchar(30),
   password             varchar(35),
   droit_acces          int,
   primary key (id_user)
);
INSERT INTO `user` (`id_user`, `nom`, `prenom`, `profession`, `email`, `password`, `droit_acces`) VALUES
(1, 'Foura', 'Oussama', 'Directeur commercial', 'oussamafoura', 'c4ca4238a0b923820dcc509a6f75849b', 1);

/*==============================================================*/
/* Table: vehicule                                              */
/*==============================================================*/
create table vehicule
(
   id_vehicule          int(25) not null auto_increment,
   nom                  varchar(35),
   matricule            varchar(35),
   primary key (id_vehicule)
);
INSERT INTO `vehicule` (`id_vehicule`, `nom`, `matricule`) VALUES
(1, 'Master 1', '0001'),
(2, 'Master 2', '0002'),
(3, 'Master 3', '0003'),
(4, 'Master 4', '0004'),
(5, 'R.P', '0005');
/*==============================================================*/
/* Table: vendeur                                               */
/*==============================================================*/
create table vendeur
(
   id_vendeur           int(25) not null auto_increment,
   id_vehicule          int(25),
   nom                  varchar(30),
   prenom               varchar(30),
   telephone            varchar(30),
   primary key (id_vendeur)
);
INSERT INTO `vendeur` (`id_vendeur`, `id_vehicule`, `nom`, `prenom`, `telephone`) VALUES
(5, 1, ' Mazouzi ', 'Hassen', '0');

alter table client_commande add constraint FK_Reference_16 foreign key (id_journee)
      references journee (id_journee) on delete cascade on update cascade;

alter table client_commande add constraint FK_Reference_17 foreign key (id_client)
      references client (id_client) on delete cascade on update cascade;

alter table commande_detail add constraint FK_Reference_13 foreign key (id_produit_prix_dd)
      references produit_prix (id_produit_prix) on delete restrict on update restrict;

alter table commande_detail add constraint FK_Reference_14 foreign key (id_produit_prix_dg)
      references produit_prix (id_produit_prix) on delete restrict on update restrict;

alter table commande_detail add constraint FK_Reference_15 foreign key (id_journee)
      references journee (id_journee) on delete cascade on update cascade;

alter table commande_detail add constraint FK_Reference_18 foreign key (id_produit_prix_sg)
      references produit_prix (id_produit_prix) on delete restrict on update restrict;

alter table journee add constraint FK_Reference_11 foreign key (id_vendeur)
      references vendeur (id_vendeur) on delete cascade on update cascade;

alter table produit add constraint FK_Reference_19 foreign key (id_produit_marge)
      references produit_marge (id_produit_marge) on delete restrict on update restrict;

alter table produit_prix add constraint FK_Reference_1 foreign key (id_produit)
      references produit (id_produit) on delete cascade on update cascade;

alter table produit_prix add constraint FK_Reference_10 foreign key (id_produit_prix_type)
      references produit_prix_type (id_produit_prix_type) on delete restrict on update restrict;

alter table stock_vehicule add constraint FK_Reference_6 foreign key (id_vehicule)
      references vehicule (id_vehicule) on delete cascade on update cascade;

alter table stock_vehicule add constraint FK_Reference_7 foreign key (id_produit)
      references produit (id_produit) on delete cascade on update cascade;

alter table vendeur add constraint FK_Reference_8 foreign key (id_vehicule)
      references vehicule (id_vehicule) on delete restrict on update restrict;

