<?php
class finalView{
    private $address = 'index.php/';
   
    public function pageView($source, $formOptions){
      $this->addFormOptions($formOptions); 
       $html = <<<EOT
<html>
    
<head>
    <meta charset="utf-8">
    <title>MedOpp Interview</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="finalStyle.css">
</head>

<body>
    <div id="headerBar"></div>
    <div id="bodyDiv">
    <div id="headerDiv">
        <h1>MedOpp Logo</h1>
    </div>
    <div id="navBar">
        <ul>
            <li><a href="{$address}?nav=home">Home</a></li>
            <li><a href="{$address}?nav=school">School Info</a></li>
            <li><a href="{$address}?nav=apply">Application</a></li>
            <li><a href="{$address}?nav=view">View Forms</a></li>
            <li id="login"><a href="#" id="alogin">Login</a></li>
        </ul>
    </div>
    <div id="contentDiv">{$this->{$source}}</div>
    </div>
     <div id="footerDiv">
        <h3>MedOpp Advising Office</h3>
        <p>Phone: 573.882.3893</p>
         <p>Site: <a href="http://premed.missouri.edu">premed.missouri.edu</a></p>
        
    </div>
</body>
</html>
EOT;
        return $html;
    }
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   private function addFormOptions($formOptions){
      $this->formContent .= 
         '<div class="form-group">
            <label>School 1</label>
            <select class="form-control">
               <option value="NA" selected>N/A</option>';
               $this->formContent .= $formOptions;
      $this->formContent .= '</select></div>';
      $this->formContent .= 
         '<div class="form-group">
            <label>School 2</label>
            <select class="form-control">
               <option value="NA" selected>N/A</option>';
               $this->formContent .= $formOptions;
      $this->formContent .= '</select></div>';
      $this->formContent .= 
         '<div class="form-group">
            <label>School 3</label>
            <select class="form-control">
               <option value="NA" selected>N/A</option>';
               $this->formContent .= $formOptions;
      $this->formContent .= '</select></div>';
      $this->formContent .= 
         '<div class="form-group">
            <label>School 4</label>
            <select class="form-control">
               <option value="NA" selected>N/A</option>';
               $this->formContent .= $formOptions;
      $this->formContent .= '</select></div>';
      $this->formContent .= 
         '<div class="form-group">
            <label>School 5</label>
            <select class="form-control">
               <option value="NA" selected>N/A</option>';
               $this->formContent .= $formOptions;
      $this->formContent .= '</select></div>';
      $this->formContent .= '<input type="submit" class="btn btn-primary" value="Submit"></form>';   
   }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $homeContent = 
      '<h1 class="center">Welcome to the Committee Interview Application for the 2018 Entering Class!</h1>
      <hr>
        <p>To assist you with your health professions applications, the MedOpp Advising Office writes and transmits committee letters of evaluation for MU students who are currently enrolled or recent graduates and are first-time applicants. (Many medical/dental schools require a committee letter; most schools highly recommend a ltter.) The committee letter is based on data gathered from serveral sources: your letters of recommendation, your interview with the Health Professions Interview Committee, and additional information in your file. Your committee letter of evaluation is transmitted to the schools of your choice along with the individual letters of recommendation that have been submitted on your behalf.</p>
        
        <p><span class="bold">To be eligible for a Health Professions Committee interview and evaluation, all materials (except letters of recommendation) must be received by the MedOpp Advising Office by May 19th at 5 pm. Also, you must attend the required spring workshops (see application timeline) or view the PowerPoint presentations on Canvas and follow up with an individual meeting for each workshop missed.</span> We will conduct interviews from mid-May through August. Medical school early decision candidates and pre-dental candidates will be interviewed in May/June. In the event that the number of studnets seeking admission to health professions school exceeds our capacity to conduct appopriate interviews and process applications in a timely manner, we reserve the right to limit the number of interviews we conduct in a given year.</p>
        
        <p>Applicants will be charged a non-refundable fee of $35 for administrative costs and transmission of letters regardless of how many schools are designtaed during the 2018 application cycle. Letters will be transmitted electronically to medical schools via Virtual Evals and to dental schools via AADSAS.</p>
        
