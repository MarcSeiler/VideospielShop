drop database if exists videospielshop;
create database if not exists videospielshop;
use videospielshop;

drop table if exists videospiele;
CREATE TABLE IF NOT EXISTS videospiele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plattform int,
    titel VARCHAR(20),
    beschreibung VARCHAR(30),
    preis DECIMAL(10, 2),
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
  kreditkartenname VARCHAR(40) not null,
  sicherheitsnummer int(3) not null,
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



INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `bildlink`) VALUES ('1', 'CSGO', 'Online multiplayer shooter', '00.00', 'images/csgo.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `bildlink`) VALUES ('2', 'Forza Horizon 2', 'Online racing simulator', '19.99', 'images/forza2.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `bildlink`) VALUES ('3', 'Horizon Forbidden West', 'Singelplayer adventure game', '59.99', 'images/horizon2.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `bildlink`) VALUES ('123', 'Dark Souls III', 'Singelplayer adventure game', '59.99', 'images/darksouls3.png');

INSERT INTO `videospielshop`.`users` (`email`, `passwort`, `kreditkartennummer`, `kreditkartendatum`, `kreditkartenname`, `sicherheitsnummer`) VALUES ('test@test.de', '$2y$10$qCgb4MKzbMKAqUU2LOFBQ.wGoAD6yBElFA7V7EPwK.QGCViJjx4mu', '0123 4567 8910 1112', '08.24', 'Fabian Mayer', '331');

