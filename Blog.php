<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body class="bg-light">
    <?php require_once('include/connection.php'); ?>

    
    <!-- start navbar -->
    <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->

    <div class="container">
    <div class="row">
        <div class="col-lg-8 " >
           
        <h1 class=" display-3 font-weight-bold">Welcome to Josip Frljic's Blog</h1>
        <?php 
                 global $dbh;
                
        if(isset($_GET["searchbtn"])){
            $search= $_GET['search'];
            $sql="SELECT * FROM post WHERE
            title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt= $dbh->prepare($sql);
            $stmt->bindValue(':search',"%".$search."%");
            $stmt->execute();
            
        }
        else{
            $sql="SELECT * FROM post ORDER BY id desc";
            $stmt=$dbh->query($sql);
        }
               
                 while($row = $stmt->fetch()){
                         $Id= $row['id'];
                         $datetime= $row['datetime'];
                         $title=$row['title'];
                         $author=$row['author'];
                         $category=$row['category'];
                         $author= $row['author'];
                         $image= $row['image'];
                         $post = $row['post'];
                    
        ?>
            <div class="card my-2 shadow">
                <div class="card-head border-2">
                    <h1><?php echo $title; ?></h1>
                   
                    <div class="row mx-auto m-0 my-1 p-0">
                      <div class="col-lg-4  text-center "><?php echo $datetime;?></div>
                      <div class="col-lg-4  text-center text-muted">Written by : <?php echo  $author; ?></div>
                    <div class="col-lg-4 ml-auto "><span class="badge badge-dark text-light badge-block w-100  text-center"><?php echo "comments:5" ;?></span></div>
                    </div>
                </div>
                <div class="card-body p-0">
                   
                <img src="Upload/<?php echo $image ?>" alt="<?php echo $image ?>" class="w-100  " style="max-height:450px;">
                    <p class="text-center"><?php
                    if(strlen($post)>80){
                        $post= substr($post,1,79)."...";
                    }
                    echo $post ?> </p>
                    <a href="FullPost.php?id=<?php echo $Id; ?>" class="btn btn-primary btn-block col-lg-4 ml-auto mr-1 my-2 ">Read More</a>
                   
            </div>
            </div>
                 <?php } ?>

    </div>
        <div class="col-lg-4 bg-primary" style="height:50px;">

        </div>
    </div>
</div>
<!-- end header -->
<!--  -->
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