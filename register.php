<?php

session_start();

if ( $_SESSION['logged'] == true) 
header('Location: main.php');

?>
<DOCTYPE HTML>
  <html>
  <head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Create an account in Alicja's Fast Food</title>
  <script src='https://www.google.com/recaptcha/api.js>'></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="fontello/css/fontello.css">


  </head>
  
  <body>



<!-- header --> 
<header>

  <nav class="navbar bg-white navbar-light navbar-expand-md"> 


<a class="navbar-brand" href="main.php">
<img class="img-fluid" id="logo" src="img/logo.png" >
</a>
<!-- logo --> 

<!-- search--> 
<form class="form-inline d-none d-sm-none d-md-block" id="search">
  <input class="form-control mr-2" type="search" placeholder="Search">
  <button class="btn btn-light" type="submit">Ok</button>
</form>
<!-- search--> 

<!-- basket -->

<div id="basket">
  <a href="basket.php"><i class="icon-basket"> </i> </a>
  </div>

<!--basket -->


<!-- menu --> 
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" >  
<span class="navbar-toggler-icon">
</span>
</button>

<div class="collapse navbar-collapse" id="mainmenu">
  <ul class="navbar-nav mr-auto">

  <?php
        if ( $_SESSION['logged'] == true) 
        echo " <li class='nav-item'>
        <a class='nav-link' href='logout_action.php'>Log out</a></li>";

        else echo "<li class='nav-item'>
        <a class='nav-link' href='login.php'>Log in</a></li>";
        ?>

<?php
        if ( $_SESSION['logged'] == true) 
        echo " <li class='nav-item'>
        <a class='nav-link' href='account.php'>Account</a></li>";

        else echo "<li class='nav-item'>
        <a class='nav-link' href='register.php'>Register</a></li>";
        ?>

        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>

  </ul>
</div>
<!-- menu --> 


 

  </nav>

</header>

<!-- food menu --> 
<div class="container-fluid">
<div class="row" id="foodmenu">
  <a href="pizza.php" class="col-sm-3 foodmenu">Pizza</a>
  <a href="burger.php" class="col-sm-3 foodmenu">Burgers</a>
  <a href="sushi.php" class="col-sm-3 foodmenu">Sushi</a>
  <a href="drink.php" class="col-sm-3 foodmenu">Drinks</a>
</div> 
</div>
<!-- food menu --> 

<!-- register form -->


<?php
if(isset($_SESSION['register_ok']))
{
    echo $_SESSION['register_ok'];
    unset($_SESSION['register_ok']);
}
?>

<div class="wholeform">

<form method="post" action="register_action.php">


    <!--email-->
  <div class="form-group ">
    <div class=" d-flex justify-content-center">
    <label for="inputAddress2">E-mail:</label>
  </div>
    <div class=" d-flex justify-content-center">
    <input name="register_email" type="email" class="form-control formwindow" placeholder="name@example.com"
    value = "<?php
    if(isset($_SESSION['last_email']))
    {
        echo $_SESSION['last_email'];
        unset($_SESSION['last_email']);
    }
    ?>">
  </div>
  </div>
    <?php
    if(isset($_SESSION['error_email']))
    {
        echo $_SESSION['error_email'];
        unset($_SESSION['error_email']);
    }
    ?>

    <!--password-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputEmail4">Password:</label>
    </div>
      <div class=" d-flex justify-content-center">
      <input name="register_pass1" type="password" class="form-control formwindow">
    </div>
    </div>
    <!--confirm password-->
    <div class="form-group  ">
      <div class=" d-flex justify-content-center">
      <label for="inputPassword4">Confirm password:</label>
    </div>
      <div class=" d-flex justify-content-center">
      <input name="register_pass2" type="password" class="form-control formwindow">
    </div>
    </div>

    <?php
    if(isset($_SESSION['error_pass']))
    {
        echo $_SESSION['error_pass'];
        unset($_SESSION['error_pass']);
    }
    ?>


    <!--first name-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputEmail4">First name:</label>
    </div>
      <div class=" d-flex justify-content-center">
      <input name="register_name" type="text" class="form-control formwindow"
             value = "<?php
             if(isset($_SESSION['last_name']))
             {
                 echo $_SESSION['last_name'];
                 unset($_SESSION['last_name']);
             }
             ?>">
    </div>
    </div>
    <!--second name-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputPassword4">Second name:</label>
    </div>
      <div class=" d-flex justify-content-center">
      <input name="register_surname" type="text" class="form-control formwindow"
             value = "<?php
             if(isset($_SESSION['last_surname']))
             {
                 echo $_SESSION['last_surname'];
                 unset($_SESSION['last_surname']);
             }
             ?>">
    </div>
    </div>


    <?php
    if(isset($_SESSION['error_name']))
    {
        echo $_SESSION['error_name'];
        unset($_SESSION['error_name']);
    }
    ?>

    <!--sex-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputState">Sex:</label>
    </div>
      <div class=" d-flex justify-content-center">
      <select name="register_sex" id="inputState" class="form-control formwindow"
              value = "<?php
              if(isset($_SESSION['last_sex']))
              {
                  echo $_SESSION['last_sex'];
                  unset($_SESSION['last_sex']);
              }
              ?>">
        <option selected>man</option>
        <option>woman</option>
        <option>other</option>
      </select>
    </div>
    </div>


    <!--telephone-->
  <div class="form-group">
    <div class=" d-flex justify-content-center">
    <label for="inputPassword4">Telephone number:</label>
  </div>
    <div class=" d-flex justify-content-center">
    <input name="register_telephone" type="text" class="form-control formwindow"
           value = "<?php
           if(isset($_SESSION['last_telephone']))
           {
               echo $_SESSION['last_telephone'];
               unset($_SESSION['last_telephone']);
           }
           ?>">
  </div>
