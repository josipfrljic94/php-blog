<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>

<?php 


if(isset($_GET['id'])){
global $dbh;

$commentId=$_GET['id'];
$Admin= $_SESSION['Username'];
$sql="UPDATE comments SET status='OFF', approvedby='$Admin'  WHERE  id='$commentId'";

$Execute=$dbh->query($sql);
if($Execute){
    $_SESSION["succesmassage"]="You upload the new topic";

    Redirectfun("Comments.php");
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
   Redirectfun("Comments.php");
  }
}

?>