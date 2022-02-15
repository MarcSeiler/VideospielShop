<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of videospielshopDBConnection
 *
 * @author z00479sx
 */
class VideospielshopDBConnection {
    protected static $pdo = null;

    public function __construct() {
        
        
        $dbhost = "localhost";
        $dbname = "videospielshop";
        $dbuser = "root";
        $dbpassword = ""; 
        
        
        if (VideospielshopDBConnection::$pdo == null)
        {
            try {
                //$pdo = new PDO('mysql:host=' . $dbhost , $dbuser, $dbpassword);
                VideospielshopDBConnection::$pdo = new PDO('mysql:host=' . $dbhost.";dbname=". $dbname, $dbuser, $dbpassword);
                VideospielshopDBConnection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {

                echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
            }
        }
    }

    public function getpdo()
    {
        return VideospielshopDBConnection::$pdo;
    }
    public function __get($s)
    {
/*        if ($s=="zinssatz")
        {
            return $this->zinssatz;
        }*/
        
        if ($s == "pdo")
        {
            return  VideospielshopDBConnection::$pdo;
        }
        if (property_exists($this, $s))
        {
            return $this->$s;
        }
        else
        {
            die("<br>unzulässiger Parameter: " . $s . "in Datei: " . __FILE__ . " Zeile:" . __LINE__ . "<br>");
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name))
        {
            $this->$name = $value;
        }
        else
        {
            die("<br>unzulässiger Parameter: " . $name . "in Datei: " . __FILE__ . " Zeile:" . __LINE__ . "<br>");
        }
    }


    public function query($sql, $format=PDO::FETCH_ASSOC)
    {
        try
        {
            $res = self::$pdo->query ($sql);
            $rows=$res->fetchall($format);
            //var_dump($rows);
            return $rows;
        } catch (Exception $ex) {
            echo __FILE__ . " " . __LINE__ . $ex->getMessage();
            die();
        }
    }


