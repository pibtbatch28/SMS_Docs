<?php require_once('DB_CONNECTION/DB_Connection.php'); ?>
<?php
	print_r($_POST);
	
$errors = array();

	if (isset($_POST['Cancel'])) {
		header('Location: index.php');
	
	}
	if(isset($_POST['Create']))
	{
	
		if(empty($_POST['nemail']) || empty($_POST['nPassword']))
	{
		$errors = '<p class="error">Please check datails again</p>';
			//	$emty[] = 'Database query failed';
				//echo '<br/>Invalid user name/password';
			
		}else
		{
		
/*		
	$email = mysqli_real_escape_string($connection, $_POST['nemail']);
	$Password = mysqli_real_escape_string($connection, $_POST['nPassword']);
	$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
*/
//	$email = sqlsrv_real_escape_string($connection, $_POST['nemail']);
//	$Password = sqlsrv_real_escape_string($connection, $_POST['nPassword']);
	$Password = $_REQUEST['nPassword'];
	$email = $_REQUEST['nemail'];
	$hashed_password = password_hash($Password, PASSWORD_DEFAULT);

echo $hashed_password;




 $query = "INSERT INTO USER_ACC (USER_ID, PASSWORD, FNAME, LNAME, PHONE_NUMBER, EMAIL) VALUES (?, ?, '', '', '', '')";


 
$para = array($email,$hashed_password);

	//mysqli_query($connection,$query);

//$resultset = mysqli_query($connection,$query);
//$resultset = sqlsrv_query($connection,$query,array($email, $hashed_password));
 $resultset = sqlsrv_query($con, $query, $para); // this use when execute once,
 /*If you intend to re-execute a statement with different parameter values, use the combination of sqlsrv_prepare() and sqlsrv_execute(). */

if($resultset){
	
	//echo sqlsrv_affected_rows($connection)." Records updated";
	//sqlsrv_rows_affected ( resource $stmt )*******
	echo sqlsrv_rows_affected($resultset)." Records updated";
	//echo mysqli_affected_rows($connection)." Records updated";
} else{
	echo "Database query failed!";
		die( print_r( sqlsrv_errors(), true));
	//echo($resultset);
}
	//echo '<p class="error" style="background: green;" >Succesfully added one user</p>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Create New User</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
</head>
<body>
	<div class="Login">
		<form action="Create_User.php" method="post">
			<fieldset>
				<legend><h1>Create New User</h1></legend>
				<?php
				if(isset($errors) && !empty($errors))
				{
					echo $errors;
				}
				?>
				<p>
					<label for="">Username</label>
					<input type="text" name="nemail" id="" placeholder="Email Address">
				</p>
				<p>
					<label for="">Password</label>
					<input type="Password" name="nPassword" id="" placeholder="Password">
				</p>
				
				<p>
					<button type="submit" name="Create">Create</button>
				</p>
				<p>
					<button type="submit" name="Cancel">Cancel</button>
				</p>
			</fieldset>
		</form>
	</div>

</body>
</html>
<?php sqlsrv_close($con);?>