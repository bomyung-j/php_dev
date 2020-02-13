// msg함수
function msg(msg){
    alert(msg);
}
//msg yesno 함수
function msg_yesno(msg){
  if(confirm(msg)){
    return true;
  }else{
    return false;
  }
  
}
function msg_yesno_mvpg(msg,url){
    if(msg_yesno(msg)==true){
        location.href=url;
    }
}
//공백일경우 false 리턴하는 함수
function null_check(element){
  var el_var = element.id.innerHTML;
  el_var = el_var.replace(/\s/gi,"");
  if(el_var == ""){return false;}
  else {return true;}
}
//정규화 함수
function regular_expression(element){
  var el_id = element.id;
  var el_var = document.getElementById(element.id).value;
  console.log("===================");
  console.log(el_id +"정규식 아이디");
  console.log(el_var +"값");
  console.log("===================");
  var name_regular = /^[a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ]{3,12}$/;
  var id_regular = /^[a-zA-Z0-9]{4,12}$/;
  var mail_regular = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;

  if(el_id =="signmail"){
    return mail_regular.test(el_var);
  }else if(el_id == "signid"){
    return id_regular.test(el_var);
  }else if(el_id == "signname"){
    return name_regular.test(el_var);
  }
}