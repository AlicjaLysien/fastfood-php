<?php

session_start();

require_once "connect.php";

$connect_with_db = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect_with_db->connect_errno > 0)
{
    echo "Error number: ".$connect_with_db->connect_errno." Error description: ".$connect_with_db->connect_error;
    /* error number is enough, you can find the description by error number, error description can show to user information we dont want to show */
}
else
{
$account_name=$_POST['account_name'];
    $account_surname=$_POST['account_surname'];
    $account_telephone=$_POST['account_telephone'];
    $account_street=$_POST['account_street'];
    $account_home_number=$_POST['account_home_number'];
    $account_city=$_POST['account_city'];

    $account_id = $_SESSION['user_id'];

    if ( ($account_name == $_SESSION['user_name']) && ($account_surname == $_SESSION['user_surname']) &&
        ($account_telephone == $_SESSION['user_telephone']) && ($account_street == $_SESSION['user_street']) &&
        ($account_home_number == $_SESSION['user_home_number']) && ($account_city == $_SESSION['user_city']) )
    {
        $_SESSION['account_change'] = false;
        $_SESSION['account_no_changes'] = "<p style='text-align: center; color: #8b0000; font-size: 22px;'>No changes found.</p>";
        header('Location: account.php');
    }




    else {
        if  ($account_name == !$_SESSION['user_name'])
        {
          $sql_account_name = "UPDATE clients SET name = '$account_name' WHERE id = '$account_id'";
          $connect_with_db->query($sql_account_name);

        }
        $_SESSION['account_change'] = true;
        $_SESSION['account_ok_changes'] = "<p style='text-align: center; color: #8b0000; font-size: 22px;'>Changes were saved.</p>";
        header('Location: account.php');
    }








    $connect_with_db->close();
}





?>