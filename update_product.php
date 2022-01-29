<head><meta charset="UTF-8"></head>
<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    session_start();

    if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl","AL32UTF8")){
        exit();  
    }

    $ORDER_QUANTITY = $_SESSION['ORDER_QUANTITY'];
    $PRODUCT_NAME = $_SESSION['PRODUCT_NAME'];

    $sql1 ="update product 
            set INVENTORY = INVENTORY - $ORDER_QUANTITY
            where PRODUCT_NAME = '".$PRODUCT_NAME."'
    ";   
    $stat1 = oci_parse($con, $sql1);
    $ret1 = oci_execute($stat1);
    
    oci_free_statement($stat1);
    echo "<script> document.location.href = 'main.html'; </script>";
    oci_close($con);

    
     


    
?>