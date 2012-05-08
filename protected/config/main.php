<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    'theme' => 'bootstrap-admin',
    'sourceLanguage' => 'en',
    'language' => 'en',
	'defaultController'=>'post',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix-components.*',
		'ext.xupload.models.XUploadForm',
		'application.extensions.nestedset.*',
    ),
	'aliases' => array(
	//assuming you extracted the files to the extensions folder
		'xupload' => 'ext.xupload'
	),

    'modules' => array(
		'errorHandler'=>array(
			'class'=>'application.modules.cms.components.CmsHandler',
		),
		'cms'=>array(
			// this layout will be set by default if no layout set for page
			//'defaultLayout'=>'cms',
		),
		'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
			'viewPath' => '//messageModuleCustom',
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
                'ext.bootstrap.gii',
				'application.gii',  //Ajax Crud template path

            ),

            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
       'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
        'coreCss'=>true, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
        'responsiveCss'=>true, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
        'plugins'=>array(
            // Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
            // To prevent a plugin from being loaded set it to false as demonstrated below
            'transition'=>true, // disable CSS transitions
            'tooltip'=>array(
                'selector'=>'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                'options'=>array(
                    'placement'=>'bottom', // place the tooltips below instead
                ),
            ),
            
            // If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
            // http://twitter.github.com/bootstrap/javascript.html
        ),
    ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
      'urlManager'=>array(
        	'urlFormat'=>'path',
        	'rules'=>array(
				'page/<view:\w+>/*'=>'site/page',
				'contact'=>'site/contact',
				'about'=>'site/page/view/about',
        		'tag/<tag:.*?>'=>'howto/index',
        		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'profile/*'=>'user/view',
				'register'=>'user/register',
				//'<controller:\w+>/<id:\d+>'=>'<controller>/view', 
					),
			'showScriptName'=>false,
			'caseSensitive'=>false, 
		),
       /* 'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database
        
          'db'=>array(
          'connectionString' => 'mysql:host=localhost;dbname=testdrive',
          'emulatePrepare' => true,
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
		  'tablePrefix'=>'tbl_',
          ),
         
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
		'facebook'=>array(
		'class' => 'ext.yii-facebook-opengraph.SFacebook',
		'appId'=>'ENTER FB APP ID', // needed for JS SDK, Social Plugins and PHP SDK
		'secret'=>'ENTER FB SECRET HERE', // needed for the PHP SDK 
		//'locale'=>'en_US', // override locale setting (defaults to en_US)
		//'jsSdk'=>true, // don't include JS SDK
		//'async'=>true, // load JS SDK asynchronously
		//'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
		//'status'=>true, // JS SDK - check login status
		//'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
		//'oauth'=>true,  // JS SDK -enable OAuth 2.0
		//'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
		//'html5'=>true,  // use html5 Social Plugins instead of XFBML
		//'ogTags'=>array(  // set default OG tags
			//'title'=>'MY_WEBSITE_NAME',
			//'description'=>'MY_WEBSITE_DESCRIPTION',
			//'image'=>'URL_TO_WEBSITE_LOGO',
		//),
		),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);