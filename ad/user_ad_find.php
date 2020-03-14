<?php
  /* user_ad.php 에서 찾는 회원의  회원 정보 전달용 페이지 */
  header("Content-Type: application/json"); //json 타입으로 변환 전송
  $root = $_SERVER['DOCUMENT_ROOT'];
  require_once("{$root}/tools.php");
  require_once("{$root}/member/pdo_member.php");
  session_check();
  if($_SERVER['REQUEST_METHOD'] != 'POST' || request_session() == null)msg_backpg('잘못된 접근입니다');
  
  $name = $_POST['name'];  
  $member_db = new pdo_member();
  $member = $member_db->member_check("name",$name); //name값을 이용해 정보를 가져옴
  echo json_encode(array("id_num" => $member['id_num'],"id"=>$member['id'],"name"=>$member['name'],
                        "mail"=>$member['mail'],"reg_time"=>$member['reg_time'],"level"=>$member['level']));
  
?>