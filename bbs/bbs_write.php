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
        게시판명 : <select name ="bbs_table" required>
                    <option value>게시판을 선택해주세요</option>
                    <option value="bbs_free">자유게시판</option>
                    <option value="bbs_study">스터디</option>
                    <option value="bbs_mountain">등산</option>
                    <option value="bbs_trip">여행</option>
                    <option value="bbs_other">기타</option>
                  </select>
        <br>
        작성자 : <input type="text" name="name" value="<?= $_SESSION['name'] ?>" readOnly>
        <br>
        제목 : <input type="text" name="title" required autofocus>
        <br>
        <textarea name="content" style="height : 400px; width : 800px;" required></textarea>
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