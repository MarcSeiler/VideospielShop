<?php



class videospieleshopDBparameter{

    protected $offset;
    protected $limit;
    protected $action;
    protected $order;
    protected $plattformsort;
    protected $kaufen;
    protected $mid;
    protected $plattform;
    protected $titel;
    protected $beschreibung;
    protected $preis;
    protected $erscheinungsdatum;
    protected $bildlink;
    
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
        
        
        $this->plattform=filter_input(INPUT_GET, "plattform", FILTER_DEFAULT);
        $this->titel=filter_input(INPUT_GET, "titel", FILTER_DEFAULT);
        $this->beschreibung=filter_input(INPUT_GET, "beschreibung", FILTER_DEFAULT);
        $this->preis=filter_input(INPUT_GET, "preis", FILTER_DEFAULT);
        
        $options=array("options" => array("default"=> date("Y-m-d")));
        $this->erscheinungsdatum=filter_input(INPUT_GET, "erscheinungsdatum", FILTER_DEFAULT, $options);
        if(!strtotime($this->erscheinungsdatum)){
            $this->erscheinungsdatum="";
        }
        
        $this->bildlink=filter_input(INPUT_GET, "bildlink", FILTER_DEFAULT);
        
        $options=array("options" => array("default"=> "1"));
        $this->plattformsort=filter_input(INPUT_GET, "plattformsort", FILTER_DEFAULT,$options);
        
        $options=array("options" => array("default"=> "0"));
        $this->kaufen=filter_input(INPUT_GET, "kaufen", FILTER_DEFAULT,$options);
        
        
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
