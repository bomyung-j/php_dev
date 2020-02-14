<head>
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="/js/index.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/index.css">
  
</head>
<body>
  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once("header.php");
  ?>
  <div id="container">
    <div id="box-right">
       우측
    </div>
    <div id="box-center" >
      <img src="/img/mainpage2.jpg" style = "width : 100%; height : 250px;">
      주간 인기 모임<br>새로운 글?
    </div>
    <div id="box-left">
      좌측
    </div>
  </div>
</body>
<?php
  require_once("footer.php");
?>