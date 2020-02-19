
<?php

function send_mail($to_mail,$msg,$name){
    
  require_once("class.phpmailer.php");

  $mail=new PHPMailer(true);

  $title = "제목";
  $from_mail="보낼 메일명";
  $pass="메일비밀번호";
  $smtp="smtp서버주소";	

  
  try{
    		
  $mail->IsSMTP();  
  //$mail->SMTPDebug = 2; 테스트 할때만 로그출력. json방식으로 받아야함으로 실사용시에는 미사용
  $mail->Host=$smtp;		
  $mail->SMTPAuth=true;		
  $mail->Port=465;		
  $mail->SMTPSecure="ssl";		
  $mail->Username=$from_mail;		
  $mail->Password=$pass;	
  $mail->CharSet = "UTF-8";	
  $mail->SetFrom($from_mail);		
  $mail->AddAddress($to_mail);		
  $mail->Subject=$title;		
  $mail->MsgHTML($msg);		
  
  $mail -> SMTPOptions = array(
      "ssl" => array(
            "verify_peer" => false
          , "verify_peer_name" => false
          , "allow_self_signed" => true
      )
  );
  
  $mail->Send();	
  	
  }	catch (phpmailerException $e){		
  echo $e->errorMessage();	
  }	catch (Exception $e){		
  echo $e->getMessage();	
  }


}
?>
