<head><meta charset="UTF-8"></head>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    session_start();

    if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")){
        exit();  
    }

    
    $PRODUCT_NAME = $_POST["PRODUCT_NAME"]; //입력한 값
    $ORDER_QUANTITY = $_POST["ORDER_QUANTITY"]; // 입력한 값
    $userID = $_SESSION["userID"]; // 현재 로그인 아이디

    $sql2 = "update product
             set INVENTORY = (INVENTORY - ($ORDER_QUANTITY-(select ORDER_QUANTITY from ordertable where ID = '$userID' and PRODUCT_NAME = '$PRODUCT_NAME')))
             where PRODUCT_NAME = '".$PRODUCT_NAME."'
    ";
    $stat2 = oci_parse($con,$sql2);
    $ret2 = oci_execute($stat2);



    $sql1 ="update ordertable 
            set ORDER_QUANTITY = $ORDER_QUANTITY
            where ID = '".$userID."' and PRODUCT_NAME = '".$PRODUCT_NAME."'
    ";
    $stat1 = oci_parse($con, $sql1);
    $ret1 = oci_execute($stat1);


    echo "<h1> 주문 수정 결과 </h1>";

    if($ret1){
        echo "주문 내역 수정이 성공적으로 입력됬습니다.<br>";
    }
    else{
        echo "수정 실패!!!<br>";
    }

    echo "<br><a href = 'main.html'>초기화면</a>";

    oci_free_statement($stat2);
    oci_free_statement($stat1);
    oci_close($con);
?>
