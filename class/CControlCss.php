<?php 

 /**
  * Класс для выводом css файла
  *
  * @author s1lent <webcahuk@gmail.com>
  */


require_once 'class/CControlFile.php';

class CControlCss extends CControlFile
{

    /**
	 * В конструктор нужно передать имя файла и путь где он лежит относительно корня приложения
     * @param string $file_name
     * @param string $css_path
	 */
	public function __construct( $file_name, $path )
	{
		parent::__construct( $file_name, $path );

        /** вызываем метод display родительского класса, но передаем этот класс с целью отправки необходимых заголовков, которые мы указываем в переопределенном методе header() */
        $this->display( $this );
    }

    /**
     * Переопределенный родительский абстрактный метод, в котором нужно обязательно указать заголовок отдаваемого типа контента Content-type ну и других (если это необходимо)
     */
    public function header()
   {
       header('Content-type: text/css');
   }


}
