<?php

class Controller
{
    function __construct()
    {
        // echo "Main Controller";
        $this->view = new View();
    }

    public function loadModel($name)
    {
        $path = 'models/' . $name . '_model';

        if (file_exists($path)) {
            require 'models/' . $name . '_model';

        }

    }
}