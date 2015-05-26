<?php 

 /**
  *  An abstract class for working with files
  *
  * @property string $_path путь к директории файла относительно корня приложения
  * @property string $_file_name имя файла
  *
  * @author s1lent <webcahuk@gmail.com>
  */


abstract class CControlFile
{
    private $_file_name = '';   // file name
    private $_path  = '';       // directory path

	
	public function __construct( $file_name, $path )
	{
        $this->setFileName( $file_name );

        $this->setPath( $path );
	}

	
    /**
     * @param string $file_name method sets the name of the file
     */
    public function setFileName( $file_name )
    {
        $this->_file_name = $file_name;
    }


    /**
     * @return string method returns the name of the file
     */
    public function getFileName()
    {
        return $this->_file_name;
    }
	

    /**
     * The method specifies the absolute path where the file is located, with which we are working
     * @param string $path
     */
    public function setPath( $path )
    {
        $sep = DIRECTORY_SEPARATOR;

        $path = $_SERVER['DOCUMENT_ROOT'] . $sep . trim( str_replace( ['/','\\'], $sep, $path ), $sep ) ;

        $this->_path = $path . $sep;
    }

	
    /**
     * The method returns the path where the file
     */
    public function getPath()
    {
        return $this->_path;
    }

	
    /**
     * @return mixed the file itself or throws an exception if the file does not exist
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
	 * he method returns an absolute pathname
     * @return string path
     */
    public function getFilePath()
    {
        return $this->_path . $this->_file_name;
    }


    /**
     * It is necessary to override this method in a child class with the obligatory indication of the title Content-type:
	 * example:
     * 	header('Content-type: text/css');
	 * or
     * 	header('Content-type: application/javascript');
	 * It is also possible to add additional headers, if appropriate
     */
    abstract function header();


    /**
     * Display our file
     * The display method pass child object in which overridden method header ()
     */
    public function display( CControlFile $subClass )
    {
        $subClass->header();
        echo $this->getFile();
    }


}
