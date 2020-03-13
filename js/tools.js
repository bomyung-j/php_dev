
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
//메세지를 예를 누를경우 url로 이동하는기능
function msg_yesno_mvpg(msg,url){
    if(msg_yesno(msg)==true){
        location.href=url;
    }
}


//정규화 함수
function regular_expression(text,type){
  var pw_regular = /^[a-zA-Z0-9~!@#$%^&*()_+|<>?:{}]{8,16}$/;
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
  }else if(type == "password"){
    return pw_regular.test(text);
  }
}
//버튼아이디와 슬라이드 시킬 div를 지정하여 슬라이드 기능 사용
state = true;
function div_slide(div){

  if(state == true){
    $("#"+div).slideDown(300,function(){});
  }
  else if(state == false){
    $("#"+div).slideUp(300,function(){});
  }
  state = !state;
}
//논리값으로 지정된id를 비활성화하는함수
function button_disable(boolean,id,text){
    console.log("button_disable 함수 시작");
    console.log(boolean);
    console.log(id);
    //disabled 은 false가 활성화 disabled이 비활성화상태이다.
    if(boolean == true){
    
      var val = false;
    }else{
      msg(text);
      var val = "disabled";
    }
    console.log(val);
    document.getElementById(id).disabled = val;
}
