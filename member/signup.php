<?php
  /* 회원가입 처리 페이지 */
  header("Content-Type: application/json");
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/mail/send_mail.php");
  require_once("{$root}/member/pdo_member.php");
  $objdata = json_decode($_POST['objdata']); //json 타입으로 받은 값을 연관 배열형태로 저장
  $signname = $objdata->signname;  // 이름 저장
  $signid = $objdata->signid;     // id 저장
  $signpwd = $objdata->signpwd;   //패스워드 저장
  $signpwd = password_hash($signpwd,PASSWORD_DEFAULT); //패스워드 암호화
  $signmail = $objdata->signmail; // 메일 저장
  

  $db = new pdo_member();
try{
  $db->signup($signid,$signpwd,$signname,$signmail);
  $msg = "이메일 회원가입을 축하합니다. http://15.164.162.105/";
  send_mail($signmail,$msg,$signname); //메일전송
}catch(Exception $e){
  echo(json_encode(array("value" => "0","flag" => "signup"))); //오류가 나올경우 실패를 전달
}
  echo(json_encode(array("value" => "1","flag" => "signup"))); //성공 전달
  
?>