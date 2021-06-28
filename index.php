<?php
  session_start();
  $inputuser = "";
  $inputpass = "";
  if(!isset($account)){
    $account ='';
  }
  if(!isset($password)){
    $password ='';
  }
  if(isset($_POST['btnlogin'])){
    require_once "config.php";
    $account = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($account != ""){
      if($password != ""){
        $sql = "SELECT * FROM tblaccount WHERE username = '$account'";
        $result = mysqli_query($link, $sql);
        $rows = mysqli_fetch_array($result);
        if($rows){
          if($rows["password"] == $password){
              $_SESSION['account'] = $account;
                    if($rows["status"] == "Active"){
                        $role = $rows["type"];
                        if($role == "Admin")
                        {
                          header("location: account.php");
                        }
                        elseif($role == "Technical"){
                          header("location: equipTech.php");
                        }
                        elseif($role == "User"){
                          header("location: ticketUser.php");
                        }
                    }
                    else{
                      $inputuser = "Inactive User";
                    }
              }
              else{
                $inputpass = "Wrong Password!";
              }
            } 
        else {
          $inputuser = "User not found!";
        }
      }
      else{
        $inputpass = "Cannot be blank";
      }
    }
    else{
      $inputuser = "Cannot be blank!";
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITHelpDesk</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.violet.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/icon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-5 col-lg-7 mx-auto mb-4 mb-lg-0">
            <div class="pr-lg-5"><img src="img/log.svg" alt="" class="img-fluid"></div>
          </div>
          <div class="col-lg-5 px-lg-4">
            <h1 class="text-uppercase mb-4">Log in</h1>
            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"class="mt-4">
              <div class="form-group mb-4">
                <input type="text" id="username" name="username" value="<?php echo $account; ?>" placeholder="Username" class="form-control border-0 shadow form-control-lg">
                <p class="text-danger"><?php echo "&nbsp; &nbsp; &nbsp;" . $inputuser; ?></p>
              </div>
              <div class="form-group mb-4">
                <input type="password" id="Pass" name="password" value="<?php echo $password; ?>" placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
                <p class="text-danger"><?php echo "&nbsp; &nbsp; &nbsp;" . $inputpass; ?></p>
              </div>
              <div class="form-group mb-4">
                <div class="custom-control custom-checkbox">
                  <input id="customCheck1" type="checkbox" onclick="PassFunction()" class="custom-control-input">
                  <label for="customCheck1" class="custom-control-label">Show Password</label>
                </div>
              </div>
              <button class="btn btn-primary shadow px-5" id="submit" name="btnlogin">Log in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="js/front.js"></script>
    <script type="text/javascript">
      function PassFunction() {
        var x = document.getElementById("Pass");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
        }
    </script>
  </body>
</html>
<?php

?>
