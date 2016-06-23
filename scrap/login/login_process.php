<?php
session_start();

require("../DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$is_data = 1;
$pw_right = 1;
$id_right = 1;

if(!empty($_POST['email_id']) && !empty($_POST['id_pwd'])){
  $safe_id = mysqli_real_escape_string($conn, $_POST['email_id']);
  $result = mysqli_query($conn, "SELECT * FROM users WHERE email='".$safe_id."'");
  $row = mysqli_fetch_assoc($result);

  if($row != null){
    if($_POST['id_pwd'] == $row['pw']){
      $_SESSION['is_login'] = true;
      $_SESSION['nickname'] = $_POST['email_id'];
      //header('Location: ../../index.php');
    }else{$pw_right =0;}
  }else{$id_right = 0;}
}else{$is_data = 0;}
$data_set = [$is_data, $pw_right, $id_right];
echo json_encode($data_set);
mysqli_close($conn);
?>
