<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>

<?php 

if(isset($_GET['id'])){
global $dbh;
$commentID=$_GET['id'];
$sql = "DELETE FROM comments WHERE '$commentID'";
$Execute=$dbh->query($sql);
if($Execute){
    $_SESSION["succesmassage"]="You  deleted the comment";

    Redirectfun("Comments.php");
  }else{
    $_SESSION["errormassage"]="Something went wrong";   
   Redirectfun("Comments.php");
  }
}

?>