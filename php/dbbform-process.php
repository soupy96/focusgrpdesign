<?php

$errorMSG = "";

// If the first name is empty or invalid
if (empty($_POST["firstname"])) {
    $errorMSG .= "First Name is required";
} else {
    $testingfirstname = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$testingfirstname)) {
        $errorMSG = "First Name must only include letters and spaces";
        $firstname = "";
    } else {
        $firstname = $_POST["firstname"];
    }
}

// If the last name is empty or invalid
if (empty($_POST["lastname"])) {
    $errorMSG .= "Last Name is required";
} else {
    $testinglastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$testinglastname)) {
        $errorMSG = "Last Name must only include letters and spaces";
        $lastname = "";
    } else {
        $lastname = $_POST["lastname"];
    }
}

// If the email is empty or invalid
if (empty($_POST["email"])) {
    $errorMSG = "Email is required";
} else {
    $testingemail = test_input($_POST["email"]);
    if (!filter_var($testingemail, FILTER_VALIDATE_EMAIL)) {
        $errorMSG = "Invalid email format";
        $email = "";
    } else {
        $email = $_POST["email"];
    }
}

// If the phonenumber is empty or invalid
if (empty($_POST["phonenumber"])) {
    $errorMSG .= "Phone number is required ";
} else {
    $testingphone = test_input($_POST["phonenumber"]);
    if(!preg_match("/^(?:\+?1[-. ]?)?\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$/", $testingphone)) {
        $errorMSG = "Invalid phone number format";
        $phonenumber = "";
    } else {
        $phonenumber = $_POST["phonenumber"];
    }
}

// If the comment is empty or invalid
if (empty($_POST["comment"])) {
    $comment = "User did not leave a comment";
} else {
    $testingcomment = test_input($_POST["comment"]);
    $comment = $testingcomment;
}

// If the company is empty or invalid
if (empty($_POST["company"])) {
    // $errorMSG .= "Company is required";
    $company = "User did not leave a company name";
} else {
    $company = test_input($_POST["company"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$EmailTo = "michael@blackridgestrategy.com"; //This is for testing
//$EmailTo = "dv27nfhr5nsl@a2plcpnl0377.prod.iad2.secureserver.net"; // This is for testing
//$EmailTo = "michael@focusgrp.ca"; // This is for testing
//$EmailTo = "mike@focusgrp.ca"; //This is for testing
//$EmailTo = "amir@focusgrp.ca"; // This is for live
$Subject = "New Form Submission Recieved";

// prepare email body text
$Body = "";
$Body .= "First Name: ";
$Body .= $firstname;
$Body .= "\n";
$Body .= "Last Name: ";
$Body .= $lastname;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Phone Number: ";
$Body .= $phonenumber;
$Body .= "\n";
$Body .= "What can we do for you?: ";
$Body .= $comment;
$Body .= "\n";
$Body .= "Company: ";
$Body .= $company;
$Body .= "\n";

// redirect to success page
if ($errorMSG == ""){
   // send email if there are no errors
    $success = mail($EmailTo, $Subject, $Body, "From:".$email);
    // echo success for the ajax part
    echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>