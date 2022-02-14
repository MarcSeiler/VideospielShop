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
           
    echo "<form>\n";
    echo "<table border=1>\n";
    echo "<tr>\n";
    echo "<tr>\n";
    echo "<td>E-Mail:</td>";
    echo "<td><input type='email' maxlength='255' placeholder='max@mustermann.de' name='email' value='$KundeEmail'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>Passwort:</td>";
    echo "<td><input type='text' maxlength='255' placeholder='Neues Passwort (Klartext)' name='passwort' value='$KundePasswort'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>Vorname:</td>";
    echo "<td><input type='text' maxlength='255' name='vorname' value='$KundeVorname'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>Nachname:</td>";
    echo "<td><input type='text' maxlength='255' name='nachname' value='$KundeNachname'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>Kreditkartennummer:</td>";
    echo "<td><input type='number' maxlength='16' name='kreditkartennummer' value='$KundeKartennummer'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>Kreditkartendatum:</td>";
    echo "<td><input type='text' maxlength='5' placeholder='MM/YY' name='kreditkartendatum' value='$KundeKartendatum'></td>";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>CVV:</td>";
    echo "<td><input type='number' maxlength='3' name='cvv' value='$KundeCVV'></td>";
    echo "</tr>\n";

    echo "</tr>\n";
    echo "</table>\n";
    echo"</form>\n";
    

    echo "<div class='buttons'>";
    echo "<div class='SpeichernKunde'> <a <button class='SpeichernKunde' href='profil.php?speichern=1'>Änderungen speichern</button></a></div>";
    echo "<div class='DeleteKunde'> <a <button class='DeleteKunde' href='profil.php?delete=1'>Profil löschen</button></a></div>";

    echo "<a <button class='buttonNavigationKauf' href='index.php?plattformsort=1'><spanA>Zurück</spanA></button></a>";
    echo "</div>";  
    
    if($p->delete == '1')
    {
        $sql = "delete from users where email = '{$_SESSION['useremail']}'";
        $res=$dbconn->exec($sql);
        header("Location: logout.php");
    }
    //TODO: MAYBE HIER WEITER HILFE
    if ($p->action=="speichern")
    {
        $dbconn->savekunde($KundeID, $KundeEmail, $KundePasswort, $KundeEmail, $KundeNachname, $KundeKartennummer, $KundeKartendatum, $KundeCVV);
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

