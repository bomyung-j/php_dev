<?php
  header("Content-Type: application/json");
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/member/pdo_member.php");
  $objdata = json_decode($_POST['objdata']);
  $signname = $objdata->signname;
  $signid = $objdata->signid;
  $signpwd = $objdata->signpwd;
  $signpwd = password_hash($signpwd,PASSWORD_DEFAULT);
  $signmail = $objdata->signmail;
  
  // 
  // echo "{$signname} : 이름","<br>";
  // echo "{$signid} : 아이디","<br>";
  // echo "{$signpwd} : 비밀번호","<br>";
  // echo "{$signmail} : 메일","<br>";
  // 
  
  $db = new pdo_member();
  $db->signup($signid,$signpwd,$signname,$signmail);
  
  echo(json_encode(array("value" => "1","flag" => "signup")));
  
?>