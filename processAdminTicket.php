<?php
session_start();
if(isset($_POST['btnAssign'])){
	$error = 0;
	require_once "config.php";
	$edit = trim($_POST["ticketid"]);
	  if($error == 0){
		  $sql = "UPDATE tblticket SET status = ?, assignedTo = ? WHERE ticketID = ?";
		  if($stmt = mysqli_prepare($link, $sql)){
			  mysqli_stmt_bind_param($stmt, "sss",  $status, $_POST['cbAssign'], $edit);
			  $status ="On-going";
				  if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							  $user = $_SESSION['account'];
							  $action = "Assigned ticket ". $edit . " to " . $_POST['cbAssign'];
							  $module = "Ticket";
							  $date = date("Y-m-d");
							  $time = date("h:iA");
							  if(mysqli_stmt_execute($stmt)){
								  header("Location: ticketAdmin.php?msg=ticketAssigned");
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
if(isset($_POST['btnApprove'])){
	$error = 0;
	require_once "config.php";
	$edit = trim($_POST["ticketid"]);
	  if($error == 0){
		  $sql = "UPDATE tblticket SET status = ?, approvedBy = ? WHERE ticketID = ?";
		  if($stmt = mysqli_prepare($link, $sql)){
			  mysqli_stmt_bind_param($stmt, "sss",  $status, $admin, $edit);
			  $status ="Completed";
			  $admin = $_SESSION['account'];
				  if(mysqli_stmt_execute($stmt)){
					$sql = "INSERT INTO tbllogs VALUES (?, ?, ?, ?, ?, ?)";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "ssssss", $id, $action, $user, $module, $date, $time);
							date_default_timezone_set("HongKong");
							$id = date("Ym") . date("His");
							  $user = $_SESSION['account'];
							  $action = "Approved ticket ". $edit ;
							  $module = "Ticket";
							  $date = date("Y-m-d");
							  $time = date("h:iA");
							  if(mysqli_stmt_execute($stmt)){
								  header("Location: ticketAdmin.php?msg=ticketApproved");
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
			header('location: ticketAdmin.php#passnotmatch');
		  }
		  else{
			$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
			if($stmt = mysqli_prepare($link, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
					if(mysqli_stmt_execute($stmt)){
					  header('location: ticketAdmin.php#changedpass');
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
		header('location: logsTicketAdmin.php#passnotmatch');
		}
		else{
		$sql = "UPDATE tblaccount SET password = ? WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
		  mysqli_stmt_bind_param($stmt, "ss", $newpass, $edit);
			if(mysqli_stmt_execute($stmt)){
			  header('location: logsTicketAdmin.php?msg=changedpass');
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
		  header('location: logsTicketAdmin.php?msg=logdeleted');
	  }
	  else {
	  echo "Error on delete statement. Please Try Again.";
	  }		
	}
	}
?>