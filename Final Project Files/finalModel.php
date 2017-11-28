<?php
class finalModel {
   public function __construct(){
   }
   public function __destruct(){
   }
   
   public function preparePageContent($nav){
      $navDirection = '';
      $formOptions = '';
         switch($nav){
            case "home":
               $source = 'homeContent';
               break;
            case "school":
               $source = 'schoolContent';
               break;
            case "apply":
               $source = 'formContent';
               $formOptions = $this->getFormOptions();
               break;
            case "view":
               $source = 'viewContent';
               break;
            default:
               $source = 'homeContent';
         }
         return array($source, $formOptions);
   }
   
   private function getFormOptions(){
      $mysqli = $this->initDatabaseConnection();
      $options = $this->prepareFormData($mysqli);
      return $options;
   }
   
   private function initDatabaseConnection() {
      include "../inc/dbinfo.inc";
      $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      return $mysqli;
   }
   
   private function prepareFormData($mysqli) {
      $sql="Select School_Name FROM Schools";
      $result = $mysqli->query($sql);
      
      $options = '';
      $row = mysqli_fetch_array($result, MYSQLI_NUM);
      
      
      while($row = $result->fetch_array()){
         $rows[] = $row;
      }
      
      foreach($rows as $row){
         $options .= '<option value = "' . $row['School_Name'] . '">' . $row['School_Name'] . '</option>';
      }
      return $options;
   }   
}
?>
