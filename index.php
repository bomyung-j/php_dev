<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("header.php");
  require_once("{$root}/bbs/pdo_bbs.php");
  $bbs_db = new pdo_bbs();
  $recent_bbs = $bbs_db->recent_bbs_print();
?>
<head>
  <script type="text/javascript" src="/js/index.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/index.css">
</head>
<body>
 <!--  헤더 require함 -->
  <div id="container">
    <div id="box-right">

    </div>
    <div id="box-center" >
        <!-- 이미지 슬라이드-->
        <img class="mySlides 1" src="/img/mainpage1.jpg">
        <img class="mySlides 2" src="/img/mainpage2.jpg">
        <img class="mySlides 3" src="/img/mainpage3.jpg">
        
        <!-- 최근글, 인기글 항목 -->
        <div class = "index-container">
          
          <div id ="index-1">
            <br><b>[최근글]</b><br>
          <ul>
              <?php foreach($recent_bbs as $rows) :?>
                <li>
                  <a href="/bbs/bbs_view.php?bbs=<?=$rows['bbs_name']?>&num=<?=$rows['num']?>">
                  <b><?= $rows['title']?> (<?=$rows['hits']?>)</b>
                  </a>
              </li>
              <?php endforeach; ?>
          </ul>
          </div>
          <!-- 추후 화면 분할 예정
          <div id="index-2">
              
          </div>
        -->
        </div>

    </div>
    <div id="box-left">

    </div>
  </div>
</body>
<?php
  require_once("footer.php");
?>
