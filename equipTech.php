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
      <nav class="navbar navbar-expand-lg px- py-4 bg-dark shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.html" class="navbar-brand font-weight-bold text-uppercase text-base">ITHelpDesk</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
        <li class="nav-item text-gray-500">
            <?php
              session_start();
              echo "Welcome " .$_SESSION['account'] . "!";
            ?>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3 bg-dark">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="equipTech.php" class="sidebar-link text-muted active"><i class="o-computer-display-1 mr-3 text-gray"></i><span>Equipment</span></a></li>
              <li class="sidebar-list-item"><a href="ticketTech.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Ticket</span></a></li>
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
            <a href="logsEquipTech.php" class="btn btn-info">Logs</a>
            <a href="equipTech.php" class="btn btn-warning">Refresh</a>
            </div>
            <br>
            <?php
              if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo "<br>";
                if($msg == "changedpass"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Password changed!";
                  echo "<a href='equipTech.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipadded"){
                  echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>";
                  echo "Equipment added successfully!";
                 echo "<a href='equipTech.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipexist"){
                  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                  echo "Equipment already exist!";
                  echo "<a href='equipTech.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipupdated"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Equipment updated!";
                  echo "<a href='equipTech.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
                elseif($msg == "equipdeleted"){
                  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                  echo "Equipment deleted!";
                  echo "<a href='equipTech.php' class='close'> <span aria-hidden='true'>&times;</span></a></div>";
                }
              }  
            ?>
            </div>
            </div>
            </div>
            <div class="row mb-4">
            <div class="col-lg-15 mb-12 mb-lg-0">
              <div class="col-lg-20 mb-4">
                <div class="card">
                  <div class="card-header">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddEquipment">Add</button>
                      <div class="float-right">
                        <div class="col-md-12 select mb-3">
                        <select id="srchOp" class="custom-select scrhOp">
                        <option value="none">Search</option>
                            <option value="mdl">Model</option>
                            <option value="brnch">Branch</option>
                            <option value="stts">Status</option>
                        </select>
                        </div>
                        <select id="dropDown" onchange="mdl(this)" class="custom-select srchOp mdl">
                          <option hidden>Model</option>
                          <option>Laptop</option>
                                          <option>CPU</option>
                                          <option>Monitor</option >
                                          <option>Keyboard</option>
                                          <option>Mouse</option>
                                          <option>Speaker</option>
                                          <option>Projector</option>
                                          <option>Printer</option>
                        </select>
                        <select id="dropDown" onchange="brnch(this)" class="custom-select srchOp brnch">
                          <option value="" hidden>Branch</option>  
                        <option value="Legarda">Legarda</option>
                        <option value="Malabon">Malabon</option>
                        <option value="Mandaluyong">Mandaluyong</option>
                        <option value="Pasay">Pasay</option>
                        <option value="Pasig">Pasig</option>
                        </select>
                        
                        <select id="dropDown" onchange="stts(this)" class="custom-select srchOp stts">
                            <option value="" hidden>Status</option>
                            <option value="Working">Working</option>
                            <option value="On-Repair">On-Repair</option>
                            <option value="Retired">Retired</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM tblequipment ORDER BY assetnumber ";
                    if($result = mysqli_query($link, $sql)){
                      if(mysqli_num_rows($result) > 0){
                  ?>
                        <div >   
                                              
                          <table class="table table-hover card-text">
                            <thead>
                              <tr>
                              <th>Asset No</th> 
                              <th>Serial No</th> 
                              <th>Model</th> 
                              <th>Branch</th>
                              <th>Status</th> 
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                                $assetno = $row['assetnumber'];
                              echo "<tbody>"; 
                                echo "<tr><td>{$assetno}</td><td class='c'>{$row['serialnumber']}</td><td class='c'>{$row['model']}</td><td class='c'>{$row['branch']}</td><td class='c'>{$row['status']}</td>";
                            ?>
                                <td> 
                                    <a href="#view<?php echo $assetno;?>" data-toggle="modal" class="btn btn-primary">View</a>
                                    <a href="#edit<?php echo $assetno;?>" data-toggle="modal" class="btn btn-info">Edit</a>
                                    <a href="#delete<?php echo $assetno;?>" data-toggle="modal" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                              <!-- Modal -->
                              <div class="modal fade" id="view<?php echo $assetno;?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">View</h5>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label><b>Asset Number: <?php echo $assetno;?></b></label><br>
                                        <label>Serial Number: <?php echo $row['serialnumber'] ;?></label><br>
                                        <label>Model: <?php echo $row['model'] ;?></label><br>
                                        <label>Description: <?php echo $row['description'] ;?></label><br>
                                        <label>Branch: <?php echo $row['branch'] ;?></label><br>
                                        <label>Status: <?php echo $row['status'] ;?></label><br>
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
                              <!-- Edit Modal -->
                              <div class="modal fade" id="edit<?php echo $assetno?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                                    </div>
                                    <div class="modal-body">
                                    <form action="processTechEquip.php" method="post">
                                      <label>Asset Number:</label>
                                      <input type="text" class="form-control" name="assetno" id="" value="<?php echo $assetno; ?>" readonly="readonly">
                                      <label>Serial Number:</label>
                                      <input class="form-control" type="text" name="serialno" value="<?php echo $row['serialnumber']?>">
                                      <label for="my-select">Model:</label>
                                        <select id="my-select" class="custom-select" name="cbModel">
                                          <option hidden><?php echo $row['model']?></option>
                                          <option>Laptop</option>
                                          <option>CPU</option>
                                          <option>Monitor</option>
                                          <option>Keyboard</option>
                                          <option>Mouse</option>
                                          <option>Speaker</option>
                                          <option>Projector</option>
                                          <option>Printer</option>
                                        </select>
                                      <label for="my-textarea">Description:</label>
                                      <textarea id="my-textarea" class="form-control" name="desc" rows="3"><?php echo $row['description']?></textarea>
                                      <div class="form-group">
                                        <label for="my-select">Status</label>
                                        <select id="my-select" class="custom-select" name="cbStatus">
                                          <option hidden><?php echo $row['status']?></option>
                                          <option value="Working">Working</option>
                                          <option value="On-Repair">On-Repair</option>
                                          <option value="Retired">Retired</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="submit" class="btn btn-primary" name="btnEdit" value="Save">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Delete Modal -->
                              <div class="modal fade" id="delete<?php echo $assetno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                    </div>
                                      <div class="modal-body">
                                      <div class="form-group">
                                      <form action = "processTechEquip.php" method="post">
                                      Are you sure you want to delete equipment "<b><?php echo $assetno; ?></b>"?
                                      <input type="hidden" name="delete" value="<?php echo $assetno; ?>">
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
          <div class="modal fade" id="AddEquipment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addEquipmentLabel">Add Equipment</h5>
                </div>
                <div class="modal-body">
                <form action = "processTechEquip.php" method="post" id="addEquipment" name="add" onsubmit="return blank()">
                  <div class="form-group">
                    <label>Serial Number:</label>
                    <input class="form-control" type="text" name="serialno" placeholder="Serial Number">
                  </div>
                  <div class="form-group">
                    <p class="text-danger" id="x"></p>
                      <label for="my-select">Model:</label>
                      <select id="my-select" class="custom-select" name="cbModel">
                        <option value="none" hidden>Model</option>
                        <option>Laptop</option>
                        <option>CPU</option>
                        <option>Monitor</option>
                        <option>Keyboard</option>
                        <option>Mouse</option>
                        <option>Speaker</option>
                        <option>Projector</option>
                        <option>Printer</option>
                      </select>
                      <p class="text-danger" id="m"></p>
                  </div>
                  <div class="form-group">
                    <label for="my-textarea">Description:</label>
                    <textarea id="my-textarea" class="form-control" name="desc" rows="3" placeholder="Description"></textarea>
                    <p class="text-danger" id="y"></p>
                  </div>
                  <div class="form-group">
                      <label for="my-select">Branch:</label>
                      <select id="my-select" class="custom-select" name="cbBranch">
                        <option value="none" hidden>Branch</option>  
                        <option value="Legarda">Legarda</option>
                        <option value="Malabon">Malabon</option>
                        <option value="Mandaluyong">Mandaluyong</option>
                        <option value="Pasay">Pasay</option>
                        <option value="Pasig">Pasig</option>
                      </select>
                      <p class="text-danger" id="b"></p>
                  </div>
                    <div class="modal-footer">
                       <input type="button"class="btn btn-secondary" onclick="clearFunction()" data-dismiss="modal" value="Close">
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
                      <form action = "processTechEquip.php" method="post" name="pass" onsubmit="return password()">
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
              <div class="col-md-6 text-center text-md-left ">
                <p class="mb-2 mb-md-0 text-primary">Gamay & Morcillos &copy; 2018-2020</p>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
      
function PassFunction() {
        var x = document.getElementById("PassShow");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
</script>
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
    function mdl($this) {
        var $selectText = $('option:selected', $this).text().toLowerCase();
        var $val = $($this).val();

        if ($selectText != 'Model') {
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
    function brnch($this) {
        var $selectText = $('option:selected', $this).text().toLowerCase();
        var $val = $($this).val();

        if ($selectText != 'Branch') {
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
    
    function blank() {
      var x = document.forms["add"]["serialno"].value;
      var y = document.forms["add"]["desc"].value;
      var b=document.add.cbBranch.value;
      var m=document.add.cbModel.value;
      if (x == "" || x == null) {
        document.getElementById("x").innerHTML = "cannot be blank"; 
        return false;
      }
      else{
    document.getElementById("x").innerHTML = ""; 
    }
      if (m == "none")
    {
      document.getElementById("m").innerHTML = "Select model"; 
      return false;
    }
    else{
    document.getElementById("m").innerHTML = ""; 
    }
     if (y == "" || y == null) {
        document.getElementById("y").innerHTML = "cannot be blank"; 
        return false;
      }
      else{
      document.getElementById("y").innerHTML = ""; 
      }
      if (b == "none")
    {
      document.getElementById("b").innerHTML = "Select branch"; 
      return false;
    }
    else{
    document.getElementById("b").innerHTML = ""; 
  }
    }
  function clearFunction() {
  document.getElementById("addEquipment").reset();
  document.getElementById("x").innerHTML = "";
  document.getElementById("y").innerHTML = "";
  document.getElementById("m").innerHTML = ""; 
  document.getElementById("b").innerHTML = "";
}
function clearFunctionEdit() {
  document.getElementById("editEquip").reset();
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