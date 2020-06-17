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


    $admin_msg_id = $_POST['admin_msg_id'];


    $sql_new_message_answered = "UPDATE messages_clients SET new = 0 WHERE id = '$admin_msg_id'";
    @$connect_with_db->query($sql_new_message_answered);



    if ($_SESSION['previous_page'] == "new")
    {
        $_SESSION['is_delete_admin_new'] = "<p style='text-align: center; color: #8b0000; font-size: 18px;'>Message was deleted!</p>";
        unset($_SESSION['previous_page']);
        header('Location: admin_messages_new.php');

    }
    if ($_SESSION['previous_page'] == "answered")
    {
        $_SESSION['is_delete_admin_ans'] = "<p style='text-align: center; color: #8b0000; font-size: 18px;'>Message was deleted!</p>";
        unset($_SESSION['previous_page']);
        header('Location: admin_messages_answered.php');

    }


    $connect_with_db->close();


}


?>