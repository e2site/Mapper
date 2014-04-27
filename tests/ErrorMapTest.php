<?php

require_once dirname(__FILE__) . '/../autoloader.php';
require_once dirname(__FILE__) . '/fixtures/Address.php';

class ErrorMapTest extends PHPUnit_Framework_TestCase {

    public function testError() {
        $test = new \mapper\map\ClassMap(new Address());
        $res = $test->getMapValue('test');
        $this->assertNull($res);
    }

}

?>
