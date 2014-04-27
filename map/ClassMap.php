<?php

namespace mapper\map;


/**
 * Фильтр преобразует массив в класс, по сути фильтр нужен для вложенных 
 * классов, когда у одного класса в параметрах есть экземпляр другого
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */
class ClassMap implements \mapper\interfaces\iMapValue {
    
    private $mapper;
    
    public function __construct(\mapper\interfaces\iSchemaMap $map) {
        $this->mapper = new \mapper\Mapper($map);
    }  

    public function getMapValue($data) {
        return $this->mapper->Map($data);
    }
}
?>
