<?php
  /* 실제 회원 삭제 처리하는 페이지 */
  ini_set("display_errors", 0); // 디스플레이 에러표시안함.
  $root = $_SERVER['DOCUMENT_ROOT']; 
  require_once("{$root}/member/pdo_member.php");
  require_once("{$root}/tools.php");
  session_check(); //세션체큰
  if($_SERVER['REQUEST_METHOD'] != 'POST' || request_session() == null)msg_backpg('잘못된 접근입니다'); //get방식 값입력 및 url 직접 접근 차단
  //메소드 방식 확인, 세션 확인
  $delete_user = $_POST['delete_user']; // 삭제할 유저 배열 저장
  $count_user = count($delete_user); //회원수저장
  $result = "결과 : ";
  
  if(isset($delete_user)){ //삭제할 유저가 있는지 변수 초기화 확인
    $db = new pdo_member();    
    try{
      for($i=0;$i<$count_user;$i++)  //있을경우 삭제 
      {
        
        $db->signout($delete_user[$i]);
        
      }
    }catch(Exception $e){
        $result = "에러발생";
    }
    $result .= "{$count_user}명 정상탈퇴 처리 되었습니다.";
  }
  else{
    $result .= "대상이 없습니다.";
  }
  
?>

<body>
  <b><?= $result ?></b>&nbsp;
  <form action="/ad/user_ad.php" method="post">
    <input type="hidden" name="ad_key" value="aws">
    <input type="submit" value="확인">
  </form>
</body>