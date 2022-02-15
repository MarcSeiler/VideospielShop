
<!DOCTYPE html> 
<html> 
<head>
  <title>Logout</title>    

 <link rel="stylesheet" href="css/register.css">  
</head> 
<body>
 <?php
session_start();
session_destroy();

?>
    <div class='LogoutFIN' >
        <p1>Logout war erfolgriech!</p1> <br><br>
        <a  href='index.php'>Zurück zur Startseite</a><br><br>
  <a href='Login.php'>Zurück zum Login</a>
    </div>
</body>
</html>