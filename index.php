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
           
                //  search button

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
       
// end search button


// start category
if(isset($_GET["category"])){
    $category= $_GET['category'];
    $sql="SELECT * FROM post WHERE category=:category";
       
    $stmt= $dbh->prepare($sql);
    $stmt->bindValue(':category',$category);
    $stmt->execute();
    
}

// end category

// pagination logic
if(isset($_GET['page'])){

    $numberpage=$_GET['page'];

   
    if($numberpage==0){
        $showpostfrom=1;
    }
    elseif($numberpage<0){
        $numberpage=$numberpage*-1;
        $showpostfrom=($numberpage*4)-4;
    }
    else{
        $showpostfrom=($numberpage*4)-4;
    }
  
    $sql="SELECT * FROM post  ORDER BY id desc LIMIT $showpostfrom,4";
    $stmt=$dbh->query($sql);
}

// end pagintion  logic

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
                    <div class="col-lg-4 ml-auto ">
                    <span class="badge badge-dark text-light badge-block w-100  text-center">
                      <!-- FETCHING COMMENTS -->
                   <?php 
                        global $dbh;
                             $sql="SELECT COUNT(*) FROM comments WHERE post_id=$Id";
                             $sth=$dbh->query($sql);
                             $Totalrow=$sth->fetch();
                             $TotalPost= array_shift($Totalrow);

                             if($TotalPost){
                                echo "Comments: ". $TotalPost;
                             }
                            else{
                                echo "No comments";
                            }
                        
                        ?>
                      <!-- end fetching -->

                    </span></div>
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


                 <!-- pagination -->
             <?php  if(isset($_GET['page'])): ?>
            <nav>
                 <ul class="pagination pagination-lg">


                 <?php if($_GET['page']>1): ?>
                       <!-- previous -->
                       <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $_GET['page']-1 ?>">Previous</a></li>
                       <?php endif; ?>
                    
                        <!-- previous -->
                 <?php 
    	              

                             $sql="SELECT COUNT(*) FROM post";
                             $sth=$dbh->query($sql);
                             $Totalrow=$sth->fetch();
                             $TotalPost= array_shift($Totalrow);
                                $numpage= $TotalPost/4;
                                $numpage=ceil($numpage);
                             if($TotalPost){
                                for($i=1;$numpage>=$i;$i++){

                                if($i==$_GET['page']): 

                                    ?>

                                  <li class="page-item active disabled" >
                                    <a class="page-link"  href="index.php?page=<?php echo $i ?>">
                                    <?php echo $i ?>
                                    </a>
                                    </li>
                                <?php else: ?>
                               
                                  <li class="page-item" >
                                  <a class="page-link"  href="index.php?page=<?php echo $i ?>">
                                  <?php echo $i ?>
                                  </a>
                                  </li>
                            <?php  
                            endif;
                                }
                             }
                                else{
                                echo "No comments";
                            }
                        
                        ?>
                        <?php if($_GET['page']<$numpage): ?>
                       
                        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $_GET['page']+1 ?>">Next</a></li>
                        <?php 
                        endif; 
                  
                        ?>
                </ul>
            </nav>
                    <?php endif; ?>
                 <!-- pagination -->

    </div>






    <!-- SIDE AREA-->


    <!-- ************ -->

    
        <div class="col-lg-4  p-0" style="min-height:120vh;">

        <div class="card bg-dark text-white rounded-0" style="min-height:350px;">

  <img class="card-img" src="images/sideimg.jpg" alt="simg">
  <div class="card-img-overlay  text-center mt-5">
    <h3 class=" font-weigh-bold ">Lorem, ipsum.</h3>
    <a href="Dashboard.php" class="btn btn-warning  rounded-0">Add new things</a>
  </div>
  <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eos, officiis delectus debitis impedit consequuntur.</p>
  </div>
</div>

<div class="card text-white  mt-3   p-0 rounded-0  " >
  <div class="card-header bg-dark text-white rounded-0">
  <h5>Sign up</h5>
  </div>
  <div class="card-body bg-light text-dark">
   <a href="Dashboard.php"  class="btn btn-success btn-block rounded-0">Join</a>
   <a href="Admin.php" class="btn btn-primary btn-block rounded-0">Register</a>
  </div>
</div>
  <div class="card mt-3 p-0 rounded-0">
  <h5 class="card-header text-white rounded-0 bg-dark">Categories</h5>
  <div class="card-body">
  <ul class="list-group list-group-flush">
  <?php 
             
                    global $dbh;
                    $sql="SELECT * FROM category" ;
                    $stmt=$dbh->query($sql);
                    while($row = $stmt->fetch()){
                            $Id= $row['id'];
                           
                            $datetime= $row['datetime'];
                            $title=$row['title'];
                          
                            ?>
                            
                            <li class="list-group-item"> <a href="index.php?category=<?php echo $title ?>"><?php echo $title ?></a></li>
                           
                      
                    <?php } ?>
      </ul>
            
            </div>
            </div>


            <ul class="list-unstyled mt-3">
            <?php 
                 
                 $sql="SELECT * FROM post ORDER BY id desc LIMIT 0,5";
               $sth= $dbh->query($sql);
               foreach($sth as $newpost){
                   $title=$newpost['title'];
                   $img= $newpost['image'];
                    $post=$newpost['post'];
                    
            ?>

            <!-- list -->
            <li class="media mb-2  bg-dark">
                   <img class="mr-3" height="90" width="100"  src="Upload/<?php echo $img ?>" alt="<?php $img ?>">
                   <div class="media-body text-light">
                     <h5 class="mt-0 mb-1"><?php echo $title ?></h5>
                    <?php 
                    if(strlen($post)>25){
                        $post= substr($post,0,25);

                    }?>
                    <?php echo "<p>".$post."...</p>" ?>

                   </div>
                 </li>

            <!-- end list -->

               <?php } ?>
            
            </ul>



        </div>
        <!-- end side area -->


    </div>
    <!-- end row -->
</div>

<!-- footer -->
<?php 
require_once('Footer.php');
?>

<!--  -->


    
</body>
</html>