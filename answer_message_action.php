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

    $admin_msg_topic = $_POST['admin_msg_topic'];
    $admin_msg_email = $_POST['admin_msg_email'];
    $admin_msg_id = $_POST['admin_msg_id'];
    $answer_admin = $_POST['answer_admin'];



    if ($answer_admin != false)
    {
        $sql_new_message_admin = "INSERT INTO messages_admin VALUES (NULL, '$admin_msg_id', '$admin_msg_email', '$admin_msg_topic', '$answer_admin')";
        @$connect_with_db->query($sql_new_message_admin);

        $sql_new_message_answered = "UPDATE messages_clients SET answer = 1 WHERE id = '$admin_msg_id'";
        @$connect_with_db->query($sql_new_message_answered);

        $_SESSION['is_sent_admin'] ="<p style='text-align: center; color: #8b0000; font-size: 18px;'>Message was sent!</p>";
        header('Location: admin_messages_new.php');
    }

    else
        {
            $_SESSION['not_sent_admin'] ="<p style='text-align: center; color: #8b0000; font-size: 18px;'>Text area is empty. Message not sent.</p>";
            header('Location: admin_messages.php');
        }


    $connect_with_db->close();


}


?>