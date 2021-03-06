<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	'modules' => [
			'rbac' => [
					'class' => 'yii2mod\rbac\Module',
			],
	],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    'authManager' => [
    		'class' => 'yii\rbac\DbManager',
    		'defaultRoles' => ['guest', 'user'],
    	],
    
    ],
];
