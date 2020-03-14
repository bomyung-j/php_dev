/* index.php에서 사용하는 이미지 슬라이드 함수 */
$(document).ready(function(){ //문서가 화면에 표시되면.
myIndex = 0; 
carousel(); //함수 시작
});
function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");

    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1;}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 9000);
}
