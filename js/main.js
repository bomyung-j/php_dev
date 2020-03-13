// 문서가 시작되면 세션 체크 및 전역변수 선언
$(document).ready(function(){
  //중복체크를 위한 플래그
  id_overlap_check = false;
  name_overlap_check = false;
  mail_overlap_check = false;
  pwd_overlap_check = false;

  var session_value = document.getElementById('session_id').innerHTML;
  if(session_value != ""){
    //console.log("세션 있음");
    session_check();
  }else {
    //console.log("세션 없음");
  }

});



//ajax 통신에 사용될 데이터값을 전달하는 용도의 객체
//공백값 체크 및 값 전달 div의 display 상태로 어떤 값을 전달할지 판별
var type_check = function(element){
  //console.log(element.id + "당신이 클릭한 버튼");

  //로그인을 시도할 경우
  if(element.id == "modal_login"){
    pid = document.getElementById('pid').value;
    pwd = document.getElementById('ppwd').value;
    if(!pid || !pwd){
      //추후 정규식 검사 구현 if
      msg("공백이거나 특수문자가 들어갔습니다!");
    }else {
      // 이상이 없을경우 객체값으로 사이트정보 , json형식 id,pw값 넘김
      return {
        objdata : {"id" : pid,"pw" : pwd , "type" : "login_try"},
        page : "member_check.php"
      }
    }
  }
  //id중복체크를 시도할 경우
  else if(element.id == "signid"){
    // console.log("아이디중복체크 시도하는중");
    signid = document.getElementById('signid').value;

    // console.log(element.innerHTML);

    if(regular_expression(signid,"id") == true && signid){
      return{
        objdata : {"id" : signid, "type" : "id_overlap_check"},
        page : "member_check.php"
      }
    }else{
      document.getElementById('id_overlap_check_tag').innerHTML ="공백이나 특수문자가 들어갔습니다.";

    }
  }
  //이름 중복체크를 시도할 경우
  else if(element.id =="signname"){
      signname = document.getElementById('signname').value;
      if(signname && regular_expression(signname,"name") == true){
        return {
            objdata : {"name" : signname, "type" : "name_overlap_check"},
            page : "member_check.php"
        }
      }else{
          document.getElementById('name_overlap_check_tag').innerHTML ="공백이나 특수문자가 들어갔습니다.";
      }
  }
  //패스워드 정규식 확인
  else if(element.id == "signpwd"){

    //console.log('비밀번호 정규식확인');
    var pw_boolean = regular_expression(element.value,"password");
    //console.log(pw_boolean);
    if(pw_boolean == true){
        pwd_overlap_check = true;
        document.getElementById('pw_overlap_check_tag').innerHTML ="사용가능한 비밀번호입니다.";
    }else{
        document.getElementById('pw_overlap_check_tag').innerHTML ="비밀번호는 8 ~ 16자리로 이루어 져야합니다.";
    }

  }
  //메일 중복체크를 시도할 경우
  else if(element.id =="signmail"){
      //console.log('메일 중복시도중');
      signmail = document.getElementById('signmail').value;
      //console.log(signmail);
      if(signmail && regular_expression(signmail,"mail") == true){
        return {
          objdata : {"mail" : signmail, "type" : "mail_overlap_check"},
          page : "member_check.php"
        }
      }else{
          document.getElementById('mail_overlap_check_tag').innerHTML ="메일 형식에 맞지 않습니다.";
      }
  }
  //회원가입을 시도할 경우
  else if(element.id == "modal_signup"){
    //console.log("회원가입 버튼을 누른상태");
    signname = document.getElementById('signname').value;
    signid = document.getElementById('signid').value;
    signpwd = document.getElementById('signpwd').value;
    signmail = document.getElementById('signmail').value;
    if(id_overlap_check != true || name_overlap_check != true || mail_overlap_check != true || pwd_overlap_check != true){

      //console.log(id_overlap_check);
      //console.log(name_overlap_check);
      //console.log(mail_overlap_check);
      //console.log(pwd_overlap_check);
      msg('중복체크가 되지 않았습니다.');
    }
    else if(!signname || !signid || !signpwd || !signmail){
      msg("공백 또는 중복체크를 해주셔야합니다.");

    }else {
    // 이상이 없을경우 객체값으로 사이트정보 , json형식 id,pw값 넘김
      //console.log("회원가입 정상 처리중");
      return {
      objdata : {"signname" : signname, "signid" : signid,
                  "signpwd" : signpwd,"signmail" : signmail},
      page : "signup.php"
      }
    }
  }

}



