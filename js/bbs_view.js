// ajax 통신을 통한 게시글 삭제 
function bbs_content_delete(table,num,name){ //테이블명 , 게시글 번호, 작성자 이름을 매개변수로 한다.
    //삭제 여부를 물어본다.
    if(msg_yesno('삭제하시겠습니까?') == true){ 
      
      var data = { num : num, table : table, name : name}; // data 선언.
      data = JSON.stringify(data); //json 문자열로 변환.
      //console.log(data);
      $.ajax({
        url : "bbs_delete.php",
        type : "post",
        data : {data : data},
        dataType : "json",
        error : function(request, error){
          // console.log('실패');
          // console.log("reqest : "+request.status +"\n"+"message:"+request.responseText+"\n"+"error : "+error);
      
        },
        success : function(data){
          var value = data['value'];
          if(value == 1){
            location.href = "/bbs/bbs_main.php?bbs="+table; // 삭제가 정상적으로 처리되었을 경우 페이지 이동
          }
          msg(data['result']); //결과 표시 (권한확인.)
        } 
      });
    }else{
        msg('취소하셨습니다');
    }
}
