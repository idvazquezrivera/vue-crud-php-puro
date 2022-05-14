<?php
require_once "db/config.php";
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$where = '';
if($data)
  $where = ' WHERE id = '.(int)$data->id.' LIMIT 1';
$sql = "SELECT * FROM clientes ".$where;
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  $rows = array();
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
} else {
  echo "0 results";
}
$conn->close();
if($data)
  $rows = $rows[0];
exit(json_encode($rows));

?>