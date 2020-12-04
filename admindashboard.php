<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Add Admin</title>
    </head>

    <!-- includes -->
    <?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>


<!-- end includes -->


    <!-- tracking url -->
    <?php $_SESSION['TrackingUrl']=$_SERVER['PHP_SELF']; ?>
<?php protectedLogin() ?>

<!-- end  tracking -->


    <!-- logic add admin -->

    <?php 
    if(isset($_POST['submit'])){

        //*TIME
        $today = date("F j, Y, H:i:s");
        $CurrentTime=  strftime($today);
       
        // TIME
        $Admin= $_SESSION['Username'];
         $Username=$_POST['username'];
         $AName=$_POST['aname'];
         $password=$_POST['password'];
         $cpassword=$_POST['cpassword'];
       
       
       if(strlen($Username)<3){
         $_SESSION["errormassage"] = "Username must be longer than 3";
       //  RedirectFun('Blog.php');
       }
       elseif(strlen($AName)<3){
         $_SESSION["errormassage"] = "Name must be longer than 3";
       }
       elseif(strlen($password)<3){
         $_SESSION["errormassage"] = "Password must be longer than 5 characterd";
       }
       elseif(strcmp($password,$cpassword)!==0 || strcmp( $password,$cpassword)===NULL){
           $_SESSION["errormassage"] = "Password is not same";    
       
       }
       elseif (CheckUserExist($Username)) {
           $_SESSION["errormassage"] = "User aleready exist";
           RedirectFun("Admin.php");
       }
       else{
           global $dbh;
         $sql="INSERT INTO admins(datetime,username,aname,password,addedby)";
         $sql.="VALUES (:datetime,:username,:aname,:password,:addedby)";
         $sth= $dbh->prepare($sql);
         $sth->bindValue(":datetime",$CurrentTime);
         $sth->bindValue(":username",$Username);
         $sth->bindValue(":aname",$AName);
         $sth->bindValue(":password",$password);
         $sth->bindValue(":addedby",$Admin);
         $Execute=$sth->execute();
       
         if($Execute){
           $_SESSION["succesmassage"]="You upload the new topic";
           // header("Location: some.html");
         }else{
           $_SESSION["errormassage"]="Something went wrong";   
           header("Location: Blog.php");
         }
         
       }
       
       }
    
    
    
    
    
    ?>



    <!-- ****END ADD ADMIN LOGIC -->


  
    <?php require_once('include/connection.php'); ?>
    <?php require_once('include/function.php'); ?>
    <?php require_once('include/session.php'); ?>
    <?php protectedLogin() ?>
<body>

  <!-- start navbar -->
  <?php require_once('include/Navbar.php'); ?>
    <!-- END OF NAVBAR -->

<header>
    <div class="container bg-warning">
        <div class="row">
            <div class="col col-lg-12">
                <h1 class="text-center text-white display-4">Add Admin</h1>
            </div>
        </div>
    </div>
</header>


<!-- session -->


<?php 
echo ErrorMas();
echo SuccesMas();
?>

<!-- end session -->

    <div class="container bg-dark py-5">
        <div class="row">
            <div class="col-lg-12">
            <form class="col-lg-8 offset-2 "  action="admindashboard.php" method="POST">

<div class="form-group ">
    <label for="username" class="font-weight-bold text-light" >Username</label>
    <input type="text" class="form-control " id="username" name="username">
</div>

<div class="form-group">
    <label for="aname" class="font-weight-bold text-light" >Name</label>
    <input type="text" class="form-control " id="aname" name="aname">
</div>

<div class="form-group ">
    <label for="password" class="font-weight-bold text-light" >Password</label>
    <input type="password" class="form-control " id="password" name="password">
</div>

<div class="form-group ">
    <label for="cpassword" class="font-weight-bold text-light" >Confirm Password</label>
    <input type="password" class="form-control " id="cpassword" name="cpassword">
</div>



<div class="row">
<div class="col-lg-6">
<a href="Dashboard.php" class="btn btn-secondary btn-block mb-2 ">Back to Dashbord</a>
</div>
<div class="col-lg-6">
<button type="submit" name="submit" class="btn btn-warning btn-block">Add Admin</button>
</div>
</div>
</forum>  
            </div>
        </div>
    </div>

<!-- end input  -->


<!-- admin deleting -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <table class="table table-striped table-dark ">
                   <thead class="thead-light">
                    <tr>
                    <th>#</th>
                       
                        <th>Date and Time</th>
                        <th>Username</th>
                        <th>Name</th>
                       <th>Added By</th>
                       <th>Action</th>
                       
                    </tr>
                    </thead>
                <?php 
               $rb=1;
                    global $dbh;
                    $sql="SELECT * FROM admins" ;
                    $stmt=$dbh->query($sql);
                    while($row = $stmt->fetch()){
                            $Id= $row['id'];
                            $datetime=$row['datetime'];
                            $username=$row['username'];
                            $aname= $row['aname'];
                            $addedby=$row['addedby'];
                           
                         
                ?>
                        <thead>
                        <tr>
                            <td><?php  echo $rb++ ?></td>
                    
                            
                            
                           

                            <td>
                                
                            <?php 
                                if(strlen($datetime)>15){
                                    $datetime= substr($datetime,0,15);
                                }
                            echo $datetime ?></td>

                           
                           
                          <td><?php echo $username?></td>

                          <td><?php echo $aname ?></td>
                                
                          <td><?php echo $addedby ?></td>

                            <td>  <a href="DeleteAdmin.php?id=<?php echo $Id ?>" class="btn btn-danger">Delete</a> </td>
                          
                          
                          
                           
                        </tr>
                        </tbody>
                    <?php } ?>
                   
                  
              

               </table>
        </div>
    </div>
</div>

<!-- end admin deleting -->



</body>
</html>