<?php 
session_start();

function ErrorMas(){
   if(isset($_SESSION["errormassage"])){
        $Output="<div class=\"alert alert-danger col-lg-8 offset-2 my-2\">".htmlentities($_SESSION["errormassage"]) ."</div>";        
        $_SESSION["errormassage"]=null;
        return $Output;
    }
 
   }
?>
<?php 
function SuccesMas(){
if(isset($_SESSION["succesmassage"])){
     $Output="<div class=\"alert alert-success col-lg-8 offset-2 my-2\">".htmlentities($_SESSION["succesmassage"]) ."</div>";        
     $_SESSION["succesmassage"]=null;
     return $Output;
}

}
?>




