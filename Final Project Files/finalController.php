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
         case 'ajaxRequest':
            $response = '<div style="position:relative;height:0;padding-bottom:56.21%"><iframe src="https://www.youtube.com/embed/Q6B59wkGn_M?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="641" height="360" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></div>';
            echo $response;
            exit;
         default:
            $this->runPage();
      }
   }
   
   private function runPage(){
      list($source, $formOptions, $logStatus) = $this->model->preparePageContent($this->nav);
      print $this->view->pageView($source, $formOptions, $logStatus);
      
   }
   
   private function handleLogin(){
      $username = $_POST['username'];
      $password = $_POST['pwd'];
      if($this->model->processLogin($username, $password) === 'true'){
         print $this->view->pageView('homeContent', '', 'true');
      }
      else print $this->view->pageView('loginContent', '', 'false');
   }
   
   private function handleLogout(){
      $this->model->processLogout();
      $this->view->pageView('homeContent', '', 'false');
   }
}
?>