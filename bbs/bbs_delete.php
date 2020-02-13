<?php
  header("Content-Type: application/json");
  
  require_once("../tools.php");
  session_check();
  
  require_once("./pdo_bbs.php");
  $db = new pdo_bbs();
  //print_r($_POST);
  $data = $_POST['data'];
  $data = json_decode($data);
  
  $s_name = request_session();
  $b_name = $data->name;
  
  $table = $data->table;
  $num = $data->num;
  
  if($s_name == $b_name){
      $db->content_delete_bbs($table,$num);
      echo json_encode(array("result" => "삭제되었습니다.", "value" => 1));
  }else{
      echo json_encode(array("result" => "삭제 할 권한이 없습니다.", "value" => 0));
  }
  
?>