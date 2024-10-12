<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$secret_key = '21102004';

$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id']) && !empty($_GET['hash'])) {
    $_id = $_GET['id'];
    $hash = $_GET['hash'];

    $expected_hash = hash_hmac('sha256', $_id, $secret_key);
    if (hash_equals($expected_hash, $hash)) {
        $user = $userModel->findUserById($_id);
    } else {
        die('Error');
    }
}

if (!empty($_POST['submit'])) {
    $errors = [];

    if (empty($_POST['name'])) {
        $errors[] = 'Không được để trống tên';
    } else {
        $name = trim($_POST['name']);
        if (strlen($name) < 5 || strlen($name) > 15) {
            $errors[] = 'Tên phải từ 5 đến 15 ký tự';
        }

        if (!preg_match('/^[A-Za-z0-9]+$/', $name)) {
            $errors[] = 'Tên chỉ chứa chữ và số';
        }
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Mật khẩu không được để trống';
    } else {
        $password = trim($_POST['password']);
        
        // Kiểm tra chiều dài
        if (strlen($password) < 5 || strlen($password) > 10) {
            $errors[] = 'Mật khẩu phải từ 5 đến 10 ký tự';
        }

        // Kiểm tra yêu cầu về ký tự
        if (!preg_match('/[a-z]/', $password) ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[~!@#$%^&*()]/', $password)) {
            $errors[] = 'Mật khẩu phải có đầy đủ chữ hoa, chữ thường, số, ký tự đặc biệt';
        }
    }

    if (empty($errors)) {
        if (!empty($_id)) {
            $userModel->updateUser($_POST);
        } else {
            $userModel->insertUser($_POST);
        }
        
        header('location: list_users.php');
        exit;
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>{$error}</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">

            <?php if ($user || !isset($_id)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $_id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php } ?>
    </div>
</body>
</html>