<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  define("PAGE_IN_POST",10); // 한페이지 안에 게시글 수
  require_once("{$root}/tools.php");
  require_once("{$root}/bbs/pdo_bbs.php");
  $db = new pdo_bbs();
  
  $table = $_GET['bbs']; //테이블명 가져옴
  $get_rows = $db->get_rows($table); //전체 테이블크기 값
  
  $page = request_var(); //request page값 가져옴
  
  ($page <= 2) ? $page_numbering = 3 : $page_numbering = $page;

  if($page != 1){
      $start_num = ($page-1)*PAGE_IN_POST;
  }else{
    $start_num = 0;
  }
  
  $result = $db->main_view_bbs($table,$start_num,PAGE_IN_POST);
  $page_count = $get_rows / PAGE_IN_POST;
  $page_count = $page_count - (int)$page_count == 0 ? $page_count : (int)$page_count + 1;

//  echo "현재 게시판명 : {$table} <br>";
//  echo "전체 글 수 : {$get_rows} <br>";
//  echo "현재 글 시작 값 : {$page} <br>";
//  echo "전체 페이지 개수 : {$page_count}";
?>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/bbs.css">
</head>
<body>
<?php  require_once("{$root}/header.php"); ?>

<div id="container">
  <div id="box-right">
     우측
  </div>
  <div id="box-center">
    <a href="/bbs/bbs_main.php?bbs=<?=$table?>"><b><?=request_bbs($table)?></b></a>
    <table id ="bbs-table" class="table table-hover">
      <thead>
        <tr>
          <td>번호</td>
          <td>작성자</td>
          <td>제목</td>
          <td>조회수</td>
          <td>작성일</td>
        </tr>
      </thead>
    <?php foreach($result as $rows) :?>
      <tr>
    
        <td><?= $rows['num'] ?></td>
        <td><?= $rows['name'] ?></td>
        <td>
          <a href="/bbs/bbs_view.php?bbs=<?=$table?>&num=<?=$rows['num']?>">
          <b><?= htmlspecialchars($rows['title']) ?></b>
          </a>
        </td>
        <td><?= $rows['hits'] ?></td>
        <td><?= substr($rows['reg_time'],2,8) ?></td>
    
      </tr>
    <?php endforeach; ?>
    </table>
    
    
        <a class="btn btn-default" href = "/bbs/bbs_main.php?bbs=<?=$table?>&page=1"><<</a>&nbsp;
        
      <?php for($num = $page_numbering-2;$num <= $page_numbering+2;$num++) :?>  
        <?php if($num <= $page_count && $num > 0) : ?>
          <?php if($num == $page) : ?>
            <a class="btn btn-default" href="/bbs/bbs_main.php?bbs=<?=$table?>&page=<?=$num?>"><b><?=$num?></b></a>&nbsp;
          <?php else : ?>
            <a class="btn btn-default" href="/bbs/bbs_main.php?bbs=<?=$table?>&page=<?=$num?>"><?=$num?></a>&nbsp;
          <?php endif?>
    
      <?php endif ?>
      <?php endfor ?>
      
        <a class="btn btn-default" href ="bbs_main.php?bbs=<?=$table?>&page=<?= $page_count?>">>></a>
    
        <form action = "/bbs/bbs_write.php">
          <input type="submit" value="글쓰기">
        </form>
      </div>
  <div id="box-left">
    좌측
  </div>
</div>


<?php require_once("{$root}/footer.php");?>
</body>

