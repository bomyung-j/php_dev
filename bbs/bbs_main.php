<?php
  /* 게시판 메인 페이지*/
  $root = $_SERVER['DOCUMENT_ROOT'];
  define("PAGE_IN_POST",10); // 한페이지 안에 게시글 수
  require_once("{$root}/bbs/pdo_bbs.php");
  require_once("{$root}/member/pdo_member.php");
  require_once("{$root}/tools.php");
  
  $member_db = new pdo_member();
  $bbs_db = new pdo_bbs();
  
  session_check();
  $name = request_session(); //세션값 받아옴
  $access = $member_db->member_check("name",$name); //세션값을 통해 관련정보 저장
  
  $table = $_GET['bbs']; //테이블명 가져옴
  $get_rows = $bbs_db->get_rows($table); //전체 테이블크기 값
  
  $page = request_page(); //현재 페이지번호 가져옴
  
  ($page <= 2) ? $page_numbering = 3 : $page_numbering = $page;
  // 페이지 번호가 2 이하이면 페이지 넘버링을 3, 아닐경우 페이지값으로 지정
  
  if($page != 1){
      $start_num = ($page-1)*PAGE_IN_POST;
  }else{
    $start_num = 0;
  }//페이지가 1이 아닐경우 (한페이지당 출력 게시물수) * (패이지번호 - 1) 아닐경우 0으로 지정.
  
  $page_content = $bbs_db->main_view_bbs($table,$start_num,PAGE_IN_POST);
  //화면에 출력할 게시물을 받아옴.
  $page_count = $get_rows / PAGE_IN_POST; 
  $page_count = $page_count - (int)$page_count == 0 ? $page_count : (int)$page_count + 1;
  // 전체 페이지 넘버 계산
?>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/bbs_main.css">
</head>
<body>
<?php  require_once("{$root}/header.php"); ?>

<div id="container">
  <div id="box-right">

  </div>
  <div id="box-center">
    <a href="/bbs/bbs_main.php?bbs=<?=$table?>"><b>[<?=request_bbs($table)?>]</b></a>
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
    <!-- 게시글 표시 항목-->  
    <?php foreach($page_content as $rows) :?> 
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
    <!-- 게시글 표시 끝-->
    
    <!-- 맨 앞 페이지 링크 << -->
    <a class="btn btn-default" href = "/bbs/bbs_main.php?bbs=<?=$table?>&page=1"><<</a>&nbsp;
    
    <!-- 1 ~ 3 페이지 까지는 page_numbering을 3으로 지정함. 그리고 page_numbering 플마(2) 값 만큼 넘버 표시 -->
    <!-- ex) page가 1이면 넘버 표시는 1(굵음, 선택됨) 2 3 4 5로 표시, 4일경우 2 3 4(굵음, 선택됨) 5 6 로 표시.-->
    <!-- 페이지 넘버링 시작-->
      <?php for($num = $page_numbering-2;$num <= $page_numbering+2;$num++) :?>
        <?php if($num <= $page_count && $num > 0) : ?>
          <?php if($num == $page) : ?>
            <a class="btn btn-default" href="/bbs/bbs_main.php?bbs=<?=$table?>&page=<?=$num?>"><b><?=$num?></b></a>&nbsp;
          <?php else : ?>
            <a class="btn btn-default" href="/bbs/bbs_main.php?bbs=<?=$table?>&page=<?=$num?>"><?=$num?></a>&nbsp;
          <?php endif?>

      <?php endif ?>
      <?php endfor ?>
      <!-- 맨 끝 페이지 표시-->
      <a class="btn btn-default" href ="bbs_main.php?bbs=<?=$table?>&page=<?= $page_count?>">>></a>
    <!-- 페이지 넘버링 끝 -->
      
        <!-- 권한에 따른 공지사항 작성 버튼 생성 여부-->
       <?php if($table != "bbs_notice" || ($table == "bbs_notice" && $access['level'] >0)) : ?>
        <form action = "/bbs/bbs_write.php">
          <input type="submit" value="글쓰기">
        </form>
      <?php endif ?>
      </div>
      
  <div id="box-left">

  </div>
</div>


<?php require_once("{$root}/footer.php");?>
</body>
