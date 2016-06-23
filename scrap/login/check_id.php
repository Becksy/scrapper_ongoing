<?php
require("../DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$check_id = 0;

$safe_id = mysqli_real_escape_string($conn, $_POST['email_id_sign']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='".$safe_id."'");
$row = mysqli_fetch_assoc($result);

if($row != null){
  $check_id = 1;
}

$data_set = [$check_id];
echo json_encode($data_set);
mysqli_close($conn);
?>
