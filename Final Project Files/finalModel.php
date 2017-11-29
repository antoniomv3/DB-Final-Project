<?php
class finalModel {
   public function __construct(){
   }
   public function __destruct(){
   }
   
   public function preparePageContent($nav){
      $navDirection = '';
      $formOptions = '';
      $logStatus = 'false';
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
               $source = 'viewContent';
               break;
            case "login":
               $source = 'loginContent';
               break;
            default:
               $source = 'homeContent';
         }
         return array($source, $formOptions, $logStatus);
   }
   
   ////WORK IN PROGRESS
   public function processLogin($username, $password) {
         $mysqli = initDatabaseConnection();
         return true;
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
