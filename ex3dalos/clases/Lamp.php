<?php

class Lamp extends Connection{
   
  public $id;
  public $lamp_name;
  public $lamp_model;
  public $lamp_zone;
  public $lamp_on;

       public function __construct($id , $lamp_name,$lamp_model,$lamp_zone,$lamp_on){
        $this->id = $id;
        $this->lamp_name = $lamp_name;
        $this->lamp_model = $lamp_model;
        $this->lamp_zone = $lamp_zone;
        $this->lamp_on = $lamp_on;
       
    }

    public function getId() {
        return $this->id;
    }

    public function getname() {
        return $this->lamp_name;
    }

    public function getmodel() {
        return $this->lamp_model;
    }

    public function getzone() {
        return $this->lamp_zone;
    }

    public function getOn() {
        return $this->lamp_on;
    }
    public function setid($id){
        $this->id=$id;
    }
    public function setname($lamp_name){
        $this->lamp_name=$lamp_name;
    }
    
    public function setmodel($lamp_model){
        $this->lamp_model=$lamp_model;
    }
    public function setzone($lamp_zone){
        $this->lamp_zone=$lamp_zone;
    }
    public function seton($lamp_on){
        $this->lamp_on=$lamp_on;
    }
   
}
       