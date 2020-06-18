<?php

session_start();

if ( $_SESSION['logged'] == true) {
    header('Location: main.php');
}



require_once "connect.php";

$connect_with_db = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect_with_db->connect_errno > 0)
{
    echo "Error number: ".$connect_with_db->connect_errno." Error describtion: ".$connect_with_db->connect_error;
    /* error number is enough, you can find the describtion by error number, error describtion can show to user information we dont want to show */
}
else {


    $register_email = $_POST['register_email'];
    $register_pass1 = $_POST['register_pass1'];
    $register_pass2 = $_POST['register_pass2'];
    $register_name = $_POST['register_name'];
    $register_surname = $_POST['register_surname'];
    $register_sex = $_POST['register_sex'];
    $register_telephone = $_POST['register_telephone'];
    $register_city = $_POST['register_city'];
    $register_street = $_POST['register_street'];
    $register_home_number = $_POST['register_home_number'];




    $register_all_ok = true;

    // test email
    if (isset($register_email))
    {
        $sql_is_email_used = "SELECT * FROM clients WHERE email = '$register_email'";
    if (@$connect_with_db->query($sql_is_email_used)->num_rows > 0) {
        $_SESSION['error_email'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>E-mail is already used.</p>";
        $register_all_ok = false;
    }

    // that helps if someone uses ą or ł and the letter can be delated, so paweł finishes as pawe (or pawel, what is ok, but the same as user wrote) and always checks symbols as _ . ^
        $register_email_corrected = filter_var($register_email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($register_email_corrected, FILTER_VALIDATE_EMAIL) == false) || ($register_email!=$register_email_corrected))
    {
        $_SESSION['error_email'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Write correct e-mail.</p>";
        $register_all_ok = false;
    }

    if (isset($_SESSION['error_email'])) {
        header("Location: register.php");
        exit();
    }
}

    //test password
    if(strlen($register_pass1) < 6 || strlen($register_pass1) > 20)
    {
        $_SESSION['error_pass'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Password has to contain from 6 to 30 characters.</p>";
        $register_all_ok = false;
    }
    if($register_pass1 != $register_pass2)
    {
        $_SESSION['error_pass'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Password are not the same.</p>";
        $register_all_ok = false;
    }
    if(isset($_SESSION['error_pass']))
    {
        header("Location: register.php");
        exit();
    }



    // name and surname test

    if(ctype_alpha($register_name) == false || ctype_alpha($register_surname) == false)
    {
        $_SESSION['error_name'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Use only letter characters.</p>";
        $register_all_ok = false;
    }
    if(strlen($register_name) < 1  || strlen($register_surname) < 1)
    {
        $_SESSION['error_name'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Write the first name and the second name.</p>";
        $register_all_ok = false;
    }
    if(isset($_SESSION['error_name']))
    {
        header("Location: register.php");
        exit();
    }

// telephone test
    if(strlen($register_telephone) != 9 )
    {
        $_SESSION['error_telephone'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Telephone number is too short or too long.</p>";
        $register_all_ok = false;
    }
    if(ctype_digit($register_telephone) == false)
    {
        $_SESSION['error_telephone'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Use only numeric characters.</p>";
        $register_all_ok = false;
    }

    if(isset($_SESSION['error_telephone']))
    {
        header("Location: register.php");
        exit();
    }


    // address test
    if(strlen($register_city) < 1 ||  strlen($register_street) < 1 || strlen($register_home_number) < 1)
    {
        $_SESSION['error_address'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Write whole home address.</p>";
        $register_all_ok = false;
    }

    if(isset($_SESSION['error_address']))
    {
        header("Location: register.php");
        exit();
    }



    // final test

    if ($register_all_ok == false)
    {
        header("Location: register.php");
    }
    else
        {
        // can be register

            $sql_add_new_client = "INSERT INTO clients VALUES ('',)";

        $_SESSION['register_ok'] = "<p style='text-align: center; color: #8b0000; font-size: 22px;'>You created an account!</p>";
        header("Location: register.php");
    }


}

