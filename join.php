<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원 가입</title>
 </head>
 <body>
    <form method="post" action = "insert_result.php">
        <table width="940" style="padding:5px 0 5px 0; ">
            <tr height="2" bgcolor="red"><td colspan="2"></td></tr>
            <tr>
                <th> 이름</th>
                <td><input type="text" name="userName"></td>
            </tr>
      
            <tr>
                <th>아이디</th>
                <td><input type="text" name="userID"></td>
            </tr>
            <tr>
                <th>비밀번호</th>
                <td><input type="password" name="userPW"> 영문/숫자포함 6자 이상</td>
            </tr>
            <tr>
                <th>주소</th>
                <td>
                    <input type="text"  name="addr" size = "30" >
                </td>
            </tr>
            <tr height="2" bgcolor="red"><td colspan="2"></td></tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="회원가입">
                    <input type="reset" value="취소">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