</div>

    <?php
    if(isset($_SESSION['error_telephone']))
    {
        echo $_SESSION['error_telephone'];
        unset($_SESSION['error_telephone']);
    }
    ?>

<!--address city-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputCity">City:</label>
    </div>
    <div class=" d-flex justify-content-center">
      <input name="register_city" type="text" class="form-control formwindow"
             value = "<?php
             if(isset($_SESSION['last_city']))
             {
                 echo $_SESSION['last_city'];
                 unset($_SESSION['last_city']);
             }
             ?>">
    </div>
    </div>

    <!--address street-->
    <div class="form-group ">
      <div class=" d-flex justify-content-center">
      <label for="inputAddress">Street:</label>
      </div>
      <div class=" d-flex justify-content-center">
      <input name="register_street" type="text" class="form-control formwindow"
             value = "<?php
             if(isset($_SESSION['last_street']))
             {
                 echo $_SESSION['last_street'];
                 unset($_SESSION['last_street']);
             }
             ?>">
      </div>
    </div>

    <!--address home number-->
    <div class="form-group  ">
      <div class=" d-flex justify-content-center">
      <label for="inputZip">Home number:</label>
      </div>
      <div class=" d-flex justify-content-center">
      <input name="register_home_number" type="text" class="form-control" style="width: 150px;"
             value = "<?php
             if(isset($_SESSION['last_home_number']))
             {
                 echo $_SESSION['last_home_number'];
                 unset($_SESSION['last_home_number']);
             }
             ?>">
      </div>
  </div>

    <?php
    if(isset($_SESSION['error_address']))
    {
        echo $_SESSION['error_address'];
        unset($_SESSION['error_address']);
    }
    ?>

    <!--checkbox-->
  <div class="form-group">
    <div class="form-check">
      <div class="d-flex justify-content-center">

      <label class="form-check-label label-register">
          <input name="register_checkbox" type="checkbox"
          <?php
          if (isset($_SESSION['last_checkbox']))
          {
           echo "checked";
           unset($_SESSION['last_checkbox']);
          }
          ?>
          >
          I accept the terms and conditions
      </label>
    </div>
    </div>
  </div>

    <?php
    if(isset($_SESSION['error_checkbox']))
    {
        echo $_SESSION['error_checkbox'];
        unset($_SESSION['error_checkbox']);
    }
    ?>

    <!--recaptcha - not working yet -->
    <div class="g-recaptcha" data-sitekey="6LeBLaYZAAAAACBa9hTU_0Fv9gy6zaDMnCbdICC7"></div>


  <div class=" d-flex justify-content-center">
  <button type="submit" class="btn btn-danger">Sign in</button>
  </div>
</form>
</div>

<!-- register form end -->


<!-- footer -->
<footer>

<div class="container">
  <div class="row">


    <!-- more info -->
    <div class="col-md-3 col-sm-6">
      Additional information
      <ul>
      <li>Regulations</li>
      <li>Supply and payments</li>
     <li>Guarantee and returns</li>
      <li>Privacy policy</li>
    <li>Cookies policy</li>
      </ul>
      </div>
 <!-- more info -->

<!-- contact -->
<div class="col-md-3 col-sm-6" id="contact">Contact
  <ul>
 <li class="icon-location">Zelená 20<br>Brno</li>
 <li class="icon-phone">Telefon number:<br>+420 111 222 555</li>
 <li class="icon-mail">E-mail:<br>alicjafastfood@mail.com</li>
 <li class="icon-clock">Opening hours:<br>every day 10:00-23:00</li>
   </ul>
</div>
<!-- contact -->

<!-- map -->
<div id="map" class="col-md-6">

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.9013481655284!2d16.525786615021715!3d49.22139797932466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471296dcd17f8bb7%3A0xd858a7507ce03785!2zS25paG92bmEgSmnFmcOtaG8gTWFoZW5hIHYgQnJuxJs!5e0!3m2!1sen!2scz!4v1590230230364!5m2!1sen!2scz" 
  width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

</div>
<!-- map -->

  </div class="container">
  </div class="row">

</footer>
<!-- footer -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

    </body>

    </html>