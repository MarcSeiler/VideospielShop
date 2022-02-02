<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=videospielshop', 'root', '');
 
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="index.php">internen Bereich</a>');
    } else {
        $errorMessage = '<div class="pwdlogin">E-Mail oder Passwort sind flasch!</div><br><br>';
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title>    
     <ul>
                <li style="float:left"><a class="active"href="index.php">BEAM</a></li>
                <li><a href="impressum.php">Impressum</a></li>
                <li><a href="register.php">Registrieren</a></li>
                
    </ul>
 <link rel="stylesheet" href="register.css">  
</head> 
<body>
 
<?php 

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 <div class="loginform">
<form action="?login=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br><br>
 
<input class="blogin" type="submit" value="Login"> <br> <br>
</form> 
    
    
 Noch nicht registriert? <a href="register.php">Hier gehts zum registrieren.</a> 
 </div>
</body>
</html>