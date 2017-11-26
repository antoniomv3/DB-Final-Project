<?php
require('finalModel.php');
require('finalView.php');

class finalController {
    private $model;
    private $view;
    private $nav = '';
    
    public function __construct() {
        $this->model = new finalModel();
        $this->view = new finalView();
        
        $this->nav = $_GET['nav'] ? $_GET['nav'] : 'home';
    }
    public function __destruct() {
        $this->model = null;
        $this->view = null;
    }
    
    public function run(){
        $navDirection = $this->processNav();
        print $this->view->pageView($navDirection);
    
    }
    
    private function processNav() {
        $navDirection = $this->model->determineNav($this->nav);
        return($navDirection);
    }
}







?>