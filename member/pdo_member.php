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
      //각종 속성에 해당하는값이 db에 있는지 확인하는 함수
      function member_check($attr,$var)
      {
          try{
              $query = $this->db->prepare("select * from member where {$attr} = :var ");
              $query->bindValue(":var",$var,PDO::PARAM_STR);
              $query->execute();
              $result = $query->fetch(PDO::FETCH_ASSOC);
          }catch(PDOException $e)
          {
            exit($e->getMessage());
          }
            return $result;
      }
      //회원가입 함수
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
      function signout($id_num){
        try{
          $query = $this->db->prepare("delete from member where id_num = :id_num");
          $query->bindValue(":id_num",$id_num,PDO::PARAM_INT);
          $query->execute();
        }catch(PDOException $e){
          exit($e->getMessage());
        }
      }
      //관리 페이지용 회원수 출력
      function member_count(){
          try{
            $query = $this->db->prepare("select count(*) from member");
            $query->execute();
            $result = $query->fetchColumn();
          }catch(PDOException $e){
              exit($e->getMessage());
          }
          return $result;
      }
      //관리 페이지용 유저출력
      function ad_member_print(){
          try{
            $query = $this->db->prepare("select * from member  order by level desc, id_num desc limit 0, 19");
          
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
          }catch(PDOException $e){
              exit($e->getMessage());
          }
          return $result;
      }
      //패스워드를 잃어버린경우 초기화하는 함수
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
      //내가 쓴 글 출력 함수
      function mypage_bbs_print($name){
          try{
            $query = $this->db->prepare("(select 'bbs_notice' as bbs_name, title, hits, reg_time, num from bbs_notice where name = :name)
                                        union all
                                        (select 'bbs_free' as bbs_name, title, hits, reg_time, num from bbs_free where name = :name)
                                        union all
                                        (select 'bbs_mountain' as bbs_name, title, hits, reg_time, num from bbs_mountain where name = :name)
                                        union all
                                        (select 'bbs_study' as bbs_name, title, hits, reg_time, num from bbs_study where name = :name)
                                        union all
                                        (select 'bbs_trip' as bbs_name, title, hits, reg_time, num from bbs_trip where name = :name)
                                         order by reg_time desc");
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
