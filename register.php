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
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $cvv = $_POST['cvv'];
    $date = $_POST['date'];
    
  
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
     if(strlen($vorname) == 0) {
        echo 'Bitte einen Vornamen angeben<br>';
        $error = true;
    }
      if(strlen($nachname) == 0) {
        echo 'Bitte einen Nachnamen angeben<br>';
        $error = true;
    }
      if(strlen($cvv) == 0) {
        echo 'Bitte die CVV angeben<br>';
        $error = true;
    }
      if(strlen($date) == 0) {
        echo 'Bitte ein Datum angeben<br>';
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
        
        $statement = $pdo->prepare("INSERT INTO users (email, passwort, kreditkartennummer, vorname, nachname, cvv, kreditkartendatum) VALUES (:email, :passwort, :kreditkartennummer, :vorname, :nachname, :cvv, :kreditkartendatum)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'kreditkartennummer'=>$cardnum, 'vorname'=>$vorname, 'nachname'=>$nachname, 'cvv'=>$cvv, 'kreditkartendatum'=>$date));        
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
    Vorname:<br>
    <input type="text" size="40" maxlength="250" name="vorname"><br><br>
 Nachname:<br>
<input type="text" size="40" maxlength="250" name="nachname"><br><br>
 
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Kreditkarte: <br>
<input type="number" size="40" maxlength="250" name="cardnum">
 | CVV:
<input type="text" size="5" maxlength="3" name="cvv"><br><br>
 Ablaufdatum:<br>
 <input type="text" size="40" maxlength="250" name="date" placeholder="MM/YY"><br><br>
 

Dein Passwort:<br>
<input type="password" id="myInput" size="40"  maxlength="250" name="passwort">
<input type="checkbox" onclick="myFunction()">Show Password<br>
 
Passwort wiederholen:<br>
<input type="password" id="myInput2" size="40" maxlength="250" name="passwort2"><br><br>
 
<input type="submit" value="Registrieren"> <br>
<br>
</form>
 Bereits registriert? <a href="login.php">Hier gehts zum Login.</a> 
 
<?php
}
?>
 
</body>
</html>