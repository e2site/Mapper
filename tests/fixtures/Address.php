<?php

class Address implements mapper\interfaces\iSchemaMap {
    public $Country;
    public $City;
    public $Index;
    
    public function getSchemaMap() {        
        return array(
            '__MAP_ERROR__' => new mapper\map\ErrorMap(null)
            
        );
    }
}
?>
