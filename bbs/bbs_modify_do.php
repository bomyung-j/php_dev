<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once("{$root}/bbs/pdo_bbs.php");
require_once("{$root}/tools.php");

$table = $_POST['bbs'];
$num = $_POST['num'];
$title = trim($_POST['title']);
$content = $_POST['content'];

if($title == "" || trim($content) == ""){
  msg_backpg("공백 값을 입력 하셨습니다.");
}else{  
  $db = new pdo_bbs();
  $db->content_update_bbs($table,$num,$title,$content);
  header("Location: /bbs/bbs_main.php?bbs={$table}");
}
?>
