<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  session_check();
  isset($_SESSION['name']) ? : msg_backpg("로그인이 필요한 서비스입니다.","/index.php"); 
  
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <script src="../js/tools.js"></script>
</head>
<body>
  <?php require_once("{$root}/header.php"); ?>
  <div id="container">
    <div id="box-right">
       우측
    </div>
    <div id="box-center">
      
      <form action ="bbs_write_do.php" method="POST">
        게시판명 : <select name ="bbs_table">
                    <option value="bbs_notice">공지사항</option>
                    <option value="bbs_free">자유게시판</option>
                  </select>
        <br>
        작성자 : <input type="text" name="name" value="<?= $_SESSION['name'] ?>" readOnly>
        <br>
        제목 : <input type="text" name="title" required autofocus>
        <br>
        내용 : <textarea name="content" required></textarea>
        <br>
        <input type="submit" value="작성">
      </form>
      
    </div>
    <div id="box-left">
      좌측
    </div>
  </div>
  <?php require_once("{$root}/footer.php"); ?>
</body>
</html>