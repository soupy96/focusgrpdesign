<?php

$errorMSG = "";

// If the first name is empty or invalid
if (empty($_POST["dbbname"])) {
    $errorMSG .= "Name is required";
} else {
    $testingdbbname = test_input($_POST["dbbname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$testingdbbname)) {
        $errorMSG = "Name must only include letters and spaces";
        $dbbname = "";
    } else {
        $dbbname = $_POST["dbbname"];
    }
}

// If the email is empty or invalid
if (empty($_POST["dbbemail"])) {
    $errorMSG = "Email is required";
} else {
    $testingdbbemail = test_input($_POST["dbbemail"]);
    if (!filter_var($testingdbbemail, FILTER_VALIDATE_EMAIL)) {
        $errorMSG = "Invalid dbbemail format";
        $dbbemail = "";
    } else {
        $dbbemail = $_POST["dbbemail"];
    }
}

// If the phonenumber is empty or invalid
if (empty($_POST["dbbphonenumber"])) {
    // $errorMSG .= "Phone number is required ";
    $dbbphonenumber = "User did not leave a phone number";
} else {
    $testingdbbphone = test_input($_POST["dbbphonenumber"]);
    if(!preg_match("/^(?:\+?1[-. ]?)?\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$/", $testingdbbphone)) {
        $errorMSG = "Invalid phone number format";
        $dbbphonenumber = "";
    } else {
        $dbbphonenumber = $_POST["dbbphonenumber"];
    }
}

// If the company is empty or invalid
if (empty($_POST["dbbcompany"])) {
    // $errorMSG .= "Company is required";
    $dbbcompany = "User did not leave a company name";
} else {
    $dbbcompany = test_input($_POST["dbbcompany"]);
}

// If the comment is empty or invalid
if (empty($_POST["dbbcomment"])) {
    $errorMSG = "Comment is required";
    // $comment = "User did not leave a comment";
} else {
    $testingdbbcomment = test_input($_POST["dbbcomment"]);
    $dbbcomment = $testingdbbcomment;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$EmailTo = "michael@blackridgestrategy.com"; //This is for testing
$Subject = "New Form Submission From Design";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $dbbname;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $dbbemail;
$Body .= "\n";
$Body .= "Phone Number: ";
$Body .= $dbbphonenumber;
$Body .= "\n";
$Body .= "Company: ";
$Body .= $dbbcompany;
$Body .= "\n";
$Body .= "What can we do for you?: ";
$Body .= $dbbcomment;
$Body .= "\n";


// redirect to success page
if ($errorMSG == ""){
   // send email if there are no errors
    $success = mail($EmailTo, $Subject, $Body, "From:".$dbbemail);
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