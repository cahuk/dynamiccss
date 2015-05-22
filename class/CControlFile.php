<?php 

 /**
  *  Абстрактный класс для работы с файлами
  *
  * @property string $_path путь к директории файла относительно корня приложения
  * @property string $_file_name имя файла
  *
  * @author s1lent <webcahuk@gmail.com>
  */


abstract class CControlFile
{
    private $_file_name = '';   // имя файла
    private $_path  = '';       // путь к директории

	
	public function __construct( $file_name, $path )
	{
		/** устанавливаем имя файла */
        $this->setFileName( $file_name );

        /** указываем путь к папке где лежат файл */
        $this->setPath( $path );
	}

	
    /**
     * @param string $file_name метод устанавливает имя файла
     */
    public function setFileName( $file_name )
    {
        $this->_file_name = $file_name;
    }


    /**
     * @return string метод возвращает имя файла
     */
    public function getFileName()
    {
        return $this->_file_name;
    }
	

    /**
     * Метод задает абсолютный путь где находится файл, с которым мы работаем
     * @param string $path
     */
    public function setPath( $path )
    {
        $sep = DIRECTORY_SEPARATOR;

        $path = $_SERVER['DOCUMENT_ROOT'] . $sep . trim( str_replace( ['/','\\'], $sep, $path ), $sep ) ;

        $this->_path = $path . $sep;
    }

	
    /**
     * Метод возвращает путь где лежит файл
     */
    public function getPath()
    {
        return $this->_path;
    }

	
    /**
     * @return mixed сам файл или выбрасывает исключение, если файл не существует
     * @throws exception
     */
    public function getFile()
    {
        $file = $this->getFilePath();

        if( file_exists( $file ) )
            return file_get_contents( $file );
        else
            throw new Exception("File {$file} dos not exists");
    }

	
    /**
	 * Меотод возвращает абсолютный путь к файлу
     * @return string path
     */
    public function getFilePath()
    {
        return $this->_path . $this->_file_name;
    }


    /**
     * Нужно переопределить этот метод в дочерних класах с обязательным указанием заголовка Content-type:
	 * пример:
     * 	header('Content-type: text/css');
	 * или
     * 	header('Content-type: application/javascript');
	 * Так же можно добавить дополнительные заголовки, если это необходимо
     */
    abstract function header();


    /**
     * Выводим наш файл
     * В метод display передаем дочерний обьект в котором переопределен метод header()
     */
    public function display( CControlFile $subClass )
    {
        $subClass->header();
        echo $this->getFile();
    }


}
