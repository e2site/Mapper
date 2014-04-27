<?php

namespace mapper\map;

/**
 * Фильтр для обработки ошибок возвращает данные переданные в конструктор
 * если при маппинге произошла ошибка и было вызвано исключение, то класс Mapper
 * проверить описан ли у объекта параметр для вызова getMapValue в случае ошибки
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */

class ErrorMap implements \mapper\interfaces\iMapValue {
    private $value;

    /**
     * 
     * @param type $value Значение, которое возвратится в результате запуска
     */
    public function __construct($value) {
        $this->value = $value;
    }

    public function getMapValue($data=null) {
        return $value;
    }
}
?>
