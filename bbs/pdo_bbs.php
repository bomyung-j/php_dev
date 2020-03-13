<?php
  date_default_timezone_set('Asia/Seoul'); //db에 저장될 시간대 설정

  class pdo_bbs{
      private $db;

      function __construct(){
        try{
          $this->db = new PDO("mysql:host=localhost;dbname=db명","관리자명","비밀번호");

        }catch(PDOException $e){
            exit($e->getMessage());
        }
      }
      // 게시글 개수 확인
      function get_rows($table){
        try{
          $query = $this->db->prepare("select count(*) from {$table}");
  //        $query->bindValue(":table",$table,PDO::PARAM_STR);
          $query->execute();
          $get_rows = $query->fetchColumn();
        }catch(PDOException $e){
            exit($e->getMessage());
        }
        return $get_rows;
      }
      //글쓰기
      function write_bbs($table,$name,$title,$content,$hits){
        try{
          $query = $this->db->prepare("insert into {$table}(name,title,content,hits,reg_time) values(:name,:title,:content,:hits,:reg_time)");
          $reg_time = date("Y-m-d H:i:s");
          $query->bindValue(":name",$name,PDO::PARAM_STR);
          $query->bindValue(":title",$title,PDO::PARAM_STR);
          $query->bindValue(":content",$content,PDO::PARAM_STR);
          $query->bindValue(":hits",$hits,PDO::PARAM_INT);
          $query->bindValue(":reg_time",$reg_time,PDO::PARAM_STR);
          $query->execute();
        }catch(PDOException $e){
            exit($e->getMessage());
        }
      }
      //게시글 전체 조회
      function main_view_bbs($table,$start_num,$page_in_post){
        try{
          $query = $this->db->prepare("select * from {$table}
           order by num desc limit :start_num, :page_in_post");
          $query->bindValue(":start_num",$start_num,PDO::PARAM_INT);
          $query->bindValue(":page_in_post",$page_in_post,PDO::PARAM_INT);

          $query->execute();
          $result = $query->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            exit($e->getMessage());
        }
          return $result;
      }
      //게시판 내용 조회
      function content_view_bbs($table,$num){
        try{
          $query = $this->db->prepare("select * from {$table} where num = :num");
          $query->bindValue(":num",$num,PDO::PARAM_INT);
          $query->execute();
          $result = $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            exit($e->getMessage());
        }
        return $result;
      }
      //조회수 증가
      function content_count_bbs($table,$num){
        try{
          $query = $this->db->prepare("update {$table} set hits = hits + 1 where num = :num");
          $query->bindValue(":num",$num,PDO::PARAM_INT);
          $result = $query->execute();

        }catch(PDOException $e){
            exit($e->getMessage());
        }

      }
      //게시글 수정
      function content_update_bbs($table,$num,$title,$content){
          try{
            $query = $this->db->prepare("update {$table} set title = :title, content = :content where num = :num");
            $query->bindValue(":title",$title,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
          }catch(PDOException $e){
            exit($e->getMessage());
          }

      }
      //게시글 삭제
      function content_delete_bbs($table,$num){
        try{
          $query = $this->db->prepare("delete from {$table} where num = :num");
          $query->bindValue(":num",$num,PDO::PARAM_INT);
          $query->execute();

        }catch(PDOException $e){
            exit($e->getMessage());
        }

      }
      //최근글 보기 함수
      function recent_bbs_print(){
          try{
            $query = $this->db->prepare("(select 'bbs_notice' as bbs_name, title, hits, reg_time, num from bbs_notice)
                                        union all
                                        (select 'bbs_free' as bbs_name, title, hits, reg_time, num from bbs_free)
                                        union all
                                        (select 'bbs_mountain' as bbs_name, title, hits, reg_time, num from bbs_mountain)
                                        union all
                                        (select 'bbs_study' as bbs_name, title, hits, reg_time, num from bbs_study)
                                        union all
                                        (select 'bbs_trip' as bbs_name, title, hits, reg_time, num from bbs_trip)
                                         order by reg_time desc limit 0, 9");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
          }catch(PDOException $e){
              exit($e->getMessage());
          }
            return $result;

      }

  }


?>
