<?php
class Bootstrap
{

    private $_url = null;
    private $_controller = null;
    private $_controllerPath="controllers/";
    private $_defaultFile=DEFAULT_PAGE;
    private $_errorFile="error.php";

    public function init()
    {
        // Sets the protected $_url
        $this->_getUrl();
        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        if (empty($this->_url[0]))
        {
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExistingController();
        $this->_callControllerMethod();
    }


    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    private function _loadDefaultController()
    {
        require $this->_controllerPath .$this->_defaultFile.'.php';
        $this->_controller = new $this->_defaultFile();
        $this->_controller->index();
    }


  private function _loadExistingController()
  {
      $file = $this->_controllerPath . $this->_url[0] . '.php';
      if (file_exists($file))
      {
          require $file;
          $this->_controller = new $this->_url[0];
      }
      else
      {
          $this->_show_error_msg();

      }

  }

    private function  _callControllerMethod()
    {
        $length = count($this->_url);
        //Check Method Existance

        if ($length > 1)
         {
            if (!method_exists($this->_controller,$this->_url[1]))
            {
                $this->_show_error_msg();
            }
         }
        switch ($length)
        {
            case 5:
                //echo "From 5";
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);

                break;

            case 4:
                //echo "From 4";
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3]);
                break;

            case 3:
                //echo "From 3";
                //Controller->Method(Param1)
                if(method_exists($this->_controller,$this->_url[1]))
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;

            case 2:
                //echo "From 2";
                //Controller->Method
                if(method_exists($this->_controller,$this->_url[1]))
                $this->_controller->{$this->_url[1]}();
                break;

            default:
                {
                //echo "From default";
                  //Controller->index (Load Default method)
                    if(isset($this->_controller))
                    $this->_controller->index();
                break;
                }
        }
    }

   private  function _show_error_msg()
   {
        require $this->_controllerPath .$this->_errorFile;

        $this->_controller= new Error();
        $this->_controller->index();
       exit;
    }
}