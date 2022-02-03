drop database if exists videospielshop;
create database if not exists videospielshop;
use videospielshop;

drop table if exists videospiele;
CREATE TABLE IF NOT EXISTS videospiele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plattform int not null,
    titel VARCHAR(30) not null,
    beschreibung VARCHAR(50),
    preis DECIMAL(10, 2) not null,
    erscheinungsdatum date,
    bildlink VARCHAR(50)
);    
select * from videospiele;
select * from videospiele where plattform like '%3%' order by id;

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

INSERT INTO `videospielshop`.`users` (`email`, `passwort`) VALUES ('root@root.de', 'root');
INSERT INTO `videospielshop`.`users` (`email`, `passwort`, `vorname`, `nachname`, `kreditkartennummer`, `kreditkartendatum`, `cvv`) VALUES ('marc.seiler@siemens-energy.com', 'geheim', 'Marc', 'Seiler', '1234567891234567', '08/24', '331');



drop table if exists rechnungen;
CREATE TABLE IF NOT EXISTS rechnungen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_spiel int,
    id_kunde int,
    datum DATE NOT NULL,
    CONSTRAINT fk_rechnungen_kunden FOREIGN KEY (id_kunde)
        REFERENCES kunden (id),
	CONSTRAINT fk_rechnungen_videospiele FOREIGN KEY (id_spiel)
        REFERENCES videospiele (id)
); 
select * from rechnungen;


INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('1', 'CSGO', 'Online multiplayer shooter', '0.00', '2012-01-01', 'images/csgo.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('12', 'God of War', 'Singleplayer adventure game', '49.99', '2022-01-21', 'images/godofwar.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Grand Theft Auto V', 'Open-World adventure Spiel', '34.99', '2013-09-17', 'images/gtav.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Rocket League', 'Online multiplayer carsoccer', '00.00', '2015-07-07', 'images/rocketleague.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'The Witcher 3: Wild Hunt', 'Singleplayer adventure game', '39.99', '2022-05-18', 'images/thwitcher3.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Battlefront II', 'Online multiplayer shooter', '19.99', '2022-11-17', 'images/battlefront2.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'The Elder Scrolls Skyrim 5', 'Singleplayer adventure game', '15.99', '2011-11-11', 'images/skyrim5.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Dark Souls III', 'Singleplayer adventure game', '49.99', '2016-03-24', 'images/darksouls3.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Cities: Skylines', 'Singelplayer city-building simulator', '29.99', '2015-03-10', 'images/citiesskylines.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Cyberpunk 2077', 'Singleplayer cyberpunk adventure game', '39.99', '2020-09-17', 'images/cyberpunk2077.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Call of Duty: Black Ops 4', 'Online multiplayer shooter', '49.99', '2018-08-03', 'images/callofduty4.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Fifa 22', 'Online multiplayer soccer simulatior', '59.99', '2021-09-26', 'images/fifa22.png');
INSERT INTO `videospielshop`.`videospiele` (`plattform`, `titel`, `beschreibung`, `preis`, `erscheinungsdatum`, `bildlink`) VALUES ('123', 'Fallout 4', 'Singelplayer action rpg', '35.99', '2025-11-10', 'images/fallout4.png');



