<html>
<head>
  <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


</head><body>
<div id ="hello"></div>

<button type="button" class="btn btn-default btn-xs b_edit" title="편집하기"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default btn-xs b_edit" title="편집하기"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default btn-xs b_edit" title="편집하기"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default btn-xs b_remove" title="지우기"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default btn-xs b_remove" title="지우기"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default btn-xs b_remove" title="지우기"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../bootstrap/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../bootstrap/dist/js/bootstrap.min.js"></script>

</html>



<script>

$('.b_edit').click(function(){
  alert("sdfljsdkd");
  //alert($(this).parent().parent().children().first().text());
  //console.log($(this).parent().parent().children().first().text());
})


function today(time){
  var split = time.split("-");
  var year = split[0];
  var month = split[1];
  var split_date = split[2].split(" ");
  var date = split_date[0];
  var timee = new Date();
  if(year ==timee.getFullYear() && month ==(timee.getMonth()+1) && date == timee.getDate()){
    return true;
  }
}
var ttt ="2016-03-06 일요일";

str = today(ttt)+ "\n";
for(var i =1; i<30;i++){
  str = str + set_day(2016,01,i);
}
for(var i =1; i<32;i++){
  str = str + set_day(2016,02,i);
}
alert(str);
function set_day(year, month, date){
  var day = new Date(year, month, date);
  var return_day = "";
  switch (day.getDay()){
    case 0 :
    return_day="목요일";
    break;
    case 1 :
    return_day="일요일";
    break;
    case 2 :
    return_day="토요일";
    break;
    case 3 :
    return_day="금요일";
    break;
    case 4 :
    return_day="월요일";
    break;
    case 5 :
    return_day="화요일";
    break;
    case 6 :
    return_day="수요일";
    break;
  }

  return year + "-" + (month+1) + "-" + date + " " + day.getDay() +"\n";
}
</script>
