<?php
class finalView{
    private $address = 'http://ec2-35-164-59-37.us-west-2.compute.amazonaws.com/';
    public function pageView($source){
        $html = <<<EOT
<html>
    
<head>
    <meta charset="utf-8">
    <title>MedOpp Interview</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
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
    <div id="contentDiv"></div>
    <script>$("#contentDiv").load("pageContent.html {$source}");</script>
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
}




?>