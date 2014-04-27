<?php


namespace mapper;

/**
 * Mapper преобразует массив параметров(в том числе вложенные массивы) 
 * в объекты и другие типы данных исходя из правил описанных в методе getSchemaMap
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */
class Mapper {

    private $mapObject;

    /**
     * 
     * @param \mapper\interfaces\iSchemaMap $map класс реализующий метод getSchemaMap
     * @throws \mapper\exceptions\MapException
     */
    public function __construct(\mapper\interfaces\iSchemaMap $map) {
        $this->mapObject = $map;
        if (!is_array($this->mapObject->getSchemaMap()))
            throw new \mapper\exceptions\MapException('Класс ' . get_class($this->mapObject) . ' не вернул массив с параметрами маппинг при вызове getSchemaMap.');
        foreach ($this->mapObject->getSchemaMap() as $key => $obj) {
            if (!($obj instanceof \mapper\interfaces\iMapValue))
                throw new \mapper\exceptions\MapException('Экземпляр класс в ключе ' . $key . ' не реализует интерфейс iMapValue.');
        }
    }

    /**
     * Преобразует массив в объект, в случае неудачи вызывает исключение, если в массиве маппинга не определен 
     * параметр __MAP_ERROR__ 
     * в случае если параметр определен, то вызывается getMapValue у класса определенного в __MAP_ERROR__ 
     * @param array $data Массив для преобразования в объект
     * @return object возвращает объект переданный в конструктор с заполнеными значениями
     * @throws MapException исключения в случае не верной передачи массива для преобразования
     */
    public function Map($data) {
        try {
            if (!is_array($data))
                throw new \mapper\exceptions\MapException('При вызове Map был передан '.gettype($data).' вместо array');
            $mapRule = $this->mapObject->getSchemaMap();
            foreach ($data as $key => $val) {
                if (isset($mapRule[$key])) {
                    $this->mapObject->{$key} = $mapRule[$key]->getMapValue($val);
                } else {
                    $this->mapObject->{$key} = $val;
                }
            }
            return $this->mapObject;
        } catch (\mapper\exceptions\MapException $error) {
            if (isset($this->mapObject->getSchemaMap()['__MAP_ERROR__'])) {
                return $this->mapObject->getSchemaMap()['__MAP_ERROR__']->getMapValue($data);
            } else {
                throw new \mapper\exceptions\MapException($error->getMessage());
            }
        }
    }

}

?>
