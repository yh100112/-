<head><meta content = "text/html; charset=utf-8"></head>
<?php
	session_start();

	if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")){
		exit();
	}

	$userID = $_POST["userID"];
	$userPW = $_POST["userPW"];

	$sql = "select ID from member where ID = '$userID' and PW = '$userPW'";

	$stat = oci_parse($con,$sql);
	$chk = oci_execute($stat);

	$ree = oci_fetch_array($stat, OCI_ASSOC);

	if($ree != false){
		 $_SESSION['userID'] = $_POST["userID"];
		echo " <script>alert(\"Welcome\");</script>";
		echo "<script> document.location.href = 'main.html'; </script>";
		header("Location:main.html");

	}
	else{
		echo " <script>alert(\"Login fail\");</script>";
		echo "<script> document.location.href = 'login.php';</script>";
		header("Location:login.php");
		exit;
	}
		
	oci_close($con);
?>
		

