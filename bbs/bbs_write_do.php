<?php

  require_once("pdo_bbs.php");
  require_once("../tools.php");
  $bbs_table = $_POST['bbs_table'];
  $name = $_POST['name'];
  $title = trim($_POST['title']);
  $content = $_POST['content'];
//  $prepage = $_SERVER['HTTP_REFERER']; //이전페이지
  // print_r($_POST);
  // echo "<br>";
  // echo $_POST['bbs_table'];
  //if(preg_replace("/\s+/", "", $title) == ""){

  //앞뒤공백을 제거한 제목이 아무것도 없는 값이 들어올 경우
  if($title == ""){
    msg_backpg("제목을 입력하세요");
  }else{
  $db = new pdo_bbs();
  $db->write_bbs($bbs_table,$name,$title,$content,0);
  header("location: bbs_main.php?bbs={$bbs_table}");
}


?>
