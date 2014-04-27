<?php

namespace mapper\map;


/**
 * Фильтр для обработки массива классов, пример:
 * array(
 *  array('Name'=>'Ivan','Age'=>21),
 *  array('Name'=>'Sergey','Age'=>23)
 * );
 * В пезультате вернет массив из двух объектов
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */

class ArrayClassMap implements \mapper\interfaces\iMapValue {

    private $mapObject;

    /**
     * 
     * @param \mapper\interfaces\iSchemaMap $map Экземпляр класса, массив которых надо создать
     */
    public function __construct(\mapper\interfaces\iSchemaMap $map) {
        $this->mapObject = $map;
    }

    public function getMapValue($data) {
        if (!is_array($data))
            throw new \mapper\exceptions\MapException('При обработке ArrayClassMap передан '.gettype($data).' вместо array');
        $res = array();
        foreach ($data as $val) {
            $newObj = new \ReflectionClass($this->mapObject);
            $mapper = new \mapper\Mapper($newObj->newInstance());            
            $res[] = $mapper->Map($val);
        }
        return $res;
    }

}

?>
