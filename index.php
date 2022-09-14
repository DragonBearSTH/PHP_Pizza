<!DOCTYPE html>
<html lang="en">
<?php require 'classes/database.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/banks.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title><?= $setting['title'] ?></title>
</head>
<?php
$fn_text = "text-warning";
$fn_bg = "bg-warning";
$btn_outline = "btn-outline-warning";
$fn_border = "border-warning";

 ?> 
<body>
    <?php
    if (mysqli_num_rows($agent) == 0) {
        echo "ตกแต่งหน้า ไม่พบ License";
    } else { ?>
        <?php
        if ($license['status'] == 'notactive') {
            echo "ตกแต่งหน้า License หมดอายุ";
        } else { ?>
            <?php ob_start();
            session_start();
            include 'components/navbar.php'; ?>
            <div class="container mt-10" style="margin-top: 100px;">
                <?php
                include 'classes/TheNewErth.php';
                $router = new TheNewErth();
                $router->map('GET', '/', 'views/home.php', 'home');
                $router->map('GET', '/shop', 'views/shop.php', 'shop');
                $router->map('GET', '/register', 'views/register.php', 'register');
                $router->map('GET', '/login', 'views/login.php', 'login');
                if (!empty($_SESSION['authme_username'])) {
                    $router->map('GET', '/logout', 'components/logout.php', 'logout');
                    $router->map('GET', '/topup', 'views/topup.php', 'topup');
                    $router->map('GET', '/inventroy', 'views/inventroy.php', 'inventroy');
                    $router->map('GET', '/profile', 'views/profile.php', 'profile');
                }
                $match = $router->match();
                if ($match) {
                    require $match['target'];
                } else {
                    echo "404";
                }
                ?>
            </div>
    <?php }
    } ?>
</body>

</html>