<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once("{$root}/bbs/pdo_bbs.php");
require_once("{$root}/tools.php");
session_check();

$bbs_table = $_POST['bbs'];
$name = $_POST['name'];
$title = trim($_POST['title']);
$content = $_POST['content'];

if($_SERVER['REQUEST_METHOD'] != 'POST' || request_session() != $name){
  msg_backpg("적절하지 못한 값이 들어왔습니다.");
}
if($title == "" || trim($content) == ""){
  msg_backpg("공백 값이 들어왔습니다.");
}else{
$db = new pdo_bbs();
$db->write_bbs($bbs_table,$name,$title,$content,0);
header("location: /bbs/bbs_main.php?bbs={$bbs_table}");
}


?>
