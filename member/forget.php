<?php
  /* 회원 정보 분실 페이지 */
  $root = $_SERVER['DOCUMENT_ROOT'];
?>

<body>
<?php require_once("{$root}/header.php");?>

<div id="container">
  <div id="box-right">

  </div>
  <div id="box-center" >
    <form action="/member/forget_do.php" method="post">
        찾으실 아이디 / 비밀번호 선택<br>
        아이디<input type="radio" name = "forget_option" value ="id" checked>&nbsp;
        비밀번호<input type="radio" name = "forget_option" value ="pwd"><br>
        이메일 입력<input type="text" name ="forget_mail" onblur="button_disable(regular_expression(this.value,'mail'),'forget_do','규칙에 맞지않아 버튼이 비활성화 됩니다. 다시 입력 해 주세요.')" required>
        <input type="submit" value="전송" id="forget_do">
    </form>
  </div>
  <div id="box-left">

  </div>
</div>

<?php require_once("{$root}/footer.php");  ?>
</body>
