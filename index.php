


<html>
    <head>
        <meta charset="UTF-8">
        <title>BEAM</title>
        <link rel="stylesheet" href="Style.css">
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

            
           <!--<<div class="grid-container">
                <div name="titel">Game 1</div>
                <div>Game 2</div>
                <div>Game 3</div>  
                <div>Game 4</div>
                <div>Game 5</div>
                <div>Game 6</div>  
                <div>Game 7</div>
                <div>Game 8</div>
                <div>Game 9</div>
            </div>
            -->  
            
            
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

$sql="select *, id as editid from videospiele order by id {$p->order} limit " . $offset . "," . $p->limit-1;
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
            
            if ($k=="editid")
            {
                //echo "<td><a href=editmitarbeiter.php?mid=$v>edit</a></td>";
            }
            else if($k != "id" && $k != "bildlink" && $k != "plattform")
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

echo "<input type='submit' name='first' value='Anfang'>\n";
echo "<input type='submit' name='next' value='Nächste'>\n";
echo "<input type='submit' name='previous' value='Vorherige'>\n";
echo "<input type='submit' name='last' value='Letzte'>\n";
//echo "<div class='grid-container'>";
//echo "<div>Test</div>";
//echo "</div>";

echo "<a href='index.php?limit=10&offset=0&action=first'>Anfang</a>\n";
echo "<a href='index.php?limit=10&offset=$offset&action=next'>Nächste</a>\n";
echo "<a href='index.php?limit=10&offset=$offset&action=previous'>Vorherige</a>\n";
echo "<a href='index.php?limit=10&offset=$offset&action=last'>Letzte</a>\n";
?>