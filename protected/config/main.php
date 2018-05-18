<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'app_config.php';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>BASE_DIR,
	'name'=>SITE_NAME,

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.business.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','192.168.1.101','192.168.0.101'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
	/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
	*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host='.DATABASE_SERVER_NAME.';dbname='.DATABASE_NAME,
			'emulatePrepare' => true,
			'username' => DATABASE_USERNAME,
			'password' => DATABASE_PASSWORD,
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        // COMMON
        'HUS'=>array(
            'class'=>'application.extensions.HUS',
        ),
		'viewRenderer'=>array(
			'class'=>'application.extensions.ESmartyViewRenderer',
			  'fileExtension' => '.tpl',
			  //'pluginsDir' => 'application.smartyPlugins',
			  //'configDir' => 'application.smartyConfig',
			  //'prefilters' => array(array('MyClass','filterMethod')),
			  //'postfilters' => array(),
			  //'config'=>array(
			  //    'force_compile' => YII_DEBUG,
			  //   ... any Smarty object parameter
			  //)
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>unserialize(ARR_PARAM),
);
