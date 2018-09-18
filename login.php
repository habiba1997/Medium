<?php


 session_start();



/*



 if (isset($_POST['email_login']) && isset($_POST['pass_login'])){

    $username = $_POST['email_login'];
    $password = sha1($_POST['pass_login']);
    $query = $db->prepare("SELECT 'Counter' FROM `users` WHERE Email='$username' and Password ='$password'");
    $query->execute();
    
    $count = $query->rowCount();
    if ($count == 1){
    $_SESSION['username'] = $username;
    foreach($query as $row)
    {
        $_SESSION['user'] = $row['Counter'];
    }
    header("location:profile.php"); //header to redirect, but doesnt work
    }else{
    echo "Invalid Login Credentials.";
    }
    }
*/



 if($_SERVER['REQUEST_METHOD']=="POST"){

 require 'connection.php';

 $mail=check($_POST['email_login']);
 echo $mail;

 $pass=$_POST['pass_login'];

 $check="0";

 
$selectt=$data->prepare("SELECT * FROM `users`");
if ($selectt->execute())
    {
        echo "executed";
    }

    foreach ($selectt as $val) 
    {
        echo "hello" ;
        if( $val["Email"]== $mail && $val["Password"]==$pass)
        {
         $_SESSION["user"]=$val['Counter'];
         $_SESSION['name']=$val['First Name']." ".$val['Last Name'];
         $check ="1";
         header("Location:profile.php");

        }
    }
if ($check=="0")
{
echo "<h1 class='primary'>"."Error in User Information"."<br>"."Re-Enter Correct Email and Password "."</h1>";
}

}
function check($string)
    {
        $string=htmlspecialchars($string);
        $string=trim($string);
        $string=stripcslashes($string);
        $string=filter_var($string,FILTER_SANITIZE_STRING);
        $string=strtolower($string);
        return $string;
    } 
?>

<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        head { position: relative}
        body{margin: inherit; background-image: url(22.jpg); background-size: cover}
        form{ position: absolute; left: 25%; top: 32%; width:70%;  padding: 2% 3%; background-color: rgba(0,0,0,0.3); border-radius:5% ; width: 50%;color: #f5f5f5; margin: auto; display: block}
        form input{ height: 40px}
        span{text-align: center; }
        form a:hover {color: white;text-decoration-line: none }
        
        
    </style>
</head>
    <body>
         
        
        
        <form action="" method="POST" class="signIn">
            <h1> <img src="222.png" class="mx-auto d-block " style="width: 10%;display:inline"> </h1> 
        <h1 style=" display:inline;" ><img src="medium.png" class="mx-auto d-block " style=" display:inline;width: 30%"> </h1>
        
              <div class="form-group">
                <label for="Email1">Email address</label>
                <input type="email" class="form-control" id="Email1" placeholder="Enter Your Email" name="email_login">
              </div>
            
              <div class="form-group">
                <label for="Password1">Password</label>
                <input type="password" class="form-control" id="Password1" placeholder="Enter Password" name="pass_login">
              </div>
            
            <button type="submit" class="btn btn-primary btn-lg" >Sign In</button> <br>
            <h6> Not a member? <a href="signUp_final.php" class="primary" > Join Now </a></h6>
        </form>
        
        
        <script src="bootstrap.min.js">
        </script>
        <script src="jquery-3.3.1.slim.min.map">
        </script>
        <script src="jquery-3.3.1.js"></script>
    </body>
</html>