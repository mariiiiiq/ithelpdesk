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
    <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
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
              <li class="sidebar-list-item"><a href="ticketAdmin.php" class="sidebar-link text-muted active"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Ticket</span></a></li>
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
            <a href="logsTicketAdmin.php" class="btn btn-info">Logs</a>
            <a href="ticketAdmin.php" class="btn btn-warning">Refresh</a>
            </div>
            <?php
              if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo "<br>";
                if($msg == "changedpass"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Password changed!";
                  echo "<a href='ticketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipapproved"){
                  echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>";
                  echo "Equipment added successfully!";
                  echo "<a href='ticketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipassigned"){
                  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                  echo "Equipment already exist!";
                  echo "<a href='ticketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipdeleted"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Equipment deleted!";
                  echo "<a href='ticketAdmin.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
              }  
            ?>
            </div>
            </div>
            </div>
            </section>
            <section>
          <section class="py-5">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="card-header">
                  <div class="form-group">
                      <div class="float-right">
                        <div class="col-md-12 select mb-3">
                        <select id="srchOp" class="custom-select scrhOp">
                        <option value="none" hidden>Search</option>
                            <option value="prob">Problem</option>
                            <option value="stts">Status</option>
                        </select>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                  <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM tblticket order by date DESC, time DESC";
                    if($result = mysqli_query($link, $sql)){
                      if(mysqli_num_rows($result) > 0){
                  ?>
                        <div class="card-body">   
                                              
                          <table class="table table-hover card-text">
                            <thead>
                              <tr>
                              <th>Ticket ID</th> 
                              <th>Problem</th> 
                              <th>Type</th> 
                              <th>Description</th> 
                              <th>Status</th> 
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                                $ticketid = $row['ticketID'];
                              echo "<tbody>"; 
                                echo "<tr><td>{$ticketid}</td><td>{$row['problem']}</td><td>{$row['category']}</td><td>{$row['description']}</td><td>{$row['status']}</td>";
                            ?>
                                <td> 
                                <form action="processAdminTicket.php" method="post">
                                <a href="#view<?php echo $ticketid;?>" data-toggle="modal" class="btn btn-primary">View</a>
                                <?php
                                if($row['status'] == "Pending"){
                                  ?>
                                    <a href="#assign<?php echo $ticketid;?>" data-toggle="modal" class="btn btn-info">Assign</a>
                                  <?php
                                }
                                elseif($row['status'] == "Waiting for approval"){
                                  ?>
                                    <input type="submit" name="btnApprove" value="Approve" class="btn btn-success">
                                    <input type="hidden" name="ticketid" value="<?php echo $ticketid; ?>">
                                  <?php
                                }
                                elseif($row['status'] == "Completed"){
                                  ?>
                                    <a href="#delete<?php echo $ticketid;?>" data-toggle="modal" class="btn btn-danger">Delete</a>
                                  <?php
                                }
                                
                                ?>
                                </form>
                                </td>
                              </tr>
                              <!-- View Modal -->
                              <div class="modal fade" id="view<?php echo $ticketid;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">View</h5>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label><b>Ticket ID: <?php echo $ticketid;?></b></label><br>
                                        <label>Problem: <?php echo $row['problem'] ;?></label><br>
                                        <label>Category: <?php echo $row['category'] ;?></label><br>
                                        <label>Description: <?php echo $row['description'] ;?></label><br>
                                        <label>Status: <?php echo $row['status'] ;?></label><br>
                                        <label>Assigned to: <?php echo $row['assignedTo'] ;?></label><br>
                                        <label>Date: <?php echo $row['date'] ;?></label><br>
                                        <label>Time: <?php echo $row['time'] ;?></label><br>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Delete Modal -->
                              <div class="modal fade" id="delete<?php echo $ticketid;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                    </div>
                                      <div class="modal-body">
                                      <div class="form-group">
                                      <form action = "processAdminTicket.php" method="post">
                                      Are you sure you want to delete ticket "<b><?php echo $ticketid; ?></b>"?
                                      <input type="hidden" name="delete" value="<?php echo $ticketid; ?>">
                                      </div>
                                        <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="btnDelete" value="Delete">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Assign Modal -->
                              <div class="modal fade" id="assign<?php echo $ticketid;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                                    </div>
                                    <div class="modal-body">
                                    <form action="processAdminTicket.php" method="post" name="frmAssign" onsubmit="return cbFunction()">
                                      <label>Ticket ID:</label>
                                      <input type="text" class="form-control" name="ticketid" id="" value="<?php echo $ticketid; ?>" readonly="readonly">
                                      <label>Problem:</label>
                                        <select id="prob" class="custom-select" name="cbProb" disabled>
                                            <option hidden><?php echo $row['problem']?></option>
                                            <option value="Hardware">Hardware</option>
                                            <option value="Software">Software</option>
                                            <option value="Connection">Connection</option>
                                          </select>
                                      <label>Category:</label>
                                        <select id="cat" class="custom-select" name="cbCat" disabled>
                                          <option hidden><?php echo $row['category']?></option>
                                        </select> 
                                      <label for="my-textarea">Description:</label>
                                      <textarea id="my-textarea" class="form-control" name="desc" rows="3" readonly="readonly"><?php echo $row['description']?></textarea>
                                      <label>Assign to:</label>
                                        <?php 

                                       $query = "SELECT * FROM tblaccount WHERE type='Technical'";
                                          $mysqli = NEW MySQLi('localhost','root','','ithelpdeskdb');
                                          $resultSet = $mysqli->query("SELECT * FROM tblaccount WHERE type='Technical'");
                                          
                                        ?>
                                        <select id="cbAssign" class="custom-select" name="cbAssign">
                                        <option value="" hidden>Technical</option>
                                       <?php 
                                        while($rows = $resultSet->fetch_assoc()){
                                          $tech = $rows['username'];
                                          echo "<option value='$tech'>$tech</option>";
                                        }
                                       ?>
                                        </select>
                                        <p id="a" class="text-danger"></p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="submit" class="btn btn-primary" name="btnAssign" value="Save">
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <?php
                              }
                              echo "</table>";
                            }
                        }  
                    ?>
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
                      <form action = "processAdminTicket.php" method="post" name="pass" onsubmit="return password()">
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
    <script src="js/front.js"></script>
    <script>
      
       $(document).ready(function(){
        $("#srchOp").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".srchOp").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".srchOp").hide();
                }
            });
        }).change();
    });
    $(document).ready(function () {
    $("#prob").change(function () {
        var val = $(this).val();
        if (val == "Hardware") {
            $("#cat").html("<option value='Laptop'>Laptop</option><option value='CPU'>CPU</option><option value='Monitor'>Monitor</option><option value='Keyboard'>Keyboard</option><option value='Mouse'>Mouse</option><option value='Speaker'>Speaker</option><option value='Projector'>Projector</option><option value='Printer'>Printer</option>");
        } else if (val == "Software") {
            $("#cat").html("<option value='Application'>Application</option><option value='OS'>OS</option>");
        } else if (val == "Connection") {
            $("#cat").html("<option value='Local'>Local</option><option value='Internet'>Internet</option>");
        } 
    });
});
$(document).ready(function () {
    $("#probadd").change(function () {
        var val = $(this).val();
        if (val == "Hardware") {
            $("#catadd").html("<option hidden>Category</option><option value='Laptop'>Laptop</option><option value='CPU'>CPU</option><option value='Monitor'>Monitor</option><option value='Keyboard'>Keyboard</option><option value='Mouse'>Mouse</option><option value='Speaker'>Speaker</option><option value='Projector'>Projector</option><option value='Printer'>Printer</option>");
        } else if (val == "Software") {
            $("#catadd").html("<option hidden>Category</option><option value='Application'>Application</option><option value='OS'>OS</option>");
        } else if (val == "Connection") {
            $("#catadd").html("<option hidden>Category</option><option value='Local'>Local</option><option value='Internet'>Internet</option>");
        } 
        else{

        }
    });
});
function prob($this) {
        var $selectText = $('option:selected', $this).text().toLowerCase();
        var $val = $($this).val();

        if ($selectText != 'Problem') {
            $('tr').each(function () {
                if ($(this).find('td').length) {
                    var txt =  $(this).find('td:eq(1)').text().toLowerCase();
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

        if ($selectText != 'By Status') {
            $('tr').each(function () {
                if ($(this).find('td').length) {
                    var txt =  $(this).find('td:eq(4)').text().toLowerCase();
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