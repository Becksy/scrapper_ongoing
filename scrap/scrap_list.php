
<div class="container">
  <h2>내가 스크랩한 컨텐츠</h2>
  <div><table class="table table-striped"><thead><tr><th></th><th></th></tr></thead><tfoot></tfoot><tbody id="target_list"></tbody></table></div>
</div>

<script>
$.ajax({
  url:'scrap/scrap_list_process.php',
  dataType:'json',
  success:function(data){
    if(data != "false"){
      var str ="";
      var time="";
      for(var i =0; i<data.length ; i++){
        var temp_time = set_day(data[i]['time']);
        var wtime ="";
        var hour = data[i]['time'].split(" ");
        if(time != temp_time){
          time = temp_time;
          if (today(time)){
            wtime ="Today";
          }else{wtime = time;}
          str = str + '<tr class="active"><td colspan="4" style="text-align:center"><h4>'+wtime+'</h4></td></tr>';
        }
        str = str+'<tr><td style="display:none">'+data[i]['id']+ '</td><td style="width:25%">'+data[i]['title']+'</td><td style="width:58%; word-break:break-all"><a href="'+data[i]['url']+'" target=_blank>'+data[i]['url']+'</a></td><td style="width:10%; text-align:center">'+hour[1]+'</td><td style="width:7%"><button type="button" class="btn btn-default btn-xs b_edit" title="편집하기" style="border:none"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-default btn-xs b_remove" title="지우기" style="border:none"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
      }
      $('#target_list').append(str);


      $('.b_edit').click(handler);
      $('.b_remove').click(handler2);
    }
  }
})

var handler = function(){
  var origin_val = $(this).parent().parent().children().first().next().text();
  var replace = '<td><input type="text" class="form-control" name="target_replace" style="border-color:red" id="target_replace" value="'+origin_val+'"></td>';
  var replace2 = '<td><button type="button" class="btn btn-default btn-xs" id="confirm_edit" title="확인" style="border:none"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button></td>';
  $(this).parent().parent().children().first().next().replaceWith(replace);
  $(this).parent().parent().children().last().replaceWith(replace2);

  $('#confirm_edit').click(function(){
    var param = 'target_replace=' + $('#target_replace').val() + '&target_id=' + $('#confirm_edit').parent().parent().children().first().text();

    $.ajax({
      url:'scrap/scrap_edit_process.php',
      data: param,
      type:'post',
      dataType:'json',
      error: function(){alert("에러, 다시 시도해보세요.");},
      success:function(data){
        if(data !="false"){
          var hour = data['time'].split(" ");
          var replace3 = '<tr><td style="display:none">'+data['id']+ '</td><td style="width:25%">'+data['title']+'</td><td style="width:58%; word-break:break-all"><a href="'+data['url']+'" target=_blank>'+data['url']+'</a></td><td style="width:10%; text-align:center">'+hour[1]+'</td><td style="width:7%"><button type="button" class="btn btn-default btn-xs b_edit" title="편집하기" style="border:none"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-default btn-xs b_remove" title="지우기" style="border:none"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
          $('#confirm_edit').parent().parent().replaceWith(replace3);
          $('.b_edit').off('click', handler);
          $('.b_edit').on('click', handler);
          $('.b_remove').off('click', handler2);
          $('.b_remove').on('click', handler2);
        }else{alert("오류가 발생하였습니다. 다시 수정해 주세요.");}
      }
    })
  })
}

var handler2 = function(){
  var target_remove = $(this).parent().parent();
  var target_remove_id = $(this).parent().parent().children().first().text();
  var param_remove = 'target_remove_id=' + target_remove_id;

  $.ajax({
    url:'scrap/scrap_remove_process.php',
    data: param_remove,
    type:'post',
    dataType: 'json',
    error: function(){alert("에러, 다시 시도해보세요.");},
    success: function(data){
      if(data != "false"){
        if(data['visible']==0){
          target_remove.detach();
        }else{alert("에러, 다시 시도해보세요.");}
      }else{alert("에러, 다시 시도해보세요.");}
    }
  })
}




/**
window.onload = function(){

  var hw = document.getElementsByClassName('b_edit');
  for(var i = 0; hw.length; i++){
  hw[i].addEventListener('click', function(){
      alert('Hello world');
  })
}
}**/

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

function set_day(time){
  var split = time.split("-");
  var year = split[0];
  var month = split[1];
  var split_date = split[2].split(" ");
  var date = split_date[0];
  var day = new Date(year, month-1, date);
  var return_day = "";
  switch (day.getDay()){
    case 0 :
    return_day="일요일";
    break;
    case 1 :
    return_day="월요일";
    break;
    case 2 :
    return_day="화요일";
    break;
    case 3 :
    return_day="수요일";
    break;
    case 4 :
    return_day="목요일";
    break;
    case 5 :
    return_day="금요일";
    break;
    case 6 :
    return_day="토요일";
    break;
  }

  return year + "-" + month + "-" + date + " " + return_day;
}
</script>
