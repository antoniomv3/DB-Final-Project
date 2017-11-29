<?php
require('finalModel.php');
require('finalView.php');

class finalController {
   private $model;
   private $view;
   private $nav = '';
   private $action = '';
    
   public function __construct() {
      $this->model = new finalModel();
      $this->view = new finalView();
        
      $this->nav = $_GET['nav'] ? $_GET['nav'] : 'home';
      $this->action = $_POST['action'];
    }
   public function __destruct() {
      $this->model = null;
      $this->view = null;
   }
    
   public function run(){
      switch($this->action) {
         case 'login':
            $this->handleLogin();
            break;
         default:
            $this->runPage();
      }
   }
   private function runPage(){
      list($source, $formOptions, $logStatus) = $this->model->preparePageContent($this->nav);
      print $this->view->pageView($source, $formOptions, $logStatus);
   }
   
   ///////WORK IN PROGRESS
   private function handleLogin(){
      $username = $_POST['username'];
      $password = $_POST['pwd'];
      if($this->model->processLogin($username, $password)){
         print $this->view->pageView('homeContent', '', "true");
      }
     /* print $this->view->pageView('homeContent', '', "true");*/
   }
}
?>