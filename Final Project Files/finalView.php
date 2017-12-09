<?php
class finalView{
   
   public function __construct(){
      session_start();
   }
   public function __destruct(){
   }
   
   public function pageView($source, $formOptions, $logStatus, $tableData, $url, $studentData, $studentSchools){
   //This function constructs the page based on the values passed from the controller. If $formOptions isn't empty, the form is going to be inserted, so this first call completes the form data with the $formOptions string containing the schools. The login/admin button is inserted based on the value of $logStatus. Table and student data are also populated if needed. $html is then created containing all of the page data, with certain parts being filled in by the variables below based on the $source value. $html is then returned to the controller to be printed. NOTE: The bootstrap modal div is modelled after examples on the bootstrap site. Icons are provided via Open Iconic.
      if($source === 'formContent'){
         $this->createForm($formOptions, $studentData, $studentSchools); 
      }
      if($tableData){
         $this->addTableData($tableData);
      }
      if($source === 'studentContent'){
         $this->createStudentData($studentData, $studentSchools);
      }
      
      if($source === 'loginContent'){
         $this->createLoginContent();
      }
      
      $navBarData = $this->addNavData($logStatus);
      $html = <<<EOT
<!doctype html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>MedOpp Interview</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="finalStyle.css">
    <script src="finalScripts.js"></script>
</head>

<body>
   <div id="headerBar"></div>
   <div id="bodyDiv">
      <div id="headerDiv">
         <img src="Images/logo.png" alt="MedOpp Logo" id="logo">
      </div>
      <div class="navBar">
         <a href="{$url}?nav=home">Home</a>
         <a href="{$url}?nav=school">School Info</a>
         <a href="{$url}?nav=apply">Application</a>
         {$navBarData}
      </div>
      <div id="contentDiv">{$this->{$source}}</div>
   </div>
   
   <div id="deleteModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this application?</p>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-danger submitDelete" data-dismiss="modal">Delete</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
   </div>
   
   <div id="footerDiv">
      <h3>MedOpp Advising Office</h3>
      <p>Phone: 573.882.3893</p>
      <p>Site: <a href="http://premed.missouri.edu" target="_blank">premed.missouri.edu</a></p>   
   </div>
</body>
</html>
EOT;
    
        return $html;
    }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
   private function createForm($formOptions, $studentData, $studentSchools){
   //This function adds the form options, finishing the $formContent source so it can be inserted completed.   
      
      $editStatus = '';
      $formStatus = 'new';
      
      $alloStatus = '';
      $osteoStatus = '';
      $dentStatus = '';
      $podStatus = '';
      $bryantYes = '';
      $bryantNo = '';
      $edYes = '';
      $edNo = '';
      $mdYes = '';
      $mdNo = '';
      $muYes = '';
      $muNo = '';
      $firstYes = '';
      $firstNo = '';
      
      if($studentData){
         $editStatus = "readonly";
         $formStatus = "update";
         if($studentData['Candidate'] === 'Allopathic Medicne') $alloStatus = "selected";
         if($studentData['Candidate'] === 'Osteopathic Medicine') $osteoStatus = "selected";
         if($studentData['Candidate'] === 'Dentistry') $dentStatus = "selected";
         if($studentData['Candidate'] === 'Podiatry') $podStatus = "selected";
      
         if($studentData['Bryant_Status'] === 'Yes') $bryantYes = 'checked';
         else $bryantNo = 'checked';
         if($studentData['ED_Status'] === 'Yes') $edYes = 'checked';
         else $edNo = 'checked';
         if($studentData['MDPHD_Status'] === 'Yes') $mdYes = 'checked';
         else $mdNo = 'checked';
         if($studentData['MU_Status'] === 'Yes') $muYes = 'checked';
         else $muNo = 'checked';
         if($studentData['MU_Status'] === 'Yes') $muYes = 'checked';
         else $muNo = 'checked';
         if($studentData['First_Status'] === 'Yes') $firstYes = 'checked';
         else $firstNo = 'checked';
         if($studentSchools[0]) 
            $selectedOption1 = '<option value="' .$studentSchools[0]["School_Name"]. '" selected>' .$studentSchools[0]["School_Name"]. '</option>';
         if($studentSchools[1]) 
            $selectedOption2 = '<option value="' .$studentSchools[1]["School_Name"]. '" selected>' .$studentSchools[1]["School_Name"]. '</option>';
         if($studentSchools[2]) 
            $selectedOption3 = '<option value="' .$studentSchools[2]["School_Name"]. '" selected>' .$studentSchools[2]["School_Name"]. '</option>';
         if($studentSchools[3]) 
            $selectedOption4 = '<option value="' .$studentSchools[3]["School_Name"]. '" selected>' .$studentSchools[3]["School_Name"]. '</option>';
         if($studentSchools[4]) 
            $selectedOption5 = '<option value="' .$studentSchools[4]["School_Name"]. '" selected>' .$studentSchools[4]["School_Name"]. '</option>';
      }
    
      $this->formContent .= '
   <h2 class="center">DEADLINE: MAY 18, 2018 BY 5 PM</h2>
   <h1 class="center">Committee Interview Applicant Information Form</h1>
   <hr>
   <form action="index.php" method="post">
   <input type="hidden" name="action" value="submitForm"><input type="hidden" name="status" value="' .$formStatus. '">
   <div class="form-row">
      <div class="form-group col">
         <label for="fname">First Name:</label>
         <input type="text" class="form-control" id="fname" name="First_Name" value="' .$studentData['First_Name']. '" required>
      </div>
      <div class="form-group col">
         <label for="lname">Last Name:</label>
         <input type="text" class="form-control" id="lname" name="Last_Name" value="' .$studentData['Last_Name']. '" required>
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col-md-4">
         <label for="stuID">MU Student ID#:</label>
         <input type="text" pattern="[0-9]{8}" class="form-control" id="stuID" name="StudentID" value="' .$studentData['StudentID']. '" ' .$editStatus. ' required>
         <small id="stuIDHelp" class="form-text text-muted">Your 8 digit MU Student ID</small>
      </div>
      <div class="form-group col-md-8">
         <label for="address">Local Address:</label>
         <input type="text" class="form-control" id="address" name="Local_Address" value="' .$studentData['Local_Address']. '" required>
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col-md-4">
         <label for="phone">Phone:</label>
         <input type="text" pattern="[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}" class="form-control" id="phone" name="Phone" value="' .$studentData['Phone']. '" required>
         <small id="phoneInfo" class="form-text text-muted">Please supply in XXX-XXX-XXXX format.</small>
      </div>
      <div class="form-group col-md-8">
         <label for="email">Email:</label>
         <input type="email" class="form-control" id="email" name="Email" value="' .$studentData['Email']. '" required>
         <small id="emailInfo" class="form-text text-muted">Include where you can be reached during Summer/Fall Semeseter. If this information changes, be sure to notify the MedOpp Office.</small>
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col">
         <label for="state">Legal resident of what state:</label>
         <input type="text" class="form-control" id="state" name="State" value="' .$studentData['State']. '" required>
      </div>
      <div class="form-group col">
         <label for="candidate">Candidate For:</label>
         <select id="candidate" class="form-control" name="Candidate">
            <option value="Allopathic Medicine"' .$alloStatus. '>Allopathic Medicine</option>
            <option value="Osteopathic Medicine"' .$osteoStatus. '>Osteopathic Medicine</option>
            <option value="Dentistry"' .$dentStatus. '>Dentistry</option>
            <option value="Podiatry"' .$podStatus. '>Podiatry</option>
         </select>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-3 form-control-label label-inline">Bryant Scholar:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="Bryant_Status" value="Yes" ' .$bryantYes. ' required> Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="Bryant_Status" value="No" ' .$bryantNo. ' required> No 
         </label>
      </div>
      <label class="col-md-3 form-control-label label-inline">Early Decision:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="ED_Status" value="Yes" ' .$edYes. ' required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="ED_Status" value="No" ' .$edNo. ' required> No 
         </label>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-3 form-control-label label-inline">MD/PHD Applicant:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="MDPHD_Status" value="Yes"' .$mdYes. ' required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="MDPHD_Status" value="No"' .$mdNo. ' required> No 
         </label>
      </div>
      <label class="col-md-3 form-control-label label-inline">Enrolled at MU for FS2017?</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="MU_Status" value="Yes"' .$muYes. ' required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="MU_Status" value="No"' .$muNo. ' required> No 
         </label>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-9 form-control-label label-inline">Is this the first time you are applying to health professions schools?</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="First_Status" value="Yes"' .$firstYes. ' required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="First_Status" value="No"' .$firstNo. ' required> No 
         </label>
      </div>
   </div>
   <h3 class="center">List of Schools</h3>
    <p>Please remember:</p>
    <ul>
        <li>All letters must be received before the packet will be transmitted.</li>
        <li class="bold">Once a packet of letters is sent, any additional submissions will cost $10.</li>
        <li>Letters will not be sent until payment is recieved and you have submitted your AMCAS/AACOMAS/TMDSAS/AADSAS application.</li>
    </ul>
   <div class="form-group">
      <label>School 1</label>
      <select class="form-control" name="First_School">' .$selectedOption1. 
      ' ' .$formOptions. '
      </select>
   </div>
   <div class="form-group">
      <label>School 2</label>
      <select class="form-control" name="Second_School">' .$selectedOption2. 
      ' ' .$formOptions. '
      </select>
   </div>
   <div class="form-group">
      <label>School 3</label>
      <select class="form-control" name="Third_School">' .$selectedOption3. 
      ' ' .$formOptions. '
      </select>
   </div>
   <div class="form-group">
      <label>School 4</label>
      <select class="form-control" name="Fourth_School">' .$selectedOption4. 
      ' ' .$formOptions. '
      </select>
   </div>
   <div class="form-group">
      <label>School 5</label>
      <select class="form-control" name="Fifth_School">' .$selectedOption5. 
      ' ' .$formOptions. '
      </select>
   </div>
   <input type="submit" class="btn btn-primary" value="Submit">
   </form>';
   }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   private function addNavData($logStatus){
   //This function determines whether or not the browser display a login button or the admin button based on $logStatus passed from the controller.
      switch($logStatus){
         case "false": 
            $navBarData = "<a href='{$url}?nav=login' id='loginButton'>Login</a>";
            break;
         case "true":
            $navBarData = 
            "<div class='dropdownDiv'>
               <button onclick='navBarDrop()' class='dropButton'><img class='keyIcon' src='Images/open-iconic/png/key-2x.png' alt='Logged In Icon'> Admin</button>
                  <div id='myDrop' class='drop-content'>
                     <a href='{$url}?nav=view'>View Forms</a>
                     <a href='{$url}?nav=logout'>Logout</a>
                  </div>
            </div>";
            break;
         default: 
            $navBarData = "<a href='{$url}?nav=login' id='loginButton'>Login</a>";
            break;
      }
      return $navBarData;
   }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   private function addTableData($tableData) {
   //This function adds the table data into the page.
      $this->viewContent .= $tableData;
      $this->viewContent .= '</tbody></table>
      <div class="hiddenSubmitDiv"></div>';
   }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   private function createStudentData($studentData, $studentSchools){
   //This function constructs the student form page.
      $this->studentContent .= '<div><h2><span id="innerName">' .$studentData['First_Name']. ' ' .$studentData['Last_Name']. '</span><span id="formSpan"><a class="backIcon" href="#"><img class="iconBorder" src="Images/open-iconic/png/arrow-circle-left-4x.png" alt="Return Icon"></a><a class="editIconInner" href="#"><img class="iconBorder" src="Images/open-iconic/png/cog-4x.png" alt="Edit Icon"></a><a class="deleteIconInner" href="#"><img class="iconBorder" src="Images/open-iconic/png/trash-4x.png" alt="Return Icon"></a></span></h2></div><hr>';
      
      $this->studentContent .= 
      '<table class="table table-striped tableBorder">
         <tbody>
            <tr>
               <td>Student ID:</td>
               <td id="innerStudentID">' .$studentData['StudentID']. '</td>
            </tr>
            <tr>
               <td>Local Address:</td>
               <td>' .$studentData['Local_Address']. '</td>
            </tr>
            <tr>
               <td>Phone Number:</td>
               <td>' .$studentData['Phone']. '</td>
            </tr>
            <tr>
               <td>Email:</td>
               <td>' .$studentData['Email']. '</td>
            </tr>
            <tr>
               <td>Legal Resident Of:</td>
               <td>' .$studentData['State']. '</td>
            </tr>
            <tr>
               <td>Candidate For:</td>
               <td>' .$studentData['Candidate']. '</td>
            </tr>
            <tr>
               <td>Bryant Scholar:</td>
               <td>' .$studentData['Bryant_Status']. '</td>
            </tr>
            <tr>
               <td>Early Decision:</td>
               <td>' .$studentData['ED_Status']. '</td>
            </tr>
            <tr>
               <td>MD/PHD Applicant:</td>
               <td>' .$studentData['MDPHD_Status']. '</td>
            </tr>
            <tr>
               <td>Enrolled at MU for FS2017?</td>
               <td>' .$studentData['MU_Status']. '</td>
            </tr>
            <tr>
               <td>First Time applying to Health Professions Schools:</td>
               <td>' .$studentData['First_Status']. '</td>
            </tr>
         </tbody>
      </table>
      <br>
      <h3>Schools</h3>
      <br>
      <table class="table table-striped tableBorder">
         <thead>
            <tr>
               <th>School Name</th>
               <th>City</th>
               <th>State</th>
               <th>School Type</th>
            <tr>
         </thead>
         <tbody>
            <tr>
               <td>' .$studentSchools[0]["School_Name"]. '</td>
               <td>' .$studentSchools[0]["City"]. '</td>
               <td>' .$studentSchools[0]["State"]. '</td>
               <td>' .$studentSchools[0]["School_Type"]. '</td>
            </tr>
            <tr>
               <td>' .$studentSchools[1]["School_Name"]. '</td>
               <td>' .$studentSchools[1]["City"]. '</td>
               <td>' .$studentSchools[1]["State"]. '</td>
               <td>' .$studentSchools[1]["School_Type"]. '</td>
            </tr>
            <tr>
               <td>' .$studentSchools[2]["School_Name"]. '</td>
               <td>' .$studentSchools[2]["City"]. '</td>
               <td>' .$studentSchools[2]["State"]. '</td>
               <td>' .$studentSchools[2]["School_Type"]. '</td>
            </tr>
            <tr>
               <td>' .$studentSchools[3]["School_Name"]. '</td>
               <td>' .$studentSchools[3]["City"]. '</td>
               <td>' .$studentSchools[3]["State"]. '</td>
               <td>' .$studentSchools[3]["School_Type"]. '</td>
            </tr>
            <tr>
               <td>' .$studentSchools[4]["School_Name"]. '</td>
               <td>' .$studentSchools[4]["City"]. '</td>
               <td>' .$studentSchools[4]["State"]. '</td>
               <td>' .$studentSchools[4]["School_Type"]. '</td>
            </tr>
         </tbody>
      </table>
      
   <div class="hiddenSubmitDiv"></div>';
   }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   private function createLoginContent(){
   //This function creates the login page, and inserts an error if there was a failed login.
      if($_SESSION['logError'] === "Yes") $this->loginContent .= '<h4 class="red">Login Failed, Try Again!</h4>';
      $this->loginContent .= '
      <form action="index.php" method="post">
      <input type="hidden" name="action" value="login">
      <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" id="username" required>
      </div>
      <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="pwd" id="pwd" required>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
      </form>';
   }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $homeContent = 
      '<h1 class="center">Welcome to the Committee Interview Application for the 2018 Entering Class!</h1>
      <hr>
        <p>To assist you with your health professions applications, the MedOpp Advising Office writes and transmits committee letters of evaluation for MU students who are currently enrolled or recent graduates and are first-time applicants. (Many medical/dental schools require a committee letter; most schools highly recommend a letter.) The committee letter is based on data gathered from serveral sources: your letters of recommendation, your interview with the Health Professions Interview Committee, and additional information in your file. Your committee letter of evaluation is transmitted to the schools of your choice along with the individual letters of recommendation that have been submitted on your behalf.</p>
        