// 모달 클릭시 div 표시 함수
function modal_on(element){
  layer_login =  document.getElementById('modal_layer_login').style;
  layer_signup = document.getElementById('modal_layer_signup').style;
  if(element.id == "login_button")
  {
    layer_login.display = "block";
    layer_signup.display = "none";
    //console.log('로그인 클릭');

  }else if(element.id == "signup_button")
  {
      layer_login.display = "none";
      layer_signup.display = "block";
        //console.log('회원가입클릭');
  }
}
// 모달 끄기 함수(this객체로 넘겨받은후 display 값 조정)
function modal_off(element){
  var div_parent = element;
  //console.log(div_parent.parentNode.id +"닫음");
  (div_parent.parentNode).style.display = "none";
}

// 로그인 or 회원가입 버튼 클릭시 함수 ajax 통신
function modal_login_signup(element){

  //공백값 체크 및 로그인인지 회원가입인지에 따라 값 불러옴.
  chk = new type_check(element);

  //console.log("개체 데이터값 :"+JSON.stringify(chk.objdata));
  //console.log("개체 페이지값 :"+chk.page);
  var page = chk.page;
  var objdata = JSON.stringify(chk.objdata);
    $.ajax({
      url : "/member/"+page,
      type : "POST",
      dataType : "json",
      data : {objdata : objdata},
      error : function(request, error){
        console.log('실패');
        console.log("reqest : "+request.status +"\n"+"message:"+request.responseText+"\n"+"error : "+error);

      },
      success : function(data){

        //console.log("데이터 : ");
        //console.log(data);
        //console.log("활성화된 id " + element.id);
        var value = data['value'];

        if(element.id == "modal_login"){
          //console.log("로그인 체크과정 진행중");
          if(value == "1"){
            var name = data['name'];
            //console.log("login 이름은 : "+name);
            msg(name+"님 로그인 성공!");
            document.getElementById("session_id").innerHTML = name;
            session_check();
          }else{
            msg("로그인에 실패하셨습니다!");
            //console.log(name);
          }
        }
        else if(element.id == "modal_signup"){
          //console.log("회원가입 진행중");
          if(value == "1"){
            msg("회원가입이 정상적으로 처리되었습니다. 가입을 환영합니다!");
            var open_login = {id : "login_button"};// k : v로 객체생성후 전달
            modal_on(open_login);
          }

        }
        else if(element.id == "signid")
        {
          //console.log("아이디 중복체크 결과");
          if(value == "2"){
            document.getElementById('id_overlap_check_tag').innerHTML = "사용 가능한 아이디 입니다.";
            id_overlap_check = true;
            //console.log('성공');


          }else{
            document.getElementById('id_overlap_check_tag').innerHTML = "이미 사용 중인 아이디 입니다.";
            id_overlap_check = false;
            //console.log('실패');
          }
        }
        else if(element.id == "signname"){
          //console.log("이름 중복체크 결과");
          if(value == "1"){
            document.getElementById('name_overlap_check_tag').innerHTML = "사용 가능한 이름 입니다.";
            name_overlap_check = true;
            //console.log('성공');
          }else{
            document.getElementById('name_overlap_check_tag').innerHTML = "이미 사용 중인 이름 입니다.";
            name_overlap_check = false;
            //console.log('실패');
          }
        }
        else if(element.id == "signmail"){
          //console.log("메일 중복체크 결과");
          if(value == "1"){
            document.getElementById('mail_overlap_check_tag').innerHTML = "사용 가능한 메일 입니다.";
            mail_overlap_check = true;
            //console.log('성공');
          }else{
            document.getElementById('mail_overlap_check_tag').innerHTML = "이미 사용 중인 메일 입니다.";
            mail_overlap_check = false;
            //console.log('실패');
          }
        }
      }
    });

}
// 세션값이 있을때 div 삭제
function session_check(){
  document.getElementById("button_layer").style.display = "none";
  document.getElementById("modal_layer").style.display = "none";
  document.getElementById("logout_form").style.display ="inline";

  var session = document.getElementById("session_id").innerHTML;
  document.getElementById("session_id").innerHTML = session + " 님 환영합니다!";
}
