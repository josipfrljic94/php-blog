<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>

<?php protectedLogin() ?>
<?php 
$today = date("F j, Y, H:i:s");
$CurrentTime=  strftime($today);


?>

<?php 

if(isset($_POST['submit'])){
  $Category= $_POST['categorytitle'];
  $Admin=$_SESSION['Username'];
if(empty($Category)){
  $_SESSION["errormassage"] = "All fields must be filled";
 RedirectFun('Categories.php');
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
    RedirectFun('Categories.php');
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
    RedirectFun('Categories.php');
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
            <form  action="Categories.php" method="POST">
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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <table class="table table-striped table-dark ">
                   <thead class="thead-light">
                    <tr>
                    <th>#</th>
                        <th>Author</th>
                        <th>Date and Time</th>
                        <th>Title</th>
                       <th>Action</th>
                       
                       
                    </tr>
                    </thead>
                <?php 
               $rb=1;
                    global $dbh;
                    $sql="SELECT * FROM category ORDER BY id desc" ;
                    $stmt=$dbh->query($sql);
                    while($row = $stmt->fetch()){
                            $Id= $row['id'];
                            $author=$row['author'];
                            $datetime= $row['datetime'];
                            $title=$row['title'];
                           
                         
                ?>
                        <thead>
                        <tr>
                            <td><?php  echo $rb++ ?></td>
                    
                            
                            
                            <td><?php  
                            
                            echo $author ?></td>
                         

                            <td>
                                
                            <?php 
                                if(strlen($datetime)>5){
                                    $datetime= substr($datetime,0,15);
                                }
                            echo $datetime ?></td>

                           
                           
                          <td><?php echo $title ?></td>
                    

                            <td>  <a href="DeleteCategory.php?id=<?php echo $Id ?>" class="btn btn-danger">Delete</a> </td>
                          
                          
                          
                           
                        </tr>
                        </tbody>
                    <?php } ?>
                   
                  
              

               </table>
        </div>
    </div>
</div>


<!-- footer -->
<?php 
require_once('Footer.php');
?>

<!--  -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
