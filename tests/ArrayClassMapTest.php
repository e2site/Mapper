<?php
require_once dirname(__FILE__) . '/../autoloader.php';
require_once dirname(__FILE__) . '/fixtures/Address.php';


class ArrayClassMapTest extends PHPUnit_Framework_TestCase {

    public function testGetMap() {
        $arr = array(
            array(
                'Country' => 'Russia',
                'City' => 'Saint-Petersnurg',
                'Index' => '123431'
            ),
            array(
                'Country' => 'Russia',
                'City' => 'Moscow',
                'Index' => '123421'
            )
        );
        $test = new mapper\map\ArrayClassMap(new Address());
        
        $a1 = new Address();
        $a1->Country = 'Russia';
        $a1->City = 'Saint-Petersnurg';
        $a1->Index = '123431';

        $a2 = new Address();
        $a2->Country = 'Russia';
        $a2->City = 'Moscow';
        $a2->Index = '123421';
        
        $this->assertEquals(array($a1,$a2), $test->getMapValue($arr));
    }
    
    public function testException() {
        $res = false;
        try{
            $test = new mapper\map\ArrayClassMap(new Address());       
            $test->getMapValue('test');
        } catch (mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals($res,true);
    }
    

}

?>
