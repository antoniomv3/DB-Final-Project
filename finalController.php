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
        /*$this->processNav();*/
        
        switch($this->view) {
             default: 
                 print $this->nav;
         }
    }
    
    
    /*private function processNav() {
        $this->model->determineNav($_GET['nav']);
    }*/
}







?>