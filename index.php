<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BEAM</title>
        <link rel="stylesheet" href="css/style.css">
        <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
        
        <script src="Login.js" type="text/javascript" language="javascript"></script>
        </head>
        <body>
            <ul>
                <li style="float:left"><a class="active"href="index.php">BEAM</a></li>
                <li><a href="impressum.php">Impressum</a></li>
                
                <?php
                    if(!isset($_SESSION['userid'])) {
                        echo '<li><a href="register.php">Registrieren</a></li>';
                        echo '<li><a href="login.php">Login</a></li>';
                        
                    }               
                    else { 
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                    
                    if(isset($_SESSION['userid'])) {
                        echo "<li><a <button class='buttonUserCreate' href='profil.php'>{$_SESSION['useremail']}</button></a></li>";
                        
                        if($_SESSION['useremail'] == "root@root.de")
                        {
                            echo "<li><a <button class='buttonUserCreate' href='editkunden.php'>Kunden bearbeiten</button></a></li>";
                            echo "<li><a <button class='buttonVideogamesCreate' href='editvideospiele.php'>Videospiele bearbeiten</button></a></li>";
                        }
                    }                    
                ?>
            </ul>

            <div class="buttons">
                <a <button class="buttonPC" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=1'">PC</button></a>
                <a <button class="buttonPS" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=2'">Playstation</button></a>
                <a <button class="buttonXB" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=3'">Xbox</button></a>             
            </div>
        </body>
</html>

<?php

    require_once("php\cls_Autoloader.php");

    $p = new videospieleshopDBparameter();

    $dbconn = new VideospielshopDBConnection();
    $pdo=$dbconn->pdo;

    $p->limit = 9;

    $sql="select count(*) as anzahl from videospiele";
    //echo $sql;
    try
    {
        $res=$pdo->query($sql,PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
        die();       
    }

    $row=$res->fetch();
    $anzahl=$row["anzahl"];

    //echo $p->action;
    if ($p->action == "show")
    {
        $offset=$p->offset;
    }
    else if ($p->action == "first")
    {
        $offset=0;
    }
    else if ($p->action == "next")
    {
        $offset=$p->offset+$p->limit;
        if ($offset > $anzahl)
        {
            $offset=$anzahl-$p->limit+1;
            if ($offset<0)
            {
                $offset=0;
            }
        }
    }
    else if ($p->action == "previous")
    {
        $offset=$p->offset-$p->limit;
        if ($offset<0)
            $offset=0;
    }

    else if ($p->action == "last")
    {
        $offset=$anzahl-$p->limit+1;
        if ($offset<0)
            $offset=0;
    }

    $plattform_cookie = "plattform_cookie";
    if(isset($_COOKIE[$plattform_cookie]) && $p->plattformsort == '0')
    {
        //var_dump($_COOKIE[$plattform_cookie]);
        $p->plattformsort = $_COOKIE[$plattform_cookie];
    }

    if($p->plattformsort == '1')
    {
        setcookie($plattform_cookie, '1', time() + (3600 * 24), '/');
        echo "<hr class='squareRed'></hr>";
    }
    else if($p->plattformsort == '2')
    {
        setcookie($plattform_cookie, '2', time() + (3600 * 24), '/');
        echo "<hr class='squareBlue'></hr>";
    }
    else if($p->plattformsort == '3')
    {
        setcookie($plattform_cookie, '3', time() + (3600 * 24), '/');
        echo "<hr class='squareGreen'></hr>";
    }

    $sql="select *, id from videospiele where plattform like '%{$p->plattformsort}%' order by id {$p->order} limit " . $offset . "," . $p->limit;
    //echo $sql;
    try
    {
        $res=$pdo->query($sql,PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
        die();       
    }


    //var_dump($res);
    $rows=$res->fetchall();
    //var_dump($rows);

    echo "<div class='ui-grid-b'>";

    for ($i=0; $i<sizeof($rows);$i++)
    {
        echo "<div class='button-wrap'>";
        echo "<div class='ui-btn'>";

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

        echo "<img class='bildlink' src='$bildlink'>";

        echo "<div class=container>";
        echo "<div class='titel'>$titel</div>";
        echo "<div class='beschreibung'>$beschreibung</div>";
        echo "<div class='erscheinungsdatum'>Veröffentlichung: $erscheinungsdatum</div>";
        echo "</div>";

        if( isset($_SESSION['userid'])) {
            if($p->plattformsort == '1')
            {
                echo "<div class='preisLinkRed'> <a <button class='preisLinkUnterklasse' href='kaufevideospiel.php?mid=$id&plattformsort=$p->plattformsort'>Kaufen: $preis €</button></a></div>";   
            }
            else if($p->plattformsort == '2')
            {
                echo "<div class='preisLinkBlue'> <a <button class='preisLinkUnterklasse' href='kaufevideospiel.php?mid=$id&plattformsort=$p->plattformsort'>Kaufen: $preis €</button></a></div>";   
            }
            else
            {
                echo "<div class='preisLinkGreen'> <a <button class='preisLinkUnterklasse' href='kaufevideospiel.php?mid=$id&plattformsort=$p->plattformsort'>Kaufen: $preis €</button></a></div>";   
            }   

        }
        else{
            if($p->plattformsort == '1')
            {
                echo "<div class='preisNormaloRed'>$preis €</div>";
            }
            else if($p->plattformsort == '2')
            {
                echo "<div class='preisNormaloBlue'>$preis €</div>";
            }
            else
            {
                echo "<div class='preisNormaloGreen'>$preis €</div>";
            }        
        }

        echo "</div>";
        echo "</div>";
      //  var_dump($rows[$i]);
    }
    echo "</div>";

    echo "<div class='buttons'>";
    echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=0&action=first&plattformsort=$p->plattformsort'><spanA>Anfang</spanA></button></a>";
    echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=previous&plattformsort=$p->plattformsort'><<</button></a>";
    echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=next&plattformsort=$p->plattformsort'>>></button></a>";
    echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=last&plattformsort=$p->plattformsort'><spanE>Letzte</spanE></button></a>";
    echo "</div>";
?>