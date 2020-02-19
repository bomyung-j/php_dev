<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  
  require_once("{$root}/member/pdo_member.php");
  require_once("{$root}/mail/send_mail.php");
  require_once("{$root}/tools.php");
  
  $db = new pdo_member();
  
//  var_dump($_POST);
  $mail = $_POST['forget_mail'];
  $option = $_POST['forget_option'];
  $result = $db->member_check("mail",$mail);
  
  if(!$result)
    msg_backpg('해당하는 이메일이 없습니다.');
    
  
  if($option == "id"){
    $msg = "찾으시는 아이디는 {$result['id']}입니다."; //아이디 전송
  }else if($option == "pwd"){
    $tp_pw = substr($result['pw'],1,8); //기존 암호화된 비밀번호값 앞부분 잘라옴.  
    $msg = "임시 비밀번호는 {$tp_pw} 입니다. <br> 로그인 후 변경해주세요.";
    $tp_pw = password_hash($tp_pw,PASSWORD_DEFAULT); // 잘라온걸 다시 암호화해서 변경
    $db->password_ini($tp_pw,"mail",$mail); //비밀번호 업데이트
  }
  send_mail($mail,$msg,$result['name']); //메일 전송 
  msg_movepg('정상 처리 되었습니다.',"/unset.php"); //메세지 전송

  
?>