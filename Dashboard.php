<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
    <?php require_once('include/connection.php'); ?>
    <?php require_once('include/function.php'); ?>
    <?php require_once('include/session.php'); ?>
    <?php protectedLogin() ?>


  <!-- start navbar -->
   <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->
<header>
    <div class="container ">
        <div class="row p-5">
           <div class="col-lg-3 mb-2">

                <a href="addNewPost.php" class="btn btn-primary round-0 shadow btn-block">Add New Post</a>
           </div>
           <div class="col-lg-3 mb-2">

            <a href="Categories.php" class="btn btn-info round-0 shadow btn-block">Add New Category</a>
       </div>
            <div class="col-lg-3 mb-2">

                <a href="admindashboard.php" class="btn btn-warning round-0 btn-block">Add New Admin</a>
        </div>
        <div class="col-lg-3 mb-2">

            <a href="Comments.php" class="btn btn-success round-0 btn-block">Approved Comments</a>
        </div>
        </div>
    </div>
</header>
<!-- end header -->
<!--  -->
<?php 
echo ErrorMas();
echo SuccesMas();
?>
<!-- MAIN AREA -->

<div class="container py-2 mb-4">
        <div class="row">
           <div class="col-lg-12 col-sm-12">
               <table class="table table-striped table-dark ">
                   <thead class="thead-light">
                    <tr>
                    <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date and Time</th>
                        <th>Author</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Actions</th>
                        <th>Live Preview</th>
                    </tr>
                    </thead>
                <?php 
               $rb=1;
                    global $dbh;
                    $sql="SELECT * FROM post";
                    $stmt=$dbh->query($sql);
                    while($row = $stmt->fetch()){
                            $Id= $row['id'];
                            $datetime= $row['datetime'];
                            $title=$row['title'];
                            $author=$row['author'];
                            $category=$row['category'];
                            $author= $row['author'];
                            $image= $row['image'];
                            $post = $row['post'];
                            //  $rb++ ;
                ?>
                        <thead>
                        <tr>
                            <td><?php  echo $rb++ ?></td>
                    
                            
                            
                            <td><?php  
                                if(strlen($title)>10){
                                    $title=substr($title,0,10)."...";
                                }

                                
                            echo $title ?></td>
                            <td>
                                
                            <?php 
                               if(strlen($category)>10){
                                    $category= substr($category,0,8)."...";
                                }
                            echo $category ?></td>
                            <td>
                                
                            <?php 
                                if(strlen($datetime)>5){
                                    $datetime= substr($datetime,0,15);
                                }
                            echo $datetime ?></td>
                            <td><?php  echo $author ?></td>
                            <td> <img  style="width:100px; height:50px;" src="Upload/<?php  echo  $image ?>" alt="<?php  echo  $image ?>"></td>
                            <td><?php echo "comments" ?></td>
                            <td>
                                <a href="UpdatePost.php?id=<?php echo $Id ?>" class="btn btn-warning">Edit</a>  
                                <a href="DeletePost.php?id=<?php echo $Id ?>" class="btn btn-danger">Delete</a> 
                            </td>
                            <td><a href="FullPost.php?id=<?php echo $Id ?>"><span class="btn btn-primary ">Live preview</span></a></td>
                          
                          
                           
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

    
</body>
</html>