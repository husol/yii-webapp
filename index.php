<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$hus=dirname(__FILE__).'/protected/extensions/HUS.php';
$const=dirname(__FILE__).'/protected/constants.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($hus);
require_once($const);

Yii::createWebApplication($config)->run();