<?php
//$connection=mysqli_connect(dbserver,dbuser,dbpass,dbname);
//$connection=mysqli_connect('localhost','root','','usertstdb');
//test connection
/* sqlsrv_connect ( string $serverName [, array $connectionInfo ] ) : resource
If values for the UID and PWD keys are not specified, the connection will be attempted using Windows Authentication.*/
$serverName = "NIPUN\SQLEXPRESS2012";
$connectionInfo = array("Database" =>"SMS", "UID"=>"sa", "PWD"=>"ndz@123");
$con = sqlsrv_connect($serverName, $connectionInfo);
//$con = sqlsrv_connect("NIPUN\\SQLEXPRESS2012:1433", "sa","ndz@123","SMS");
if($con){
	echo "Connection Established.<br/>";
}else{
	echo "Connection could not established.<br/>";
	die(print_r(sqlsrv_errors(), true));
}

/*if(mysqli_connect_errno()){
	die('Database connection failed '.mysqli_connect_error());
}else{
	echo "Connection successful!";
}*/
?>