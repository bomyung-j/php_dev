<?php
/* 게시판 글쓰기, 수정을 처리하는 페이지 */
ini_set('display_error',0); //디스플레이 에러 표시 안함.
$root = $_SERVER['DOCUMENT_ROOT'];
require_once("{$root}/bbs/pdo_bbs.php");
require_once("{$root}/tools.php");
session_check(); // 세션 확인

/* 정보 받아옴 */
$bbs_table = $_POST['bbs'];
$num = $_POST['num']; //num의 경우 modify할 경우에만 사용됨.
$name = $_POST['name'];
$title = trim($_POST['title']);
$content = $_POST['content'];
$write_type = $_POST['write_type'];

/* 권한 확인 절차 */
if($_SERVER['REQUEST_METHOD'] != 'POST' || request_session() != $name){
  msg_backpg("적절하지 못한 값이 들어왔습니다.");
}
/* 정상적인 값이 들어왔는지 확인*/
if($title == "" || trim($content) == ""){
  msg_backpg("공백 값이 들어왔습니다.");
}else{
  $db = new pdo_bbs();
  /* 글쓰기인지 수정인지 확인 */
  if($write_type == "write"){
    $db->write_bbs($bbs_table,$name,$title,$content,0); //글 작성
  }else if($write_type =="modify"){
    $db->content_update_bbs($bbs_table,$num,$title,$content); // 글 수정
  }
  msg_locate("처리되었습니다.","/bbs/bbs_main.php?bbs={$bbs_table}"); //작성한 게시판 main으로 이동

}


?>
