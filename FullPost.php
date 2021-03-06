<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>
<?php $SearchQuerryParametar=$_GET["id"]; ?>


<?php 
 // START  PHP CODE OF COMMENT 

            
 if(isset($_POST['submit'])){
   
    $name=$_POST['name'];
    $Admin="Josip Frljic";
    $email=$_POST['email'];
    $textcomment=$_POST['textcomment'];
    date_default_timezone_set("Europe/Zagreb");
    $CurrentTime=time();
    $rightTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

    if(empty($name)||empty($email)||empty($textcomment)){
        $_SESSION["errormassage"]="All fields must be filled"; 
        RedirectFun("FullPost.php?id=$SearchQuerryParametar");
        
    }
    elseif (strlen($name)<3 || strlen($name)>55){
        $_SESSION["errormassage"]="Name is to short or to long"; 
        RedirectFun("FullPost.php?id=6");
        
    }
    elseif (strlen($name)<5 || strlen($name)>55){
        $_SESSION["errormassage"]="email is to short or to long"; 
        RedirectFun("FullPost.php?id=$SearchQuerryParametar");
       
    }
    elseif (strlen($textcomment)>99) {
        $_SESSION["errormassage"]="Name is to short or to long"; 
        RedirectFun("FullPost.php?id=$SearchQuerryParametar");
       
    }

    else{
        global $dbh;
        $sql="INSERT INTO comments (name,email,comment,datetime,approvedBy,status,post_id) VALUES(:name,:email,:comment,:datetime,'Pending','OFF',:postid)";
        
        $sth=$dbh->prepare($sql);
        $sth->bindValue(':datetime', $rightTime);  
        $sth->bindValue(':name', $name);  
        $sth->bindValue(':email', $email);  
        $sth->bindValue(':comment', $textcomment); 
        $sth->bindValue(':postid',$SearchQuerryParametar);  
        $CheckExecution=$sth->execute(); 
        if($CheckExecution){
            $_SESSION["succesmassage"]="Your comment is added";
        

            header("Location:FullPost.php?id={$SearchQuerryParametar}");
          
        }
        else{
            $_SESSION["errormassage"]="Sorry, but something go wrong";
        }
    }
}


// END PHP CODE OF COMMENT




?>


<!-- FETCHING DATA OF POST -->




<!-- END FETCHING DATA OF POST -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body class="bg-light">



    <!-- start navbar -->
<?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->
    
   
    <div class="container">
    <div class="row">
        <div class="col-lg-8 " >
        <?php 
             echo ErrorMas();
             echo SuccesMas();
?>
           
        <h1 class=" display-3 font-weight-bold">Welcome to Josip Frljic's Blog</h1>

        <?php 
                 global $dbh;
        $idget=$_GET['id'];
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
            if(!isset($idget)|| $idget==0){
                $_SESSION["errormassage"]="Wrong request";
                RedirectFun("Blog.php");
            }
          
            $sql="SELECT * FROM post WHERE id=$idget";
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
                    <div class="col-lg-4 ml-auto "><span class="badge badge-dark text-light badge-block w-100  text-center">
                    
                   <!-- FETCHING COMMENTS -->
                   <?php 
                        global $dbh;
                             $sql="SELECT COUNT(*) FROM comments";
                             $sth=$dbh->query($sql);
                             $Totalrow=$sth->fetch();
                             $TotalPost= array_shift($Totalrow);

                             if($TotalPost){
                                echo "Comments: ". $TotalPost;
                             }
                            else{
                                echo "-";
                            }
                        
                        ?>
                      <!-- end fetching -->
                    
                    </span></div>
                    </div>
                </div>
                <div class="card-body p-0">
                   
                <img src="Upload/<?php echo $image ?>" alt="<?php echo $image ?>" class="w-100  " style="max-height:450px;">
                    <p class="text-center"><?php
                  
                    echo $post ?> </p>
                  
                   
            </div>
            </div>
                

                <div class="card">
                <h1 class="text-warning">
                    Comments
                </h1>
              
            <?php 
            $sql="SELECT * FROM comments WHERE post_id= '$SearchQuerryParametar' AND status='ON' ORDER BY id desc";
            $stmt=$dbh->query($sql);
            while($row2 = $stmt->fetch()){
                $ComentaryName= $row2['name'];
                $Comentarydate= $row2['datetime'];
               $Comment=$row2['comment'] 
                ?>
                <div class="media ml-2">
                    <div class="media-body">
                        <h6 class="blockquote "><?php echo $ComentaryName ?></h6>
                        <p class="text-muted display-6"><?php echo $Comentarydate ?></p>
                        <p><?php echo $Comment ?></p>
                    </div>
                </div>
            <?php } ?>
           
              

                <!-- END FETCHING COMMENTS -->
                <form  action="FullPost.php?id= <?php echo $SearchQuerryParametar ?>" method="post">
               
                <div class="form-group">
                <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Name</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="name" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Email</div>
                        </div>
                        <input type="email" required class="form-control" id="email" name="email" placeholder="email" >
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="textcomment" id="textcomment" class="w-100" rows="6"></textarea>
                </div>
                <div>
                    <button class="btn btn-primary m-1" type="submit" name="submit">Submit</button>
                </div>
</form>

                </div>

    </div>
        <div class="col-lg-4 bg-primary" style="height:50px;">

        </div>
        <?php } ?>
    </div>
</div>
<!-- end header -->
<!--  -->
<!-- footer -->
<?php 
require_once('Footer.php');
?>

<!--  -->



    
</body>
</html>