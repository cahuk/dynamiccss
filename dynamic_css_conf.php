<?php
	/**
	* specify the path to the css file separately for the mobile and regular versions
     * an example for the desktop version:
     * 'screen_css' => [
            'path'=>'/dynamiccss/css1/',
            'name'=>'screen.css'
            ]
     *
     * an example for the mobile version:
     * 'mobile_css' =>[
            'path'=>'/dynamiccss/css/',
            'name'=>'mobile.css'
        ]
     *
	* if you want to load a single file, for example, only mobile.css, and the second to leave the default then simply delete yelement 'screen_css or mobile_css' from an array or ask him a blank
	*/
	return [
		'screen_css' => [
            'path'=>'dynamiccss/css',
            'name'=>'screen.css'
        ],
		'mobile_css' =>[
            'path'=>'dynamiccss/css',
            'name'=>'mobile.css'
        ]
	];