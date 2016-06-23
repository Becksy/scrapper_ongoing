<div class="container">
  <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron" style="background-color:#FFEB3B">
    <p style="color:#37474F">맛집 정보, 관심 기사, 재미있는 영상 등 유익한 웹 컨텐츠를 저장하세요.<br>
      언제 어디서든 <font size="6">ScrapContents.com</font>에서 확인할 수 있어요.
    </p>
    <br>

    <div class="alert alert-danger" role="alert" style="text-align:center; display:none;" id="login_message"></div>
    <form class="form-horizontal" id="target_obj_t" method="POST">
      <div class="form-group">
        <label for="target_obj" class="col-sm-2 control-label" style="color:#424242">웹주소</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="target_obj" placeholder="저장하고 싶은 웹페이지의 주소를 붙여넣기 해주세요(Ctrl+v)" id="target_obj">
        </div>
      </div>
      <div class="form-group">
        <label for="target_obj_des" class="col-sm-2 control-label" style="color:#424242">메모</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="target_obj_des" placeholder="메모를 넣어주세요(생략해도 돼요)" id="target_obj_des">
        </div>
      </div>
    </form>

    <p style="text-align:center">
      <button type="submit" class="btn btn-lg btn-primary" id="scrap" style="background-color:#FFEB3B; border:2px solid; border-color:#607D8B; color:#607D8B">Scrap!</button>
    </p>
  </div>
</div>

<script>

var is_logined = "<?php session_start(); echo $_SESSION['is_login']; ?>";

$('#scrap').click(function(){
  if(is_logined !="1"){
    $('#login_message').css("display","");
    $('#login_message').html('로그인을 하셔야 컨텐츠를 저장하실 수 있습니다.');
    $('#login_message').fadeOut(10000);
  }else if($('#target_obj').val() != "" ){
    $.ajax({
      url:'scrap/scrap_process.php',
      data: $('#target_obj_t').serialize(),
      type:'post',
      dataType:'json',
      success:function(data){
        if(data != null){
          $('#target_obj').val('');
          $('#target_obj_des').val('');
          $('#login_message').css("display","");
          $('#login_message').html('성공적으로 URL이 저장되었습니다.');
          $('#login_message').fadeOut(5000);

          var hour = data['time'].split(" ");
          if(check_today()){
            $('#target_list').children().first().after('<tr><td style="display:none">'+data['id']+ '</td><td style="width:25%">'+data['title']+'</td><td style="width:58%; word-break:break-all"><a href="'+data['url']+'" target=_blank>'+data['url']+'</a></td><td style="width:10%; text-align:center">'+hour[1]+'</td><td style="width:7%"><button type="button" class="btn btn-default btn-xs b_edit" title="편집하기" style="border:none"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-default btn-xs b_remove" title="지우기" style="border:none"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>');
          }else{
            $('#target_list').prepend('<tr><td style="display:none">'+data['id']+ '</td><td style="width:25%">'+data['title']+'</td><td style="width:58%; word-break:break-all"><a href="'+data['url']+'" target=_blank>'+data['url']+'</a></td><td style="width:10%; text-align:center">'+hour[1]+'</td><td style="width:7%"><button type="button" class="btn btn-default btn-xs b_edit" title="편집하기" style="border:none"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-default btn-xs b_remove" title="지우기" style="border:none"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>');
            $('#target_list').prepend('<tr class="active"><td colspan="4" style="text-align:center"><h4>Today</h4></td></tr>');
          }
          $('.b_edit').off('click', handler);
          $('.b_edit').on('click', handler);
          $('.b_remove').off('click', handler2);
          $('.b_remove').on('click', handler2);
        }
      }
    })
  }else{
    $('#login_message').css("display","");
    $('#login_message').html('저장할 컨텐츠의 웹주소를 입력해주세요.');
    $('#login_message').fadeOut(4000);
  }
})

function check_today(){
  var today = document.getElementById('target_list');
  if (today.firstChild != null){
    var tr = today.firstChild;
    var h5 = tr.firstChild.firstChild;
    if(h5.innerHTML =="Today"){
      return true;
    }else{return false;}
  }else{return false;}
}
</script>
