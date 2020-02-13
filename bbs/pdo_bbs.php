<?php
  date_default_timezone_set('Asia/Seoul'); //db에 저장될 시간대 설정
  
  class pdo_bbs{
      private $db;
      
      function __construct(){
        try{
          $this->db = new PDO("mysql:host=localhost;dbname=php_db","root","");
          
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
      function content_delete_bbs($table,$num){
        try{
          $query = $this->db->prepare("delete from {$table} where num = :num");
          $query->bindValue(":num",$num,PDO::PARAM_INT);
          $query->execute();
      
        }catch(PDOException $e){
            exit($e->getMessage());
        }
      
      }
      // function view_bbs(){
      //   try{
      // 
      // 
      //   }catch(PDOException $e){
      //       exit($e->getMessage());
      //   }
      // 
      // }
  }


?>