<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  $name = request_session();
  $modify_var = $_POST['modify_pwd'];
  $now_pw = $modify_var[0];
  
  if($modify_var[1] != $modify_var[2]){
      echo "1번 : {$modify_var[1]} 2번 : {$modify_var[2]}";
      msg_backpg("변경할 비밀번호가 서로 맞지 않습니다.");
  }
  
  $db = new pdo_member();
  $db_var = $db->member_check("name",$name);
  if(!password_verify($now_pw,$db_var['pw'])){
      msg_backpg("현재 비밀번호가 틀립니다.");
  }else{ 
   $pw = password_hash($modify_var[1],PASSWORD_DEFAULT);
   $db->password_ini($pw,"name",$name);
   msg_locate("비밀번호 변경이 완료되었습니다. 다시 로그인 해주세요.","/unset.php");
   //header("location: /unset.php");
 }
?>