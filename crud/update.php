<?php 
  require_once "db/config.php";
  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  $set = [];
  foreach($data as $i => $input){
    if($i != 'id')
     $set[] = $i.'="'.$input->value.'"';
  }
  $sql = "UPDATE clientes SET ".implode(', ', $set).' WHERE id = '.$data->id;
  $result = $conn->query($sql);
  if ($result === TRUE) {
    $message = "Record was updated successfully";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  exit(json_encode(array('result' => $result, 'message' => $message)));
?>