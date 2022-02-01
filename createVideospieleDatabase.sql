drop database if exists videospielshop;
create database if not exists videospielshop;
use videospielshop;

drop table if exists videospiele;
CREATE TABLE IF NOT EXISTS videospiele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plattform int not null,
    titel VARCHAR(20) not null,
    beschreibung VARCHAR(30),
    preis DECIMAL(10, 2) not null,
    erscheinungsdatum date,
    bildlink VARCHAR(100)
);    
select * from videospiele;

Drop table if exists users;
CREATE TABLE if not exists users ( 
  id INT NOT NULL AUTO_INCREMENT ,
  email VARCHAR(255) NOT NULL ,
  passwort VARCHAR(255) NOT NULL ,
  vorname VARCHAR(255) NOT NULL DEFAULT '' ,
  nachname VARCHAR(255) NOT NULL DEFAULT '' ,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  updated_at TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  kreditkartennummer VARCHAR(16) not null,
  kreditkartendatum VARCHAR(5) not null,
  cvv int(3) not null,
  PRIMARY KEY (id), UNIQUE (email)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
select * from users;




drop table if exists rechnungen;
CREATE TABLE IF NOT EXISTS rechnungen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kunde int,
    datum DATE NOT NULL,
    CONSTRAINT fk_rechnungen_kunden FOREIGN KEY (id_kunde)
        REFERENCES kunden (id)
); 
select * from rechnungen;


INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('1', 'CSGO', 'Online multiyplayer shooter', '0.00', '2012-01-01', 'images/csgo.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('12', 'God of War', 'Singleplayer adventure game', '49.99', '2022-01-21-', 'images/godofwar.png');



