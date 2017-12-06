<?php
require('finalModel.php');
require('finalView.php');

class finalController {
   private $model;
   private $view;
   private $nav = '';
   private $action = '';
   //This is the url to the site, which will be passed where needed to redirect pages back to index.php.
   private $url = 'http://ec2-35-164-59-37.us-west-2.compute.amazonaws.com';
    
   public function __construct() {
   //On starting a new instance of the controller, it first starts instances of the model and view, then it grabs 'nav' data from the url, and if nothing is set it sets it to home. This nav data will be passed later to determine what content is displayed on the page. It also grabs 'action' from post data if it exists. 
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
   //This is what is called when the index page is loaded. It will perform actions based on the action value obtained from post data.
      switch($this->action) {
         //If the action is 'login', which comes from submitting the login form, it calls this function to handle the login.
         case 'login':
            $this->handleLogin();
            break;
         //If the action is 'ajaxRequest', which comes from an ajax call found in the school info tab, it will respond with this url and will be inserted into the page to load a youtube video. It will then exit as there is no other role the controller needs to perform if the action is simply an ajax request.
         case 'ajaxRequest':
            $response = '<div style="position:relative;height:0;padding-bottom:56.21%"><iframe src="https://www.youtube.com/embed/Q6B59wkGn_M?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="641" height="360" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></div>';
            echo $response;
            exit;
         //These Student functions deal with editting the student information in some way, and all call the same function with different nav data to send to the model.
         case 'selectStudent':
            $this->nav = 'selectStudent';
            $this->handleStudent();
            break;
         case 'deleteStudent':
            $this->nav = 'deleteStudent';
            $this->handleStudent();
            break;
         case 'editStudent':
            $this->nav = 'editStudent';
            $this->handleStudent();
            break;
         case 'submitForm':
            $status = $_POST['status'];
            if($status === 'new'){
               $this->nav = 'newStudent';
               $this->handleStudent();
            }
            if($status === 'update'){
               $this->nav = 'updateStudent';
               $this->handleStudent();
            }
            break;
         //If there is no action, it will run this function which constructs the page content. 
         default:
            $this->runPage();
      }
   }
   
   private function runPage(){
   //If there is no action to perform, the page is then loaded with these two functions. The first sends the nav data obtained earlier to the model where it will receive back an array of variables. $source determines what variable in the view class will be plugged in to display content. $formOptions is only returned when the application form page is requested, it contains options for a select field that was obtained from the database and is to be inserted into the form before it is presented to the user. $logStatus says whether or not the user is logged in, if not the page will have a login button, if so it will have an admin button for accessing forms and logging out. The controller then prints the $html value returned from the view after passing it the three values it obtained in the function above. 
      list($source, $formOptions, $logStatus, $tableData, $studentData, $studentSchools) = $this->model->preparePageContent($this->nav);
      print $this->view->pageView($source, $formOptions, $logStatus, $tableData, $this->url, $studentData, $studentSchools);
   }
   
   private function handleStudent(){
      list($source, $formOptions, $logStatus, $tableData, $studentData, $studentSchools) = $this->model->preparePageContent($this->nav);
      print $this->view->pageView($source, $formOptions, $logStatus, $tableData, $this->url, $studentData, $studentSchools);
   }
   
   private function handleLogin(){
   //This function is called when a login is attempted. It grabs the username and password from the post data and passes them along to the model for processing. If there is a match, it redirects the page to home, if not it returns the user to the login page to try again. 
      $username = $_POST['username'];
      $password = $_POST['pwd'];
      if($this->model->processLogin($username, $password) === 'true'){
         header('Location: ' .$this->url. '?nav=home');
         
      }
      else{
         header('Location: ' .$this->url. '?nav=login');
      }
   }
}
?>

