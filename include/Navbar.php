
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  
  <ul class="navbar-nav mr-auto">
 
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=1">Blog <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Dashboard.php">Dashboard</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link " href="addNewPost.php" tabindex="-1" >Add New Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="Categories.php" tabindex="-1" >Add New Category</a>
          </li>

          <li class="nav-item">
        <a class="nav-link " href="Login.php" >Login</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="LogOut.php" >Log out</a>
      </li>

        </ul>
   
   <ul class="navbar-nav ml-auto  ">

   <?php
if ($_SERVER['PHP_SELF']== '/blogapp/index.php'):?>
<li class="mr-3">
<form action="index.php ">
  <div class="form-group">
      <div class=" row">
        <input type="text" name="search" class="input w-50 border-0 rounded-0" placeholder="search post">
      <button type="submit" class="btn btn-primary w-50 border-0 rounded-0" name="searchbtn">Search</button>
      </div>
      </div>
      </form>
      </li>

  <?php endif ?>

   <li class="nav-item">
        <a class="nav-link " href="Login.php" >Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="LogOut.php" >Log out</a>
      </li>
      </div>
   </li>
 

</nav>