<li class="dropdown" id="login_dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="login_box">Log in<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <div id="message_target"></div>
    <li><a></a></li>
    <li>
      <div class="container" style="width:350px">
        <form class="form-horizontal" id="log_in_data">
<!--        <form class="form-horizontal" action="scrap/login/login_process.php" method="POST">         -->
          <div class="form-group">
            <label for="email_id" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="id_pwd" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="id_pwd" name="id_pwd" placeholder="Password">
            </div>
          </div>
        </form>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Remember me
              </label>
            </div>
          </div>
          <div class="col-sm-4 ">
            <button type="submit" class="btn btn-default" id="log_in_ajax">Log in</button>
          </div>
        </div>

      </div>
    </li>
  </ul>
</li>
<script>
    $('#log_in_ajax').click(function(){
      $.ajax({
        url:'scrap/login/login_process.php',
        data: $('#log_in_data').serialize(),
        type:'post',
        dataType:'json',
        success:function(data){

          if(data[0]=='1' && data[1]=='1' && data[2]=='1'){
            location.href="./index.php";

          }else if(data[0]=='0'){
            $('#login_box').attr('aria-expanded','true');
            $('#login_dropdown').addClass("open");
            $('#message_target').html('<div class="alert alert-danger" role="alert">입력하세요</div>');

          }else if(data[1]=='0'){
            $('#login_box').attr('aria-expanded','true');
            $('#login_dropdown').addClass("open");
            $('#message_target').html('<div class="alert alert-danger" role="alert">비밀번호 틀렸어!!!</div>');

          }else if(data[2]=='0'){
            $('#login_box').attr('aria-expanded','true');
            $('#login_dropdown').addClass("open");
            $('#message_target').html('<div class="alert alert-danger" role="alert">이메일이 등록 안 되어 있음</div>');
          }

        }
      })
    })
</script>
