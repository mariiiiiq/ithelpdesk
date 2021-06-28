<?php
session_start();
if(isset($_POST['btnAdd'])){
	$error = 0;
	$msg = "";
	require_once "config.php";
	$sql = "SELECT * FROM tblaccount WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $_POST['addUser']);
		if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt);
		}
		else{
			echo "Error on select statement";
		}
		if($error == 0 && mysqli_num_rows($result) != 1){
     		$sql = "INSERT INTO tblaccount VALUES (?, ?, ?, ?, ?, ?)";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ssssss", $user, $pass, $type, $status, $date, $time);
				date_default_timezone_set("HongKong");
				$user = $_POST['addUser'];
				$pass = $_POST['addPass'];
				$type = $_POST['cbType'];
				$status = "Active"; 
				$date = date("Y-m-d");
				$time = date("h:iA");
				if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
					if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
						date_default_timezone_set("HongKong");
						$id = date("Ym") . date("His");
						$user = $_SESSION['account'];
						$action = "Added new user ". $_POST['addUser'];
						$module = "Account";
						$date = date("Y-m-d");
						$time = date("h:iA");
						if(mysqli_stmt_execute($stmt)){
							header('Location: acc.php?msg=accountadded');
						}
						else{
							echo "Error on inserting logs. Please try again later.";
						}
					}
				}
				else{
					echo "Error on insert statement. Please try again later.";
				}
			}
		}
		else{
			$_SESSION['addacc'] = trim($_POST['addUser']);
            $_SESSION['addpass'] = trim($_POST['addPass']);
			$_SESSION['addtype'] = trim($_POST['cbType']);
			header('Location: acc.php#accountexist');
			
		}
	}
}

if(isset($_POST['btnEdit'])){
  $error=0;
  require_once "config.php";
  $edit = trim($_POST["editUser"]);
	if($error == 0){
		$sql = "UPDATE tblaccount SET password = ?, type = ? WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $_POST['editPass'], $_POST['editcbType'], $edit);
			echo $_POST['editPass'] . $_POST['editcbType'];
				if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
					if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
						date_default_timezone_set("HongKong");
						$id = date("Ym") . date("His");
						$user = $_SESSION['account'];
						$action = "Updated user ". $edit;
						$module = "Account";
						$date = date("Y-m-d");
						$time = date("h:iA");
						if(mysqli_stmt_execute($stmt)){
							header("Location: acc.php?msg=accountupdated");
						}
						else{
							echo "Error on inserting logs. Please try again later.";
						}
					}
					
				}
				else{
					echo "Error on updatee statement";
				}
		}
	}
}
if(isset($_POST['btnStatus'])){
	$error=0;
	require_once "config.php";
	$edit = trim($_POST["userStat"]);
	$stat = trim($_POST["stat"]);
	if($stat == "Active"){
		$s = "Inactive";
		$a = "Deactivated";
	}
	
	elseif ($stat == "Inactive") {
		$s= "Active";
		$a = "Activated";
	}
	if($error == 0){
		$sql = "UPDATE tblaccount SET status = ? WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ss", $s, $edit);
			if(mysqli_stmt_execute($stmt)){
				$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
					if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
						date_default_timezone_set("HongKong");
						$id = date("Ym") . date("His");
						$user = $_SESSION['account'];
						$action = $a . " user ". $edit;
						$module = "Account";
						$date = date("Y-m-d");
						$time = date("h:iA");
						if(mysqli_stmt_execute($stmt)){
							header("Location: acc.php?msg=account". $a);
						}
						else{
							echo "Error on inserting logs. Please try again later.";
						}
				}
			}
			else{
				echo "Error on update statement";
			}
		}
	}
  }
if(isset($_POST['btnDelete'])){
	require_once "config.php";
	$delete = trim($_POST['delete']);
	$sql = "DELETE FROM tblaccount WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt,"s", $delete );
	  if(mysqli_stmt_execute($stmt)){
		$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
			date_default_timezone_set("HongKong");
			$id = date("Ym") . date("His");
			$user = $_SESSION['account'];
			$action = "Deleted user ". $delete;
			$module = "Account";
			$date = date("Y-m-d");
			$time = date("h:iA");
			if(mysqli_stmt_execute($stmt)){
				header('location: acc.php?msg=accountdeleted');
			}
			else{
				echo "Error on inserting logs. Please try again later.";
			}
		}
	  }
	  else {
		echo "Error on delete statement. Please Try Again.";
	  }		
	}
  }
  
?>