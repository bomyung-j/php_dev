<?php
  /* 게시글 삭제 처리 페이지*/
  $root = $_SERVER['DOCUMENT_ROOT'];
  header("Content-Type: application/json");
  require_once("{$root}/tools.php");
  require_once("{$root}/bbs/pdo_bbs.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  
  $member_db = new pdo_member();
  $bbs_db = new pdo_bbs();
  
  
  $data = $_POST['data']; //ajax통신을 통해 받은 json데이터 저장
  $data = json_decode($data); //배열형태로 변환
  
  $s_name = request_session(); //세션값 가져옴
  $b_name = $data->name; //글쓴이 가져옴
  
  $access = $member_db->member_check("name",$s_name);//관리자인지 확인하기위해 값 받아옴.
  
  $table = $data->table;
  $num = $data->num;
  
  if($s_name == $b_name || $access['level'] > 0){ //글쓴이 이거나 관리자이면 삭제
      $bbs_db->content_delete_bbs($table,$num);
      echo json_encode(array("result" => "삭제되었습니다.", "value" => 1));
  }else{//아닐경우 권한없음.
      echo json_encode(array("result" => "삭제 할 권한이 없습니다.", "value" => 0));
  }
  
?>