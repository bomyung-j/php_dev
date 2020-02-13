<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  $name = request_session();
  $db = new pdo_member();
  $member_print = $db->mypage_member_print($name);
  $bbs_print = $db->mypage_bbs_print($name);

?>
<!doctype html>
<html>
<head>
  <meta-charset = "utf-8">
  <link rel="stylesheet" type="text/css" href="/css/bbs.css">
</head>
<body>
  <?php require_once("{$root}/header.php");?>
  
  <div id="container">
    <div id="box-right">
       우측
    </div>
    <div id="box-center">
      <span>아이디 : <?=$member_print['id']?></span><br>
      <span>이름 : <?=$member_print['name']?></span><br>
      <span>메일 : <?=$member_print['mail']?></span><br>
      <span>가입일 : <?=$member_print['reg_time']?></span><br><br>
      내가 쓴 글
      <table class="table table-hover">
        <tr>
          <td>게시판명</td>
          <td>제목</td>
          <td>조회수</td>
          <td>작성일시</td>
        </tr>
      <?php foreach($bbs_print as $row):  ?>
          <tr>
            <td><?= $row['bbs']; ?> </td>
            <td><a href="/bbs/bbs_view.php?bbs=<?=$row['bbs']?>&num=<?=$row['num']?>"><b><?= $row['title'];?></b></a></td>
            <td><?= $row['hits']; ?> </td>
            <td><?= $row['reg_time']; ?> </td>
          </tr>
      <?php endforeach; ?>
      </table>
    </div>
    <div id="box-left">
      좌측
    </div>
  </div>
  <?php require_once("{$root}/footer.php"); ?>
</body>
</html>
