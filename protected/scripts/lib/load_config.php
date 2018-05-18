<?php

$config = parse_ini_file(dirname(__FILE__).'/../config.conf');

foreach($config as $key => $value) {
	if (!defined($key)) {
        define($key, $value);
    }
}
