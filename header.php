<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once("{$root}/tools.php");
session_check();
ini_set('display_errors',0);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/css/main.css">
<link rel="stylesheet" type="text/css" href="/css/container.css"> 

<script src="/js/tools.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</head>
<body>

  <div id="header-top">
    
    <button style ="float : left; width : 200px" class = "btn btn-danger" type="button" onclick="location.href('/introduce.php')">소개페이지</button>

<!-- 세션활성화시 div -->
    <div id ="session_layer">
        <b id = "session_id"><?= request_session();?></b>
        <div id="logout_form">
          <button class = "btn btn-primary" type="button" onclick="msg_yesno_mvpg('로그아웃 하시겠습니까?','/unset.php')">로그아웃</button>
          <button class = "btn btn-primary" type="button" onclick="location.href('/member/mypage.php')">마이페이지</button>
        </form>
      </div>
      
    </div>

<!-- 로그인 회원가입 버튼-->

    <div id = "button_layer">
      <button class = "btn btn-primary" id = "login_button" type="button" onclick ="modal_on(this)">로그인</button>
      <button class = "btn btn-primary" id = "signup_button" type="button" onclick ="modal_on(this)">회원가입</button>
      <button class = "btn btn-primary" id = "forget_button" type="submit" onclick ="location.href='/member/forget.php'">아이디/패스워드찾기</button>
    </div>
  </div>



<!-- 로그인 및 회원가입 div-->
<div id="modal_layer">
  
  <!-- 로그인 div -->
  <div id="modal_layer_login">
    <center><b style="font-size : 40px;">Login</b></center>
    <br>
    <form>
      id : <input type="text" id="pid"><br>
      pw : <input type="password" id="ppwd">
    </form>
    
      <button type="button" id="modal_login" onclick="modal_login_signup(this)">확인</button>
      <button type="button" onclick ="modal_off(this)">닫기</button>
  </div>

  <!-- 회원가입 div -->
  <div id="modal_layer_signup">
      <center><b style="font-size : 40px;">Sign up</b></center>
      <br><br>
    <form style ="font-size : 20px;">
      name :  <input type="text" id="signname" onblur="modal_login_signup(this)" placeholder = "한/영 3글자 이상 입력">&nbsp;<span id="name_overlap_check_tag"></span><br>
      id : <input type="text" id="signid" onblur="modal_login_signup(this)"  placeholder ="영문 4글자 이상 입력"> &nbsp;<span id="id_overlap_check_tag"></span>
      <span id ="overlap_check_value"></span>
      <br>
      pw : <input type="password" id="signpwd" placeholder ="특수문자 포함 8자리 이상">&nbsp;<span id="pw_overlap_check_tag"></span><br>
      mail : <input type="text" id="signmail" onblur ="modal_login_signup(this)" placeholder = "ex) admin@naver.com">&nbsp;<span id="mail_overlap_check_tag"></span><br>
    </form>
  
      <button type="button" id="modal_signup" onclick="modal_login_signup(this)">확인</button>
      <button type="button" onclick ="modal_off(this)">닫기</button>
    
  </div>
  
</div><!-- 회원가입로그인 div 끝 -->
<br><br>

<!-- 로고 -->
<center><a href="/index.php"><img src="/img/logo.png" style="width : 200px; height : 80px;"></a></center></p><br>

<!-- gnb항목 -->
<div class ="gnb">
  <div id = "gnb-content">
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_notice">&nbsp;공지사항&nbsp;</a>&nbsp;&nbsp;
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_free">&nbsp;자유게시판&nbsp;</a>&nbsp;&nbsp;
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_study">&nbsp;스터디&nbsp;</a>&nbsp;&nbsp;
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_mountin">&nbsp;등산&nbsp;</a>&nbsp;&nbsp;
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_trip">&nbsp;여행&nbsp;</a>&nbsp;&nbsp;
    <a class ="gnb-link" href="/bbs/bbs_main.php?bbs=bbs_other">&nbsp;기타&nbsp;</a>
  </div>
</div>

</body>
<script type="text/javascript" src="/js/bootstrap.js"></script>
</html>
