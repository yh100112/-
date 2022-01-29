<head><meta charset="UTF-8"></head>
<?php
	   error_reporting(E_ALL);
    	ini_set("display_errors",1);
    	if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")) exit();

	$ID = 'r';
	$sql2 = " select * from member where id = '$ID' ";

	$stat2 = oci_parse($con,$sql2);
	$ret2 = oci_execute($stat2);	
	$row2 = oci_fetch_array($stat2);
	echo "<br>", $row2["ID"];
	echo "<br> ", $row2['PW'];

		
	
	oci_free_statement($stat2);
	oci_close($con);
?>
	
	
