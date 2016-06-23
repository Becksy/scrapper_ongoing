function put_url(someword){
  $('#ch_target_obj_url').val(someword);
}

function get_url(){
  chrome.tabs.query({'active': true, 'lastFocusedWindow': true}, function (tabs) {
    put_url(tabs[0].url);
  });
}

function test_404(){
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/test404.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      // JSON.parse does not evaluate the attacker's scripts.
      $('#test').append(xhr.responseText);
    }
  }
  xhr.send();
}

document.addEventListener('DOMContentLoaded', function () {

  get_url();

  $('#send_url').click(function(){
    test_404();
  });

});
