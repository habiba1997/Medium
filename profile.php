<?php

include('connection.php');
session_start();

if(!isset($_SESSION["user"]))
{ 
header("Location: login.php");  
}


if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["edit"]))

{
    $edit=$db->prepare("UPDATE posts SET title=:title, post=:post WHERE post_id=:post_id");

    $edit->execute(array(":title"=>$_POST['title'],":post"=>$_POST['post'],":post_id"=>$_POST['user_id']));

}


if ( isset($_GET['action']) && isset($_GET['post_id']) )
{
    if ( $_GET['action'] == 'delete' )
    {
        $del=$db->prepare("DELETE FROM posts WHERE post_id=:post_id");

        if( $del->execute(array(":post_id"=>$_GET['post_id'])) )
        {
            $del_status="The post of id".$_GET['post_id']."has been removed";
        }
        else
        {
            $del_status="Something went wrong!";
        }
    }

    else if ( $_GET["action"] == "edit" )
    {
        $select = $db->prepare("SELECT * FROM posts WHERE post_id=:post_id");

        $select->execute(array(":post_id"=>$_GET["post_id"]));

        foreach ($select as $val)
        {
            $title = $val["title"];
            $post = $val["post"];
            $post_id = $val["post_id"];
        }
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	 crossorigin="anonymous">


</head>
<body>
    
<div style="margin-top: 70px"></div>
  <style>
  body{
    background-image: url("papers.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

  </style>


<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold fixed-top" style="margin-bottom:20px;background-color:rgba(0,0,0,0.3)">

    <ul class="navbar-nav mx-auto">

      <li class="nav-item active" style="margin:0 50px">
        <a class="nav-link" href="project.html">Medium <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item" style="margin:0 50px">
        <a class="nav-link" href="home.php">Home</a>
      </li>

      <li class="nav-item active" style="margin:0 50px">
        <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
      </li>

    </ul>

  <a href="insert.php" class="float-right button btn btn-info my-2 my-sm-0" style="margin:30px">Add Post</a>

  <a href="logout.php" class="float-right button btn btn-danger my-2 my-sm-0" style="margin:30px">Logout</a>

</nav>


<?php

$userID = $_SESSION['user'];
$query = $db->prepare("SELECT * FROM posts WHERE user_id='$userID' ORDER BY time DESC");

$query->execute();


foreach($query as $row)



echo "<div class='card border-primary mb-3 col-sm-6 mx-auto' style='max-width: 30rem;'>
  <div class='card-header bg-transparent border-primary'>".$row['time']."</div>
  <div class='card-body'>
  <a href='profile.php?action=delete&post_id=".$row['post_id']."'><i class='fas fa-minus-circle float-right' style='color:red'></i></a>
  <a href='insert.php?action=edit&post_id=".$row['post_id']."'><i class='fas fa-edit float-right' style='color:info'></i></a>
    <h4 class='card-title text-primary'>".$row['title']."</h4>
    <p class='card-text text-info'>".$row['post']."</p>
  </div>
  </div>";


//<div class='card-footer bg-transparent border-primary'>".$_SESSION['username']."</div>


?>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>

    
</body>
</html>







