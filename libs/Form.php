<?php
class Form{
    private $_currentItem=null;
    private  $_postData=array();
    private $_val=array();
    private $_error=array();

  public function  __construct(){
      $this->_val=new Val();
  }
    /*
     * This is to run $_POST[]
     */
    public function post($filed)
    {
       $this->_postData[$filed]=$_POST[$filed];
       $this->_currentItem=$filed;
       return $this;
    }
    /*
     * fetch return the posted data
     * @param mixed $fieldName
     * @return mixed string or array
     */

    public  function fetch($fieldName=false){
        if($fieldName)
        {
            if(isset($this->_postData[$fieldName]))
            {
                return $this->_postData[$fieldName];
            }
            else
            {
                return false;
            }
        }
        else
        {
             return $this->_postData;
        }

    }
/*
 * this is to validate
 */
    public function val($typeOfValidator,$arg=null)
    {
       if($arg==null)
          {
              $error=$this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
          }
      else{
              $error=$this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem],$arg);
         }

    if($error){
            $this->_error[$this->_currentItem]=$error;
        }
        return $this;
    }
    public function submit()
    {
        if (empty($this->_error))
        {
            return true;
        }
        else
        {
            $str = '';
            foreach ($this->_error as $key => $value)
            {
                $str .= $key . ' => ' . $value . "\n";
            }
            //throw new Exception($str);
            return $str;
        }
    }
}