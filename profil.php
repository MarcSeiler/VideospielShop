<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BEAM</title>
        <link rel="stylesheet" href="Style.css">
        <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">        
        </head>
        <body> 
        </body>
</html>

<?php
    if(isset($_SESSION['userid'])) {

        require_once("php\cls_Autoloader.php");

        $p = new videospieleshopDBparameterKunden();
        //var_dump($p);
        $dbconn = new VideospielshopDBConnection();
        $pdo=$dbconn->pdo;


        $sql="select * from users where email = '{$_SESSION['useremail']}';";
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
                if($k == 'id')
                {
                    $KundeID = $v;
                }
                if($k == 'email')
                {
                    $KundeEmail = $v;
                }
                else if($k == 'passwort')
                {
                    $KundePasswort = $v;
                }                
                else if($k == 'vorname')
                {
                    $KundeVorname = $v;
                }
                else if($k == 'nachname')
                {
                    $KundeNachname = $v;
                }
                else if($k == 'kreditkartennummer')
                {
                    $KundeKartennummer = $v;
                }
                else if($k == 'kreditkartendatum')
                {
                    $KundeKartendatum = $v;
                }
                else if($k == 'cvv')
                {
                    $KundeCVV = $v;
                }
            }
        }      

        echo "<div class='kundeEmailKauf'><b>Email</b></div>";
        echo "<div class='kundeEmailKaufInhalt'>$KundeEmail</div>";

        echo "<div class='kundeVornameKauf'><b>Passwort (Hash)</b></div>";
        echo "<div class='kundeVornameKaufInhalt'>$KundePasswort</div>";

        echo "<div class='kundeVornameKauf'><b>Vorname</b></div>";
        echo "<div class='kundeVornameKaufInhalt'>$KundeVorname</div>";

        echo "<div class='kundeNachnameKauf'><b>Nachname</b></div>";
        echo "<div class='kundeNachnameKaufInhalt'>$KundeNachname</div>";

        echo "<div class='kundekreditkartennummerKauf'><b>Kartennummer</b></div>";
        echo "<div class='kundekreditkartennummerKaufInhalt'>$KundeKartennummer</div>";

        echo "<div class='kundekreditkartennummerKauf'><b>Kartendatum</b></div>";
        echo "<div class='kundekreditkartennummerKaufInhalt'>$KundeKartendatum</div>";

        echo "<div class='kundekreditkartennummerKauf'><b>CVV</b></div>";
        echo "<div class='kundekreditkartennummerKaufInhalt'>$KundeCVV</div>";

        echo "<div class='buttons'>";
        echo "<div class='DeleteKunde'> <a <button class='DeleteKunde' href='profil.php?delete=1'>Profil löschen</button></a></div>";

        echo "<a <button class='buttonNavigationKauf' href='index.php?plattformsort=1'><spanA>Zurück</spanA></button></a>";
        echo "</div>";  

        if($p->delete == '1')
        {
            $sql = "delete from users where email = '{$_SESSION['useremail']}'";
            $res=$dbconn->exec($sql);
            header("Location: logout.php");
        }

        //Rechnungen
        $sql=   "select v.titel, r.id_plattform, u.email, r.spielkey, r.kaufdatum
                from rechnungen as r
                join users as u on u.id = r.id_kunde
                join videospiele as v on v.id = r.id_spiel
                where u.id = {$KundeID}";
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
        echo "<div class='Einkaufsverlauf'><b>Einkaufsverlauf</b></div>";

        echo "<table class='styled-table'>";
         echo "<thead>";
             echo "<tr>";
                 echo "<th>Titel</th>";
                 echo "<th>Plattform</th>";
                 echo "<th>E-Mail</th>";
                 echo "<th>Key</th>";
                 echo "<th>Kaufdatum</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

        for ($i=0; $i<sizeof($rows);$i++)
        {
            foreach ($rows[$i] as $k=>$v)
            {
                if($k == 'titel')
                {
                    $titel = $v;
                    //var_dump($titel);
                }
                if($k == 'id_plattform')
                {
                    if($v == '1')
                    {
                        $plattform = 'PC';
                    }
                    if($v == '2')
                    {
                        $plattform = 'Playstation';
                    }
                    if($v == '3')
                    {
                        $plattform = 'XBox';
                    }
                    //var_dump($plattform);
                }
                else if($k == 'email')
                {
                    $KundeEmail = $v;
                    //var_dump($KundeEmail);
                }                
                else if($k == 'spielkey')
                {
                    $SpielKey = $v;
                    //var_dump($SpielKey);
                }
                else if($k == 'kaufdatum')
                {
                    $Kaufdatum = $v;
                    //var_dump($Kaufdatum);
                }
            }
                    echo "<tr>";
                        echo "<td>$titel</td>";
                        echo "<td>$plattform</td>";
                        echo "<td>$KundeEmail</td>";
                        echo "<td>$SpielKey</td>";
                        echo "<td>$Kaufdatum</td>";
                    echo "</tr>";      
        }        
            echo "</tbody>";
        echo "</table>";   
    }
?>

