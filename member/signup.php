<?php
  header("Content-Type: application/json");
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/mail/send_mail.php");
  require_once("{$root}/member/pdo_member.php");
  $objdata = json_decode($_POST['objdata']);
  $signname = $objdata->signname;
  $signid = $objdata->signid;
  $signpwd = $objdata->signpwd;
  $signpwd = password_hash($signpwd,PASSWORD_DEFAULT);
  $signmail = $objdata->signmail;
  
  // 
  // "{$signname} : 이름","<br>";
  // "{$signid} : 아이디","<br>";
  // "{$signpwd} : 비밀번호","<br>";
  // "{$signmail} : 메일","<br>";
  // 
  
  $db = new pdo_member();
try{
  $db->signup($signid,$signpwd,$signname,$signmail);
  $msg = "이메일 회원가입을 축하합니다. http://15.164.162.105/";
  send_mail($signmail,$msg,$signname);
}catch(Exception $e){
  echo(json_encode(array("value" => "0","flag" => "signup")));
}
  echo(json_encode(array("value" => "1","flag" => "signup")));
  
?>