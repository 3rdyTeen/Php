<?php
// $_SESSION['data-id'] = $_POST['id'];
$data['status'] = 'success' ;
$data['msg'] =$_POST['id'] ;
return json_encode($data);
?>