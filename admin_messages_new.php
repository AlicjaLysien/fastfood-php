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

    $sql_number_messages = "SELECT * FROM messages_clients WHERE new =1 AND answer=0 ORDER BY id DESC";

   $result_messages = @$connect_with_db->query($sql_number_messages);

}


?>

<DOCTYPE HTML>
  <html>
  <head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Log in to Alicja's Fast Food</title>
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



<!-- menu --> 
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" >  
<span class="navbar-toggler-icon">
</span>
</button>

<div class="collapse navbar-collapse" id="mainmenu">
  <ul class="navbar-nav mr-auto">


      <li class="nav-item">
          <a class="nav-link" href="admin_messages_new.php">Messages</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Orders</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Discounts</a>
        </li>

  </ul>
</div>
<!-- menu --> 

  </nav>

</header>


<!-- messages menu  -->

<nav aria-label="...">
    <ul class="pagination pagination-lg">
        <li class="page-item active" aria-current="page">
      <span class="page-link">
        New
        <span class="sr-only">(current)</span>
      </span>
        </li>
        <li class="page-item"><a class="page-link" href="admin_messages_answered.php">Answered</a></li>
        <li class="page-item"><a class="page-link" href="admin_messages_old.php">Old</a></li>
    </ul>
</nav>

<!-- messages menu  -->

<?php
if ( isset($_SESSION['is_delete_admin_new']) && $_SESSION['is_delete_admin_new'] == true)
    echo $_SESSION['is_delete_admin_new'];
unset($_SESSION['is_delete_admin_new']);

?>


<?php
if ( isset($_SESSION['is_sent_admin']) && $_SESSION['is_sent_admin'] == true)
    echo $_SESSION['is_sent_admin'];
unset($_SESSION['is_sent_admin']);

if ( isset($_SESSION['not_sent_admin']) && $_SESSION['not_sent_admin'] == true)
    echo $_SESSION['not_sent_admin'];
unset($_SESSION['not_sent_admin']);
?>



<!-- main part  -->
<?php

if ($result_messages->num_rows > 0) {



echo "<div class=\"accordion\" id=\"accordionExample\">";
    $i = 1;
    while ($row = $result_messages->fetch_assoc()) {

echo "<form action='answer_message_action.php' method='post'>";

echo  "<div class='card'> <div class='card-header' id='heading".$i."'> <h2 class='mb-0'>";

echo "<button class='btn btn-block text-left btn-danger' type='button' data-toggle='collapse' data-target='#collapse".$i."' aria-expanded='true' aria-controls='collapse".$i."'>".$row['topic']."<i> from ".$row['email']."</i></button>";

echo "<input type='hidden' name='admin_msg_topic' value='".$row['topic']."'>";
echo "<input type='hidden' name='admin_msg_email' value='".$row['email']."'>";
echo "<input type='hidden' name='admin_msg_id' value='".$row['id']."'>";

echo "</h2></div>";

echo "<div id='collapse".$i."' class='collapse' aria-labelledby='heading".$i."' data-parent='#accordionExample'>  <div class='card-body'>";

echo $row['message'];
echo "</div>";

// admin message


echo "<textarea class='form-control messagewindow' name='answer_admin' id='exampleFormControlTextarea1' rows='3'></textarea>";

echo " <button id='answer".$row['topic']."' class='btn btn-center text-center btn-danger' type='submit'>Answer</button>";

echo  "</form>";
//admin message

echo "<form action='delete_message_action.php' method='post'>";
echo "<input type='hidden' name='admin_msg_id' value='".$row['id']."'>";
$_SESSION['previous_page'] = "new";
echo "<button id='delete".$row['id']."' class='btn btn-center text-center btn-danger' type='submit'>Delete</button></div></div>";
echo "</form>";
    $i++;
    }

echo "</div>";

}
?>
<!-- main part  -->


<!-- footer -->
<footer>



</footer>
<!-- footer -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>

    </body>

    </html>