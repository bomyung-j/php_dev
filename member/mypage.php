<?php
  /* 마이페이지 */
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  $name = request_session();
  if(!isset($name))msg_backpg("로그인을 하셔야 확인 가능한 서비스입니다.");
  $db = new pdo_member();
  $member_print = $db->member_check("name",$name);
  $bbs_print = $db->mypage_bbs_print($name);
  
?>
<!doctype html>
<html>
<head>
  <meta-charset = "utf-8">
  <link rel="stylesheet" type="text/css" href="/css/bbs_main.css">
  <script src="/js/tools.js" type="javascript"></script>
</head>
<body>
  <?php require_once("{$root}/header.php");?>

  <div id="container">
    <div id="box-right">

    </div>
    <div id="box-center">

      <span>아이디 : <?=$member_print['id']?></span><br>
      <span>이름 : <?=$member_print['name']?></span><br>
      <span>메일 : <?=$member_print['mail']?></span><br>
      <span>가입일 : <?=$member_print['reg_time']?></span><br><br>
      
      <button class ="btn btn-secondary" type="button" onclick ="div_slide('modify_pw')">비밀번호 변경하기</button>
        <div id="modify_pw" style="display : none;">
          <form action="/member/modify_password.php" method="post">
          현재 비밀번호<input name ="modify_pwd[0]" type="password" placeholder="기존 비밀번호 입력" required><br>
          변경할 비밀번호<input name="modify_pwd[1]" type="password" onblur="button_disable(regular_expression(this.value,'password'),'modify_pwd_btn','규칙이 맞지않아 버튼이 비활성화 됩니다. 다시 입력해주세요.')" placeholder="특수문자 포함 8자리 이상"required><br>
          변경할 비밀번호 재입력<input name ="modify_pwd[2]" type="password" onblur="" placeholder="위와 동일하게 입력" required><br>
          <input id="modify_pwd_btn" type="submit" value ="변경하기" class ="btn btn-primary">
          </form>
        </div>
        <br><br>
        <?php if($member_print['level'] > 0) :?>
          <form action="/ad/user_ad.php" method="post">
            <input type="hidden" name="ad_key" value="aws">
            <input type="submit" class="btn btn-secondary" value="유저관리">
          </form>
        <?php endif?>
        <br><br>
      내가 쓴 글
      <table class="table table-hover">
        <thead>
          <td>게시판명</td>
          <td>제목</td>
          <td>조회수</td>
          <td>작성일시</td>
        </thead>
      <?php foreach($bbs_print as $row):  ?>
          <tr>
            <td><?= request_bbs($row['bbs_name']); ?> </td>
            <td><a href="/bbs/bbs_view.php?bbs=<?=$row['bbs_name']?>&num=<?=$row['num']?>"><b><?= $row['title'];?></b></a></td>
            <td><?= $row['hits']; ?> </td>
            <td><?= $row['reg_time']; ?> </td>
          </tr>
      <?php endforeach; ?>
      </table>
    </div>
    <div id="box-left">

    </div>
  </div>
  <?php require_once("{$root}/footer.php"); ?>
</body>
</html>
