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
      list($source, $formOptions) = $this->processNav();
      print $this->view->pageView($source, $formOptions);
      
   }
    
   private function processNav() {
      list($source, $formOptions) = $this->model->preparePageContent($this->nav);
      return array($source, $formOptions);
   }
}
?>