<?php

session_start();

require_once "connect.php";

$connect_with_db = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connect_with_db->connect_errno > 0)
{
    echo "Error number: ".$connect_with_db->connect_errno." Error describtion: ".$connect_with_db->connect_error;
    /* error number is enough, you can find the describtion by error number, error describtion can show to user information we dont want to show */
}
else
{

   
    $login_email=$_POST['login_email'];
    $login_password=$_POST['login_password'];

    $sql_find = "SELECT * FROM clients WHERE email ='$login_email' AND pass ='$login_password'";
    
    if ($result = @$connect_with_db->query($sql_find))  /* result = false, when i have error in my query, not when nothing found*/
  
        { 
            $sql_find_number = $result->num_rows;
            if ($sql_find_number > 0)
                {

                    $_SESSION['logged'] = true;

                    $found_user = $result->fetch_assoc();
                    
                    $_SESSION['user_id'] = $found_user['id'];
                    $_SESSION['user_name'] = $found_user['name'];
                    $_SESSION['user_surname'] = $found_user['surname'];
                    $_SESSION['user_email'] = $found_user['email'];
                    $_SESSION['user_telephone'] = $found_user['telephone'];
                    $_SESSION['user_city'] = $found_user['city'];
                    $_SESSION['user_street'] = $found_user['street'];
                    $_SESSION['user_home_number'] = $found_user['home_number'];
                    

                
                  unset($_SESSION['wrong']);
                    $result->free();
                    
                    header('Location: main.php');
                    
                }
        
            else 
            {
                $_SESSION['wrong'] ="<p style='text-align: center; color: #8b0000; font-size: 22px;'>Wrong e-mail or password.</p>";
                header('Location: login.php');
            }
        }




    $connect_with_db->close();
}





?>