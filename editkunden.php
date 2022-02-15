<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/ev.css.">
    </head>
    <body>
        <?php
        if(isset($_SESSION['userid'])) {
                        
            if($_SESSION['useremail'] == "root@root.de")
            {
                require_once("php\cls_Autoloader.php");

                $mc= new kundencontroller();
                $mc->run();
            }
        }
        ?>
    </body>
</html>
