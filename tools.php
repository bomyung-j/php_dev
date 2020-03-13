<?php
//세션이 시작되지 않았으면 시작하는 함수
  function session_check(){
    if(session_status() == PHP_SESSION_NONE){
      session_start();
    }
  }
  //현재 페이지값을 가져오는 함수
  function request_page(){
      return isset($_REQUEST['page']) ? $_REQUEST['page'] : $_REQUEST['page'] = "1";

  }
  //현재 세션값을 가져오는 함수
  function request_session(){
    return isset($_SESSION['name']) ? $_SESSION['name'] : null;
  }
  //메세지를 보내며 url로 이동하는 함수
  function msg_locate($msg,$url){
  ?>
    <script>
      alert('<?= $msg?>');
      location.href = '<?=$url?>';
    </script>
    <?php
  
    exit();
  }
//메세지를 보내며 이전페이지로 이동하는 함수
  function msg_backpg($msg){
      ?>
      <script>
        alert('<?= $msg ?>');
        history.back();
      </script>
      <?php
      exit();
  }
//  function session_name(){
//    return isset($_SESSION['name']) ? $_SESSIOON['name'] : $_SESSION['name'] ="null";
//  }
//각 게시판 이름에 맞게 돌려주는 함수
  function request_bbs($bbs){
      if($bbs == "bbs_notice"){
        return "공지사항";
      }
      else if($bbs == "bbs_free"){
        return "자유게시판";
      }
      else if($bbs == "bbs_study"){
        return "스터디 게시판";
      }
      else if($bbs == "bbs_mountain"){
        return "등산 게시판";
      }
      else if($bbs == "bbs_trip"){
        return "여행 게시판";
      }
      else if($bbs == "bbs_other"){
        return "기타";
      }

  }
?>
