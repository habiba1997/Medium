<?php

    Try {
      include'mySQLConnection.php';
      $dataStatus= "Databas Connected Successfully";
      }
    catch(PDOException $e)
      {
     echo "Connection failed: " . $e->getMessage();
      }
        
    



    if($_SERVER['REQUEST_METHOD']=="POST" )      
    {       
          


            if(!empty($_POST['Firstname_input']))
               {
                  $Firstname_var=check($_POST['Firstname_input']);
               }
               else{$Firstname_error="error";}

               if(!empty($_POST['Lastname_input']))
               {
                  $Lastname_var=check($_POST['Lastname_input']);
               }
               else{$Lastname_error="error";}

              if(!empty($_POST['email_input'])){
                $email_var=check($_POST['email_input']);
              }
              else{$email_error=" ";}

              if(!empty($_POST['phone_input'])){
               $phone_var=check($_POST['phone_input']);
              }
              else{$phone_error=" ";}

              if(!empty($_POST['age_input'])){
                $age_var=check($_POST['age_input']);
              }
              else{$age_error=" ";}

              if(!empty($_POST['pass_input'])){
                if (!empty($_POST['repass_input']))
                {
                                  if($_POST['pass_input']==$_POST['repass_input'])
                                  {
                                     $hashpass_var=$_POST['pass_input'];
                                  }
                                  else
                                  {
                                    $similar_pass=" ";
                                  }


                }
                else 
                {
                    $repass_error=" ";
                }
              }
              else{$pass_error=" ";}
  
              if(!empty($_POST['gender_input'])){
                $gender_var=check($_POST['gender_input']);
              }
              else{$gender_error=" ";}
  


 
       if ( isset($Firstname_var) && isset($Lastname_var) &&  isset($email_var) &&  isset($age_var) && isset($phone_var) &&  isset($hashpass_var) && isset($gender_var) )
       {

        $in = $data->prepare("INSERT INTO `users`(`First Name`, `Last Name`, `Email`, `Age`, `Phone`, `Password`, `Gender`) VALUES( :fn, :ln, :e, :a, :ph, :pas, :g)");
 
        $in->execute(array(':fn' => $Firstname_var, ':ln' => $Lastname_var, ':e' => $email_var, ':a' => $age_var, ':ph' => $phone_var,':pas' => $hashpass_var, ':g' => $gender_var ));

        header("Location:login.php");
               
       }

       else 
       {
        $stat = " errror in vars" ;
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
        body{ background-image: url(22.jpg); background-size: cover}
        form{  position: absolute; left: 25%; top:10%; width:70%;  padding: 4% 6%; background-color: rgba(01,0,0,0.5); border-radius:5% ; width: 50%;color: #f5f5f5}
        form input{ height: 40px}
        span{text-align: center;color: red }
        form a:hover {color: white;text-decoration-line: none }

        /*Problem with margin bottom of form */
        
    </style>
</head>
    <body>
  <!--  <?php echo "<h3 style='color:red'> ".$dataStatus."</h3>" ;
    if (isset($status)) {echo " <h3 style='color:red'> ".$status."</h3>";} 
    if (isset($stat)) {echo " <h3 style='color:red'> ".$stat."</h3>";}?> -->
        
    <form action="" method="POST" class="mx-auto d-block signUp"  >
        <h1> <img src="222.png" class="mx-auto d-block " style="width: 10%;display:inline"> </h1> 
        <h1 style=" display:inline;" ><img src="medium.png" class="mx-auto d-block " style=" display:inline;width: 30%"> </h1>

            <div class="form-group">
            <label for="Name">Name</label> 
                <div class="row">
                    <input style= "width: 44% ; margin-right: 3%; margin-left:2%; display: block" class="form-control" id="Name" type="text" placeholder="First Name" name="Firstname_input" >
                    <input  style=" margin-left:3%; display:inline ;width: 44%" class="form-control" id="Name" type="text" placeholder="Last Name" name="Lastname_input" > 
                    <span>  <?php if(isset($Firstname_error)){ echo "Your First Name is REQUIRED"; } echo "<br>"; 
                                 if(isset($Lastname_error)){ echo "Your Last Name is REQUIRED"; }?> 
            </span>
                </div>
            </div>
             
            <div class="form-group"> 
                 <label for="Email">Email</label>
                <input class="form-control" id="Email" type="email" placeholder="Enter Your Email" name="email_input"> 
                <span> <?php if(isset($email_error)){ echo "Your Email is REQUIRED"; } 
            ?> </span>
            </div>

            <div class="form-group">
                 <label for="Age">Age</label>
                <input class="form-control" id="Age" type="number" placeholder="Enter Your Age" name="age_input" > 
            <span> <?php if(isset($age_error)){ echo "Your Age is REQUIRED"; } ?> </span>
            </div>
             
             
            <div class="form-group">
                 <label for="Phone">Phone Number</label>
                <input class="form-control" id="Phone" type="number" placeholder="Enter Your Phone Number" name="phone_input"> 
            <span> <?php if(isset($phone_error)){ echo "Phone Number is REQUIRED"; } 
                ?> </span>
            </div>
             
             <div class="form-group">
                 <label for="Password">Password</label>
                <input class="form-control" id="Password" type="password" placeholder="Enter Your Password" name="pass_input">  
            <span> <?php if(isset($pass_error)){ echo "Password is REQUIRED"; } 
                ?> </span>
            </div>
        
         <div class="form-group">
                 <label for="Password2">Re-Enter Your Password</label>
                <input class="form-control" id="Password" type="password" placeholder="Enter Password" name="repass_input">  
            <span> <?php if(isset($repass_error)){ echo "Re-Enter Your Password"; } 
                    if(isset($similar_pass)){ echo "The Entered Passwords Don't Match"; } ?> </span>
            </div>
             
            <div>
                <label >Gender</label>                  
                  <div class="row" >
                    <input class="p-2" type="radio"  name="gender_input" value="male" >  
                    <label  class="p-2" style="display: inline">Male</label>
                  </div>
                  <div class="row">
                       <input  class="p-2" type="radio"  name="gender_input"   value="female">
                       <label   class="p-2" style="display: inline "> Female </label>
                  </div>
            
            <span> <?php if(isset($_GET['gender_error'])){ echo "Your gender is REQUIRED"; } ?> </span>
            </div>
            
             <button style="padding: 10px 10% " type="submit" class="mx-auto d-block btn btn-primary btn-lg"> Sign Up </button> 
             <hr>
             <h5 class="text-center">Already have an account ? <a href="signIn.php" style="text-decoration: none;"> Sign In </a> </h5> 

        </form>
        
        
        <script src="bootstrap.min.js">
        </script>
        <script src="jquery-3.3.1.slim.min.map">
        </script>
        <script src="jquery-3.3.1.js"></script>
    </body>
</html>