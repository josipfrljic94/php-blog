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

    RedirectFun('index.php?page=1');
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
 <!-- start navbar -->
 <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->

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

<!-- footer -->
<?php 
require_once('Footer.php');
?>

<!--  -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
