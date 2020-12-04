<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>
<?php 

    if(isset( $_SESSION['ADMIN_ID'])){
        RedirectFun('Dashboard.php');
    }
?>
<?php 
    if(isset($_POST['submit'])) {

        $Username=$_POST['username'];
        $password=$_POST['password'];
        
        if(empty($Username) || empty($password)){
            $_SESSION["errormassage"] = "All places must be filled";
        }
        else{
           $FindedUser=findUser($Username,$password);
           if($FindedUser){

            $_SESSION['ADMIN_ID']=$FindedUser['id'];
            $_SESSION['Username']=$FindedUser['username'];
            $_SESSION['aname']=$FindedUser['aname'];
            $_SESSION["succesmassage"]="Welcome ".$_SESSION['aname'];

          TrackingUrl();
           }else{
            $_SESSION["errormassage"] = "User doesn't exist";
               RedirectFun("Login.php");
           }
            // echo $Username ."and".$password;
        }
    }
?>

    <body>
   <!-- start navbar -->
   <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->
<header>
    <div class="container ">
        <div class="row p-5">
           <div class="col-lg-3 mb-2">

               
           </div>
         
        
        </div>
    </div>
</header>
<!-- end header -->

<!-- main -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
<div class="card border-0 rounded-0 shadow mb-3 " >
  <div class="card-body">
   <?php 
echo ErrorMas();
echo SuccesMas();
?>
    <!-- start form -->

    <form action="Login.php" method="POST">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="username" class="form-control" id="username"  name="username" placeholder="Username">
    <small id="text" class="form-text text-muted">Input your username</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

    <!-- end form -->



  </div>
</div>
</div>
</div>
</div>

<!-- end main -->

<footer>
    <div class="container-fluid">
        <div class="row  bg-secondary ">
            <div class=" col col-md-4 col-sm-10 text-white  m-0 p-0">
                <ul class="text-center  w-100 text-white m-0 p-0" style="list-style:none;">
                <li ><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class=" col col-md-4 col-sm-10 text-white  p-0 m-0  ">
            <ul class="text-center text-white w-100 m-0 p-0" style="list-style:none;">
                <li><a href="#">Policy</a></li>
                <li><a href="#">Sponsors</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            </div>
            <div class="col col-md-4 col-sm-10 text-white m-0 p-0  ">
                <ul class="text-center text-white w-100 m-0 p-0" style="list-style:none;">
                <li><a href="#">fa</a></li>
                <li><a href="#">fa</a></li>
                <li><a href="#">fa</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center"> All rights reserved</div>
    </div>
</footer>



    
</body>
</html>