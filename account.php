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
        <li class="sidebar-list-item"><a href="account.php" class="sidebar-link text-muted active"><i class="o-profile-1 mr-3 text-gray"></i><span>Accounts</span></a></li>
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
            <br>
            <div class="row">
            <div class="col-lg-12 mb-12 mb-lg-0 center">
            <div class="col-lg-12 mb-4">
              <div class="float-right">
            
            <a href="logsAcc.php" class="btn btn-info">Logs</a>
            <a href="account.php" class="btn btn-warning">Refresh</a>
            </div>
            <br>
            
            <?php
              if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo "<br>";
                if($msg == "accountadded"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Account successfully added!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "changedpass"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Password changed!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "accountupdated"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Account updated!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "accountdeleted"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Account deleted!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "accountActivated"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Account Activated!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "accountDeactivated"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Account deactivated!";
                  echo "<a href='account.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
              }  
             
            ?>
            </div>
            </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-12 mb-12 mb-lg-0">
              <div class="col-lg-20 mb-4">
                <div class="card">
                  <div class="card-header">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccount">Add</button>
                      <div class="float-right">
                        <div class="col-md-12 select mb-3">
                          <script type="text/javascript">
                              function ChangeDropdowns(value){
                                  if(value=="none"){
                                      document.getElementById('usrnme').style.display='none';
                                      document.getElementById('usrtype').style.display='none';
                                      document.getElementById('stts').style.display='none';
                                  }
                                  else if(value=="Username"){
                                      document.getElementById('usrnme').style.display='block';
                                      document.getElementById('usrtype').style.display='none';
                                      document.getElementById('stts').style.display='none';
                                  }
                                  else if(value=="Usertype"){
                                      document.getElementById('usrnme').style.display='none';
                                      document.getElementById('usrtype').style.display='block';
                                      document.getElementById('stts').style.display='none';
                                  }
                                  else if(value=="Status"){
                                      document.getElementById('usrnme').style.display='none';
                                      document.getElementById('usrtype').style.display='none';
                                      document.getElementById('stts').style.display='block';
                                  }
                              }
                          </script>
                          
                        <select id="search" class="custom-select" onchange="ChangeDropdowns(this.value);">
                        <option value="none"hidden>Search</option>
                            <option value="Username">Username</option>
                            <option value="Usertype">Usertype</option>
                            <option value="Status">Status</option>
                        </select>
                        </div>
                        <input type="text" id="usrnme" placeholder="Search" class="form-control usrnme" style="display:none;">
                        <select id="usrtype" onchange="usrtype(this)" class="custom-select usrtype" style="display:none;">
                        <option value="none" hidden>Usertype</option>
                            <option value="">Admin</option>
                            <option value="">Technical</option>
                            <option value="">User</option>
                        </select>
                        <select id="stts" onchange="stts(this)" class="custom-select stts" style="display:none;">
                        <option value="none" hidden>Status</option>
                            <option value="">Active</option>
                            <option value="">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php
                    require_once "config.php";
                    $acc = $_SESSION['account'];
                    $sql = "SELECT * FROM tblaccount where username != '$acc' order by username";
                    if($result = mysqli_query($link, $sql)){
                      if(mysqli_num_rows($result) > 0){
                  ?>
                        <div class="card-body">   
                                              
                          <table class="table table-hover card-text">
                            <thead>
                              <tr>
                              <th>Username</th> 
                              <th>Password</th> 
                              <th>Type</th> 
                              <th>Status</th> 
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                              $username = $row['username'];
                                $mask_number =  str_repeat("*", strlen($row['password']));
                              echo "<tbody>"; 
                                echo "<tr><td  >{$username}</td><td  >{$mask_number}</td><td  >{$row['type']}</td><td  >{$row['status']}</td>";
                            ?>
                                <td class="c"> 
                                  <?php
                                    if($row['status'] == "Active"){
                                      $stat = "Deactivate";
                                    }
                                    else{
                                      $stat = "&nbsp;&nbsp;&nbsp;Activate&nbsp;&nbsp;&nbsp;";
                                    }
                                  ?>
                                  <form action="processAcc.php" method="post">
                                    <input type="submit" name="btnStatus" value="<?php echo $stat;?>" class="btn btn-success">
                                    <input type="hidden" name="userStat" value="<?php echo $row['username']; ?>">
                                    <input type="hidden" name="stat" value="<?php echo $row['status']; ?>">
                                    
                                    <a href="#view<?php echo $username;?>" data-toggle="modal" class="btn btn-primary">View</a>
                                    <a href="#edit<?php echo $username;?>" data-toggle="modal" class="btn btn-info">Edit</a>
                                    <a href="#delete<?php echo $username;?>" data-toggle="modal" class="btn btn-danger">Delete</a>
                                  </form>
                                </td>
                              </tr>
                              <!-- View Modal -->
                              <div class="modal fade" id="view<?php echo $username;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">View account</h5>
                                      </div>
                                      <div class="modal-body">
                                      <div class="form-group">
                                        <label>Username: <?php echo $username;?></label><br>
                                        <label>Password: <?php echo $row['password'] ;?></label><br>
                                        <label>Type: <?php echo $row['type'] ;?></label><br>
                                        <label>Status: <?php echo $row['status'] ;?></label><br>
                                        <label>Date: <?php echo $row['date'] ;?></label><br>
                                        <label>Time: <?php echo $row['time'] ;?></label><br>
                                      </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                                     
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Edit Modal -->
                              <div class="modal fade" id="edit<?php echo $username;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Update Account</h5>
                                    </div>
                                      <div class="modal-body">
                                        <form action = "processAcc.php" method="post" id="editAccount" name="editAccount">
                                          <div class="form-group">
                                          <label>Username</label> 
                                          <input type="text" class="form-control"name="editUser" value="<?php echo $row['username']; $un =$row['username']; ?>" readonly="readonly"/>
                                          </div>
                                          <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="editPass" id="editPass" value="<?php echo $row['password'];?>">
                                          <input type="checkbox" onclick="PassFunctionEdit()" >Show Password<p id="y" class="text-danger"></p>
                                          </div>
                                          <div class="form-group">
                                            <label>User Type</label>
                                            <select class="custom-select" name="editcbType">
                                              <option value="<?php echo $row['type'];?>" hidden><?php echo $row['type'];?></option>
                                              <option value="Admin">Admin</option>
                                              <option value="Technical">Technical</option>
                                              <option value="User">User</option>
                                            </select>
                                            <div class="modal-footer">
                                            <input type="button"class="btn btn-secondary" onclick="clearFunctionEdit()" data-dismiss="modal" value="Close">
                                              <input type="submit" class="btn btn-primary" name="btnEdit" value="Save">
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal fade" id="deleted<?php echo $username;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">View account</h5>
                                      </button>
                                      </div>
                                      <div class="modal-body">
                                      <form action = "processAcc.php" method="post">
                                      <div class="form-group">
                                      <input type="hidden" name="delete" value="<?php echo $row['username']; ?>">
                                      deleted! <?php echo $row['username']; ?>
                                      </div>
                                        </div>
                                        <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="btnDelete" value="Close">
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Delete Modal -->
                              <div class="modal fade" id="delete<?php echo $username;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                    </div>
                                      <div class="modal-body">
                                      <div class="form-group">
                                      <form action = "processAcc.php" method="post">
                                      Are you sure you want to delete account "<b><?php echo $row['username']; ?></b>"?
                                      <input type="hidden" name="delete" value="<?php echo $row['username']; ?>">
                                      </div>
                                        <div class="modal-footer">
                                        <input type="submit" class="btn btn-warning" name="btnDelete" value="Delete">
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
          <!-- Add Modal -->
          <div class="modal fade" id="addAccount" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addAccountLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addAccountLabel">Add Account</h5>
                </div>
                <div class="modal-body">
                  <form action = "processAcc.php" method="post" id="addAccount" name="add" onsubmit="return IsEmpty()">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="addUser" id="addUser"aria-describedby="addUsername" placeholder="Enter Username">
                      <p id="x" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="addPass" id="addPass" placeholder="Password" id="PassShow">
                      <input type="checkbox" onclick="PassFunction()" >Show Password<p id="y" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                      <label>User Type</label>
                      <select class="custom-select" name="cbType" id="cbType">
                        <option value="none" hidden>Type</option>
                        <option value="Admin">Admin</option>
                        <option value="Technical">Technical</option>
                        <option value="User">User</option>
                      </select>
                      <p id="z" class="text-danger"></p>
                    </div>
                    <div class="modal-footer">
                    <input type="button"class="btn btn-secondary" onclick="clearFunctionAdd()" data-dismiss="modal" value="Close">
                      <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
                      <form action = "processAcc.php" method="post" name="pass" onsubmit="return password()">
                          <div class="form-group">
                            <label>Old Password</label> 
                            <input type="password" class="form-control" name="oldPass" id="oldPass">
                            <input type="checkbox" onclick="PassFunctionx()">Show Password
                            <p id="old" class="text-danger"></p>
                            <label>New Password</label> 
                            <input type="password" class="form-control" name="newPass" id="newPass">
                            <input type="checkbox" onclick="PassFunctiony()">Show Password
                            <p id="new" class="text-danger"></p>
                            <label>Confirm New Password</label> 
                            <input type="password" class="form-control" name="conPass" id="conPass">
                            <input type="checkbox" onclick="PassFunctionz()">Show Password
                            <p id="con" class="text-danger"></p>
                          </div>
                      </div>
                      <div class="modal-footer">
                      <input type="button"class="btn btn-secondary" onclick="clearFunction()" data-dismiss="modal" value="Close">
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
                <p class="mb-2 mb-md-0">Gamay & Morcillos &copy; 2020</p>
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
    
    if(window.location.href.indexOf("#accountexist") > -1) {
    $('#addAccount').modal('show');
    var x = document.forms["add"]["addUser"].value;
        document.getElementById("x").innerHTML = "Account Exist!"; 
        document.getElementById("addUser").value = "<?php echo $_SESSION['addacc']?>"; 
        document.getElementById("addPass").value = "<?php echo $_SESSION['addpass']?>"; 
        document.getElementById("cbType").value = "<?php echo $_SESSION['addtype']?>"; 
  }
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
      function PassFunction() {
        var ap   = document.getElementById("addPass");
        if (ap.type === "password") {
          ap.type = "text";
        } else {
          ap.type = "password";
        }
      }
      function PassFunctionEdit() {
        var p = document.getElementById("editPass");
        if (p.type === "password") {
          p.type = "text";
        } else {
          p.type = "password";
        }
      }
    </script>
    <script>
        $("#usrnme").on("keyup",function() {
          var value=$(this).val();
          $("table tr").each(function(result)
          {
            if(result!==0)
            {
                var id =$(this).find("td:first").text();
                if(id.indexOf(value)!==0 && id.toLowerCase().indexOf(value.toLowerCase())<0)
                {
                    $(this).hide();
                }
                else{
                    $(this).show();
                }
            }
          }); 
        });
        function usrtype($this) {
        var $selectText = $('option:selected', $this).text().toLowerCase();
        var $val = $($this).val();

        if ($selectText != 'UserType') {
            $('tr').each(function () {
                if ($(this).find('td').length) {
                    var txt =  $(this).find('td:eq(2)').text().toLowerCase();
                    if (txt === $selectText) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                }
            })
        }
        else {
            $('tr').show();
        }

    }
        function stts($this) {
        var $selectText = $('option:selected', $this).text().toLowerCase();
        var $val = $($this).val();

        if ($selectText != 'Status') {
            $('tr').each(function () {
                if ($(this).find('td').length) {
                    var txt =  $(this).find('td:eq(3)').text().toLowerCase();
                    if (txt === $selectText) {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                }
            })
        }
        else {
            $('tr').show();
        }

    }
    </script>
    <script type="text/javascript">
        
function IsEmpty() {
  var x = document.forms["add"]["addUser"].value;
  var y = document.forms["add"]["addPass"].value;
  var cb=document.add.cbType.value;
  if (x == "") {
    document.getElementById("x").innerHTML = "cannot be blank"; 
    return false;
  }
  else{
    document.getElementById("x").innerHTML = ""; 
  }
  if (y == "") {
    document.getElementById("y").innerHTML = "cannot be blank"; 
    return false;
  }
  else{
    document.getElementById("y").innerHTML = ""; 
  }
  
    if (cb == "none")
    {
      document.getElementById("z").innerHTML = "Select usertype"; 
      return false;
    }
    else{
    document.getElementById("z").innerHTML = ""; 
  }
}
  function clearFunctionAdd() {
  document.forms['addAccount'].reset();
  document.getElementById("x").innerHTML = ""; 
  document.getElementById("y").innerHTML = "";
  document.getElementById("z").innerHTML = "";  
}
function clearFunctionEdit() {
  document.forms['editAccount'].reset();
}
function clearFunction() {
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