<?php
class finalModel {
   public function __construct(){
   //On construction, the model will start the session and if logStatus is not set, meaning the browser is new to this page or the previous session expired, it will set it to false, meaning the user is not logged in. It will also check if there is a log error, if so it will print an error message when it reloads the login screen.
      session_start();
      if(!isset($_SESSION['logStatus'])) $_SESSION['logStatus'] = 'false';
      if(!isset($_SESSION['logError'])) $_SESSION['logError'] = 'No';
   }
   public function __destruct(){
   }
   
   public function preparePageContent($nav){
   //The functionality of this method is determined by the $nav value passed from the controller. It first creates the variables it will return, getting $logStatus from session to maintain dynamic status no matter where the user redirects on the page, then manipulates those variables based on the value of 'nav'.  
      $formOptions = '';
      $logStatus = $_SESSION['logStatus'];
      $tableData = '';
      $studentData = '';
      $source = '';
      $studentSchools = '';
         switch($nav){
            case "home":
               $source = 'homeContent';
               break;
            case "school":
               $source = 'schoolContent';
               break;
            case "apply":
            //The function called here obtains additional form data from the database and passes it back as well.
               $source = 'formContent';
               if($logStatus === 'true'){
                  $formOptions = $this->prepareFormData($this->initDatabaseConnectionLogged());
               }
               else {
                  $formOptions = $this->prepareFormData($this->initDatabaseConnectionUnlogged());
               }
               break;
            case "view":
            //This page requires a user be logged in, so if an unlogged user attempts to access it, it will instead return a variable pointing them to a page saying they must be logged in.
               if($logStatus === 'true'){
                  $source = 'viewContent';
                  $tableData = $this->prepareTableData($this->initDatabaseConnectionLogged());
               }
               else $source = 'unloggedContent';
               break;
            case "login":
               $source = 'loginContent';
               break;
            case "logout":
            //This logs out the user, updates $logStatus so that it now shows false, then shoots the user back to the home page.
               $this->processLogout();
               $logStatus = $_SESSION['logStatus'];
               $source = 'homeContent';
               break;
            //These next five all handle student information in some way, and call similar functions to perform their tasks. They all also require the user to be logged in.
            case "selectStudent":
               if($logStatus === 'true'){
                  $source = 'studentContent';
                  $studentData = $this->prepareStudentData($this->initDatabaseConnectionLogged());
                  $studentSchools = $this->prepareStudentSchools($this->initDatabaseConnectionLogged());
               }
               break;
            case "deleteStudent":
               if($logStatus === 'true'){
                  $source = 'viewContent';
                  $this->deleteStudentData($this->initDatabaseConnectionLogged(), $studentID);
                  $tableData = $this->prepareTableData($this->initDatabaseConnectionLogged());
               }
               break;
            case "editStudent":
               if($logStatus === 'true'){
                  $source = 'formContent';
                  $formOptions = $this->prepareFormData($this->initDatabaseConnectionLogged());
                  $studentData = $this->prepareStudentData($this->initDatabaseConnectionLogged());
                  $studentSchools = $this->prepareStudentSchools($this->initDatabaseConnectionLogged());
               }
               break;
            case "updateStudent":
               if($logStatus === 'true'){
                  $source = 'studentContent';
                  $this->updateStudentData($this->initDatabaseConnectionLogged());
                  $studentData = $this->prepareStudentData($this->initDatabaseConnectionLogged());
                  $studentSchools = $this->prepareStudentSchools($this->initDatabaseConnectionLogged());
               }
               break;
            //When making a new application, if the user is logged in it will redirect them to the student's form page. If not, it will redirect them back to the home page.
            case "newStudent":
               if($logStatus === 'true'){
                  $this->newStudentData($this->initDatabaseConnectionLogged());
                  $source = 'studentContent';
                  $studentData = $this->prepareStudentData($this->initDatabaseConnectionLogged());
                  $studentSchools = $this->prepareStudentSchools($this->initDatabaseConnectionLogged());
               }
               if($logStatus === 'false'){
                  $this->newStudentData($this->initDatabaseConnectionUnlogged());
                  $source = 'homeContent';
               }
               break;
            default:
            //If anything not listed above is present in the nav variable, it will return it to the home page anyway.
               $source = 'homeContent';
         }
         return array($source, $formOptions, $logStatus, $tableData, $studentData, $studentSchools);
   }
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   public function processLogin() {
   //This function logs the user in, first it connects to the database, then it obtains the username and password variables from the post data. It sees if there is a user in the database matching the username variable inputted. If so, it then compares the passwords and on a match sets the session log status to true. If not it sets it to false. It then frees the results and closes the connection, and returns the logStatus obtained from the session. 
      $username = $_POST['username'];
      $password = $_POST['pwd'];
      
      $mysqli = $this->initDatabaseConnectionUnlogged();
         
      if(!$query = $mysqli->prepare("SELECT * FROM Users WHERE username = ?")){
         echo "There was an error processing the login! Try again!";
         exit;     
      }
      
      $query->bind_param("s", $username);
      $query->execute();
      $result = $query->get_result();
       
      if($result->num_rows === 1){
         $row = $result->fetch_array(MYSQLI_ASSOC);
         if(password_verify($password, $row['password'])){
            $_SESSION['logStatus'] = 'true';
            $_SESSION['logError'] = 'No';
         }
         else {
            $_SESSION['logStatus'] = 'false';
            $_SESSION['logError'] = 'Yes';
         }
      }
      else {
         $_SESSION['logStatus'] = 'false';
         $_SESSION['logError'] = 'Yes';
      }
      $result->free();
      $query->close();
      $mysqli->close();
      return $_SESSION['logStatus'];
   }
   
