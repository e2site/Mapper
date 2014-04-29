<?php
namespace mapper\map;

/**
 * Фильтр преобразует текстовые или иные переменные к переменным 
 * описаным в классе как статик или массив
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */

class ConstantMap implements \mapper\interfaces\iMapValue {
    private $consList = array();
    private $returnVal;

    /**
     * Конструктор обработчика констант
     * @param object/array $structure
     * @param boolean $returnVal Если не удалось найти в структуре переданного параметра вернет то значение, которое было передано вместо исключения 
     * @throws MapException
     */
    public function __construct($structure,$returnVal = false) {
        $this->returnVal = $returnVal;
        if(is_object($structure)) {            
            $param = get_class_vars(get_class($structure));
            foreach ($param as $name => $value) {
                $this->consList[$name] = $value;
            }
        }
        else if(is_array($structure)) {
            foreach ($structure as $name => $value) {
                $this->consList[$name] = $value;
            }
        } else {
            throw new \mapper\exceptions\MapException('В ConstantMap передан '.gettype($structure).', нужно передать Массив, либо Объект');
        }
    }

    public function getMapValue($data){
        foreach ($this->consList as $val) {
            if(strtolower($data) == strtolower($val)) {
                return $val;
            }
        }
        if($this->returnVal) {
            return $data;
        }else {
            throw new \mapper\exceptions\MapException('Не найдено констант с параметром '.$data);
        }
    }
}
?>
