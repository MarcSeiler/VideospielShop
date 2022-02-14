<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of videospieleshopDBparameterKunden
 *
 * @author z00479sx
 */
class videospieleshopDBparameterKunden {
    
    protected $offset;
    protected $limit;
    protected $action;
    protected $order;
    protected $mid;
    protected $email;
    protected $passwort;
    protected $vorname;
    protected $nachname;
    protected $kreditkartennummer;
    protected $kreditkartendatum;
    protected $cvv;
    protected $delete;
    protected $speichern;
    
    public function __construct() {
        
        $options=array("options" => array("default"=> 0, "min_range"=>0));
        $this->offset=filter_input(INPUT_GET, "offset", FILTER_VALIDATE_INT,$options);

        $options=array("options" => array("default"=> 10, "min_range"=>0));
        $this->limit=filter_input(INPUT_GET, "limit", FILTER_VALIDATE_INT,$options);

        $options=array("options" => array("show"=> 10));
        $this->action=filter_input(INPUT_GET, "action", FILTER_DEFAULT,$options);
        
        $actions=["first","next","previous","last","show"];
        if (!in_array($this->action, $actions))
        {
            $this->action="show";
        }
        
        if (filter_has_var(INPUT_GET, "first"))
                $this->action="first";
        if (filter_has_var(INPUT_GET, "next"))
                $this->action="next";
        if (filter_has_var(INPUT_GET, "previous"))
                $this->action="previous";
        if (filter_has_var(INPUT_GET, "last"))
                $this->action="last";
        if (filter_has_var(INPUT_GET, "speichern"))
                $this->action="speichern";
        if (filter_has_var(INPUT_GET, "new"))
                $this->action="neu";
        if (filter_has_var(INPUT_GET, "loeschen"))
                $this->action="delete";
        if (filter_has_var(INPUT_GET, "home"))
                $this->action="home";
        
        
        
        $options=array("options" => array("default"=> "asc"));
        $this->order=filter_input(INPUT_GET, "order", FILTER_DEFAULT,$options);
        
        $options=array("options" => array("default"=> 0, "min_range"=>-1));
        $this->mid=filter_input(INPUT_GET, "mid", FILTER_VALIDATE_INT,$options);
        
        $options=array("options" => array("default"=> ""));
        
        $this->email=filter_input(INPUT_GET, "email", FILTER_DEFAULT, $options);
        $this->passwort=filter_input(INPUT_GET, "passwort", FILTER_DEFAULT, $options);
        $this->vorname=filter_input(INPUT_GET, "vorname", FILTER_DEFAULT, $options);
        $this->nachname=filter_input(INPUT_GET, "nachname", FILTER_DEFAULT, $options);
        
        $this->kreditkartennummer=filter_input(INPUT_GET, "kreditkartennummer", FILTER_DEFAULT, $options);
        $this->kreditkartendatum=filter_input(INPUT_GET, "kreditkartendatum", FILTER_DEFAULT,$options);
        $this->cvv=filter_input(INPUT_GET, "cvv", FILTER_DEFAULT,$options);
        
        $options=array("options" => array("default"=> "0"));
        $this->delete=filter_input(INPUT_GET, "delete", FILTER_DEFAULT, $options);
        
        $this->speichern=filter_input(INPUT_GET, "speichern", FILTER_DEFAULT, $options);
       
        //var_dump($this);
    }
    
    public function __get($s)
    {
        if (property_exists($this, $s))
        {
            return $this->$s;
        }
        else
        {
            die("<br>unzulässiger Parameter: " . $s . "in Datei: " . __FILE__ . " Zeile:" . __LINE__ . "<br>");
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name))
        {
            $this->$name = $value;
        }
        else
        {
            die("<br>unzulässiger Parameter: " . $name . "in Datei: " . __FILE__ . " Zeile:" . __LINE__ . "<br>");
        }
    }
}

?>
