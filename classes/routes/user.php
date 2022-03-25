<?php
include_once '../api/User.php';
$user = new User();

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'login':
		echo $user->login($_POST['email'], $_POST['password']);
	break;
	case 'register':
		echo $user->register($_POST['name'],$_POST['email'], $_POST['phone'], $_POST['password']);
	break;
	case 'delete-user':
		echo $user->deleteUser($_POST['id']);
	break;
	case 'get-all-user':
		echo $user->getAllUser();
	break;
	default:
		// echo $sysset->index();
		break;
}