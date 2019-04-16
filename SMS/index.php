<?php require_once('DB_CONNECTION/DB_Connection.php'); ?>
<?php  session_start();?>
<?php
print_r($_POST);
/*if(isset($_POST['sign_in'])){header('Location:home.php');}*/
if (isset($_POST['sign_in'])){
//   header('Location:home.php');
  $errors=array();
  if(empty($_POST['user_id']) || empty($_POST['pwd'])){//checking whether fields are empty
    $errors[] = "<p> Please check detils again!<p/>";
  }else{
    //assigning values to variable
  $user_id=$_POST['user_id'];
  $password=$_POST['pwd'];
  //initiate variable for database password
  $dbpass=null;
 // $u=ctype_upper($user_id)
  //hashing entered password
 // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  //prepairing sql query
  $sqlq = "SELECT PASSWORD FROM USER_ACC WHERE USER_ID=?";
  $para=array($user_id);
  $stmt = sqlsrv_prepare($con, $sqlq, $para);//preparir and execute instead of sqlsrv_query
  //checking occured errors when prepairing sql
  if( !$stmt ) {
     $errors[] = "<p> Invalid values!<p/>".print_r( sqlsrv_errors(), true);
    //die( print_r( sqlsrv_errors(), true));
    }else{
      //execute query
      $result = sqlsrv_execute($stmt);
      //checking is there any result
      if($result){
        //locking for saved password of paticular user id
      while($rec = sqlsrv_fetch_array($stmt)){
       //fetching db pass
        $dbpass = $rec['PASSWORD'];
      }
      //password matching
      if(password_verify($password, $dbpass)){
              $_SESSION["curuser"] = $user_id;
              header('Location: home.php');
              echo "<p><h2>success<h2/><p/>";
       }else{
        $errors[] ="User name or password incorrect!";
       }
      }else{
         $errors[] ="Attempt failed!";
      }
    }


  }
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	        <meta http-equiv="x-UA-Compatible" content="id=edge">
	<title>SMS</title>
	<link rel="stylesheet" href="signin.css">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<form action="index.php" method="post" class="form-signin">
    <!-- <img class="mb-4" src="{{ site.baseurl }}/docs/{{ site.docs_version }}/assets/brand/<bdo></bdo>otstrap-solid.svg" alt="" width="72" height="72"> -->
    <h1 class="h1 mb-3 font-weight-normal text-center">WELCOME</h1><h5 class="mb-3 font-weight-normal text-center"><b>TO<br/>STUDENT MANAGEMENT SYSTEM</b></h5>
    <label for="inputEmail" class="sr-only">Email address</label>
    <!--<input name="user_id" type="email" id="inputEmail" class="form-control rd" placeholder="User id" required autofocus><br>--->
     <input name="user_id" type="text" id="inputEmail" class="form-control rd" placeholder="User Id" required autofocus><br>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="pwd" type="password" id="inputPassword" class="form-control " placeholder="Password" required>
    <hr>
  <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br> -->
  <!---<a href="admin.html" class="btn btn-primary btn-block">Sign in</a>--->
    <?php   if(isset($errors) && !empty($errors)){
// foreach( $orders as $id => $qty)
   //foreach ($errors = $er)
 //echo "err occur".$errors;
        echo $errors[0].'<br>';
        echo '<b>Note :</b> If you foget password please contact administrator !';


  }?>
  <button type="submit" name="sign_in" class="btn btn-primary btn-block" >SIGN IN</button>

  <br>


  <p class="text-center">
  	
  <!---  <a href="Create_User.php">Create password </a>||
    <a href="#"> Forget password</a>-------->

  </p>
  
</form>

</body>
</html>
<?php sqlsrv_close($con);?>