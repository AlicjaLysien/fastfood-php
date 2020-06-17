<?php

session_start();

require_once "connect.php";

$connect_with_db = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect_with_db->connect_errno > 0)
{
    echo "Error number: ".$connect_with_db->connect_errno." Error description: ".$connect_with_db->connect_error;
    /* error number is enough, you can find the description by error number, error description can show to user information we dont want to show */
}
else {

    $contact_email = $_POST['contact_email'];
    $contact_topic = $_POST['contact_topic'];
    $contact_message = $_POST['contact_message'];


    echo $contact_message;
    echo $contact_email;
    echo $contact_topic;



    if ($contact_email != false && $contact_message != false)
    {
        $sql_new_message = "INSERT INTO messages_clients VALUES (NULL, '$contact_email', '$contact_topic', '$contact_message', default, default)";
        @$connect_with_db->query($sql_new_message);

        $_SESSION['is_sent'] ="<p style='text-align: center; color: #8b0000; font-size: 22px;'>Your message was sent!.</p>";
        header('Location: contact.php');

    }

    else
    {
        $_SESSION['not_sent'] ="<p style='text-align: center; color: #8b0000; font-size: 22px;'>Fill all gaps!.</p>";
        header('Location: contact.php');
    }



}


$connect_with_db->close();





?>