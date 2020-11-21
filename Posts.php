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
   
    
    </nav>
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
                            <td> <img class=" " style="width:100px; height:50px;" src="Upload/<?php  echo  $image ?>" alt="<?php  echo  $image ?>"></td>
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