<?php
  /* 게시판 글쓰기 페이지*/
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  $name = request_session();
  $name != null?:msg_backpg("로그인이 필요한 서비스 입니다.");//세션 로그인 체크
  $member_db = new pdo_member();
  $access = $member_db->member_check("name",$name);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/bbs_write.css">
  <script src="/js/tools.js"></script>
</head>
<body>
  <?php require_once("{$root}/header.php"); ?>
  <div id="container">
    <div id="box-right">

    </div>
    <div id="box-center">
          <b style="font-size : 25px;">글쓰기</b>
          <form action ="bbs_write_do.php" method="POST">
          <input type="hidden" name ="write_type" value ="write">
      <div class = "bbs-write-inner-style">
        <table>
            <tr>
            <td>게시판명</td>
                    <td><select name ="bbs" required>
                        <option value>게시판을 선택해주세요</option>
                        <option value="bbs_free">자유게시판</option>
                        <option value="bbs_study">스터디</option>
                        <option value="bbs_mountain">등산</option>
                        <option value="bbs_trip">여행</option>
                        <option value="bbs_other">기타</option>
                        <?php if($access['level'] > 0) : //관리자 권한일경우 공지 선택가능?>
                          <option value="bbs_notice">공지사항</option>
                        <?php endif ?>
                      </select></td>
            </tr>
            <tr>
              <td>작성자</td>
              <td><input type="text" name="name" value="<?= $_SESSION['name'] ?>" readOnly></td>
            </tr>
            <tr>
              <td>제목</td>
              <td><input type="text" name="title" required autofocus></td>
            </tr>
        </table>
      </div>
            <textarea name="content" required></textarea>
            <input class ="btn btn-primary" type="submit" value="작성">
            </form>
            
    </div>
    <div id="box-left">

    </div>
  </div>
  <?php require_once("{$root}/footer.php"); ?>
</body>
</html>
