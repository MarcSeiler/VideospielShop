<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BEAM</title>
        <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" href="style.css">

        <script src="Login.js" type="text/javascript" language="javascript"></script>

        </head>
        <body>
            <ul>
                <li style="float:left"><a class="active"href="index.php">BEAM</a></li>
                <li><a href="impressum.php">Impressum</a></li>

            </ul>
        

        
            
            
               
        <!--<form method="get" action="login.html">  
        <button type="submit">Login</button>
        </form>  
        <form method="get" action="register.html">  
        <button type="submit">Register</button>
        </form>-->  
        </body>




</html>


<?php

if(isset($_SESSION['userid'])) 
{

    require_once("php\cls_Autoloader.php");

    $p = new videospieleshopDBparameter();

    $dbconn = new VideospielshopDBConnection();
    $pdo=$dbconn->pdo;


    $sql="select * from videospiele where id = {$p->mid}";
    //echo $sql;
    try
    {
        $res=$pdo->query($sql,PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
        die();       
    }



    $rows=$res->fetchall();
    //var_dump($rows);


    for ($i=0; $i<sizeof($rows);$i++)
    {

        foreach ($rows[$i] as $k=>$v)
        {
                if($k == "id")
                {
                    $id = $v;
                }
                else if($k == "titel")
                {
                    $titel = $v;
                }
                else if($k == "beschreibung")
                {
                    $beschreibung = $v;
                }
                else if($k == "preis")
                {
                    $preis = $v;
                }
                else if($k == "erscheinungsdatum")
                {
                    $erscheinungsdatum = $v;
                }
                else if($k == "bildlink")
                {
                    $bildlink = $v;
                }    
        }    

        // @Moritz ab hier
        //--------------------------------------
        echo "<img class='bildlinkKaufInhalt' src='$bildlink'>";

        echo "<div class='kaufContainer'>";
        echo "<div class='titelKauf'>Titel</div>";
        echo "<div class='titelKaufInhalt'>$titel</div>";
            echo "<div class='tplatformKauf'>Plattform</div>";
        if($p->plattformsort == '1')
            {
                echo "<div class='plattformKaufInhalt'>PC</div>";   
            }
            else if($p->plattformsort == '2')
            {
                echo "<div class='plattformKaufInhalt'>Playstation</div>";   
            }
            else
            {
                echo "<div class='plattformKaufInhalt'>XBox</div>";   
            }       
        echo "<div class='beschreibungKauf'>Beschreibung</div>";
        echo "<div class='beschreibungKaufInhalt'>$beschreibung</div>";

        echo "<div class='erscheinungsdatumKauf'>Titel</div>";
        echo "<div class='erscheinungsdatumKaufInhalt'>Veröffentlichung: $erscheinungsdatum</div>";

        echo "<div class='preisKauf'>Preis</div>";
        echo "<div class='preisKaufInhalt' href='kaufevideospiel.php?mid=$id'>$preis €</div>";


        $idvideospiel = $p->mid;

        //Kunde
        $sql="select id from users where email = '{$_SESSION['useremail']}'";
        //echo $sql;
        try
        {
            $res=$pdo->query($sql,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();       
        }

        $rows=$res->fetchall();
        for ($i=0; $i<sizeof($rows);$i++)
        {

            foreach ($rows[$i] as $k=>$v)
            {
                if($k == 'id')
                {
                    $idkunde = $v;
                }
            }
        }
        //var_dump($idkunde);

        $sql="select vorname, nachname, email, kreditkartennummer from users where id = $idkunde;";
        //echo $sql;
        try
        {
            $res=$pdo->query($sql,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();       
        }
        $rows=$res->fetchall();
        //var_dump($rows);

        for ($i=0; $i<sizeof($rows);$i++)
        {
            foreach ($rows[$i] as $k=>$v)
            {
                if($k == 'vorname')
                {
                    $KundeVorname = $v;
                }
                if($k == 'nachname')
                {
                    $KundeNachname = $v;
                }
                if($k == 'email')
                {
                    $KundeEmail = $v;
                }
                if($k == 'kreditkartennummer')
                {
                    $KundeKartennummer = $v;
                    $arr1 = str_split($v, 12);
                    //var_dump($arr1[1]);
                    $KundeKartennummerGeheim = $arr1[1];
                    //var_dump($KundeKartennummerGeheim);
                }
            }
        }

        //++++++++++++++++++ HIER

        echo "<div class='kundeVornameKauf'>Vorname </div>";
        echo "<div class='kundeVornameKaufInhalt'>$KundeVorname</div>";

        echo "<div class='kundeNachnameKauf'>Nachname</div>";
        echo "<div class='kundeNachnameKaufInhalt'>$KundeNachname</div>";

        echo "<div class='kundeEmailKauf'>Email </div>";
        echo "<div class='kundeEmailKaufInhalt'>$KundeEmail</div>";

        echo "<div class='kundekreditkartennummerKauf'>Kartennummer </div>";
        echo "<div class='kundekreditkartennummerKaufInhalt'>**** **** **** $KundeKartennummerGeheim</div>";






        if( isset($_SESSION['userid'])) {
            echo "<div class='kaufenKauf'> <a <button class='preisLinkUnterklasse' href='kaufevideospiel.php?mid=$id&plattformsort=$p->plattformsort&kaufen=1'>Kauf bestätigen</button></a></div>";
            echo "<div class='KaufAGBs'> *beim Click auf den 'Kauf bestätigen'-Button erklären Sie sich einverstanden mit unseren AGBs und verkaufen uns Ihre Seele.</div>";            
        }
        else {
             echo "<div class='keineAnmeldung'> Bitte melden Sie sich an, um einen Kauf abzuschließen</div>";
        }
      //  var_dump($rows[$i]);
    }

    echo "<div class='buttons'>";
    echo "<a <button class='buttonNavigationKauf' href='index.php?plattformsort=$p->plattformsort'><spanA>Zurück</spanA></button></a>";
    echo "</div>";  
    
            echo "</div>";

    //--------------------- Bis hier und dann noch...

    if($p->kaufen == 1)
    {

        $gamekey = rand(0, 9) . rand(0, 9) .rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  '-' . rand(0, 9) . rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  '-' . rand(0, 9) . rand(0, 9) .  rand(0, 9) .  rand(0, 9);
        //var_dump($gamekey);

        $sql = "insert into rechnungen (id_spiel, id_plattform, id_kunde, spielkey) values ('$idvideospiel', '$p->plattformsort', '$idkunde', '$gamekey')";
        //echo $sql;
        $pdo->exec ($sql);
        $pdo->lastInsertId();
        
        echo "<div class='KaufeErfolgreich'>Kauf erfolgreich!</div>";
        echo "<div class='GameKey'>Dein Game-Key: $gamekey</div>";
        echo "<div class='GameKeyInfo'>Falls Sie Ihren Key verlieren, können Sie ihn auf der Profil-Seite unter Rechnungen nachlesen.</div>";

    }   
}
?>
