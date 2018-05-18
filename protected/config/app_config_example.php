<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!function_exists("mlog")) {
    function mlog($content, $override = false, $filename = '/tmp/debug') {
        //date_default_timezone_set('Asia/Ho_Chi_Minh');
        $openType = $override ? 'w' : 'a';
        if (!$handle = @fopen($filename, $openType)) {
            $result = 3; //"Cannot open file ($filename)";
        }
        //if(empty($content)) $content = var_export($content, true);
        if (empty($content) || is_array($content) || is_object($content)) {
            $content = print_r($content, true);
        }
        $content = date('Y-m-d H:i:s') . "  $content \n\n";

        // Write $somecontent to our opened file.
        if (@fwrite($handle, $content) === FALSE) {
            $result = 2; //"Cannot write to file ($filename)";
        } else {
            $result = 1; //"Success, wrote ($somecontent) to file ($filename)";
        }
        @fclose($handle);
        return $result;
    }
}

// COMMON
define('DIR_SEP', DIRECTORY_SEPARATOR);

// Your site name
define('SITE_NAME',          'Huyen Doan Trang Bang | huyendoantrangbang.org.vn');

// Database information
define('DATABASE_SERVER_NAME',      'localhost');
define('DATABASE_NAME',             'huyendoan');
define('DATABASE_USERNAME',             'root');
define('DATABASE_PASSWORD',             '123456');

// Base Path
define('BASE_DIR', dirname(__FILE__).DIR_SEP.'..');

// Application Path
define('APP_DIR',  BASE_DIR.DIR_SEP.'..');

// Define Parameters
define('ARR_PARAM',	serialize(
	array(
		'imagesPath'=>APP_DIR.DIR_SEP.'images',
		'filesPath'=>APP_DIR.DIR_SEP.'files',
		'backupPath'=>APP_DIR.DIR_SEP.'backup',
		'adminEmail'=>'huyendoantrangbang@gmail.com',
		'pagingPerPage'=> 10,
)));

// Define array language for your site
define('ARR_LANGUAGE',      serialize(array('en',
                                            'vi'
                            )));

// Define default language to present
define('APP_DEFAULT_LANGUAGE',              'vi');

?>
