<?php
  /* 게시판 내용 보기 페이지*/
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/bbs/pdo_bbs.php");
  $db = new pdo_bbs();
  $table = $_GET['bbs'];
  $num = $_GET['num'];
  
  $db->content_count_bbs($table,$num); //게시글 조회수 증가시킴
  $content = $db->content_view_bbs($table,$num); // 게시글 내용 가져옴
?>
<head>
  <script src="/js/tools.js"></script>
  <script src="/js/bbs_view.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/bbs_view.css">
</head>


<body>

  <?php require_once("{$root}/header.php"); ?>
  <div id="container">
    <div id="box-right">

    </div>
    <div id="box-center">
      <div class="bbs-view-div">
        <table style="width: 100%;">
          <!-- [게시판명] 제목 표시-->
          <thead>
            <td><a href="/bbs/bbs_main.php?bbs=<?=$table?>"><b>[<?=request_bbs($table)?>]</b></a> &nbsp;<?= htmlspecialchars($content['title']); //xss방지 ?></td>
          </thead>
          <!-- 작성자, 조회수 표시-->
          <tr>
            <td id="bbs-view-info"><i>작성자 : <a id="name"><?=$content['name']?>&nbsp;/&nbsp;조회수 : <?=$content['hits']?>&nbsp;/&nbsp;작성시간 : <?=substr($content['reg_time'],5,11)?></a></i></td>
          </tr>
        </table>
          <br>
          <!-- 내용 표시-->
            <?= htmlspecialchars($content['content']); //xss방지?>
      </div>  
      <!-- 글 삭제, 수정 버튼-->
      <button class="btn btn-danger" onclick="bbs_content_delete('<?=$table?>','<?=$num?>','<?=$content['name']?>')">글 삭제</button>
      <button class="btn btn-primary" onclick="location.href='./bbs_modify.php?bbs=<?=$table?>&num=<?=$num?>'">글 수정</button>
    </div>
    <div id="box-left">

    </div>
  </div>

  <?php require_once("{$root}/footer.php"); ?>
</body>
