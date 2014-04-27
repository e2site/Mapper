#Mapper - библеотека для преобразования массива(включая вложенные массивы) в объект 

###Назначение

Изначально написан для работы с различными api, данные в формате json преобразуются в массив, а затем при помощи библеотеки сопаставляются.
Так же библеотека позволяет создавать фильтры для обработки данных в момент преобразования. Обработки ошибок.


###Подключение

```php
<?php
require_once dirname(__FILE__) . '/mapper/autoloader.php';

```

###Стандартные фильтры


* ArrayClassMap - Фильтр для обработки массива состоящих из классов(вложенные массивы)
* ClassMap - Фильтр преобразует массив в класс
* ConstantMap - Фильтр преобразует текстовые или иные переменные 
* ErrorMap - Фильтр для обработки ошибок

###Описание обычного объекта для маппинга
Все объекты для сопастовления должны реализовать interface 
#### `iSchemaMap`
метод getSchemaMap должен вернуть массив содержащий описание параметров, которым требуются специальные
сопастовления, массив имеет вид
```
array(
  'Имя параметра' => new Filter(),
  'Имя параметра 2' => new Filter2()
}
```

```php
<?php

class Address implements mapper\interfaces\iSchemaMap {
    public $Country;
    public $City;
    public $Index;
    
    public function getSchemaMap() {        
        return array(
            '__MAP_ERROR__' => new mapper\map\ErrorMap(null)
            
        );
    }
}

```
В данном пример описан класс у которого будут сопоставленны параметры 
```
   Country;
   City;
   Index;
```    
В случае ошибки при сопастовлении в данном пример вместо исключения 
```
MapException
```
Будет возвращен 
```
NULL
```

Если в объекте нету параметров для которых требуется нестандартное сопастовление, то можно вернуть пустой массив 

```php
<?php

class Address implements mapper\interfaces\iSchemaMap {
    public $Country;
    public $City;
    public $Index;
    
    public function getSchemaMap() {        
        return array();
    }
}

```
Данный пример отличается от преведущего тем, что в случае ошибки будет вывано исключение MapException


###Описание объекта с вложенными объектами


Для примера класс клиент состоит из массива классов адрес
```php
class Client implements \mapper\interfaces\iSchemaMap {
    
    
    public $Name;
    public $Age;
    
    public $Addresses;

    public function getSchemaMap(){
        return Array(
          'Addresses' => new \mapper\map\ArrayClassMap(new Address()),  
        );
    }
}
```
В данном примере мы указали, что для параметра $Addresses нужно использовать фильтр ArrayClassMap и передали в него класс, который будет использоватся для сопастовления.
Входные данные для преобразования будут следующего вида:
```php
  array(
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
```        

###Преобразование массива в класс
Для преобразования массива в класс нужно создать экземпляр класса Mapper, в который передается указатель на класс, который нужно сопаставить, затем вызвать метод Map, в который неоходимо передать массив для сопастовления
```php
require_once dirname(__FILE__) . '/mapper/autoloader.php';

$testArray = array(
            'Name' => 'Filipp',
            'Age' => 26,
            'Addresses' => array(
            )
        );
        
$map = new \mapper\Mapper(new Address());   
$classAddress = $map->Map($testArray);
        
```

###Создание своих фильтров
Для создания своих фильтров нужно создать новый класс, который реализует interface
#### `iMapValue`

В качестве примера создадим фильтр, который получает массив, а возвращает сумму.
Пример входных данных, который будет обрабатывать объект
```php
 array(
 ...,
 'Value' => array(1,2,3),
 ...
 );
```

Теперь код нашего фильтра
```php
class ArraySumMap implements \mapper\interfaces\iMapValue {

    public function getMapValue($data) {
        $val = 0;
        foreach($data as $v) {
          $val += $v;
        }
        return $val;
    }
}
?>
```

И экземпляр класса, который использует этот фильтр
```php
class TestValue implements mapper\interfaces\iSchemaMap {

    public $Value;
    
    public function getSchemaMap() {        
        return array(
            'Value' => new mapper\map\ArraySumMap()
            
        );
    }
}
```
