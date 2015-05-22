<?php

/**
 * Контроллер работы с динамически переключением цсс файлов
 */
  
	/** стартуем сессию */
	@session_start();
	
    /** если сессию не удалось стартонуть, выбрасываем исключение */
	if(session_id()=='')
		throw new Exception('Failed to start session.');
		

	/** подключаем все необходимые классы */
	require_once 'class/CMainController.php';


    /** @var object CMainCssController обьект контроллера для работы с цсс файлами */
    $dynamicСss = new CMainController();
	

    /** указываем путь к конфигу */
    $config_path = 'dynamic_css_conf.php';
	
	
	/** Подгружаем конфиг */
    if( file_exists( $config_path ) ) {
	
       $config = require_once $config_path;
	   
       $config_screen = $dynamicСss->getConfigItem( $config['screen_css'] );
	   
       $config_mobile = $dynamicСss->getConfigItem( $config['mobile_css'] );
	   
    }


    /** @var string $com_variable переменная, по которая будет служить ключем в сессии и GET запросе */
    $com_variable  = CMainController::COM_CSS_DATA;


    /** 
	 * Если в сессии не существут данных об устройстве или выборе пользователя, тогда их нужнозаписать,
     * это означает, что мы работаем с версие CSS исходя из устройства пользователя
	 */
    if( !isset( $_SESSION[ $com_variable ] ) )
        $_SESSION[ $com_variable ] = $dynamicСss->getDefaultData( $dynamicСss->getDevice() );


    /** @var string $user_chois записываем текущую информациб об выборе типа */
    $user_chois = $_SESSION[ $com_variable ][ CMainController::COM_CSS_DATA_USER_CHOIS ]; //храниться линк для переключения стилей


    /** 
	 * Cначала проверяем или клиент не изменил тип верстки
     * для этого нужно проверить нет ли GET запроса  $_GET['user_choice'] и существует $_SESSION['css_data']['user_choice']
     */
    if( isset( $_GET['user_choice'] ) ) {
        
        $_SESSION[ $com_variable ] = $dynamicСss->getNewData( $user_chois ); // заносим новые данные в сессию
        
        header('Location:' . $_SERVER['HTTP_REFERER']); // редиректим на страницу от куда пришли
		
        die();
		
    }

	
    /** проверяем или есть GET запрос для отображения css файла <link rel="stylesheet" type="text/css" href="dynamicoutput.css.php?get_css" /> */
    if( isset( $_GET['get_css'] ) ) {
	
        /** определяем имя ссц файла по умолчанию, это файлы модуля /css/(screen.css|mobile.css) в зависимости от устройства или выбора пользователя */
        $css_file_name = $user_chois . '.css';
		
        $css_path = '';
		

		/** если в конфиге указан путь к цсс файлу полной версии */
		if( isset( $config_screen ) && $user_chois == $dynamicСss->getDeviceScreen() ) {
		
			$css_file_name = $config_screen['name'];
			
			$css_path = $config_screen['path'];
			
		}

		/** если в конфиге указан путь к цсс файлу мобильной версии версии */
		if( isset( $config_mobile ) && $user_chois == $dynamicСss->getDeviceMobile() ) {
		
			$css_file_name = $config_mobile['name'];
			
			$css_path = $config_mobile['path'];
			
		}
		
		
		/** запускаем работу класса для отдачи css файла */
		$dynamicСss->init( $css_file_name, $css_path );
		
    }

    /** выводим необходимый текст ссылки переключением версий */
    if( isset( $_GET['get_js'] ) ) {
	
        header('Content-type: application/javascript');
		
        echo 'document.getElementById("dynamic_css").innerHTML="' . $_SESSION[ $com_variable ][ CMainController::COM_CSS_DATA_LINK_NAME ] . '"';
		
    }
	
	