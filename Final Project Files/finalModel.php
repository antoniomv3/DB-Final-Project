<?php
class finalModel {
   public function __construct(){
      session_start();
      if(!isset($_SESSION['logStatus'])) $_SESSION['logStatus'] = 'false';
   }
   public function __destruct(){
   }
   
   public function preparePageContent($nav){
      $navDirection = '';
      $formOptions = '';
      $logStatus = $_SESSION['logStatus'];
         switch($nav){
            case "home":
               $source = 'homeContent';
               break;
            case "school":
               $source = 'schoolContent';
               break;
            case "apply":
               $source = 'formContent';
               $formOptions = $this->prepareFormData($this->initDatabaseConnection());
               break;
            case "view":
               if($logStatus === 'true'){
                  $source = 'viewContent';
               }
               else $source = 'unloggedContent';
               break;
            case "login":
               $source = 'loginContent';
               break;
            case "logout":
               $this->processLogout();
               $logStatus = $_SESSION['logStatus'];
               $source = 'homeContent';
               break;
            default:
               $source = 'homeContent';
         }
         return array($source, $formOptions, $logStatus);
   }
 
   
   public function processLogin($username, $password) {
         $mysqli = $this->initDatabaseConnection();
         $username = stripslashes($username);
         $password = stripslashes($password);
         $username = $mysqli->real_escape_string($username);
         $password = $mysqli->real_escape_string($password);
         $query = "SELECT * FROM Users WHERE username ='$username';";
         $result = $mysqli->query($query);
         if($result->num_rows === 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if(password_verify($password, $row['password'])){
               $_SESSION['logStatus'] = 'true';
            }
            else $_SESSION['logStatus'] = 'false';
         }
         $result->free();
         $mysqli->close();
         return $_SESSION['logStatus'];
   }
   
   public function processLogout(){
      $_SESSION['logStatus'] = 'false';
   }
   private function initDatabaseConnection() {
      include "../inc/dbinfo.inc";
      $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      return $mysqli;
   }
   
   private function prepareFormData($mysqli) {
      $query="SELECT School_Name FROM Schools";
      $result = $mysqli->query($query);
      $options = '';
      
      while($row = $result->fetch_array()){
         $rows[] = $row;
      }
      
      foreach($rows as $row){
         $options .= '<option value = "' . $row['School_Name'] . '">' . $row['School_Name'] . '</option>';
      }
      $result->free();
      $mysqli->close();
      return $options;
   }   
}
?>
