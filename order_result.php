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
    $_SESSION['ORDER_QUANTITY'] = $ORDER_QUANTITY;
    $_SESSION['PRODUCT_NAME'] = $PRODUCT_NAME;
    $userID = $_SESSION["userID"]; // 현재 로그인 아이디

    
    $sql1 ="select member.ID, product.PRODUCT_NAME, product.PRODUCT_NUM, member.ADDRESS 
            from member,product 
            where member.ID = '$userID' and product.PRODUCT_NAME = '$PRODUCT_NAME' ";    
    $stat1 = oci_parse($con, $sql1);
    $ret1 = oci_execute($stat1);
    $row1 = oci_fetch_array($stat1); 

    
    $sql3 ="merge into ordertable S 
            using dual
                on (S.ID = '$userID' and S.PRODUCT_NUM = '".$row1["PRODUCT_NUM"]."')
            when matched then
                update set S.ORDER_QUANTITY = S.ORDER_QUANTITY + $ORDER_QUANTITY
            when not matched then
                insert (S.ID, S.PRODUCT_NAME, S.PRODUCT_NUM, S.ORDER_QUANTITY, S.ADDRESS)
                values ( '".$userID."', '".$row1["PRODUCT_NAME"]."' ,'".$row1["PRODUCT_NUM"]."',".$ORDER_QUANTITY.",'".$row1["ADDRESS"]."')  
    ";
    $stat3 = oci_parse($con,$sql3);
    $ret3 = oci_execute($stat3);
    


    echo "<h1> 주문 결과 </h1>";

    if($ret3){
        echo "주문이 성공적으로 입력됬습니다.";
    }
    else{
        echo "주문 실패!!!<br>";
    }

    echo "<br><a href = 'update_product.php'>초기화면</a>";

    oci_free_statement($stat1);
    oci_free_statement($stat3);
    oci_close($con);
?>
  

