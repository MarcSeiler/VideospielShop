<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BEAM</title>
        <link rel="stylesheet" href="style.css">
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
                        
                        if($_SESSION['useremail'] == "root@root.de")
                        {
                            echo "<li><a <button class='buttonVideogamesCreate' href='editvideospiele.php'>Videospiele bearbeiten</button></a></li>";
                            echo "<li><a <button class='buttonUserCreate' href='editvideospiele.php'>Videospiele bearbeiten</button></a></li>";
                        }
                    }
                    
                ?>
            </ul>

            <div class="buttons">
                <a <button class="buttonPC" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=1'">PC</button></a>
                <a <button class="buttonPS" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=2'">Playstation</button></a>
                <a <button class="buttonXB" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=3'">Xbox</button></a>             
            </div>
            
            
               
        <!--<form method="get" action="login.html">  
        <button type="submit">Login</button>
        </form>  
        <form method="get" action="register.html">  
        <button type="submit">Register</button>
        </form>-->  
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


if($p->plattformsort == '1')
{
    echo "<div class='squareRed'></div>";
}
else if($p->plattformsort == '2')
{
    echo "<div class='squareBlue'></div>";
}
else if($p->plattformsort == '3')
{
    echo "<div class='squareGreen'></div>";
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

//echo "<table border=1>";
//$first=true;
for ($i=0; $i<sizeof($rows);$i++)
{
    echo "<div class='button-wrap'>";
    echo "<div class='ui-btn'>";
        
    echo "<div>";
    foreach ($rows[$i] as $k=>$v)
    {
            if($k == "id")
            {
                $id = $v;
            }
            else if ($k=="preis")
            {
                //echo "<td><a href=editmitarbeiter.php?mid=$v>edit</a></td>";
                if( isset($_SESSION['userid'])) {
                    echo "<a <button class='$k' href='kaufevideospiel.php?mid=$id'>$v €</button></a>";                         
                }
                else {
                    echo "<div class='$k'>$v</div>";   
                    
                }                
            }
            else if($k != "id" && $k != "bildlink" && $k != "plattform" && $k != "preis")
            {
                //var_dump($v);

                echo "<div class='$k'>$v</div>";
            }
            if($k == "bildlink")
            {
                echo "<img class='$k' src='./$v'>";
            }
            echo "\n";     
            
    }    
    
    echo "</div>";
    echo "</div>";
    echo "</div>";
  //  var_dump($rows[$i]);
}
echo "</div>";

//<img src='./images/csgo.png' hier einfügen“>.

/*
echo "<input type='submit' name='first' value='Anfang'>\n";
echo "<input type='submit' name='next' value='Nächste'>\n";
echo "<input type='submit' name='previous' value='Vorherige'>\n";
echo "<input type='submit' name='last' value='Letzte'>\n";
//echo "<div class='grid-container'>";
//echo "<div>Test</div>";
//echo "</div>";
*/



echo "<div class='buttons'>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=0&action=first&plattformsort=$p->plattformsort'><spanA>Anfang</spanA></button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=next&plattformsort=$p->plattformsort'>Nächste</button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=previous&plattformsort=$p->plattformsort'>Vorherige</button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=last&plattformsort=$p->plattformsort'><spanE>Letzte</spanE></button></a>";
echo "</div>";


/*
echo "<div class='buttons'>";

echo "<a href='index.php?limit=9&offset=0&action=first&plattformsort=$p->plattformsort'>Anfang</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=next&plattformsort=$p->plattformsort'>Nächste</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=previous&plattformsort=$p->plattformsort'>Vorherige</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=last&plattformsort=$p->plattformsort'>Letzte</a>\n";
echo "</div>";
*/


/*
var_dump($_SESSION);
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
 echo"USER ID: $userid";
*/
 
?>