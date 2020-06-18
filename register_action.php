<?php

session_start();

if ( $_SESSION['logged'] == true) {
    header('Location: main.php');
}



require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $connect_with_db = @new mysqli($host, $db_user, $db_password, $db_name);
    if ($connect_with_db->connect_errno > 0) {
        throw new Exception(mysqli_connect_errno());
    }
}
catch (Exception $e)
{
    echo "<p style='text-align: center; color: #8b0000; font-size: 22px;'>You created an account!</p>";
    echo "Error information".$e;
}


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
    $register_checkbox = $_POST['register_checkbox'];


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


    // hash password
    $hash_pass = password_hash($register_pass1, PASSWORD_DEFAULT);


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


// telephone test
    if(ctype_digit($register_telephone) == false)
    {
        $_SESSION['error_telephone'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Use only numeric characters.</p>";
        $register_all_ok = false;
    }
    if(strlen($register_telephone) != 9 )
    {
        $_SESSION['error_telephone'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Telephone number is too short or too long.</p>";
        $register_all_ok = false;
    }



    // address test
    if(strlen($register_city) < 1 ||  strlen($register_street) < 1 || strlen($register_home_number) < 1)
    {
        $_SESSION['error_address'] = "<p style='text-align: center; color: #8b0000; font-size: 16px;'>Write whole home address.</p>";
        $register_all_ok = false;
    }


// checkbox test
    if(!isset($_POST['register_checkbox']))
    {
        $_SESSION['error_checkbox'] = "<p style='text-align: center; color: #8b0000; font-size: 14px;'>Confirm conditions.</p>";
        $register_all_ok = false;
    }

// remember informations
    $_SESSION['last_email'] = $register_email;
    $_SESSION['last_pass1'] = $register_pass1;
    $_SESSION['last_pass2'] = $register_pass2;
    $_SESSION['last_name'] = $register_name;
    $_SESSION['last_surname'] = $register_surname;
    $_SESSION['last_sex'] = $register_sex;
    $_SESSION['last_telephone'] = $register_telephone;
    $_SESSION['last_city'] = $register_city;
    $_SESSION['last_street'] = $register_street;
    $_SESSION['last_home_number'] = $register_home_number;
    if(isset($_POST['register_checkbox'])) $_SESSION['last_checkbox'] = true;


    // final test

    if ($register_all_ok == false)
    {
        header("Location: register.php");
    }
    else
        {
        // can be register

$sql_add_new_client = "INSERT INTO clients VALUES (NULL, '$register_name', '$register_surname', '$register_email', 
'$hash_pass', '$register_sex', '$register_telephone', '$register_city', '$register_street', '$register_home_number')";

            @$connect_with_db->query($sql_add_new_client );

        $_SESSION['register_ok'] = "<p style='text-align: center; color: #8b0000; font-size: 22px;'>You created an account!</p>";
        header("Location: register.php");
    }


}

