<?php
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();

$params = [];
if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
}

$users = $userModel->getUsers($params);

$secret_key = '21102004';

if(!isset($_GET['name'])){
    echo "<div class='alert alert-danger' role='alert'>HIỆN KHÔNG THỂ THỰC HIỆN HÀNH ĐỘNG DELETE SAU KHI ĐĂNG KÝ DO CHƯA SETUP</div>";
    echo "<div class='alert alert-danger' role='alert'>HÃY ĐĂNG NHẬP LẠI TẠI KHOẢN VÀ MẬT KHẨU VỪA ĐĂNG KÝ MỚI CÓ THỂ XÓA</div>";
    $admin_username = ""; 
    $admin_password = "";
}
else{
    $admin_username = $_GET['name']; 
    $admin_password = password_hash($_GET['password'],  PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html>

<head>
    <script>
        function confirmDelete() {
            return confirm("Có muốn xóa ko?");
        }
    </script>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if (!empty($users)) { ?>
            <div class="alert alert-warning" role="alert">
                List of users! <br>
                Hacker: http://php.local/list_users.php?keyword=ASDF%25%22%3BTRUNCATE+banks%3B%23%23
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {

                        $userId = $user['id'];
                        $hash = hash_hmac('sha256', $userId, $secret_key);



                        ?>
                        <tr>
                            <th scope="row"><?php echo $user['id'] ?></th>
                            <td>
                                <?php echo $user['name'] ?>
                            </td>
                            <td>
                                <?php echo $user['fullname'] ?>
                            </td>
                            <td>
                                <?php echo $user['type'] ?>
                            </td>
                            <td>
                                <a href="form_user.php?id=<?php echo $userId ?>&hash=<?php echo $hash ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $userId ?>&hash=<?php echo $hash ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>


                                <?php
                                if ($user['name'] === $admin_username && password_verify($_GET['password'], $admin_password)) {
                                    $_SESSION['delete_token'] = $_SESSION['main_token'];
                                    echo ' <a href="delete_user.php?id='.$userId.'&hash='.$hash.'&token='.$_SESSION['delete_token'].'&maintoken='.$_SESSION['main_token'].' "
                                onclick="return confirmDelete();">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>';
                                } else {
                                    
                                }
                                ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
</body>

</html>