<?php

class Client implements \mapper\interfaces\iSchemaMap {
    
    
    public $Name;
    public $Age;
    
    public $Addresses;

    public function getSchemaMap(){
        return Array(
          'Addresses' => new \mapper\map\ArrayClassMap(new Address()),  
        );
    }
}

?>
