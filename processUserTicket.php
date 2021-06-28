<?php
session_start();
if(isset($_POST['btnAdd'])){
	$error = 0;
	require_once "config.php";
				$sql = "INSERT INTO tblticket VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				if($stmt = mysqli_prepare($link, $sql)){
					mysqli_stmt_bind_param($stmt, "ssssssssss", $ticketid, $prob, $cat, $desc, $status, $date, $time, $user, $tech, $admin);
					date_default_timezone_set("HongKong");
					$ticketid = date("Ymd") . date("His");
					$prob = $_POST['cbProb'];
					$cat = $_POST['cbCat'];
					$desc = $_POST['desc'];
					$status = "Pending"; 
					$date = date("Y-m-d");
					$time = date("h:iA");
					$user = $_SESSION['account'];
					$tech = "";
					$admin = "";
					if(mysqli_stmt_execute($stmt)){

						$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							$user = $_SESSION['account'];
							$action = "Added ticket ". $ticketid;
							$module = "Ticket";
							$date = date("Y-m-d");
							$time = date("h:iA");
							if(mysqli_stmt_execute($stmt)){
								header("Location: ticketUser.php?msg=ticketadded");
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
	$edit = trim($_POST["ticketid"]);
	  if($error == 0){
		  $sql = "UPDATE tblticket SET problem = ?, category = ?, description = ? WHERE ticketID = ?";
		  if($stmt = mysqli_prepare($link, $sql)){
			  mysqli_stmt_bind_param($stmt, "ssss", $_POST['cbProb'], $_POST['cbCat'], $_POST['desc'], $edit);
				  if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							  $user = $_SESSION['account'];
							  $action = "Updated ticket ". $edit;
							  $module = "Ticket";
							  $date = date("Y-m-d");
							  $time = date("h:iA");
							  if(mysqli_stmt_execute($stmt)){
								  header("Location: ticketUser.php?msg=ticketupdated");
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
	$sql = "DELETE FROM tblticket WHERE ticketID = ?";
	if($stmt = mysqli_prepare($link, $sql)){
	  mysqli_stmt_bind_param($stmt,"s", $delete );
	  if(mysqli_stmt_execute($stmt)){
		$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
			date_default_timezone_set("HongKong");
			$id = date("Ym") . date("His");
			$user = $_SESSION['account'];
			$action = "Deleted ticket ". $delete;
			$module = "Ticket";
			$date = date("Y-m-d");
			$time = date("h:iA");
			if(mysqli_stmt_execute($stmt)){
				header("Location: ticketUser.php?msg=ticketdeleted");
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
			header('location: ticketUser.php#passnotmatch');
		  }
		  else{
			$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
					if(mysqli_stmt_execute($stmt)){
					  header('location: ticketUser.php#changedpass');
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
		header('location: logsTicketUser.php#passnotmatch');
		}
		else{
		$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
		  mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
			if(mysqli_stmt_execute($stmt)){
			  header('location: logsTicketUser.php?msg=changedpass');
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
		  header('location: logsTicketUser.php?msg=logdeleted');
	  }
	  else {
	  echo "Error on delete statement. Please Try Again.";
	  }		
	}
	}
?>