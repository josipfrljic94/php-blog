<?php require_once('include/connection.php'); ?>
<?php 
function RedirectFun($location) {
    header('Location:' .$location);
    exit;
  }

  function CheckUserExist($Username){
    global $dbh;
    $sql="SELECT username FROM admins WHERE username=:userName";
    $sth=$dbh->prepare($sql);
    $sth->bindValue(":userName",$Username);
    $sth->execute();
    $Result= $sth->rowcount();

    if($Result>=1){
      return true;
    }
    else{
      return false;
    }
  }
function findUser($Username,$password){

  global $dbh;
  $sql="SELECT * FROM admins WHERE username=:userName AND password=:passWord";
  $sth=$dbh->prepare($sql);
  $sth->bindValue(":userName",$Username);
  $sth->bindValue(":passWord",$password);
  $sth->execute();
  $Result= $sth->rowcount();
  if($Result==1){
   return $Finded_Admin=$sth->fetch();
  
  
  }
    else{
      return null;

    }
 
  }
function protectedLogin(){
 if (isset($_SESSION['ADMIN_ID'])) {
  return true;
 } else {
  $_SESSION["errormassage"] = "Login required";
  RedirectFun('Login.php');
 }
 
}

function TrackingUrl(){
  if (isset($_SESSION['TrackingUrl'])) {
   RedirectFun($_SESSION['TrackingUrl']);
  } else {
    RedirectFun('index.php');
  }
  
}

?>