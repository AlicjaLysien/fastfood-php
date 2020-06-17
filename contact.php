<?php

session_start();

?>

<DOCTYPE HTML>
  <html>
  <head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contact Alicja</title>
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



<?php
if ( isset($_SESSION['is_sent']) && $_SESSION['is_sent'] == true)
    echo $_SESSION['is_sent'];
unset($_SESSION['is_sent']);

if ( isset($_SESSION['not_sent']) && $_SESSION['not_sent'] == true)
    echo $_SESSION['not_sent'];
unset($_SESSION['not_sent']);
?>



<!-- mail form -->


<div class="wholeform">
<form action="contact_action.php" method="post">
  <div class="form-group">
    <div class=" d-flex justify-content-center">
    <label for="exampleFormControlInput1">Email address:</label>
  </div>
    <div class=" d-flex justify-content-center">
    <input type="email" name="contact_email" class="form-control formwindow" id="exampleFormControlInput1" placeholder="name@example.com"
    
    <?php
if ( $_SESSION['logged'] == true) 
echo "value='".$_SESSION['user_email']."'";
    ?>
    
    >
  </div>
  </div>
  <div class="form-group">
    <div class=" d-flex justify-content-center">
    <label for="exampleFormControlSelect1">Topic:</label>
  </div>
    <div class=" d-flex justify-content-center">
    <select name="contact_topic" class="form-control formwindow" id="exampleFormControlSelect1">
      <option>Order</option>
      <option>Services</option>
      <option>Career</option>
      <option>Guarantee and returns</option>
      <option>Others</option>
    </select>
  </div>
  </div>
  <div class="form-group">
    <div class=" d-flex justify-content-center">
    <label for="exampleFormControlTextarea1">Your message:</label>
  </div>
    <div class=" d-flex justify-content-center">
        <textarea class="form-control messagewindow" name="contact_message" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  </div>
  <div class=" d-flex justify-content-center">
  <button type="submit" class="btn btn-danger">Send</button>
</div>
</form>
</div>


<!-- mail form -->


<!-- footer -->
<footer>

<div class="container" id="footer">
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