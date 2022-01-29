<head>
<meta charset="UTF-8">
<link rel=stylesheet href='css/ab.css' type="text/css">
<style>
a{ text-decoration:none }
footer {

    position:absolute;

    bottom:8%;

    width:100%;

    height:10%;
    
}
@font-face {
        font-family: "MF";
        src: url("css/font/BMJUA_ttf.ttf");
        }
    p{font-family: "MF",serif;}
    p{font-size:40px;}

</style>
</head>
<body>
<?php
        session_start();
        

        if(!$con = oci_connect("b689005","b689005","203.249.87.162:1521/orcl")) exit();

        $userID = $_SESSION['userID'];
        $PRODUCT_PART = $_POST["PRODUCT_PART"]; //입력한 값

        $sql = "select * from product where PRODUCT_PART = '$PRODUCT_PART'";
        $stat = oci_parse($con, $sql);
        $ret = oci_execute($stat);
        if(!$ret){
                echo "sql문 오류!!!";
                exit();
        }
	if(empty($userID))
	{
		echo "<script>alert(\"로그인 하세요\")</script>";
		echo "<script> document.location.href = 'login.php'; </script>";
	}
?>   

<form method = "POST" action = "order_result.php">
<img src="css/background/mark.png" style="float:right; width:150px; height:150px;">
	    
	<table width="200" height="50" >
	<tr>
	<td><p>제품 목록</p></td>
	</tr>
	</table>
	<table class="type11">
	<thead>
        <tr>
        <th>제품번호</th><th>제품이름</th><th>부위</th><th>재고량</th><th>원산지</th><th>업체번호</th>
        </tr>
	</thead>
</form>

<?php
        while(($row = oci_fetch_array($stat)) != false ){
                echo "<tr>";
                echo "<td>", $row["PRODUCT_NUM"], "</td>";
                echo "<TD>", $row["PRODUCT_NAME"], "</TD>";
                echo "<TD>", $row["PRODUCT_PART"], "</TD>";
                echo "<TD>", $row["INVENTORY"], "</TD>";
                echo "<TD>", $row["ORIGIN"], "</TD>";
                echo "<TD>", $row["COMPANY_NUM"], "</TD>";
                echo "</tr>";
        }
?>

        </table><br><br><br><br><br><br><br><br><br><br>
	<table align="center">
        <tr>
           <td ><input type='text' placeholder="제품이름 입력" name='PRODUCT_NAME' tabindex='1'/></td>
            <td ><input type='text'  placeholder="주문수량" name='ORDER_QUANTITY' tabindex='1'/></td>
            <td rowspan='2'>
            <input type='submit' tabindex='3' value='주문하기' style='height:25px'/>
            </tr>
        </table>

	<footer>
       현재 접속 아이디 : <?php echo "$userID";?>
	<br>
	<br>
        <button><a href='main.html'> 초기화면</a></button>
<?php        
        oci_free_statement($stat);
        oci_close($con);
?>
</body>