<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/bbs/pdo_bbs.php");
  $db = new pdo_bbs();
  $table = $_GET['bbs'];
  $num = $_GET['num'];

  $db->content_count_bbs($table,$num);
  $content = $db->content_view_bbs($table,$num);
?>
<head>
  <script src="/js/tools.js"></script>
  <script src="/js/bbs.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/bbs.css">
</head>


<body>

  <?php require_once("{$root}/header.php"); ?>
  <div id="container">
    <div id="box-right">
       우측
    </div>
    <div id="box-center">
      작성자 : <a id="name"><?=$content['name']?></a>
      번호 : <a id="num"><?=$num?></a><br>
      게시판명 : <a id="bbs"><?= $table ?></a><br>
      제목 : <?= htmlspecialchars($content['title']); ?><br>
      내용 : <?= htmlspecialchars($content['content']); ?> <br>
      <div class="my-2">
      <a class="btn btn-danger" onclick="bbs_content_delete()">글 삭제</a>
      <a class="btn btn-primary" onclick="bbs_content_delete()">글 수정</a>
      </div>

    </div>
    <div id="box-left">
      좌측
    </div>
  </div>

  <?php require_once("{$root}/footer.php"); ?>
</body>
