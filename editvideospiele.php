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
        <link rel="stylesheet" href="ev.css">
    </head>
    <body>
        <?php
            require_once("php\cls_Autoloader.php");

            $mc= new videospielecontroller();
            $mc->run();
        ?>
    </body>
</html>
