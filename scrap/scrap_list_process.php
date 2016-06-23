<?php
session_start();
require("DB/config.php");

$conn = mysqli_connect($config["host"], $config["duser"], $config["dpw"]);
mysqli_select_db($conn, $config["dname"]);

$safe_user = mysqli_real_escape_string($conn, $_SESSION['nickname']);
$query = "SELECT * FROM scraps WHERE register='".$safe_user."' AND visible=1 ORDER BY time DESC";
$result = mysqli_query($conn, $query);

$result_ajax =array();

if($row = mysqli_fetch_assoc($result)){
  array_push($result_ajax, $row);
  while($row = mysqli_fetch_assoc($result)){
    array_push($result_ajax, $row);
  }
  echo json_encode($result_ajax);
}else{
  $result_ajax ="false";
  echo json_encode($result_ajax);
}
mysqli_close($conn);
?>
