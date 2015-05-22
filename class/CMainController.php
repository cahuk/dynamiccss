<?php

/**
 * Клас для запуска работы с динамическим css файлами
 */
 
/** подключаем используемые классы */
require_once 'class/CIdentifyDevice.php';
require_once 'class/CControlCss.php';

class CMainController {

    /** эти константы являються ключами, по которым будут храниться наши данные в сесии и в GET запросе при переключении между css файлами */
    const COM_CSS_DATA = 'css_data';
    const COM_CSS_DATA_USER_CHOIS = 'user_choice';
    const COM_CSS_DATA_LINK_NAME  = 'link_name';

	/** @property array $_link_and_name массив, в котором находится имена ссылок для переключения версий css файлов */
    private $_link_and_name  = [
	
        'screen' => 'Перейти на мобильную версию сайта', // если сейчас полная версия, тогда ссылку нужно назвать с указанием на мобильную версию
		
        'mobile' => 'Перейти на полную версию сайта',    // и наоборот, если это мобильная версия, нужно назвать ссылку переход на полную
    
	];

	/** @property array $_new_data хранит в себе данные об выборе пользователя, которые потом заносятся в сессию */
    private $_new_data = array(); 
	
	/** @property CControlCss $_controlCss хранит ссылку на обьект CControlCss */
    private $_controlCss = null;	
	
	/** @property string $_device хранит устройство пользователя */
	private $_device ='';
	
	/** @property string $_device_screen хранит ключ для десктопной версии CIdentifyDevice::SCREEN */
	private $_device_screen = '';
	
	/** @property string $_device_mobile хранит ключ для мобильной версии CIdentifyDevice::MOBILE */
	private $_device_mobile = '';
	
	
	/**
	 * В конструкторе определяем устройство пользователя и записываем ключи для свойст $_device_screen и $_device_mobile
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
		/** если путь к папке css не указан, тогда берем по умолчанию - папку этого модуля /css/ */
		if( $path=='' )
			$path = pathinfo( $_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME ) . '/css';
	
		/** запускаем класс CControlCss для вывода нашего css файла */
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
     * @param string $user_chois выбор пользователя
     * @return array $this->_new_data новые данные для занесения в сессию
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
     * @return array $this->_new_data новые данные для занесения в сессию
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
     * @param string $data_user_chois выбор или устройство клиента
     * @param string $data_link_name название ссылки для переключения между версиями css файлов
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