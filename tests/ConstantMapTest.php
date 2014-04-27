<?php

require_once dirname(__FILE__) . '/../autoloader.php';
require_once dirname(__FILE__) . '/fixtures/ConstValue.php';

class ConstantMapTest extends PHPUnit_Framework_TestCase {

    public function testMapClass() {
        $const = new \mapper\map\ConstantMap(new ConstValue());
        $this->assertEquals(ConstValue::$Yes, $const->getMapValue('Yes'));
        $this->assertEquals(ConstValue::$Yes, $const->getMapValue('yes'));
    }

    public function testMapArray() {
        $ar = array(
            'Yes' => 'Yes',
            'No' => 'No'
        );
        $const = new \mapper\map\ConstantMap($ar);
        $this->assertEquals(ConstValue::$Yes, $const->getMapValue('Yes'));
        $this->assertEquals(ConstValue::$Yes, $const->getMapValue('yes'));
    }

    public function testException() {
        $res = false;
        try {
            $ar = array(
                'Yes' => 'Yes',
                'No' => 'No'
            );
            $const = new \mapper\map\ConstantMap($ar);
            $test = $const->getMapValue('Error');
        } catch (\mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals(true, $res);
    }
    
    public function testConstructException() {
        $res = false;
        try {            
            $const = new \mapper\map\ConstantMap('test');

        } catch (\mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals(true, $res);
    }

    public function testReturnValue() {

        $ar = array(
            'Yes' => 'Yes',
            'No' => 'No'
        );
        $const = new \mapper\map\ConstantMap($ar,true);
        $test = $const->getMapValue('Error');

        $this->assertEquals($test, 'Error');
    }

}
?>
