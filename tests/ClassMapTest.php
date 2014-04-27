<?php

require_once dirname(__FILE__) . '/../autoloader.php';
require_once dirname(__FILE__) . '/fixtures/Client.php';
require_once dirname(__FILE__) . '/fixtures/Address.php';

class ClassMapTest extends PHPUnit_Framework_TestCase {

    public function testGetValue() {
        $arr = array(
            'Country' => 'Russia',
            'City' => 'Saint-Petersnurg',
            'Index' => '123431'
        );
        $addres = new Address();
        $addres->Country = 'Russia';
        $addres->City = 'Saint-Petersnurg';
        $addres->Index = '123431';
        $test = new \mapper\map\ClassMap(new Address());
        $this->assertEquals($addres, $test->getMapValue($arr));
    }

    public function testException() {
        $res = false;
        try {
            $test = new \mapper\map\ClassMap(new Client());
            $test->getMapValue('test');
        } catch (\mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals($res, true);
    }

    public function testError() {
        $test = new \mapper\map\ClassMap(new Address());
        $res = $test->getMapValue('test');
        $this->assertNull($res);
    }

}

?>
