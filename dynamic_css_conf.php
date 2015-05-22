<?php
	/**
	* указываем путь к css файлам отдельно для мобильной и обычной версии
     * пример для обычной версии:
     * 'screen_css' => [
            'path'=>'/dynamiccss/css1/',
            'name'=>'screen.css'
            ]
     *
     * пример для мобильной версии:
     * 'mobile_css' =>[
            'path'=>'/dynamiccss/css/',
            'name'=>'mobile.css'
        ]
     *
	* если нужно подгрузить только один файл, например только mobile.css, а второй оставить по умолчанию тогда достаточно удалить елемент 'screen_css или mobile_css' из массива или задать ему пустое значение
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