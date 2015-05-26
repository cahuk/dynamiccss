<?php 

 /**
  * Class css file for output
  *
  * @author s1lent <webcahuk@gmail.com>
  */

require_once 'class/CControlFile.php';

class CControlCss extends CControlFile
{

    /**
	 * In the constructor you need to pass the file name and path where it is located relative to the application
     * @param string $file_name
     * @param string $css_path
	 */
	public function __construct( $file_name, $path )
	{
		parent::__construct( $file_name, $path );

        /** We call the display method of the parent class, but pass this class in order to send the necessary headers that we indicate in the overridden method header () */
        $this->display( $this );
    }

    /**
     * Override the parent abstract method in which it is necessary to specify a title given out content type Content-type well and the other (if necessary)
     */
    public function header()
   {
       header('Content-type: text/css');
   }


}
