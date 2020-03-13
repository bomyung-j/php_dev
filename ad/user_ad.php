<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  
  session_check();
  $page = request_page();
  if($_SERVER['REQUEST_METHOD'] != 'POST' || $_POST['ad_key'] != "aws" || request_session() == null)msg_backpg('잘못된 접근입니다');
   //get방식 값입력 및 url 직접 접근 차단, key값 확인
  
  $db = new pdo_member();
  $member = $db->ad_member_print();
  $member_count = $db->member_count();
?>
<!doctype html>
<head>
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="/js/user_ad.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/user_ad.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/bbs_main.css">
</head>
<body>
  유저관리중 : <?= request_session()?>님 <br>
  총 유저 : <?= $member_count ?>명<br>
  <a href="/index.php"><b style="color : blue">사이트로 이동</b></a><br><br>
  <div class="user-table">
    <form action="/ad/user_ad_do.php" method="post">
      <b>유저이름으로 검색하기</b>
    <table class ="table">
     <thead>
       <td>삭제여부</td>
       <td>유저번호</td>
       <td>유저id</td>
       <td>유저이름</td>
       <td>이메일</td>
       <td>가입일시</td>
       <td>권한레벨</td>
     </thead>
       <tbody id="find_table">
         
       </tbody>
    </table>
    
    <input type="text" id="name"><button type="button" class="btn btn-primary" onclick="find_user()">찾기</button>
    
    <br><br>
    
    <b>여러유저 삭제</b>
    <table class ="table">
      <thead>
        <td>삭제여부</td>
        <td>유저번호</td>
        <td>유저id</td>
        <td>유저이름</td>
        <td>이메일</td>
        <td>가입일시</td>
        <td>권한레벨</td>
      </thead>
      <?php foreach($member as $rows):?>
        <tr>
          <td>
          <?php if($rows['level'] == 0) :?> <!--관리자는 삭제못하도록 설정 -->
            <input type="checkbox" name ="delete_user[]" value="<?=$rows['id_num']?>">
          <?php endif ?>
          </td>
          <td><?= $rows['id_num'];?></td>
          <td><?= $rows['id'];?></td>
          <td><?= $rows['name'];?></td>
          <td><?= $rows['mail'];?></td>
          <td><?= $rows['reg_time'];?></td>
          <td><?= $rows['level'];?></td>
        </tr>
        <?php endforeach?>
      </table> 
      <br>
      <!-- <button type="button" class="btn btn-danger" onclick="member_delete();">삭제 (버튼)</button> -->
      <input class="btn btn-danger" type="submit" value="삭제하기">
    </form>
  </div>
</body>
<script type="text/javascript" src="/js/bootstrap.js"></script>
</html>