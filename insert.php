<?php

include("connection.php");
session_start();


if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['insert']))

{
    $userId = $_SESSION['user'];
    $title = $_POST['title'];
    $post = $_POST['post'];
    $ins=$db->prepare("INSERT INTO posts (title,post,user_id) VALUES ('$title','$post','$userId')");

    if($ins->execute())
    {
        $status="Data inserted successfuly";
        header("Location: profile.php");
    } 
    else
    {
        $status="Something went wrong!";
    }

}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["edit"]))

{
    $edit=$db->prepare("UPDATE posts SET title=:title, post=:post WHERE post_id=:post_id");

    $edit->execute(array(":title"=>$_POST['title'],":post"=>$_POST['post'],":post_id"=>$_GET['post_id']));
    header("Location: profile.php");

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

 
 <style>
  body{
    background-image: url("papers.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

  </style>

</head>
<body>

<?php
if(isset($status))
{
    echo "<span style='font-size:26px'>$status</span>";
}
?>


<form method="POST" id="uform" class="w-50 mx-auto" style="margin-top:120px">

<div class="form-group">

<input type="text" name="title" placeholder="Title" class="form-control" value="<?php
if(isset($_GET['action']))
if($_GET['action']=="edit")
{
    $postID = $_GET['post_id'];
    $query = $db->prepare("SELECT title FROM posts WHERE post_id='$postID'");

    $query->execute();

    foreach($query as $row)
        echo $row['title'];
}
else
    echo "Title";
?>">
</div>

<div class="form-group">
    
<textarea name="post" form="uform" cols="30" rows="10" placeholder="What's on your mind" class="form-control"><?php
if(isset($_GET['action']))
if($_GET['action']=="edit")
{
    $postID = $_GET['post_id'];
    $query = $db->prepare("SELECT post FROM posts WHERE post_id='$postID'");

    $query->execute();

    foreach($query as $row)
        echo $row['post'];
}
?></textarea>
</div>
<button type="submit" class="btn btn-primary" name="<?php
if(isset($_GET['action']))
{
    echo "edit";
}
else
{
    echo "insert";
}
?>">Submit</button>

</form>


