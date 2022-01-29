<head><meta charset="UTF-8"></head>
<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);

    if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")) exit();

    	    
    $orderNum = 
    $userID = $_SESSION["userID"];
    $PRODUCT_NUM = $_POST["userName"];
    $addr = $_POST["addr"];
    $userPW = $_POST["userPW"];


    $sql = " insert into orders
             values ('".$userID."', '".$userPW."', '".$userName."', '".$addr."')
    ";

    $ret = oci_execute(oci_parse($con, $sql));

    echo "<h1> 주문 결과 </h1>";

    if($ret){
        echo "주문이 성공적으로 입력됬습니다.";
    }
    else{
        echo "주문 실패!!!<br>";
    }
    echo "<br> <a href = 'main.html'> 로그인 화면 </a> ";
    oci_close($con);
?>
