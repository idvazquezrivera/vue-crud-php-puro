<?php 
  require_once "db/config.php";
  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);

  $sql = 'DELETE from clientes WHERE id = '.$data->id;
  $result = $conn->query($sql);
  if ($result === TRUE) {
    $message = "Record was deleted successfully";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  exit(json_encode(array('result' => $result, 'message' => $message)));
?>