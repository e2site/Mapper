<?php

namespace mapper\interfaces;

/**
 * Интерфейс, используется при создание классов, которые отвечают за маппинг
 * нестандартных(значения которые при присвоении нужно преобразовать или изменить) значение.
 * PHP version 5
 * @package mapper
 * @author Filipp C <e2site@yandex.ru>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 */

interface iMapValue {
    
    /**
     * Возвращает данные для которых требовалось специальное преобразование 
     * @param All $data Данные для преобразования
     * @return All результат обработки
     */
    public function getMapValue($data);
}
?>