        <p><span class="bold">To be eligible for a Health Professions Committee interview and evaluation, all materials (except letters of recommendation) must be received by the MedOpp Advising Office by May 18th at 5 pm. Also, you must attend the required spring workshops (see application timeline) or view the PowerPoint presentations on Canvas and follow up with an individual meeting for each workshop missed.</span> We will conduct interviews from mid-May through August. Medical school early decision candidates and pre-dental candidates will be interviewed in May/June. In the event that the number of students seeking admission to health professions school exceeds our capacity to conduct appropriate interviews and process applications in a timely manner, we reserve the right to limit the number of interviews we conduct in a given year.</p>
        
        <p>Applicants will be charged a non-refundable fee of $35 for administrative costs and transmission of letters regardless of how many schools are designated during the 2018 application cycle. Letters will be transmitted electronically to medical schools via Virtual Evals and to dental schools via AADSAS.</p>
        
        <p>Remember: It is to your advantage to have all letters of recommendation in our office by June.<span class="bold"> Revisions of your personal statement and CV must be submitted before you schedule your committee interview. Once your interview has been scheduled, updates to your file will not be accepted.</span></p>
        
        <p>These materials are part of your permanent file with the MedOpp Advising Office; however, only your official committee evaluation letter and supporting letters will be sent by this office. Official transcripts and other application materials must be sent by you. AMCAS, AACOMAS, TDMSAS, and AADSAS applications are available online, usually by May; other application materials can be obtained directly from appropriate schools.</p>
        
