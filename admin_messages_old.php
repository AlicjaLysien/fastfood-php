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

    $sql_deleted_messages = "SELECT * FROM messages_clients WHERE new =0  ORDER BY id DESC";
   $result_messages = @$connect_with_db->query($sql_deleted_messages);


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
        <li class="page-item"><a class="page-link" href="admin_messages_new.php">New</a></li>
        <li class="page-item"><a class="page-link" href="admin_messages_answered.php">Answered</a></li>
        <li class="page-item active" aria-current="page">
      <span class="page-link">
       Old
        <span class="sr-only">(current)</span>
      </span>
        </li>
    </ul>
</nav>

<!-- messages menu  -->



<!-- main part  -->
<?php

if ($result_messages->num_rows > 0) {



echo "<div class=\"accordion\" id=\"accordionExample\">";
    $i = 1;
    while ($row = $result_messages->fetch_assoc()) {


echo  "<div class='card'> <div class='card-header' id='heading".$i."'> <h2 class='mb-0'>";

echo "<button class='btn btn-block text-left btn-danger' type='button' data-toggle='collapse' data-target='#collapse".$i."' aria-expanded='true' aria-controls='collapse".$i."'>".$row['topic']."<i> from ".$row['email']."</i></button>";



echo "</h2></div>";

echo "<div id='collapse".$i."' class='collapse' aria-labelledby='heading".$i."' data-parent='#accordionExample'>  <div class='card-body'>";

echo $row['message'];

$id_previous_msg = $row['id'];
        $sql_the_answer = "SELECT * FROM messages_admin WHERE id_messages_clients = '$id_previous_msg'";
        $result_the_answer = @$connect_with_db->query($sql_the_answer);
if( $result_the_answer->num_rows > 0) {
    $row_admin = $result_the_answer->fetch_assoc();
    echo "</br></br><i>" . $row_admin['message'] . "</i>";
}

echo "</div></div></div>";

// admin message


//admin message

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