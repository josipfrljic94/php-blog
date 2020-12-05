<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>


<?php 

if(isset($_POST['submit'])){
  // time
  $today = date("F j, Y, H:i:s");
  $CurrentTime=  strftime($today);
  

  // end time
 $Admin=$_SESSION['Username'];
  $Username=$_POST['username'];
  $AName=$_POST['aname'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];


if(strlen($Username)<3){
  $_SESSION["errormassage"] = "Username must be longer than 3";
//  RedirectFun('Blog.php');
}
elseif(strlen($AName)<3){
  $_SESSION["errormassage"] = "Name must be longer than 3";
}
elseif(strlen($password)<3){
  $_SESSION["errormassage"] = "Password must be longer than 5 characterd";
}
elseif(strcmp($password,$cpassword)!==0 || strcmp( $password,$cpassword)===NULL){
    $_SESSION["errormassage"] = "Password is not same";    

}
elseif (CheckUserExist($Username)) {
    $_SESSION["errormassage"] = "User aleready exist";
    RedirectFun("Admin.php");
}
else{
  $sql="INSERT INTO admins(datetime,username,aname,password,addedby)";
  $sql.="VALUES (:datetime,:username,:aname,:password,:addedby)";
  $sth= $dbh->prepare($sql);
  $sth->bindValue(":datetime",$CurrentTime);
  $sth->bindValue(":username",$Username);
  $sth->bindValue(":aname",$AName);
  $sth->bindValue(":password",$password);
  $sth->bindValue(":addedby",$Admin);
  $Execute=$sth->execute();

  if($Execute){
    $_SESSION["succesmassage"]="You upload the new topic";
    // header("Location: some.html");
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
    header("Location: Blog.php");
  }
  
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <!-- start navbar -->
  <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->


<!-- END OF NAVBAR -->
<header>
    <div class="container bg-dark">
        <div class="row">
            <div class="col col-lg-12">
                <h1 class="text-center text-white display-4">Register</h1>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<?php 
echo ErrorMas();
echo SuccesMas();
?>

<section class="container py-2 mb-4">
    <div class="row" style="min-height:50px">

        <div class="col-lg-8 offset-lg-2  bg-secondary" style="min-height:50px">
            <form  action="Admin.php" method="POST">

    <div class="form-group ">
        <label for="username" class="font-weight-bold text-light" >Username</label>
        <input type="text" class="form-control " id="username" name="username">
    </div>

    <div class="form-group">
        <label for="aname" class="font-weight-bold text-light" >Name</label>
        <input type="text" class="form-control " id="aname" name="aname">
    </div>

    <div class="form-group ">
        <label for="password" class="font-weight-bold text-light" >Password</label>
        <input type="password" class="form-control " id="password" name="password">
    </div>

    <div class="form-group ">
        <label for="cpassword" class="font-weight-bold text-light" >Confirm Password</label>
        <input type="password" class="form-control " id="cpassword" name="cpassword">
    </div>



    <div class="row">
    <div class="col-lg-6">
    <a href="Dashbord.php" class="btn btn-dark btn-block mb-2 ">Back to Dashbord</a>
    </div>
    <div class="col-lg-6">
    <button type="submit" name="submit" class="btn btn-warning btn-block">Published</button>
    </div>
    </div>
    </forum>  
        </div>
    </div>
</section>



<!-- footer -->
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
