<?php
class Welcome extends Controller{
    function __construct(){
        parent::__construct();
    }
function index(){
    $this->view->title="Welcome to JUST !!!";
    $this->view->render('header');
    $this->view->render('welcome');
    $this->view->render('footer');
}
}
