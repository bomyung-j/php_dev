<?php
  function session_check(){
    if(session_status() == PHP_SESSION_NONE){
      session_start();
    }
  }
  function request_var(){
      return isset($_REQUEST['page']) ? $_REQUEST['page'] : $_REQUEST['page'] = "1";
      
  }
  function request_session(){
    return isset($_SESSION['name']) ? $_SESSION['name'] : "";
  }

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
  function request_bbs($bbs){
      if($bbs == "bbs_notice"){
        return "공지사항";
      }
      else if($bbs == "bbs_free"){
        return "자유게시판";
      }
      else if($bbs == "bbs_study"){
        return "스터디";
      }
      else if($bbs == "bbs_mountin"){
        return "등산";
      }
      else if($bbs == "bbs_trip"){
        return "여행";
      }
      else if($bbs == "bbs_other"){
        return "기타";
      }
    
  }
?>
