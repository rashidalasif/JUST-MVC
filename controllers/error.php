<?php
class Error extends Controller
{
    function __construct()
    {
        parent::__construct();

    }
    function index()
    {
        echo '<pre>';
        echo "Your Requested URL  Not Found";
        echo '</pre>';
    }
}