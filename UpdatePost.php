<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>

<?php 
$getId= $_GET["id"];
if(isset($_POST['submit'])){
    $title= $_POST['title'];
  $Category= $_POST['categorytitle'];

$author= $_POST["author"];
  $image= $_FILES['image']['name'];
  $target= "Upload/".basename( $_FILES['image']['name']);
  $post= $_POST['post'];
  $today = date("F j, Y, H:i:s");
$CurrentTime=  strftime($today);
if(empty($title)){
  $_SESSION["errormassage"] = "All fields must be filled";
  RedirectFun('Dashboard.php');
}
elseif(strlen($title)<2 ){
  $_SESSION["errormassage"] = "Title must have at least three characters";
  RedirectFun('Dashboard.php');
}
elseif(strlen($title)>54 || strlen($post)>999){
  $_SESSION["errormassage"] = "Title can have max 54 characters";
  RedirectFun('Dashboard.php');
}
else{
  $sql="UPDATE  post SET title='$title',category='$Category', author='$author',image='$image', post='$post' 
  WHERE id='$getId' ";

  $sth= $dbh->prepare($sql);
  $Execute=$sth->execute();
    move_uploaded_file( $_FILES['image']['tmp_name'],$target);
  if($Execute){
    $_SESSION["succesmassage"]="You upload the new topic";

    RedirectFun('Blog.php');
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
    RedirectFun('Dashboard.php');
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


<!-- END OF NAVBAR -->
<header>
    <div class="container bg-dark">
        <div class="row">
            <div class="col col-lg-12">
                <h1 class="text-center text-white display-4">Edit Post</h1>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<?php 
echo ErrorMas();
echo SuccesMas();
?>
<?php 
// $getId= $_GET["id"];
$sql= "SELECT *  FROM post WHERE id= $getId";
$stmt=$dbh->query($sql);

while($row= $stmt->fetch()){
    $id=$row['id'];
    $title=$row['title'];
    $author=$row["author"];
    $category=$row['category'];
    $image=$row['image'];
    $post=$row['post'];
   
}
?>

<section class="container py-2 mb-4">
    <div class="row" style="min-height:50px">
        <div class="col-lg-8 offset-lg-2  bg-secondary" style="min-height:50px">
 <form  action="UpdatePost.php?id=<?php echo $getId ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group ">
        <label for="title" class="font-weight-bold text-light" >Title</label>
        <input type="text" class="form-control " value="<?php echo $title  ?>" id="title" name="title">
    </div>
    <div class="form-group ">
        <label for="categorytitle" class="font-weight-bold text-light" >Category</label>
        <select type="text" class="form-control " id="categorytitle"   name="categorytitle">
        <?php 
        global $dbh;
            $sql="SELECT id,title FROM category";
            $stmt=$dbh->query($sql);
            while($row = $stmt->fetch()){
               
                $id=$row["id"];
                $categorytitle=$row["title"];

        ?>
        <?php if($categorytitle==$category) : ?>
        <option selected ><?php echo $categorytitle ?></option>
        <?php endif ?>
                <option><?php echo $categorytitle ?></option>
          <?php } ?>  
       
      
        </select>
        <?php 
echo ErrorMas();
echo SuccesMas();
?>
      
    </div>
    <div class="form-group ">
        <label for="author" class="font-weight-bold text-light" >Author</label>
        <input type="text" class="form-control " id="author" value="<?php echo $author  ?>" name="author">
    </div>
    <div class="form-group  mt-5">
    <div class="custom-file">
    
    <input type="file" class=" custom-file-input " id="imageSelect" name="image" value="<?php echo $image?>">
    <label class="custom-file-label" for="imageSelect" >Input image</label>
    </div>
  </div>
    <div class="form-group">
    <label for="post" class="font-weight-bold text-light">Post</label>
    <textarea class="form-control" id="post" name="post" value="" rows="4"><?php echo $post ?></textarea>
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