        <p>If you have any further questions regarding this process, please call one of the MedOpp Advisiors at 882-3893.</p>';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $formContent = '';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $loginContent = '<h2 class="center">Please Sign In</h2>';
   
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
   
   var $unloggedContent = 
'<br><br><h2 class="center">Sorry!</h2>
<p class="center">You must be logged in to access this content!<p><br><br>';
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
   
   var $schoolContent = 
'<h2 class="center">School Information</h2>
<hr>
<div>
   <div class="displayInline">
      <a href="https://apps.aamc.org/msar-ui/#/landing" target="_blank">
         <img class="schoolLogo" src="Images/AAMC.jpeg" alt="AAMC logo">
      </a>
      <a href="http://www.aacom.org/become-a-doctor/us-coms" target="_blank">
         <img class="schoolLogo" src="Images/AACOM.png" alt="AACOM logo">
      </a>
   </div>
   <div class="displayInline">
      <br><h2>Medicine</h2>
      <p>Physicians treat and prevent human illness, disease and injury. There are two types of physicians: the M.D. (Doctor of Medicine) and the D.O. (Doctor of Osteopathic Medicine). Medical school programs are four years in length. At the end of four years, allopathic institutions grant the M.D. degree and osteopathic institutions grant the D.O. degree. You should examine the similarities and differences in training and practice. For more information, consult the links above, AAMC for Allopathic Medicine and aacom for Osteopathic Medicine.</p>
   </div>
</div>
<div>
   <div>
      <a href="http://www.adea.org/dental_education_pathways/aadsas/Pages/PDS.aspx" target="_blank">
         <img class="schoolLogo" src="Images/ADEA.png" alt="AADSAS logo">
      </a>
   </div>
   <div>
      <h2>Dentistry</h2>
      <p>Dental school is four years in length for general practice. At the end of four years, a graduate earns a D.D.S., Doctor of Dental Surgery or a D.M.D., Doctor of Dental Medicine. The majority of dental schools award the D.D.S. degree; however, some award a D.M.D. degree. The education and degrees are the same. The AADSAS link above provides more information on dental programs.</p><br>
   </div>
</div>
<div>
   <div>
      <a href="http://www.aacpm.org/colleges/" target="_blank" class="center">
         <img class="schoolLogo" src="Images/AACPM.jpeg" alt="AACPM logo">
      </a>
   </div>
   <div>
      <br><h2>Podiatry</h2>
      <p>A Doctor of Podiatric Medicine (DPM) specializes in the prevention, diagnosis, and treatment of foot disorders resulting from injury or disease. A DPM makes independent judgments, prescribes medications, and when necessary, performs surgery.</p>
      <p>After completing four years of podiatric medical training, the podiatrist is required by most states to complete at least one year of postgraduate residency training. Surgically-based residencies can last from one to three years. State licensing requirements generally include graduation from an accredited college of podiatric medicine, passage of National Board examinations, and oral examinations. The AACPM link above provides more information on podiatric programs.</p>
   </div>
</div>
<hr>
<div id="videoDiv">
   <button id="loadButton">Load Health School Tips Video</button>
</div>';
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $viewContent = 
'<h2 class="center">Applications Master List</h2>
<hr>
<table id="applicationTable" class="table table-striped tableBorder">
   <thead>
      <tr>
         <th>Student ID</th>
         <th>Last Name</th>
         <th>First Name</th>
         <th class="text-right">Edit/Delete</th>
      <tr>
   </thead>
   <tbody>';
   
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
   
   var $studentContent = '';
   
}
?>