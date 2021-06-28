<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITHelpDesk</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/icon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-4 bg-dark shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.html" class="navbar-brand font-weight-bold text-uppercase text-base">ITHelpDesk</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item text-gray-500">
            <?php
              session_start();
              echo "Welcome " .$_SESSION['account']. "!";
            ?>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3 bg-dark">
      
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="account.php" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Accounts</span></a></li>
              <li class="sidebar-list-item"><a href="equipAdmin.php" class="sidebar-link text-muted"><i class="o-computer-display-1 mr-3 text-gray"></i><span>Equipment</span></a></li>
              <li class="sidebar-list-item"><a href="ticketAdmin.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Ticket</span></a></li>
              <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Account Setting</span></a>
            <div id="pages" class="collapse">
              <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted pl-lg-5">Log out</a></li>
                <li class="sidebar-list-item"><a href="#changePass" data-toggle="modal" class="sidebar-link text-muted pl-lg-5">Change Password</a></li>
               
              </ul>
            </div>
          </li>
        </ul>
        
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section>
          <?php
              if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo "<br>";
                if($msg == "changedpass"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Password changed!";
                  echo "<a href='logsTicketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "logdeleted"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Log deleted!";
                  echo "<a href='logsTicketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                
              }  
             
            ?>
</section>
          <section>
            <br>
            <div class="row mb-4">
              <div class="col-lg-12 mb-12 mb-lg-0">
              <div class="col-lg-20 mb-4">
                <div class="card">
                  <div class="card-header">
                    <div class="form-group">
                      <center><h2 class="text-primary">Ticket Logs</h2></center>
                    </div>
                  </div>
                  <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM tbllogs where module='Ticket' order by date DESC, time DESC";
                    if($result = mysqli_query($link, $sql)){
                      if(mysqli_num_rows($result) > 0){
                  ?>
                        <div class="card-body">   
                                              
                          <table class="table table-hover card-text">
                            <thead>
                              <tr>
                              <th>Action</th> 
                              <th>User</th> 
                              <th>Module</th> 
                              <th>Date</th> 
                              <th>Time</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                              echo "<tbody>"; 
                                echo "<tr><td class='c'>{$row['action']}</td><td class='c'>{$row['user']}</td><td class='c'>{$row['module']}</td><td class='c'>{$row['date']}</td><td class='c'>{$row['time']}</td>";
                            ?>
                               <td> <a href="#delete<?php echo $row['id'];?>" data-toggle="modal" class="btn btn-danger">Delete</a></yd>
                              </tr>
                               <!-- Delete Modal -->
                               <div class="modal fade" id="delete<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                    </div>
                                      <div class="modal-body">
                                      <div class="form-group">
                                      <form action = "processAdminTicket.php" method="post">
                                      Are you sure you want to delete this log?
                                      <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                                      </div>
                                        <div class="modal-footer">
                                        <input type="submit" class="btn btn-warning" name="btnDeletelogs" value="Delete">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </tbody>
                            <?php
                            }
                            
                          echo "</table>";
                      }
                    }
                  ?>    
                </div>
              </div>
              </div>
            </div>
          </section>
        </div>
        <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action = "processAcc.php" method="post" name="pass"onsubmit="return password()">
                          <div class="form-group">
                            <label>Old Password</label> 
                            <input type="password" class="form-control" name="oldPass" id="oldPass">
                            <input type="checkbox" onclick="PassFunctionx()">Show Password
                            <p id="old" class="text-danger"></p>
                            <label>New Password</label> 
                            <input type="password" class="form-control" name="newPass" id="newPass">
                            <input type="checkbox" onclick="PassFunctiony()">Show Password
                            <p class="text-danger" id="new"></p>
                            <label>Confirm New Password</label> 
                            <input type="password" class="form-control" name="conPass" id="conPass">
                            <input type="checkbox" onclick="PassFunctionz()">Show Password
                            <p class="text-danger" id="con"></p>
                          </div>
                      </div>
                      <div class="modal-footer">
                      <input type="button"class="btn btn-secondary" onclick="clearFunctionPass()" data-dismiss="modal" value="Close">
                        <input type="submit" class="btn btn-primary" name="btnPass" value="Save">
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
        <footer class="footer bg-dark shadow align-self-end py-3 px-xl-5 w-100">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 text-center text-md-left text-primary">
                <p class="mb-2 mb-md-0">Gamay and Morcillos &copy; 2020</p>
              </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    <script>
       if(window.location.href.indexOf("#passnotmatch") > -1) {
    $("#changePass").modal('show');
    var x = document.forms["pass"]["oldPass"].value;
        document.getElementById("old").innerHTML = "Password not match!"; 
        document.getElementById("oldPass").value = "<?php echo $_SESSION['oldPass']?>"; 
  }
  function PassFunctionx() {
        var x = document.getElementById("oldPass");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      function PassFunctiony() {
        var y = document.getElementById("newPass");
        if (y.type === "password") {
          y.type = "text";
        } else {
          y.type = "password";
        }
      }
      function PassFunctionz() {
        var z = document.getElementById("conPass");
        if (z.type === "password") {
          z.type = "text";
        } else {
          z.type = "password";
        }
      }
      function clearFunctionPass() {
  document.forms['pass'].reset();
  document.getElementById("old").innerHTML = ""; 
  document.getElementById("new").innerHTML = ""; 
  document.getElementById("con").innerHTML = ""; 
}
function password() {
      var x = document.forms["pass"]["oldPass"].value;
      var y = document.forms["pass"]["newPass"].value;
      var z = document.forms["pass"]["conPass"].value;
      if (x == "" || x == null) {
        document.getElementById("old").innerHTML = "cannot be blank"; 
        return false;
      }
      else{
    document.getElementById("old").innerHTML = ""; 
    }
      
     if (y == "" || y == null) {
        document.getElementById("new").innerHTML = "cannot be blank"; 
        return false;
      }
      else{
      document.getElementById("new").innerHTML = ""; 
      }
      if (z == "" || z == null) {
        document.getElementById("con").innerHTML = "cannot be blank"; 
        return false;
      }
      else{
      document.getElementById("con").innerHTML = ""; 
      }
      if (y != z) {
        document.getElementById("con").innerHTML = "new password does not match"; 
        return false;
      }
      else{
      document.getElementById("con").innerHTML = ""; 
      }
    }
    </script>
  </body>
</html>