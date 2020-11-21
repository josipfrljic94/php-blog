<?php require_once('include/connection.php'); ?>
<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>
<?php 



// $getId= $_GET['id'];
$sql = "DELETE FROM post WHERE id =:getID";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':getID', $_GET['id'], PDO::PARAM_INT);   
$stmt->execute();
RedirectFun("Blog.php");

?>