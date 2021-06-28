<?php
session_start();
if(isset($_POST['btnAdd'])){
	$error = 0;
	require_once "config.php";
				$sql = "INSERT INTO tblequipment VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				if($stmt = mysqli_prepare($link, $sql)){
					mysqli_stmt_bind_param($stmt, "ssssssss", $assetno, $serialno, $model, $desc, $branch, $status, $date, $time);
					date_default_timezone_set("HongKong");
					$assetno = "AU-" .$_POST['cbBranch'] . date("Ym") . date("His");
					$serialno = $_POST['serialno'];
					$model = $_POST['cbModel'];
					$desc = $_POST['desc'];
					$branch = $_POST['cbBranch'];
					$status = "Working"; 
					$date = date("Y-m-d");
					$time = date("h:iA");
					echo "hehe";
					if(mysqli_stmt_execute($stmt)){
						$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							$user = $_SESSION['account'];
							$action = "Added equipment ". $assetno;
							$module = "Equipment";
							$date = date("Y-m-d");
							$time = date("h:iA");
							if(mysqli_stmt_execute($stmt)){
								header("Location: equipAdmin.php?msg=equipadded");
							}
							else{
								echo "Error on inserting logs. Please try again later.";
							}
						}
					}
					else{
						echo "Error in insert statement";
					}
			}
			else{
				echo "ngi";
			}
}

if(isset($_POST['btnEdit'])){
  $error=0;
  require_once "config.php";
  $edit = trim($_POST["assetno"]);
	if($error == 0){
		$sql = "UPDATE tblequipment SET serialnumber = ?, model = ?, description = ?, status = ? WHERE assetnumber = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssss", $_POST['serialno'], $_POST['cbModel'], $_POST['desc'], $_POST['cbStatus'], $edit);
				if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							$user = $_SESSION['account'];
							$action = "Updated equipment ". $edit;
							$module = "Equipment";
							$date = date("Y-m-d");
							$time = date("h:iA");
							if(mysqli_stmt_execute($stmt)){
								header("Location: equipAdmin.php?msg=equipupdated");
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
	$sql = "DELETE FROM tblequipment WHERE assetnumber = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt,"s", $delete );
	  if(mysqli_stmt_execute($stmt)){
		$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
			date_default_timezone_set("HongKong");
			$id = date("Ym") . date("His");
			$user = $_SESSION['account'];
			$action = "Deleted equipment ". $delete;
			$module = "Equipment";
			$date = date("Y-m-d");
			$time = date("h:iA");
			if(mysqli_stmt_execute($stmt)){
				header("Location: equipAdmin.php?msg=equipdeleted");
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
			header('location: equipAdmin.php#passnotmatch');
		  }
		  else{
			$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
					if(mysqli_stmt_execute($stmt)){
					  header('location: equipAdmin.php#changedpass');
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
			  header('location: logsEquipAdmin.php?msg=changedpass');
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
		  header('location: logsEquipAdmin.php?msg=logdeleted');
	  }
	  else {
	  echo "Error on delete statement. Please Try Again.";
	  }		
	}
	}
?>