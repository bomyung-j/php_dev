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
function regular_expression(text,type){
  
  var name_regular = /^[a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ]{3,12}$/;
  var id_regular = /^[a-zA-Z0-9]{4,12}$/;
  var mail_regular = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
  console.log(text);
  console.log(type);
  if(type == "mail"){
    return mail_regular.test(text);
  }else if(type == "id"){
    return id_regular.test(text);
  }else if(type == "name"){
    return name_regular.test(text);
  }
}
function button_disable(boolean,id){
    console.log(boolean);
    console.log(id);
    //disabled 은 false가 활성화 disabled이 비활성화이다. 
    if(boolean == true){ 
      var val = false; 
    }else{
      msg('제대로 된 값이 아닙니다.');
      var val = "disabled";
    }
    console.log(val);
    document.getElementById(id).disabled = val;
  
}