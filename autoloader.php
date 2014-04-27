<?php

define('MAPPER_PATH',  dirname(__FILE__));

require_once MAPPER_PATH . '/Mapper.php';
require_once MAPPER_PATH . '/exceptions/MapException.php';
require_once MAPPER_PATH . '/interfaces/iSchemaMap.php';
require_once MAPPER_PATH . '/interfaces/iMapValue.php';
require_once MAPPER_PATH . '/map/ClassMap.php';
require_once MAPPER_PATH . '/map/ArrayClassMap.php';
require_once MAPPER_PATH . '/map/ConstantMap.php';
require_once MAPPER_PATH . '/map/ErrorMap.php';
?>
