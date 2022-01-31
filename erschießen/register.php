<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=videospielshop', 'root', '');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Registrierung</title>    
</head> 
<body>
 
<?php
$showFormular = true; 
 
if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $cardnum = $_POST['cardnum'];
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
        if(strlen($cardnum) == 0) {
        echo 'Bitte eine Kreditkartennummer angeben<br>';
        $error = true;
    }
    
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO users (email, passwort, kreditkartennummer) VALUES (:email, :passwort, :kreditkartennummer)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'kreditkartennummer'=>$cardnum));
        
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
 <script>
     function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var y = document.getElementById("myInput2");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
 </script>
    
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Kreditkarte: <br>
<input type="number" size="40" maxlength="250" name="cardnum"><br><br>

Dein Passwort:<br>
<input type="password" id="myInput" size="40"  maxlength="250" name="passwort">
<input type="checkbox" onclick="myFunction()">Show Password<br>
 
Passwort wiederholen:<br>
<input type="password" id="myInput2" size="40" maxlength="250" name="passwort2"><br><br>
 
<input type="submit" value="Abschicken"> <br>
<br>
</form>
 <form method="get" action="login.php">
    <button type="submit">Login</button>
</form>
 
<?php
}
?>
 
</body>
</html>