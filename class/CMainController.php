<?php

/**
 * The main class of a client to run a dynamic substitution css files
 */
 
/** connect the used classes */
require_once 'class/CIdentifyDevice.php';
require_once 'class/CControlCss.php';

class CMainController {

    /** these constants are the keys, which will be stored in our data Session and GET requests when you switch between the css files */
    const COM_CSS_DATA = 'css_data';
    const COM_CSS_DATA_USER_CHOIS = 'user_choice';
    const COM_CSS_DATA_LINK_NAME  = 'link_name';

	/** @property array $_link_and_name an array that contains the names of links to switch versions of css files */
    private $_link_and_name  = [
	
        'screen' => 'Перейти на мобильную версию сайта', // if now the full version, then the link must be called with an indication to the mobile version
		
        'mobile' => 'Перейти на полную версию сайта',    // and conversely, if it is a mobile version should be called a link to the full transition
    
	];

	/** @property array $_new_data It keeps the data on the user's selections, which are then recorded in the session */
    private $_new_data = array(); 
	
	/** @property CControlCss $_controlCss stores the object reference CControlCss */
    private $_controlCss = null;	
	
	/** @property string $_device stores the user's device */
	private $_device ='';
	
	/** @property string $_device_screen It holds the key to the desktop version CIdentifyDevice::SCREEN */
	private $_device_screen = '';
	
	/** @property string $_device_mobile It holds the key to the mobile version CIdentifyDevice::MOBILE */
	private $_device_mobile = '';
	
	
	/**
	 * In the constructor to determine the user's device and record keys for properties $_device_screen and $_device_mobile
	 */
	public function __construct()
	{
		$this->_device = CIdentifyDevice::getDevice();
		
		$this->_device_screen = CIdentifyDevice::SCREEN;
		
		$this->_device_mobile = CIdentifyDevice::MOBILE;
	}

    /**
     * initialization class
     */
    public function init( $css_file_name, $path='' )
    {
		/** if the path to the css is not specified, then take the default - this module folder /css/ */
		if( $path=='' )
			$path = pathinfo( $_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME ) . '/css';
	
		/** run the class CControlCss to output our css file */		
        $this->_controlCss = new CControlCss( $css_file_name, $path );
    }	
	
    /**
     * @return string user device
     */
    public function getDevice()
    {
		return $this->_device;
    }
	
    /**
     * @return string user device screen
     */
    public function getDeviceScreen()
    {
		return $this->_device_screen;
    }
	
    /**
     * @return string user device mobile
     */
    public function getDeviceMobile()
    {
		return $this->_device_mobile;
    }

    /**
     * @param string $user_chois the user's choice
     * @return array $this->_new_data new data for inclusion in the session
     */
    public function getNewData( $user_chois )
    {
        if( $user_chois == $this->_device_screen ) {

            $this->createData( $this->_device_mobile, $this->_device_mobile );

        } else {

            $this->createData( $this->_device_screen, $this->_device_screen );
        }

        return $this->_new_data;
    }

    /**
     * @param string $user_device устройство пользователя
     * @return array $this->_new_data new data for inclusion in the session
     */
    public function getDefaultData( $user_device )
    {
        if( $user_device == $this->_device_screen ) {

            $this->createData( $this->_device_screen, $this->_device_screen );

        } else {

            $this->createData( $this->_device_mobile, $this->_device_mobile );
        }

        return $this->_new_data;
    }

    /**
     * @param string $data_user_chois the selection or the user's device
     * @param string $data_link_name name links to switch between versions of css files
     */
    private function createData( $data_user_chois, $data_link_name )
    {
        $this->_new_data = [
		
            self::COM_CSS_DATA_USER_CHOIS => $data_user_chois,
			
            self::COM_CSS_DATA_LINK_NAME  => $this->_link_and_name[ $data_link_name ]
			
        ];

    }

    /**
     * @param array $config_item
     * @return mixed array|null
     */
    public function getConfigItem( $config_item )
    {
        $config_item = (array) $config_item;
        if( isset( $config_item['path'], $config_item['name']) 
			&& !empty( $config_item['path'] ) 
			&& !empty( $config_item['name'] ) )
		{
		
            return $config_item;
			
        }

        return null;
    }

}