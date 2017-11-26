<?php
class finalModel {
   public function __construct(){
   }
   public function __destruct(){
   }
   
   public function determineNav($nav){
      $navDirection = '';
         switch($nav){
            case "home":
               $navDirection = '#homeContent';
               break;
            case "school":
               $navDirection = '#schoolContent';
               break;
            case "apply":
               $navDirection = '#formContent';
               break;
            case "view":
               $navDirection = '#viewContent';
               break;
            default:
               $navDirection = '#homeContent';
         }
         return $navDirection;
   }
}
?>