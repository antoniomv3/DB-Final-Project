<?php
	/* Created by Professor Wergeles for CS2830 at the University of Missouri */ 
    $dbhost = "finalproject-db-instance.c7yb7qexypbh.us-west-2.rds.amazonaws.com";
    $dbuser = "test";
    $dbpass = "pass";
    $dbname = "finalDatabase";


    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if($mysqli->connect_error){
        die('connect error(' . $mysql->connect_errno . ')' . $mysqli->connect_error);
    }
    
    print "Connected! Status: " . $mysqli->host_info . "\n";*/*/
    print "hello";
    /*$query = "select * from foodStock";
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
        print $row['name'];
        print "<br>\n";
    }
*/
    /*$result->close();
    mysqli->close();*/
?>