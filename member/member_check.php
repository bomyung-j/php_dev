<?php
  /* 회원정보 전달용 페이지 (로그인, 중복체크) */
  header("Content-Type: application/json");//보내는 데이터 타입 json으로
  $root = $_SERVER['DOCUMENT_ROOT']; //서버 경로 를 변수화
  ini_set('display_errors',0); //에러 화면 표시 안함.
  require_once("{$root}/tools.php"); //세션확인을 위해 tools를 불러옴
  require_once("pdo_member.php"); // pdo객체 사용위해 pdo불러옴
  session_check(); //세션 확인 함수
  $db = new pdo_member(); //pdo 객체 생성

  
  //Json.stringify 함수로 받은걸  배열형태로 다시 변환
  $objdata = $_POST['objdata'];
  $objdata = json_decode($objdata);
  
  $type = $objdata->type; //로그인인지 아이디 / 이름 중복체크인지 확인.

  /* 로그인 or 아이디 중복 체크*/
  if($type == "login_try" || $type == "id_overlap_check"){
    $id = $objdata->id;
    $pw = $objdata->pw;
    $result = $db->member_check("id",$id);
    if($result){
      if(password_verify($pw,$result['pw'])){
        $_SESSION['name'] = $result['name'];
        echo json_encode(array("name" => $result['name'],"value" => "1"));//비밀번호 맞음
      }else{
        echo json_encode(array("value" => "0"));  //비밀번호 틀림
      }
    }else{
        echo json_encode(array("value" => "2")); //사용가능 아이디
    }
    /* 이름, 메일 중복 체크 result가 있을경우 이미 있는 값이므로 사용 불가능*/
  }else if($type == "name_overlap_check"){
    $name = $objdata->name;
    $result = $db->member_check("name",$name);
    if($result){
        echo json_encode(array("value" => "0")); // 사용 불가능
    }else{
        echo json_encode(array("value" => "1")); //사용가능
    }
  }else{
    $mail = $objdata->mail;
    $result = $db->member_check("mail",$mail);
    if($result){
        echo json_encode(array("value" => "0")); //사용 불가능
    }else{
        echo json_encode(array("value" => "1")); //사용가능
    }

  }


/*
  $pw = $objdata->pw;

  $result = $db->member_login($id);
if($result){
    if($pw == $result['pw']){
      $_SESSION['name'] = $result['name']; //세션등록
      echo(json_encode(array("name" => $result['name'],"flag" => "login", "value" => "1")));
    }
    else{
      echo(json_encode(array("name" => null,"flag" => "login", "value" => "0")));
    };
}else{
    echo json_encode(array("name" => null,"flag" => "overlap_check", "value" => "1"));
}
*/
  ?>
