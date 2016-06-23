<li class="dropdown" id="signin_dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="signin_box">Sign in<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <div id="message_target_sign"></div>
    <li><a></a></li>
    <li>
      <div class="container" style="width:350px">
        <form class="form-horizontal" id="sign_in_data">
<!--        <form class="form-horizontal" action="scrap/login/login_process.php" method="POST">         -->
          <div class="form-group">
            <label for="email_id_sign" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email_id_sign" name="email_id_sign" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="id_pwd_sign" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="id_pwd_sign" name="id_pwd_sign" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label for="id_pwd_sign2" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="id_pwd_sign2" name="id_pwd_sign2" placeholder="Password 다시 한번">
            </div>
          </div>
        </form>

        <div class="form-group">
          <div class="col-sm-offset-8 col-sm-4 ">
            <button type="submit" class="btn btn-default" id="sign_in_ajax">Sign in</button>
          </div>
        </div>

      </div>
    </li>
  </ul>
</li>
<script>
    $('#sign_in_ajax').click(function(){
      $.ajax({
        url:'scrap/login/check_id.php',
        data: $('#sign_in_data').serialize(),
        type:'post',
        dataType:'json',
        success:function(data){
          if($('#email_id_sign').val().indexOf('@')<0){
            $('#signin_box').attr('aria-expanded','true');
            $('#signin_dropdown').addClass("open");
            $('#message_target_sign').html('<div class="alert alert-danger" role="alert">\"이메일 주소\"를 입력해주세요</div>');
          }else{

            if(data[0]=='0'){

              if($('#id_pwd_sign').val() == $('#id_pwd_sign2').val()){
                $.ajax({
                  url:'scrap/login/signin_process.php',
                  data: $('#sign_in_data').serialize(),
                  type:'post',
                  dataType:'json',
                  success:function(data){

                    if(data[0]=='1'){
                      alert("회원가입에 성공하셨습니다. Log in 해주세요.");
                      location.href="./index.php";
                    }else if(data[0]=='0'){
                      $('#signin_box').attr('aria-expanded','true');
                      $('#signin_dropdown').addClass("open");
                      $('#message_target_sign').html('<div class="alert alert-danger" role="alert">다시 해보세요</div>');
                    }
                  }
                })
              }else{
                $('#signin_box').attr('aria-expanded','true');
                $('#signin_dropdown').addClass("open");
                $('#message_target_sign').html('<div class="alert alert-danger" role="alert">비밀번호를 똑같이 입력해요!!!</div>');
              }
            }else{
              $('#signin_box').attr('aria-expanded','true');
              $('#signin_dropdown').addClass("open");
              $('#message_target_sign').html('<div class="alert alert-danger" role="alert">이미 이메일이 등록되어 있어요</div>');
            }
          }
        }
      })
    })
</script>
