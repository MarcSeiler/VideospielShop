<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kundenview
 *
 * @author z00479sx
 */
class kundenview {
    
    protected $id;
    protected $email;
    protected $passwort;
    protected $vorname;
    protected $nachname;
    protected $kreditkartennummer;
    protected $kreditkartendatum;
    protected $cvv;


    protected $action;
    protected $success;
    protected $message;
    
    function __construct($id, $email, $passwort, $vorname, $nachname, $kreditkartennummer, $kreditkartendatum, $cvv, $action, $success, $message)
    {
        $this->id=$id;
        $this->email=$email;
        $this->passwort=$passwort;
        $this->vorname=$vorname;
        $this->nachname=$nachname;
        $this->kreditkartennummer = $kreditkartennummer;
        $this->kreditkartendatum=$kreditkartendatum;
        $this->cvv=$cvv;
        $this->action=$action;
        $this->success = $success;
        $this->message = $message;
        //var_dump($this);
    }
    
    public function render()
    {
        
        $dbconn= new VideospielshopDBConnection();
        $id=$this->id;
        $email=$this->email;
        $passwort=$this->passwort;
        $vorname=$this->vorname;
        $nachname=$this->nachname;
        $kreditkartennummer=$this->kreditkartennummer;
        $kreditkartendatum=$this->kreditkartendatum;
        $cvv=$this->cvv;       
             
        echo "<form>\n";
        echo "<table border=1>\n";
        echo "<tr>\n";
        echo "<td>Id:</td>";
        echo "<td><input type='number' readonly name='mid' value='$id'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>E-Mail:</td>";
        echo "<td><input type='email' maxlength='255' placeholder='max@mustermann.de' name='email' value='$email'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Passwort:</td>";
        echo "<td><input type='text' maxlength='255' placeholder='Neues Passwort (Klartext)' name='passwort' value='$passwort'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Vorname:</td>";
        echo "<td><input type='text' maxlength='255' name='vorname' value='$vorname'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Nachname:</td>";
        echo "<td><input type='text' maxlength='255' name='nachname' value='$nachname'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Kreditkartennummer:</td>";
        echo "<td><input type='number' maxlength='16' name='kreditkartennummer' value='$kreditkartennummer'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Kreditkartendatum:</td>";
        echo "<td><input type='text' maxlength='5' placeholder='MM/YY' name='kreditkartendatum' value='$kreditkartendatum'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>CVV:</td>";
        echo "<td><input type='number' maxlength='3' name='cvv' value='$cvv'></td>";
        echo "</tr>\n";
        
        
        echo "</tr>\n";
        echo "</table>\n";
        echo "<input type='submit' name='first' value='Anfang'>\n";
        echo "<input type='submit' name='next' value='Nächster'>\n";
        echo "<input type='submit' name='previous' value='Vorheriger'>\n";
        echo "<input type='submit' name='last' value='Letzter'>\n";
        echo "<input type='submit' name='speichern' value='Speichern'>\n";
        echo "<input type='submit' name='loeschen' value='Löschen'>\n";
        echo "<input type='submit' name='new' value='Neu'>\n";
        echo "<input type='submit' name='home' value='Home'>\n";

        echo"</form>\n";
    }
    
    
    
}
