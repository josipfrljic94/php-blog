<?php require_once('include/function.php'); ?>
<?php require_once('include/session.php'); ?>

<?php 
       $_SESSION['ADMIN_ID']=null;
       $_SESSION['Username']=null;
       $_SESSION['aname']=null;
    session_destroy();
    RedirectFun('Login.php');
?>