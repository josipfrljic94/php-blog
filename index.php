<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>
<?php 
$today = date("F j, Y, H:i:s");
$CurrentTime=  strftime($today);
echo $CurrentTime;

?>

<?php 

if(isset($_POST['submit'])){
  $Category= $_POST['categorytitle'];
  $Admin="Josip Frljic";
if(empty($Category)){
  $_SESSION["errormassage"] = "All fields must be filled";
 RedirectFun('index.php');
}
elseif(strlen($Category)<2){
  $_SESSION["errormassage"] = "Title must have at least three characters";
}
elseif(strlen($Category)>54){
  $_SESSION["errormassage"] = "Title can have max 54 characters";
}
else{
  $sql="INSERT INTO category(title,author,datetime)";
  $sql.="VALUES (:categoryName,:adminName,:dateTime)";
  $sth= $dbh->prepare($sql);
  $sth->bindValue(":categoryName",$Category);
  $sth->bindValue(":adminName",$Admin);
  $sth->bindValue(":dateTime",$CurrentTime);
  $Execute=$sth->execute();

  if($Execute){
    $_SESSION["succesmassage"]="You upload the new topic";
    // header("Location: some.html");
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
    header("Location: index.php");
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="Blog.php">Blog <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Posts.php">Posts</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link " href="addNewPost.php" tabindex="-1" >Add New Post</a>
          </li>
        </ul>
   
   <ul class="ml-auto navbar-nav ">
   <li class="nav-item">
        <a class="nav-link " href="#" tabindex="-1" >Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#" tabindex="-1" >Log out</a>
      </li>
      </div>
   </ul>
 

</nav>
<!-- <div class="footer"> -->

<!-- END OF NAVBAR -->
<header>
    <div class="container bg-dark">
        <div class="row">
            <div class="col col-lg-12">
                <h1 class="text-center text-white display-4">Menage Categories</h1>
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
            <form  action="index.php" method="POST">
    <div class="form-group p-3">
        <label for="categorytitle" class="font-weight-bold text-light" >Input New Category</label>
        <input type="text" class="form-control " id="categorytitle" name="categorytitle">
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