    public function exec($sql)
    {
        try
        {
            $res = self::$pdo->exec ($sql);
            return $res;
        } catch (Exception $ex) {
            echo __FILE__ . " " . __LINE__ . $ex->getMessage();
            die();
        }
    }
    
    
    public function savevideospiel($id, $plattform, $titel, $beschreibung, $preis, $erscheinungsdatum, $bildlink)
    {
        //echo $id;
        if ($id == -1)
        {
            if($plattform == 666)
            {
                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('1', 'CSGO', 'Online multiplayer shooter', '0.00', '2012-01-01', 'images/csgo.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('12', 'God of War', 'Singleplayer adventure game', '49.99', '2022-01-21', 'images/godofwar2022.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Grand Theft Auto V', 'Open-World adventure Spiel', '34.99', '2013-09-17', 'images/gtav.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Rocket League', 'Online multiplayer carsoccer', '00.00', '2015-07-07', 'images/rocketleague.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'The Witcher 3: Wild Hunt', 'Singleplayer adventure game', '39.99', '2022-05-18', 'images/thewitcher3.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Battlefront II', 'Online multiplayer shooter', '19.99', '2022-11-17', 'images/battlefront2.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'The Elder Scrolls Skyrim 5', 'Singleplayer adventure game', '15.99', '2011-11-11', 'images/skyrim5.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Dark Souls III', 'Singleplayer adventure game', '49.99', '2016-03-24', 'images/darksouls3.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Cities: Skylines', 'City-building simulator', '29.99', '2015-03-10', 'images/citiesskylines.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Cyberpunk 2077', 'Singleplayer adventure game', '39.99', '2020-09-17', 'images/cyberpunk2077.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Call of Duty: Black Ops 4', 'Online multiplayer shooter', '49.99', '2018-08-03', 'images/callofduty4.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Fifa 22', 'Online soccer simulatior', '59.99', '2021-09-26', 'images/fifa22.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();

                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('123', 'Fallout 4', 'Singelplayer action rpg', '35.99', '2025-11-10', 'images/fallout4.png')";
                echo $sql;
                self::$pdo->exec ($sql);
                return self::$pdo->lastInsertId();
            }
            else
            {
            
                //var_dump($preis);
                //var_dump($erscheinungsdatum);
                //var_dump($bildlink);


                $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('$plattform', '$titel', '$beschreibung', '$preis', '$erscheinungsdatum', '$bildlink')";
                //echo $sql;
                self::$pdo->exec ($sql);
                return self::$pdo->lastInsertId();
            }
        }
        else
        {
            //var_dump($preis);
            //var_dump($titel);
            //var_dump($beschreibung);
            
            $sql = "update videospiele set plattform = '$plattform', titel='$titel', beschreibung='$beschreibung'";
            
            if ($preis <> '')
                $sql = $sql . ", preis='$preis'";
            
            if ($erscheinungsdatum <> '')
                $sql = $sql . ", erscheinungsdatum='$erscheinungsdatum'";
            
            if ($bildlink <> '')
                $sql = $sql . ", bildlink='$bildlink'";
            
            
            $sql = $sql . " where id = $id";
            //echo $sql;
            self::$pdo->exec ($sql);
            return $id;
        }   
    }
    
    public function savekunde($id, $email, $passwort, $vorname, $nachname, $kreditkartennummer, $kreditkartendatum, $cvv)
    {
        //echo $id;
        if ($id == -1)
        {   
            if($vorname == 666)
            {
                $passwort_hash = password_hash('marc', PASSWORD_DEFAULT);
                $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('marc.seiler@siemens-energy.com', '$passwort_hash', 'Marc', 'Seiler', '0012033488765543', '12/24', '447')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();
                                
                $passwort_hash = password_hash('moritz', PASSWORD_DEFAULT);
                $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('moritz.popp@siemens.com', '$passwort_hash', 'Moritz', 'Popp', '0111023300768812', '04/25', '737')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();
              
                $passwort_hash = password_hash('fabian', PASSWORD_DEFAULT);
                $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('fabian.mayer@siemens.com', '$passwort_hash', 'Fabian', 'Mayer', '0111024408812807', '12/24', '900')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();
                
                $passwort_hash = password_hash('alex', PASSWORD_DEFAULT);
                $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('alexander.henning@siemens-energy.com', '$passwort_hash', 'Alexander', 'Henning', '0510215007608875', '12/24', '334')";
                echo $sql;
                self::$pdo->exec ($sql);
                self::$pdo->lastInsertId();
                
                $passwort_hash = password_hash('lucifer', PASSWORD_DEFAULT);
                $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('lucifer.teufel@derleibhaftige.com', '$passwort_hash', 'Lucifer', 'Teufel', '6666666666666666', '06/66', '666')";
                echo $sql;
                self::$pdo->exec ($sql);
                return self::$pdo->lastInsertId();
            }
            else
            {
                $sql = "select * from users where email = '$email'"; 
                try
                {
                    $res=self::$pdo->query($sql,PDO::FETCH_ASSOC);
                } catch (PDOException $e) {

                    echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
                    die();       
                }
                $rows=$res->fetchall();

                if(sizeof($rows) == 0)
                {
                    $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
                    $sql = "insert into users (email, passwort, vorname, nachname, kreditkartennummer, kreditkartendatum, cvv) values ('$email', '$passwort_hash', '$vorname', '$nachname', '$kreditkartennummer', '$kreditkartendatum', '$cvv')";
                    //echo $sql;
                    self::$pdo->exec ($sql);
                    return self::$pdo->lastInsertId();   
                }
                else {
                    echo "<div class='EmailVegeben'>Email wurde schon vergeben!</div>";
                }   
            }
        }
        else
        {
            $arr1 = str_split($passwort, 7);
            //var_dump($arr1[0]);
            //var_dump($arr1[1]);
            if(!($arr1[0] == '$2y$10$'))
            {
                $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
            }
            else
            {
                $passwort_hash = $passwort;
            }
            
            $sql = "update users set email = '$email'";
            
            if ($passwort <> '')
                $sql = $sql . ", passwort='$passwort_hash'";
            
            if ($vorname <> '')
                $sql = $sql . ", vorname='$vorname'";
            
            if ($nachname <> '')
                $sql = $sql . ", nachname='$nachname'";
            
            if ($kreditkartennummer <> '')
                $sql = $sql . ", kreditkartennummer='$kreditkartennummer'";
                        
            if ($kreditkartendatum <> '')
                $sql = $sql . ", kreditkartendatum='$kreditkartendatum'";
            
            if ($cvv <> '')
                $sql = $sql . ", cvv='$cvv'";
                        
            $sql = $sql . " where id = $id";
            //echo $sql;
            self::$pdo->exec ($sql);
            return $id;
        }   
            
        
    }
}
