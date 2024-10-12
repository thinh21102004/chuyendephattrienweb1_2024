<?php
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL;
$id = NULL;

if (!empty($_GET['id']) && !empty($_GET['token'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['delete_token']) && hash_equals($_SESSION['delete_token'], $_GET['token']) ) {
        $userModel->deleteUserById($id);
        header('location: logout.php');
        exit;
    } else {
        echo 
        die('Không thể xóa 1');
    }
} else {
    die('Không thể xóa 2');
}
?>
