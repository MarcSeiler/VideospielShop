<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=videospielshop', 'root', '');
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Registrierung</title>  
<link rel="stylesheet" href="register.css">  
</head> 
<body>
    <ul>
                <li style="float:left"><a class="active"href="index.php">BEAM</a></li>
                <li><a href="impressum.php">Impressum</a></li>
                <li><a href="register.php">Registrieren</a></li>
                <li><a href="login.php">Login</a></li>
    </ul>
 
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
        echo '<div class="email0">Bitte eine gültige E-Mail-Adresse eingeben</div><br>';
        $error = true;
    }     
    if(strlen($passwort) == 0) {
        echo '<div class="pwd0">Bitte ein Passwort angeben</div><br>';
        $error = true;
    }
    if(strlen($cardnum) == 0) {
        echo '<div class="cardnum">Bitte eine Kreditkartennummer angeben</div><br>';
        $error = true;
    }
     if(strlen($vorname) == 0) {
        echo '<div class="vorname0"Bitte einen Vornamen angeben</div><br>';
        $error = true;
    }
      if(strlen($nachname) == 0) {
        echo '<div class="nachname0"Bitte einen Nachnamen angeben</div><br>';
        $error = true;
    }
      if(strlen($cvv) == 0) {
        echo '<div class="cvv0"Bitte die CVV angeben</div><br>';
        $error = true;
    }
      if(strlen($date) == 0) {
        echo '<div class="date0"Bitte ein Datum angeben</div><br>';
        $error = true;
    }
    
    if($passwort != $passwort2) {
        echo '<div class="pwddouble">Die Passwörter müssen übereinstimmen</div><br>';
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
    <div class="loginform">
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
<input type="password" id="myInput" size="40"  maxlength="250" name="passwort"><br>
<input type="checkbox" onclick="myFunction()">Show Password<br><br>
 
Passwort wiederholen:<br>
<input type="password" id="myInput2" size="40" maxlength="250" name="passwort2"><br><br>
 
<input class="bregi" type="submit" value="Registrieren"> <br>
<br>
</form>
 Bereits registriert? <a href="login.php">Hier gehts zum Login.</a> 
 
<?php
}
?>
  </div>
</body>
</html>