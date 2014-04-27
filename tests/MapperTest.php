<?php

require_once dirname(__FILE__) . '/../autoloader.php';
require_once dirname(__FILE__) . '/fixtures/Address.php';
require_once dirname(__FILE__) . '/fixtures/Client.php';
require_once dirname(__FILE__) . '/fixtures/MapDestroy.php';

class MapperTest extends PHPUnit_Framework_TestCase {

    private $mapArray1;
    private $mapArray2;
    private $mapArray3;

    public function setUp() {
        $this->mapArray1 = array(
            'Country' => 'Russia',
            'City' => 'Saint-Petersnurg',
            'Index' => '123431'
        );

        $this->mapArray2 = array(
            'Name' => 'Filipp',
            'Age' => 26,
            'Addresses' => array(
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
            )
        );
        $this->mapArray3 = array(
            'Name' => 'Filipp',
            'Age' => 26,
            'Addresses' => array(
            )
        );
    }

    public function testObject() {
        
        $map = new \mapper\Mapper(new Address());
        $addres = new Address();
        $addres->Country = 'Russia';
        $addres->City = 'Saint-Petersnurg';
        $addres->Index = '123431';
        $this->assertEquals($addres, $map->Map($this->mapArray1));
    }

    public function testNestedObjects() {
        $map = new \mapper\Mapper(new Client());
        $client = new Client();

        $a1 = new Address();
        $a1->Country = 'Russia';
        $a1->City = 'Saint-Petersnurg';
        $a1->Index = '123431';

        $a2 = new Address();
        $a2->Country = 'Russia';
        $a2->City = 'Moscow';
        $a2->Index = '123421';

        $client->Name = 'Filipp';
        $client->Age = 26;
        $client->Addresses = array($a1, $a2);

        $this->assertEquals($client, $map->Map($this->mapArray2));
    }

    public function testArrayCountNull() {
        $map = new \mapper\Mapper(new Client());
        $client = new Client();
        $client->Name = 'Filipp';
        $client->Age = 26;
        $client->Addresses = array();

        $this->assertEquals($client, $map->Map($this->mapArray3));
    }

    public function testIsArray() {
        $map = new \mapper\Mapper(new Address());
        $this->assertEquals(new Address, $map->Map(array()));
    }

    public function testMapException() {
        $res = false;
        try {
            $data = null;
            $map = new \mapper\Mapper(new Client());
            $test = $map->Map($data);
        } catch (\mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals(true, $res);
    }

    public function testMapError() {
        $data = null;
        $map = new \mapper\Mapper(new Address());
        $this->assertNull($map->Map($data));
    }

    public function testExceptionConstruct() {
        $res = false;
        try {
            $map = new \mapper\Mapper(new MapDestroy());
        } catch (\mapper\exceptions\MapException $err) {
            $res = true;
        }
        $this->assertEquals(true, $res);
    }

}

?>
