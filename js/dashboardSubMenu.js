var flag = 1;

$('.showClasses').click(function() {
    console.log(flag);
  if(flag == 1){
    $('#classMenu').css('display', 'block');
    flag = 0;
    console.log("display block");
  }
  else{
    $('#classMenu').css('display', 'none');
    flag = 1;
  }

});