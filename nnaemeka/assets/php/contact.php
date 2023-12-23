<?php

// ENTER YOUR EMAIL
$emailTo = "nokonkwo8426@gmail.com";

// ENTER IDENTIFIER
$emailIdentifier =  "Message sent via contact form from " . $_SERVER["SERVER_NAME"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $clientEmail = trim($_POST["email"]);
    $message = trim($_POST["message"]);
    $fhp_input = trim($_POST["company"]);

    $response = array("nameMessage" => "", "emailMessage" => "", "messageMessage" => "", "successMessage" => "");

    if (empty($name)) {
        $response["nameMessage"] = "Name is required";
    }

    if (!filter_var($clientEmail, FILTER_VALIDATE_EMAIL)) {
        $response["emailMessage"] = "Invalid email format";
    }

    if (empty($message)) {
        $response["messageMessage"] = "Message is required";
    }

    if (empty($fhp_input) && empty($response["nameMessage"]) && empty($response["emailMessage"]) && empty($response["messageMessage"])) {

        $response["successMessage"] = "Message sent successfully";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $name . " <" . $clientEmail . ">\r\n";
        $headers .= "Reply-To: " . $clientEmail;

        mail($emailTo, $emailIdentifier, $message, $headers);
    }

    echo json_encode($response);
}

?>

