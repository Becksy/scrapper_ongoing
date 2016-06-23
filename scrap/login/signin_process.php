<?php

require("../DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$safe_pw = mysqli_real_escape_string($conn, $_POST['id_pwd_sign']);
$safe_id = mysqli_real_escape_string($conn, $_POST['email_id_sign']);

$query = "INSERT INTO users (id,email,pw) VALUES('','".$safe_id."','".$safe_pw."')";
$result__ = mysqli_query($conn, $query);


$result = mysqli_query($conn, "SELECT * FROM users WHERE email='".$safe_id."'");
$row = mysqli_fetch_assoc($result);
$regi_suc = 0;
if($row != null){
  $regi_suc = 1;
}
$data_set = [$regi_suc];
echo json_encode($data_set);
mysqli_close($conn);
?>
