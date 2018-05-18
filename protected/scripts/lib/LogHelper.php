<?php
require_once(dirname(__FILE__).'/Log.php');

// Logger's log level
//	0 - log nothing
//	1 - log errors
//	2 - log errors&warnings
//	3 - log errors&warnings&infos
if (!defined('LOGGER_LOG_LEVEL')) {
	define('LOGGER_LOG_LEVEL', 3);
}

// Logger's log file
if (!defined('LOGGER_LOG_FILE')) {
	define('LOGGER_LOG_FILE', 'logs/logger.log');
}

// Logger's log format
if (!defined('LOGGER_LOG_FORMAT')) {
	define('LOGGER_LOG_FORMAT', "{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}");
}

class LogHelper
{
	/**
	 * Log an error message
	 */
	function error($code, $message) {
		if (LOGGER_LOG_LEVEL > 0) {
			$log = &Log::getInstance(LOGGER_LOG_FILE, array('format' => LOGGER_LOG_FORMAT));

			$entry['level'] = 'ERROR';
			$entry['code'] = $code;
			$entry['message'] = $message;

			$log->addEntry($entry);
		}
	}

	/**
	 * Log an information message
	 */
	function info($code, $message) {
		if (LOGGER_LOG_LEVEL > 2) {
			$log = &Log::getInstance(LOGGER_LOG_FILE, array('format' => LOGGER_LOG_FORMAT));

			$entry['level'] = 'INFO';
			$entry['code'] = $code;
			$entry['message'] = $message;

			$log->addEntry($entry);
		}
	}

	/**
	 * Log a warning message
	 */
	function warning($code, $message) {
		if (LOGGER_LOG_LEVEL > 2) {
			$log = &Log::getInstance(LOGGER_LOG_FILE, array('format' => LOGGER_LOG_FORMAT));

			$entry['level'] = 'WARNING';
			$entry['code'] = $code;
			$entry['message'] = $message;

			$log->addEntry($entry);
		}
	}

	/**
	 * Log a notification message
	 */
	function notice($code, $message) {
		if (LOGGER_LOG_LEVEL > 2) {
			$log = &Log::getInstance(LOGGER_LOG_FILE, array('format' => LOGGER_LOG_FORMAT));

			$entry['level'] = 'NOTICE';
			$entry['code'] = $code;
			$entry['message'] = $message;

			$log->addEntry($entry);
		}
	}
}