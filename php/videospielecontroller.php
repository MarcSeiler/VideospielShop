<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class videospielecontroller
{
    function __construct()
    {
        
    }
    
    function run()
    {
        require_once("php\cls_Autoloader.php");

        $p = new videospieleshopDBparameter();
        //var_dump($p);
        $dbconn = new VideospielshopDBConnection();
        $pdo=$dbconn->pdo;


        $id = -1;
        $plattform = '';
        $titel="";
        $beschreibung="";
        $preis='';
        $erscheinungsdatum=date("Y-m-d");
        $bildlink="";

        //echo $p->action;
        //echo $p->mid;


        $success=true;
        $message="";

        if ($p->action == "delete")
        {

            $sql = "delete from videospiele where id = {$p->mid}";
            $res=$dbconn->exec($sql);
            $p->action="next";

        }

        if ($p->action=="speichern")
        {
            //var_dump($p);
            $id=$dbconn->savevideospiel($p->mid, $p->plattform, $p->titel, $p->beschreibung, $p->preis, $p->erscheinungsdatum, $p->bildlink);
            $sql = "select * from videospiele where id = $id";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }

        }

        if ($p->action == "next")
        {
            $sql = "select * from videospiele where id > {$p->mid} order by id limit 1";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }
            else
            {
                $p->action="show";
            }

        }
        if ($p->action == "previous")
        {
            $sql = "select * from videospiele where id < {$p->mid} order by id desc limit 1";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }
            else
            {
                $p->action="show";
            }

        }

        if ($p->action == "last")
        {
            $sql = "select * from videospiele  order by id desc limit 1";
            $rows=$dbconn->query($sql);

            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }

        }
    

        if ($p->action == "show")
        {

            $sql = "select * from videospiele where id = {$p->mid}";

            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }
            else
            {
                $p->action="first";
            }

        }
        if ($p->action == "first")
        {
            $sql = "select * from videospiele order by id asc limit 1";
            $rows=$dbconn->query($sql);

            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $plattform= $rows[0]["plattform"];
                $titel= $rows[0]["titel"];
                $beschreibung= $rows[0]["beschreibung"];
                $preis= $rows[0]["preis"];
                $erscheinungsdatum= $rows[0]["erscheinungsdatum"];
                $bildlink= $rows[0]["bildlink"];
            }
        }
        
        if ($p->action == "home")
        {
            header("Location: ./index.php");
            exit;
        
        }

       $mv = new vidoespieleview($id, $plattform, $titel, $beschreibung, $preis, $erscheinungsdatum, $bildlink, $p->action, $success, $message);
       //var_dump($mv);
       echo $mv->render();
    }
}
