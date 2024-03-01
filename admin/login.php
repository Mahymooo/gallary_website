<?php
    // ------------star register-----------------
    if($_SERVER['REQUEST_METHOD']==='POST'){
      include_once('includes/conn.php');
      if(isset($_POST['submit_register'])){
      // echo "post";
    try{
    $full_name=$_POST['full_name'];
    $user_name=$_POST['user_name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
      // -------password validation--------->
    
    // --------EMAIL VALIDATION------>
    if(isset($email)){
      if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $sql="INSERT INTO `users`(`full_name`, `user_name`, `email`, `password`) VALUES (?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$full_name, $user_name, $email, $password]);
    // echo "inserted";
    }}}catch(PDOEXCEPTION $e){
    echo "error" .$e->getMessage();
    }
    }
    
    //------------start login----------------------
    session_start();
    // $_SESSION['submit_login']=$_POST['submit_login'];
    // if(isset($_SESSION['submit_login']) and $_SESSION['submit_login']==true){
    //   header('location:users.php');
    //   die();
    // }
    if(isset($_POST['submit_login'])){
      $_SESSION['submit_login']=$_POST['submit_login'];
    try{
      $email=$_POST['email'];
      $password=$_POST['password'];
      $sql="SELECT * FROM `users` WHERE `email`=?";
      $stmts=$conn->prepare($sql);
      $stmts->execute([$email]);
      if($stmts->rowcount()){
        $result=$stmts->fetch();
        $user_name=$result['full_name'];
        $verify=password_verify($password,$result['password']);
        if($verify){
          $_SESSION['full_name']=$user_name;
          header('location:users.php');
          echo "correct password";
        }else{
          echo "not correct password";
          // header('location:login.php');
      }}else{
        echo "not logged";
      }}catch(PDOEXCEPTION $e){
      echo "error" .$e->getMessage();
      }}}
    


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Images Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
    <!-- START LOGIN -->
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
              <input type="submit" value="login" class="btn btn-primary w-110 py-8 fs-5 mb-4 rounded-2" placeholder="submit" required=""  name="submit_login"/>
                <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-file-image-o"></i></i> Images Admin</h1>
                  <p>©2016 All Rights Reserved. Images Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        <!-- STAT REGISTRATION -->
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="" method="POST">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Fullname" required="" name="full_name"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="user_name"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required=""  name="password"/>
              </div>
              <div>
              <input type="submit"  class="btn btn-primary w-110 py-8 fs-5 mb-4 rounded-2" placeholder="submit" required=""  name="submit_register"/>
                <!-- <a class="btn btn-default submit" href="index.html">Submit</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-file-image-o"></i></i> Images Admin</h1>
                  <p>©2016 All Rights Reserved. Images Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        <!-- END REGISTRATION -->
      </div>
    </div>
  </body>
</html>
