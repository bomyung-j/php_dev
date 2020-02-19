<?php
  date_default_timezone_set('Asia/Seoul');
  class pdo_member{
      private $db;
      function __construct()
      {
          try{
            $this->db = new PDO("mysql:host=localhost;dbname=db명","관리자명","비밀번호");

          }catch(PDOException $e){
              exit($e->getMessage());
          }
      }
      function member_check($attr,$var)
      {
          try{
              $query = $this->db->prepare("select id, pw, name from member where {$attr} = :var ");
              $query->bindValue(":var",$var,PDO::PARAM_STR);
              $query->execute();
              $result = $query->fetch(PDO::FETCH_ASSOC);
          }catch(PDOException $e)
          {
            exit($e->getMessage());
          }
            return $result;
      }
      function signup($signid,$signpwd,$signname,$signmail){
        try{
          $query = $this->db->prepare("insert into member(id,pw,name,mail,reg_time) values(:signid,:signpwd,:signname,:signmail,:reg_time)");
          
          $reg_time = date("Y-m-d H:i:s");
          $query->bindValue(":signid",$signid,PDO::PARAM_STR);
          $query->bindValue(":signpwd",$signpwd,PDO::PARAM_STR);
          $query->bindValue(":signname",$signname,PDO::PARAM_STR);
          $query->bindValue(":signmail",$signmail,PDO::PARAM_STR);
          $query->bindValue(":reg_time",$reg_time,PDO::PARAM_STR);
          $query->execute();
        }catch(PDOException $e){
            echo "에러";
            exit($e->getMessage());
        }
          
      }
      function mypage_member_print($name){
          try{
            $query = $this->db->prepare("select * from member where name = :name");
            $query->bindValue(":name",$name,PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
          }catch(PDOException $e){
              exit($e->getMessage());
          }
          return $result;
      }
      function password_ini($pw,$attr,$var){
          try{
            $query = $this->db->prepare("update member set pw = :pw where {$attr} = :var");
            $query->bindValue(":pw",$pw,PDO::PARAM_STR);
            $query->bindValue(":var",$var,PDO::PARAM_STR);
            $query->execute();
          }catch(PDOException $e){
              exit($e->getMessage());
          }
      }
      function mypage_bbs_print($name){
          try{
            $query = $this->db->prepare("select  'bbs_notice' as bbs, title, hits, reg_time, num from bbs_notice where name = :name 
                                        union all select 'bbs_free' as bbs, title, hits, reg_time, num from bbs_free where name = :name order by reg_time desc");
            $query->bindValue(":name", $name,PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
          }catch(PDOException $e){
              exit($e->getMessage());
          }
            return $result;
        
      }
  }

?>