   private function processLogout(){
      $_SESSION['logStatus'] = 'false';
   }
   //If the user is not logged in, it connects to the database with this user information which has limited access to the database.
   private function initDatabaseConnectionUnlogged() {
      include "../inc/dbinfoUnlogged.inc";
      $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
      if ($mysqli->connect_errno){
         echo "There was an error connecting to the database! Try again!";
         exit;
      }
      return $mysqli;
   }
   //If the user is logged in, it connects to the database with this user which has more access to the database.
   private function initDatabaseConnectionLogged() {
      include "../inc/dbinfoLogged.inc";
      $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
      if ($mysqli->connect_errno){
         echo "There was an error connecting to the database! Try again!";
         exit;
      }
      return $mysqli;
   }
   
   private function prepareFormData($mysqli) {
   //This function connects to the database and creates a string containing options for all of the schools obtained.
      $query="SELECT School_Name FROM Schools";
      
      if (!$result = $mysqli->query($query)){
         echo "There was an error processing the form data! Try again!";
         $mysqli->close();
         exit;
      }
      
      $options = '<option value="N/A">N/A</option>';
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
   
   private function prepareTableData($mysqli) {
   //This function prepares the table the user sees when selecting the master application list, it contains every student in the database.
      $query="SELECT StudentID, Last_Name, First_Name FROM Students ORDER BY Last_Name ASC;";
      
      if(!$result = $mysqli->query($query)){
         echo "There was an error processing the table data! Try again!";
         $mysqli->close();
         exit;
      }
      
      if($result->num_rows === 0){
         $tableData = '<tr><td colspan="4">There are no applications in the database at this time!</td></tr>';
         return $tableData;
      }
      
      $tableData = '';
      
      while($row = $result->fetch_array()){
         $rows[] = $row;
      }
      
      foreach($rows as $row){
         $tableData .= '<tr><td><a class="studentSelect" href="#">' .$row['StudentID']. '</a></td><td class="lastName">' .$row['Last_Name']. '</td><td class="firstName">' .$row['First_Name']. '</td>
         <td class="text-right"><a href="#"><img class="iconBorder editIcon" src="Images/open-iconic/png/cog-2x.png" alt="Edit Icon"></a><a href="#"><img class="iconBorder deleteIcon" src="Images/open-iconic/png/trash-2x.png" alt="Delete Icon"></a></td></tr>';
      }
      
      $result->free();
      $mysqli->close();
      return $tableData;
   }
  
   private function prepareStudentData($mysqli) {
   //This function grabs all the information on individual students based on their entry in the Students table. 
      $studentID = $_POST['StudentID'];
      
      if(!$query = $mysqli->prepare("SELECT * FROM Students WHERE StudentID = ?")){
         echo "There was an error processing the student data! Try again!";
         exit;  
      }
       
      $query->bind_param("s", $studentID);
      $query->execute();
      $result = $query->get_result();
      
      $studentData = $result->fetch_array();
      
      $result->free();
      $query->close();
      $mysqli->close();
      return $studentData;
   }
   
   private function prepareStudentSchools($mysqli) {
   //This function grabs all the schools of an individual student based on their entry in the Applications table.
      $studentID = $_POST['StudentID'];
    
      if(!$query = $mysqli->prepare("SELECT b.School_Name, b.City, b.State, b.School_Type FROM Students INNER JOIN Applications ON Students.StudentID = Applications.StudentID INNER JOIN Schools AS b ON b.School_Name = Applications.School_Name WHERE Applications.StudentID = ?")){
         echo "There was an error processing the school data! Try again!";
         exit;  
      }
      
      $query->bind_param("s", $studentID);
      $query->execute();
      $result = $query->get_result();

      $studentSchools = array();
      while ($row = $result->fetch_assoc()){
         $studentSchools[] = $row;
      }
      $result->free();
      $query->close();
      $mysqli->close();
      return $studentSchools;
   }

   private function deleteStudentData($mysqli){
      $studentID = $_POST['StudentID'];
      
      if(!$query = $mysqli->prepare("DELETE FROM Applications WHERE StudentID = ?")){
         echo "Unable to delete student data at this time. Try again!";
         exit;  
      }
      
      $query->bind_param("s", $studentID);
      $query->execute();
      
      $query = $mysqli->prepare("DELETE FROM Students WHERE StudentID = ?");
      $query->bind_param("s", $studentID);
      $query->execute();
   
      $query->close();
      $mysqli->close();
   }
   
   private function updateStudentData($mysqli){
      $First_Name = $_POST['First_Name'];
      $Last_Name = $_POST['Last_Name'];
      $StudentID = $_POST['StudentID'];
      $Local_Address = $_POST['Local_Address'];
      $Phone = $_POST['Phone'];
      $Email = $_POST['Email'];
      $State = $_POST['State'];
      $Candidate = $_POST['Candidate'];
      $Bryant_Status = $_POST['Bryant_Status'];
      $ED_Status = $_POST['ED_Status'];
      $MDPHD_Status = $_POST['MDPHD_Status'];
      $MU_Status = $_POST['MU_Status'];
      $First_Status = $_POST['First_Status'];
      
      $First_School = $_POST['First_School'];
      $Second_School = $_POST['Second_School'];
      $Third_School = $_POST['Third_School'];
      $Fourth_School = $_POST['Fourth_School'];
      $Fifth_School = $_POST['Fifth_School'];
   
      if(!$query = $mysqli->prepare("UPDATE Students SET First_NAME = ?, Last_Name = ?, Local_Address = ?, Phone = ?, Email = ?, State = ?, Candidate = ?, Bryant_Status = ?, ED_Status = ?, MDPHD_Status = ?, MU_Status = ?, First_Status = ? WHERE StudentID = ?")){
         echo "Unable to update student data at this time. Try again!";
         exit;  
      }
      
      $query->bind_param("sssssssssssss", $First_Name, $Last_Name, $Local_Address, $Phone, $Email, $State, $Candidate, $Bryant_Status, $ED_Status, $MDPHD_Status, $MU_Status, $First_Status, $StudentID);
      $query->execute();
      
      if(!$query = $mysqli->prepare("DELETE FROM Applications WHERE StudentID = ?")){
         echo "Unable to update student school data at this time. Try again!";
         exit;  
      }
      
      $query->bind_param("s", $StudentID);
      $query->execute();
      
      if(!$query = $mysqli->prepare("INSERT INTO Applications (StudentID, School_Name) VALUES (?, ?);")){
         echo "Unable to update student school data at this time. Try again!";
         exit; 
      }
      
      if($First_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $First_School);
      $query->execute();
      }
      if($Second_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Second_School);
      $query->execute();
      }
      if($Third_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Third_School);
      $query->execute();
      }
      if($Fourth_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Fourth_School);
      $query->execute();
      }
      if($Fifth_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Fifth_School);
      $query->execute();
      }
      
      $query->close();
      $mysqli->close();
   }
    
   private function newStudentData($mysqli){
      $First_Name = $_POST['First_Name'];
      $Last_Name = $_POST['Last_Name'];
      $StudentID = $_POST['StudentID'];
      $Local_Address = $_POST['Local_Address'];
      $Phone = $_POST['Phone'];
      $Email = $_POST['Email'];
      $State = $_POST['State'];
      $Candidate = $_POST['Candidate'];
      $Bryant_Status = $_POST['Bryant_Status'];
      $ED_Status = $_POST['ED_Status'];
      $MDPHD_Status = $_POST['MDPHD_Status'];
      $MU_Status = $_POST['MU_Status'];
      $First_Status = $_POST['First_Status'];
      
      $First_School = $_POST['First_School'];
      $Second_School = $_POST['Second_School'];
      $Third_School = $_POST['Third_School'];
      $Fourth_School = $_POST['Fourth_School'];
      $Fifth_School = $_POST['Fifth_School'];
      
      if(!$query = $mysqli->prepare("INSERT INTO Students (First_Name, Last_Name, StudentID, Local_Address, Phone, Email, State, Candidate, Bryant_Status, ED_Status, MDPHD_Status, MU_Status, First_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
         echo "Unable to submit student data at this time. Try again!";
         exit;
      }
      
      $query->bind_param("sssssssssssss", $First_Name, $Last_Name, $StudentID, $Local_Address, $Phone, $Email, $State, $Candidate, $Bryant_Status, $ED_Status, $MDPHD_Status, $MU_Status, $First_Status);
      $query->execute();
        
      if(!$query = $mysqli->prepare("INSERT INTO Applications (StudentID, School_Name) VALUES (?, ?)")){
         echo "Unable to submit student school data at this time. Try again!";
         exit;
      }
       
      if($First_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $First_School);
      $query->execute();
      }
      if($Second_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Second_School);
      $query->execute();
      }
      if($Third_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Third_School);
      $query->execute();
      }
      if($Fourth_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Fourth_School);
      $query->execute();
      }
      if($Fifth_School != 'N/A'){
      $query->bind_param("ss", $StudentID, $Fifth_School);
      $query->execute();
      }
        
      $query->close();
      $mysqli->close();
    }
}
?>
