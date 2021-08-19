<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    

    include './partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $cpassword = $_POST["cpassword"];
   
  
    $sql="SELECT * FROM `users`  WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
    if($num==1){
      while($row= mysqli_fetch_assoc($result)){
       if(password_verify($password,$row['password'])){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location: welcome.php");
       } else{
        $showError="Invalid credentials";
    }

      }
     

        // echo "your account has been created now you can log in ";
    }
      else{
        $showError="Invalid credentials";
    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
      <?php
      require './partials/_nav.php';
      ?>
      <?php
      if($login){
          echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You are Logged-in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      if($showError){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning! </strong>'.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
      ?>
      <div class="container col-md-6 my-3">
          <h1 class="text-center">Login To Our Website</h1>
        
  <form action="/sidjain/LoginApp/login.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
   
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password"   name="password">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Login</button>
</form>
      </div>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>