drop database if exists iris_scolarite_JV_23;
create database iris_scolarite_JV_23;
use iris_scolarite_JV_23;

create table classe (
    idclasse int(3) not null auto_increment,
    nom varchar (50),
    salle varchar(50),
    diplome varchar(50),
    primary key (idclasse)
);

create table etudiant (
    idetudiant int(3) not null auto_increment,
    nom varchar (50),
    prenom varchar(50),
    email varchar(50),
    idclasse int(3) not null,
    primary key (idetudiant),
    foreign key (idclasse) references classe(idclasse)
);

create table professeur (
    idprofesseur int(3) not null auto_increment,
    nom varchar (50),
    prenom varchar(50),
    diplome varchar(50),
    primary key (idprofesseur)
);

create table enseignement (
    idenseignement int(3) not null auto_increment,
    matiere varchar (50),
    nbheures int(3),
    coef int(3),
    idclasse int(3) not null,
    idprofesseur int(3) not null,
    primary key (idenseignement),
    foreign key (idclasse) references classe(idclasse),
    foreign key (idprofesseur) references professeur(idprofesseur)
);

insert into classe values 
(null, "SIO 2A", "Salle 3.10", "BTS SIO SLAM"),
(null, "SIO 2B", "Salle 3.8", "BTS SIO SLAM");

insert into etudiant values
(null, "Ryad", "Thamila", "a@gmail.com", 1),
(null, "Louis", "Alexis", "b@gmail.com", 1);

insert into professeur values 
(null, "Ben", "Oka", "Bac"),
(null, "Chouaky", "Abdel", "Bac");

insert into enseignement values 
(null, "Java", 220, 4, 1, 1),
(null, "BDD", 120, 3, 1, 2),
(null, "Java", 200, 4, 2, 1),
(null, "BDD", 120, 3, 2, 2);

create table user (
    iduser int(3) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email varchar(50),
    mdp varchar(50),
    role enum("admin", "user"),
    primary key (iduser)
);

insert into user values 
(null, "Ryad", "Thamila", "a@gmail.com", "123", "admin"),
(null, "Sharif", "Dylan", "b@gmail.com", "456", "user");


-- liste des noms des classes avec le nombres d'étudiants par classe

create view classesEtudiants as (
    select c.nom, c.salle, count(e.idetudiant) as nb
    from classe c, etudiant e
    where c.idclasse = e.idclasse
    group by c.nom, c.salle
);


--- Hachage par md5
update user set mdp= md5(mdp);

-- Remise des anciens mdp

update user set mdp="123" where iduser = 1;
update user set mdp="456" where iduser = 2;

-- Hachage en sha1
update user set mdp = sha1(mdp);

-- Grain de sel 
create table grainSel (
    nb varchar(100) not null,
    primary key (nb)
);

insert into grainSel values("124587292670897");


drop trigger insertUser;
delimiter $
create trigger insertUser before insert on user 
for each row 
begin
    declare pnb varchar(100);
    select nb into pnb from grainSel;

    set new.mdp = sha1(concat(new.mdp, pnb));
end $
delimiter ;


--- Travail de mots de passe historisés avec vérification
create table historique (
    idmdp int(10) not null auto_increment,
    mdp varchar(200),
    iduser int(3) not null, 
    primary key(idmdp),
    foreign key (iduser) references user (iduser)
);

drop trigger if exists insertHistorique;

delimiter $
create trigger insertHistorique before update on user
for each row 
begin 
    declare pnb varchar(100);
    select nb into pnb from grainSel;
    set new.mdp = sha1(concat(new.mdp, pnb));
    if new.mdp != old.mdp then
        insert into historique values (null, old.mdp, old.iduser);
    end if; 
end $
delimiter ;

update user set mdp = "456" where iduser = 5;

update user set mdp = "678" where iduser = 5;

update user set mdp = "345" where iduser = 5;

update user set mdp = "234" where iduser = 5;

-- Ajout de l'attribut date et un flag : actif oui / non 
alter table user add datemdp date;
alter table user add actif boolean;

update user set datemdp ="2022-11-1";
update user set actif = 1;


-- a@gmail.com 
-- mdp : 000

-- b@gmail.com
-- mdp : 123
