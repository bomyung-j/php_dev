
<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once("{$root}/bbs/pdo_bbs.php");
require_once("{$root}/tools.php");
session_check();

$db = new pdo_bbs();
$table = $_GET['bbs'];
$num = $_GET['num'];
$result = $db->content_view_bbs($table,$num);

if(request_session() != $result['name']){ // 어드민 권한도 가능하게 만들기
  msg_backpg("수정 할 권한이 없습니다.");
}

 ?>
 <head>
   <link rel="stylesheet" type="text/css" href="/css/bbs_write.css">
 </head>
<body>
<?php require_once("{$root}/header.php");?>
<div id="container">
  <div id="box-left">
  </div>
  <div id="box-center">
      <b style="font-size : 25px;">글수정</b>
    <form action ="bbs_modify_do.php" method="post">
      <input type="hidden" name="num" value="<?= $num ?>">
      <input type="hidden" name="bbs" value="<?= $table ?>">
      <div class="bbs-write-inner-style">
        <table>
          <tr>
            <td>게시판명</td><td><input type="text" value ="<?= request_bbs($table)?>" readOnly></td>
          </tr>
          <tr>
            <td>작성자</td><td><input type="text" name="name" value="<?= $result['name'] ?>" readOnly></td>
          </tr>
          <tr>
            <td>제목</td><td><input type="text" value = "<?= $result['title'] ?>"name="title" required autofocus></td>
          </tr>
          </table>
      </div>
      <textarea name="content" required><?= $result['content'] ?></textarea>
      <br>
      <input class ="btn btn-primary" type="submit" value="수정완료">
    </form>
  </div>
  <div id="box-right">
  </div>

</div>
<?php require_once("{$root}/footer.php");?>
</body>
