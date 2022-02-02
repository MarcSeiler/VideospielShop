

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
                <li><a href="register.php">Registrieren</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>

            <div class="buttons">
                <a <button class="buttonPS" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=2'">Playstation</button></a>
                <a <button class="buttonXB" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=3'">Xbox</button></a>             
                <a <button class="buttonPC" onclick="href='index.php?limit=9&offset=0&action=first&plattformsort=1'">PC</button></a>
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


$sql="select *, id as editid from videospiele where plattform like '%{$p->plattformsort}%' order by id {$p->order} limit " . $offset . "," . $p->limit;
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

echo "<div class='grid-container'>";

//echo "<table border=1>";
//$first=true;
for ($i=0; $i<sizeof($rows);$i++)
{
    /*
    if ($first)
    {
        $first=false;
        echo"<tr>";
        foreach ($rows[$i] as $k=>$v)
        {
            if ($k=="editid")
            {
                //echo "<td></td>";
                
            }
            else
            {
                //echo "<td>" . $k . "</td>";
            }
        }
        echo "</tr>";
        
    }
     * */
    
    
    echo "<div>";
    foreach ($rows[$i] as $k=>$v)
    {
            
            if ($k=="preis")
            {
                //echo "<td><a href=editmitarbeiter.php?mid=$v>edit</a></td>";
                echo "<a <button class='buttonbuy' href='index.php'>$v €</button></a>";
            }
            else if($k != "id" && $k != "bildlink" && $k != "plattform" && $k != "preis")
            {
                //var_dump($v);

                echo "<div name='$k'>$v</div>";
            }
            if($k == "bildlink")
            {
                echo "<img name='$k' src='./$v'>";
            }
            echo "\n";     
            
    }    
    
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
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=0&action=first&plattformsort=$p->plattformsort'>Anfang</button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=next&plattformsort=$p->plattformsort'>Nächste</button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=previous&plattformsort=$p->plattformsort'>Vorherige</button></a>";
echo "<a <button class='buttonNavigation' href='index.php?limit=9&offset=$offset&action=last&plattformsort=$p->plattformsort'>Letzte</button></a>";
echo "</div>";


//TODO @Fabian: Nur sichtbar wenn man als root angemeldet ist
echo "<a <button class='buttonVideogamesCreate' href='editvideospiele.php'>Videospiele bearbeiten</button></a>\n";



/*
echo "<div class='buttons'>";

echo "<a href='index.php?limit=9&offset=0&action=first&plattformsort=$p->plattformsort'>Anfang</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=next&plattformsort=$p->plattformsort'>Nächste</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=previous&plattformsort=$p->plattformsort'>Vorherige</a>\n";
echo "<a href='index.php?limit=9&offset=$offset&action=last&plattformsort=$p->plattformsort'>Letzte</a>\n";
echo "</div>";
*/
?>