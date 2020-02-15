<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("header.php");
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
      <div>
        <img class="mySlides 1" src="/img/mainpage1.jpg">
      </div>  
        <img class="mySlides 2" src="/img/mainpage2.jpg">
        <img class="mySlides 3" src="/img/mainpage3.jpg">
      
      주간 인기 모임<br>새로운 글?
    </div>
    <div id="box-left">
      
    </div>
  </div>
</body>
<?php
  require_once("footer.php");
?>