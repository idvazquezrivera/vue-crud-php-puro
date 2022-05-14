<?php 
  require_once "db/config.php";
  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  $values = [];
  $fields = [];
  foreach($data as $i => $input){
    $fields[] = $i;
    $values[] = $input->value;
  }
  $sql = "INSERT INTO clientes (".implode(', ', $fields).") VALUES ('".implode("', '", $values)."')";
  $result = $conn->query($sql);
  if ($result === TRUE) {
    $message = "New record created successfully";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  exit(json_encode(array('result' => $result, 'message' => $message)));
?>