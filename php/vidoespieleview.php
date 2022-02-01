<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mitarbeitercontroller
 *
 * @author gramppko
 */
class vidoespieleview
{
    
    protected $id;
    protected $plattform;
    protected $titel;
    protected $beschreibung;
    protected $preis;
    protected $erscheinungsdatum;
    protected $bildlink;
    
    protected $action;
    protected $success;
    protected $message;
    
    function __construct($id, $plattform, $titel, $beschreibung, $preis, $erscheinungsdatum, $bildlink, $action, $success, $message)
    {
        $this->id=$id;
        $this->plattform=$plattform;
        $this->titel=$titel;
        $this->beschreibung=$beschreibung;
        $this->preis=$preis;
        $this->erscheinungsdatum = $erscheinungsdatum;
        $this->bildlink=$bildlink;
        $this->action=$action;
        $this->success = $success;
        $this->message = $message;
        var_dump($this);
    }
    
    public function render()
    {
        
        $dbconn= new VideospielshopDBConnection();
        $id=$this->id;
        $plattform=$this->plattform;
        $titel=$this->titel;
        $beschreibung=$this->beschreibung;
        $preis=$this->preis;
        $bildlink=$this->bildlink;
             
        echo "<form>\n";
        echo "<table border=1>\n";
        echo "<tr>\n";
        echo "<td>Id:</td>";
        echo "<td><input type='number' readonly name='mid' value='$id'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Plattform:</td>";
        echo "<td><input type='text' name='plattform' value='$plattform'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Titel:</td>";
        echo "<td><input type='text' name='titel' value='$titel'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Beschreibung:</td>";
        echo "<td><input type='text' name='beschreibung' value='$beschreibung'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Preis:</td>";
        echo "<td><input type='number' step='0.01' placeholder='0.00' name='preis' value='$preis'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Erscheinungsdatum:</td>";
        echo "<td><input type='date' placeholder='YYYY-MM-DD' name='erscheinungsdatum' value='{$this->erscheinungsdatum}'></td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Bildlink:</td>";
        echo "<td><input type='text' name='bildlink' placeholder='images/xxx.png' value='$bildlink'></td>";
        echo "</tr>\n";
        /*
        echo "<tr>\n";
        echo "<td>Abteilung:</td>";
        echo "<td><select name='abteilung'>";
        //$abteilungen = ["Einkauf","Verkauf", "Entwicklung", "Fertigung", "Personal"];
        
        $abteilungen = $dbconn->getAbteilungen();
        var_dump($abteilungen);
        foreach ($abteilungen as $a)
        {
            echo "<option value='$a[0]]' ";
            if ($this->abteilung == $a[0])
            {
                echo " selected ";
            }
            echo ">$a[0]</option>";
        }
        echo "</select>"
        . "</td>";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td>Geschlecht:</td>";
        echo "<td>\n";

        echo "<input type='radio' name='geschlecht' value='m'";
        if ($this->geschlecht == "m")
        {
            echo " checked ";
        }
        echo ">männlich<br>";
        echo "<input type='radio' name='geschlecht' value='w'";
        if ($this->geschlecht == "w")
        {
            echo " checked ";
        }
        echo ">weiblich<br>";
        echo "<input type='radio' name='geschlecht' value='d'";
        if ($this->geschlecht == "d")
        {
            echo " checked ";
        }
        echo ">divers<br>";
        echo "</td>\n";
        */
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

