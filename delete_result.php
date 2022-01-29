<head><meta charset="UTF-8"></head>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    session_start();

    if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")){
        exit();  
    }

    
    $PRODUCT_NAME = $_POST["PRODUCT_NAME"]; //입력한 값
    $userID = $_SESSION["userID"]; // 현재 로그인 아이디
    
    $sql = "update product
            set (INVENTORY) = (INVENTORY + (select ORDER_QUANTITY from ordertable where ID = '$userID' and PRODUCT_NAME = '$PRODUCT_NAME'))
            where PRODUCT_NAME = '".$PRODUCT_NAME."'       
    ";    
    $stat = oci_parse($con, $sql);
    $ret = oci_execute($stat);
    
    $sql1 ="delete ordertable where ID = '".$userID."' and PRODUCT_NAME = '".$PRODUCT_NAME."' ";    
    $stat1 = oci_parse($con, $sql1);
    $ret1 = oci_execute($stat1);

    echo "<h1> 주문 취소 결과 </h1>";

    if($ret1){
        echo "주문 취소 접수가 성공적으로 완료되었습니다.<br>";
    }
    else{
        echo "취소 실패!!!<br>";
    }

    echo "<br><a href = 'main.html'>초기화면</a>";

    oci_free_statement($stat);
    oci_free_statement($stat1);
    oci_close($con);

?>