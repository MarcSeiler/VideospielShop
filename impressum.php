<?php
    session_start();
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Impressum</title>
        <link rel="stylesheet" href="css/style.css">
        <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
        
        <script src="Login.js" type="text/javascript" language="javascript"></script>
        </head>
        <body>
            <ul>
                <li style="float:left"><a class="active"href="index.php">BEAM</a></li>
                <?php
                    if(!isset($_SESSION['userid'])) {
                        echo '<li><a href="register.php">Registrieren</a></li>';
                        echo '<li><a href="login.php">Login</a></li>';
                    }               
                    else { 
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                ?>
                        
            </ul>
            <div class="text">
            <h1>Impressum</h1>

                <p1>Konzernzentrale<br><br></p1>

                <p2>
                    Siemens Aktiengesellschaft<br>
                    Werner-von-Siemens-Straße 1<br>
                    80333 München<br>
                    Deutschland<br>
                    contact@siemens.com<br>
                    Tel. +49 (89) 3803 5491<br>
                    Fax +49 (69) 797 6664<br><br>
                </p2>

                <p3>Aufsichtsratsvorsitzender<br><br></p3>

                <p4>Jim Hagemann Snabe<br><br></p4>

                <p5>Vorstand<br><br></p5>

                <p6>
                    Roland Busch (Vorsitzender)<br>
                    Cedrik Neike<br>
                    Matthias Rebellius<br>
                    Ralf P. Thomas<br>
                    Judith Wiese <br><br>
                </p6>

                <p7>Sitz der Gesellschaft<br><br></p7>

                <p8>
                    Berlin und München, Deutschland<br>
                    Registergericht<br>
                    Berlin-Charlottenburg, HRB 12300<br>
                    München, HRB 6684<br>
                    WEEE-Reg.-Nr. DE 23691322<br><br>
                </p8>

                <p9>Umsatzsteuer-Identifikationsnummer<br><br></p9>

                <p10>DE129274202<br><br></p10>

                <p11>Verantwortlicher gemäß § 18 Abs. 2 MStV<br><br></p11>

                <p12>
                    Günther Petrasch<br>
                    Siemens Aktiengesellschaft
                    Siemens Deutschland<br>
                    Communications<br>
                    Nonnendammallee 101<br>
                    13629 Berlin<br>
                    Deutschland<br><br>
                </p12>
                </div>
           
        </body>



</html>
