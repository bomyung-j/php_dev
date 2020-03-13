
function find_user(){
  var user_name = document.getElementById('name').value; //검색할 유저이름
  var find_table = document.getElementById('find_table'); //값이 추가될 테이블 tbody
  var row = find_table.insertRow(find_table.rows.length-1); //추가될 위치
  
  $.ajax({
      url : "/ad/user_ad_find.php",
      type : "POST",
      dataType : "json",
      data : {name : user_name},
      success : function(data){
        
        /*관리자 끼리는 삭제 못하도록 체크박스 없도록 지정*/
        if(data['level'] < 1){
          /* checkbox의 선택자로는 value를 지정하지 못하니 노드로 접근.*/
          /* td 자식노드인 input의 value값을 지정*/
           var row1 =  row.insertCell(0);
           row1.innerHTML = "<input type=\"checkbox\" name =\"delete_user[]\" >";
           row1.firstChild.value = data['id_num'];
        }else{
           row.insertCell(0).innerHTML = null;
        }
        row.insertCell(1).innerHTML = data['id_num'];
        row.insertCell(2).innerHTML = data['id'];
        row.insertCell(3).innerHTML = data['name'];
        row.insertCell(4).innerHTML = data['mail'];
        row.insertCell(5).innerHTML = data['reg_time'];
        row.insertCell(6).innerHTML = data['level'];
      }
    
  });
  
}