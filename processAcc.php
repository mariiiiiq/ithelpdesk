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
							header('Location: account.php?msg=accountadded');
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
			header('Location: account.php#accountexist');
			
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
							header("Location: account.php?msg=accountupdated");
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
							header("Location: account.php?msg=account". $a);
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
				header('location: account.php?msg=accountdeleted');
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
  if(isset($_POST['btnPass'])){
	require_once "config.php";
	$oldpass = trim($_POST['oldPass']);
	$newpass = trim($_POST['conPass']);
	$edit = $_SESSION['account'];
	$sql = "SELECT * FROM tblaccount WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt, "s", $param_id);
	  $param_id = trim ($_SESSION['account']);
	  if(mysqli_stmt_execute($stmt)){
		$result = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($result) == 1){
		  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		  if($oldpass != $row['password']){
			
			$_SESSION['oldPass'] = trim($_POST['oldPass']);
			header('location: account.php#passnotmatch');
		  }
		  else{
			$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
					if(mysqli_stmt_execute($stmt)){
					  header('location: account.php?msg=changedpass');
					}
					else{
						echo "Error on update statement";
					}
			}
		  }
		}
		else{
		  echo "Error on select statement.";
		}
	  }
	  else{
		echo "Error on select statement";
	  }
	}
  }
  if(isset($_POST['btnPasslogs'])){
	require_once "config.php";
	$oldpass = trim($_POST['oldPass']);
	$newpass = trim($_POST['conPass']);
	$edit = $_SESSION['account'];
	$sql = "SELECT * FROM tblaccount WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt, "s", $param_id);
	  $param_id = trim ($_SESSION['account']);
	  if(mysqli_stmt_execute($stmt)){
		$result = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($result) == 1){
		  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		  if($oldpass != $row['password']){
			
			$_SESSION['oldPass'] = trim($_POST['oldPass']);
			header('location: logsAcc.php#passnotmatch');
		  }
		  else{
			$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
					if(mysqli_stmt_execute($stmt)){
					  header('location: logsAcc.php?msg=changedpass');
					}
					else{
						echo "Error on update statement";
					}
			}
		  }
		}
		else{
		  echo "Error on select statement.";
		}
	  }
	  else{
		echo "Error on select statement";
	  }
	}
  }
  if(isset($_POST['btnDeletelogs'])){
	require_once "config.php";
	$delete = trim($_POST['delete']);
	$sql = "DELETE FROM tbllogs WHERE id = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt,"s", $delete );
	  if(mysqli_stmt_execute($stmt)){
        header('location: logsAcc.php?msg=logdeleted');
	  }
	  else {
		echo "Error on delete statement. Please Try Again.";
	  }		
	}
  }
?>