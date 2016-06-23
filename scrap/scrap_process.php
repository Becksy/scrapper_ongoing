<?php
session_start();
require("DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$safe_url = mysqli_real_escape_string($conn, $_POST['target_obj']);
$safe_title = mysqli_real_escape_string($conn, $_POST['target_obj_des']);
$register = $_SESSION['nickname'];

$query = "INSERT INTO scraps (url,title,register) VALUES('".$safe_url."','".$safe_title."','".$register."')";
mysqli_query($conn, $query);
$result__ = mysqli_query($conn,"SELECT * FROM scraps WHERE register='".$register."' ORDER BY time DESC LIMIT 1");
$row = mysqli_fetch_assoc($result__);

if($row != null){
  echo json_encode($row);
}
mysqli_close($conn);
?>
