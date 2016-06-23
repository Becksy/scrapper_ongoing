<?php
session_start();
require("DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$safe_title = mysqli_real_escape_string($conn, $_POST['target_replace']);
$safe_url = mysqli_real_escape_string($conn, $_POST['target_url_']);
$safe_id = mysqli_real_escape_string($conn, $_POST['target_id']);
$register = $_SESSION['nickname'];

$query = "UPDATE `scraps` SET title='".$safe_title."' WHERE id='".$safe_id."'";
mysqli_query($conn, $query);
$result__ = mysqli_query($conn,"SELECT * FROM scraps WHERE id='".$safe_id."'");
$row = mysqli_fetch_assoc($result__);

if($row != null){
  echo json_encode($row);
}else{echo json_encode("false");}


mysqli_close($conn);
?>
