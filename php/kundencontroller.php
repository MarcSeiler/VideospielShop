<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kundencontroller
 *
 * @author z00479sx
 */
class kundencontroller {
    
    function __construct()
    {
        
    }
    
    function run()
    {
        require_once("php\cls_Autoloader.php");

        $p = new videospieleshopDBparameterKunden();
        //var_dump($p);
        $dbconn = new VideospielshopDBConnection();
        $pdo=$dbconn->pdo;


        $id = -1;
        $email = '';
        $passwort='';
        $vorname='';
        $nachname='';
        $kreditkartennummer='';
        $kreditkartendatum='';
        $cvv='';

        //echo $p->action;
        //echo $p->mid;


        $success=true;
        $message="";
        
        if ($p->action == "delete")
        {
            $sql = "delete from users where id = {$p->mid}";
            $res=$dbconn->exec($sql);
            $p->action="next";
        }
        
        if ($p->action=="speichern")
        {
            //var_dump($p);
            $id=$dbconn->savekunde($p->mid, $p->email, $p->passwort, $p->vorname, $p->nachname, $p->kreditkartennummer, $p->kreditkartendatum, $p->cvv);
            $sql = "select * from users where id = $id";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }
        }
        
        if ($p->action == "next")
        {
            $sql = "select * from users where id > {$p->mid} order by id limit 1";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }
            else
            {
                $p->action="show";
            }
        }
        
        if ($p->action == "previous")
        {
            $sql = "select * from users where id < {$p->mid} order by id desc limit 1";
            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }
            else
            {
                $p->action="show";
            }

        }

        if ($p->action == "last")
        {
            $sql = "select * from users  order by id desc limit 1";
            $rows=$dbconn->query($sql);

            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }

        }
    

        if ($p->action == "show")
        {

            $sql = "select * from users where id = {$p->mid}";

            $rows=$dbconn->query($sql);
            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }
            else
            {
                $p->action="first";
            }

        }
        if ($p->action == "first")
        {
            $sql = "select * from users order by id asc limit 1";
            $rows=$dbconn->query($sql);

            if (sizeof($rows) == 1)
            {
                $id = $rows[0]["id"];
                $email= $rows[0]["email"];
                $passwort= $rows[0]["passwort"];
                $vorname= $rows[0]["vorname"];
                $nachname= $rows[0]["nachname"];
                $kreditkartennummer= $rows[0]["kreditkartennummer"];
                $kreditkartendatum= $rows[0]["kreditkartendatum"];
                $cvv= $rows[0]["cvv"];
            }
        }
        
        if ($p->action == "home")
        {
            header("Location: ./index.php");
            exit;
        
        }
        
        $mv = new kundenview($id, $email, $passwort, $vorname, $nachname, $kreditkartennummer, $kreditkartendatum, $cvv, $p->action, $success, $message);
        //var_dump($mv);
        echo $mv->render();
    }
}
