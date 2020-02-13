function bbs_content_delete(){
    
    if(msg_yesno('삭제하시겠습니까?') == true){
      
      var num = document.getElementById('num').innerHTML;
      var table = document.getElementById('bbs').innerHTML;
      var name = document.getElementById('name').innerHTML;
      var data = { num : num, table : table, name : name};
      data = JSON.stringify(data);
      console.log(data);
      $.ajax({
        url : "bbs_delete.php",
        type : "post",
        data : {data : data},
        dataType : "json",
        error : function(request, error){
          console.log('실패');
          console.log("reqest : "+request.status +"\n"+"message:"+request.responseText+"\n"+"error : "+error);
      
        },
        success : function(data){
          var value = data['value'];
          if(value == 1){
            location.href = "/bbs/bbs_main.php?bbs="+table;
          }
          msg(data['result']);
        } 
      });
    }else{
        msg('취소하셨습니다');
    }
}
