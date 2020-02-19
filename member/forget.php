<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
?>
<head>
  <script src="/js/forget.js" type="javascript"></script>
</head>
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
        이메일 입력<input type="text" name ="forget_mail" onblur="button_disable(regular_expression(this.value,'mail'),'forget_do')" required>
        <input type="submit" value="전송" id="forget_do">
    </form>
  </div>
  <div id="box-left">

  </div>
</div>

<?php require_once("{$root}/footer.php");  ?>
</body>