        <p>Remember: It is to your advantage to have all letters of recommendation in our office by June.<span class="bold"> Revisions of your personal statement and CV must be submitted before you schedule your committee interview. Once your interview has been scheduled, updates to your file will not be accepted.</span></p>
        
        <p>These materials are part of your permananent file with the MedOpp Advising Office; however, only your official committee evaluation letter and supporting letters will be sent by this office. Official transcripts and other application materials must be sent by you. AMCAS, AACOMAS, TDMSAS, and AADSAS applications are available online, usually by May; other application materials can be obtianed directly from appropriate schools.</p>
        
        <p>If you have any further questions regarding this process, please call one of the MedOpp Advisiors at 882-3893.</p>';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   var $formContent = 
'<h2 class="center">DEADLINE: MAY 18, 2018 BY 5 PM</h2>
<h1 class="center">Committee Interview Applicant Information Form</h1>
<form>
   <div class="form-row">
      <div class="form-group col">
         <label for="fname">First Name:</label>
         <input type="text" class="form-control" id="fname" name="firstName">
      </div>
      <div class="form-group col">
         <label for="lname">Last Name:</label>
         <input type="text" class="form-control" id="lname" name="lastName">
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col-md-4">
         <label for="stuID">MU Student ID#:</label>
         <input type="text" class="form-control" id="stuID" name="studentID">
         <small id="stuIDHelp" class="form-text text-muted">Your 8 digit MU Student ID</small>
      </div>
      <div class="form-group col-md-8">
         <label for="address">Local Address:</label>
         <input type="text" class="form-control" id="address" name="address">
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col-md-4">
         <label for="phone">Phone:</label>
         <input type="text" class="form-control" id="phone" name="phone">
      </div>
      <div class="form-group col-md-8">
         <label for="email">Email:</label>
         <input type="email" class="form-control" id="email" name="email">
         <small id="phoneInfo" class="form-text text-muted">Include where you can be reached during Summer/Fall Semeseter. If this information changes, be sure to notify the MedOpp Office.</small>
      </div>
   </div>
   <div class="form-row">
      <div class="form-group col">
         <label for="state">Legal resident of what state</label>
         <input type="text" class="form-control" id="state" name="state">
      </div>
      <div class="form-group col">
         <label for="candidate">Candidate For:</label>
         <select id="candidate" class="form-control" name="candidate">
            <option value="Allo">Allopathic Medicine</option>
            <option value="Osteo">Osteopathic Medicine</option>
            <option value="Dent">Dentistry</option>
         </select>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-3 form-control-label label-inline">Bryant Scholar:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="bryant" value="yes" required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="bryant" value="no" required> No 
         </label>
      </div>
      <label class="col-md-3 form-control-label label-inline">Early Decision:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="earlydecision" value="yes" required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="earlydecision" value="no" required> No 
         </label>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-3 form-control-label label-inline">MD/PHD Applicant:</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="mdphd" value="yes" required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="mdphd" value="no" required> No 
         </label>
      </div>
      <label class="col-md-3 form-control-label label-inline">Enrolled at MU for FS2017?</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="enrolled" value="yes" required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="enrolled" value="no" required> No 
         </label>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-md-9 form-control-label label-inline">Is this the first time you are applying to health professions schools?</label>
      <div class="col-md-3 div-inline">
         <label class="radio-inline">
            <input type="radio" class="" name="firstapply" value="yes" required > Yes 
         </label>
         <label class="radio-inline">
            <input type="radio" class="" name="firstapply" value="no" required> No 
         </label>
      </div>
   </div>
   <h3 class="center">List of Schools</h3>
    <p>Please remember:</p>
    <ul>
        <li>All letters must be received before the packet will be transmitted.</li>
        <li class="bold">Once a packet of letters is sent, any additional submissions will cost $10.</li>
        <li>Letters will not be sent until payment is recieved and you have submitted your AMCAS/AACOMAS/TMDSAS/AADSAS application.</li>
    </ul>';


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   var $schoolContent = '<h2>Will be worked on later</h2>';
   var $viewContent = '<h2>Will be worked on later</h2>';



}
?>