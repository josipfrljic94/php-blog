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

            <a href="index.php" class="btn btn-info round-0 shadow btn-block">Add New Category</a>
       </div>
            <div class="col-lg-3 mb-2">

                <a href="admin.php" class="btn btn-warning round-0 btn-block">Add New Admin</a>
        </div>
        <div class="col-lg-3 mb-2">

            <a href="addNewPost.php" class="btn btn-success round-0 btn-block">Approved Comments</a>
        </div>
        </div>
    </div>
</header>
<!-- end header -->
<!--  -->

<!-- MAIN AREA -->

<div class="container py-2 mb-4">
        <div class="row">
        <?php 
echo ErrorMas();
echo SuccesMas();
?>
           <div class="col-lg-12 col-sm-12">
               <table class="table table-striped table-dark ">
                   <thead class="thead-light">
                    <tr>
                    <th>#</th>
                        <th>Author</th>
                        <th>Date and Time</th>
                        <th>Comments</th>
                        <th>Approved</th>
                        <th>Remove</th>
                        <th>Details</th>
                       
                    </tr>
                    </thead>
                <?php 
               $rb=1;
                    global $dbh;
                    $sql="SELECT * FROM comments ORDER BY id desc" ;
                    $stmt=$dbh->query($sql);
                    while($row = $stmt->fetch()){
                            $Id= $row['id'];
                            $author=$row['name'];
                            $datetime= $row['datetime'];
                           $postId=$row['post_id'];
                            $comment=$row['comment'];
                            $status=$row['status'];
                         
                ?>
                        <thead>
                        <tr>
                            <td><?php  echo $rb++ ?></td>
                    
                            
                            
                            <td><?php  
                                if(strlen($author)>10){
                                    $author=substr($author,0,10)."...";
                                }

                                
                            echo $author ?></td>
                         

                            <td>
                                
                            <?php 
                                if(strlen($datetime)>5){
                                    $datetime= substr($datetime,0,8);
                                }
                            echo $datetime ?></td>

                            <td>
                                
                                <?php 
                                    // if(strlen($comment)>5){
                                    //     $comment= substr($comment,0,15);
                                    // }
                                echo $comment ?></td>

                           
                          
                           <?php if($status=="OFF"): ?>
                            <td>
                                <a href="ApproveComment.php?id=<?php echo $Id ?>" class="btn btn-info">Approved</a>     
                            </td>
                            <?php else :?>
                                <td>
                                <a href="DisapproveComment.php?id=<?php echo $Id ?>" class="btn btn-warning">Disapproved</a>     
                            </td>
                                <?php endif ?>


                            <td>  <a href="DeleteComment.php?id=<?php echo $Id ?>" class="btn btn-danger">Delete</a> </td>
                            <td><a href="FullPost.php?id=<?php echo $postId ?>"><span class="btn btn-primary ">Live preview</span></a></td>
                          
                          
                           
                        </tr>
                        </tbody>
                    <?php } ?>
                   
                  
              

               </table>
           </div>
        </div>
</div>
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