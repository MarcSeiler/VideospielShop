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
        echo $id;
        if ($id == -1)
        {
            var_dump($preis);
            var_dump($erscheinungsdatum);
            var_dump($bildlink);
            
                    
            $sql = "insert into videospiele (plattform, titel, beschreibung, preis, erscheinungsdatum, bildlink) values ('$plattform', '$titel', '$beschreibung', '$preis', '$erscheinungsdatum', '$bildlink')";
            echo $sql;
            self::$pdo->exec ($sql);
            return self::$pdo->lastInsertId();
        }
        else
        {
            var_dump($preis);
            var_dump($titel);
            
            $sql = "update videospiele set plattform = '$plattform', titel='$titel'";
            
            if ($beschreibung <> '')
                $sql = $sql . ", beschreibung='$beschreibung'";
            
            if ($preis <> '')
                $sql = $sql . ", preis='$preis'";
            
            if ($erscheinungsdatum <> '')
                $sql = $sql . ", erscheinungsdatum='$erscheinungsdatum'";
            
            if ($bildlink <> '')
                $sql = $sql . ", bildlink='$bildlink'";
            
            
            $sql = $sql . " where id = $id";
            echo $sql;
            self::$pdo->exec ($sql);
            return $id;
        }   
            
        
    }
}
