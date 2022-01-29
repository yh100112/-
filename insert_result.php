<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
	
    if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")) exit();

    $userID = $_POST["userID"];
    $userName = $_POST["userName"];
    $addr = $_POST["addr"];
    $userPW = $_POST["userPW"];
  
      
    $sql = " insert into member 
	     values ('".$userID."', '".$userPW."', '".$userName."', '".$addr."')
    ";

    $ret = oci_execute(oci_parse($con, $sql));

    echo "<h1> 신규 회원 가입 결과 </h1>";

    if($ret){
        echo "회원 데이터가 성공적으로 입력됬습니다.";
    }
    else{
        echo "회원 가입 실패!!!<br>";
    }
    echo "<br> <a href = 'login.php'> 로그인 화면 </a> ";	
    oci_close($con);
?>

