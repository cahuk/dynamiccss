<?php

/**
 * The controller works with dynamic switching css files
 */
  
	/** start session */
	@session_start();
	
    /** if there is no session, then throws an exception */
	if(session_id()=='')
		throw new Exception('Failed to start session.');
		

	/** connect the main controller class */
	require_once 'class/CMainController.php';


    /** @var object CMainCssController controller object to work with css files */
    $dynamicСss = new CMainController();
	

    /** specify the path to a config */
    $config_path = 'dynamic_css_conf.php';
	
	
	/** load the configuration */
    if( file_exists( $config_path ) ) {
	
       $config = require_once $config_path;
	   
       $config_screen = $dynamicСss->getConfigItem( $config['screen_css'] );
	   
       $config_mobile = $dynamicСss->getConfigItem( $config['mobile_css'] );
	   
    }


    /** @var string $com_variable variables that will serve as a key in the session in a GET request */
    $com_variable  = CMainController::COM_CSS_DATA;


    /** 
	 * If the session, there is no data on the device or the user's selection, then they need to write,
     * this means that we work with the version of the device based on the CSS user
	 */
    if( !isset( $_SESSION[ $com_variable ] ) )
        $_SESSION[ $com_variable ] = $dynamicСss->getDefaultData( $dynamicСss->getDevice() );


    /** @var string $user_chois Writes the current information on the choice of the type of device */
    $user_chois = $_SESSION[ $com_variable ][ CMainController::COM_CSS_DATA_USER_CHOIS ]; //store link to switch styles


    /** 
	 * First, the client does not check or change the type of layout
     * it needs to check whether the request $_GET ['user_choice'] and not isset $_SESSION['css_data']['user_choice']
     */
    if( isset( $_GET['user_choice'] ) ) {
        
        $_SESSION[ $com_variable ] = $dynamicСss->getNewData( $user_chois ); // Pushes the new data in the session
        
        header('Location:' . $_SERVER['HTTP_REFERER']); // redirect to the page where you came from
		
        die();
		
    }

	
    /** check or have a GET request to display the css file <link rel="stylesheet" type="text/css" href="dynamicoutput.css.php?get_css" /> */
    if( isset( $_GET['get_css'] ) ) {
	
        /** determine the name of the CSS default file is the module files /css/(screen.css|mobile.css) epending on the device or the user's choice */
        $css_file_name = $user_chois . '.css';
		
        $css_path = '';
		

		/** if the path to the config file css desktop version */
		if( isset( $config_screen ) && $user_chois == $dynamicСss->getDeviceScreen() ) {
		
			$css_file_name = $config_screen['name'];
			
			$css_path = $config_screen['path'];
			
		}

		/** if the path to the config file css mobile version */
		if( isset( $config_mobile ) && $user_chois == $dynamicСss->getDeviceMobile() ) {
		
			$css_file_name = $config_mobile['name'];
			
			$css_path = $config_mobile['path'];
			
		}
		
		
		/** Run the job class returns css file */
		$dynamicСss->init( $css_file_name, $css_path );
		
    }

    /** display the desired link text switching versions */
    if( isset( $_GET['get_js'] ) ) {
	
        header('Content-type: application/javascript');
		
        echo 'document.getElementById("dynamic_css").innerHTML="' . $_SESSION[ $com_variable ][ CMainController::COM_CSS_DATA_LINK_NAME ] . '"';
		
    }
	
	