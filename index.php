<html lang="th">
<?php
ob_start();
session_start();
include('./Controllers/con_db.php');

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Depoly</title>
    <link rel="stylesheet" href="Appilcation/includes/css/main.css">
    <link rel="stylesheet" href="Appilcation/includes/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
</head>

<body class=" ">
<?php include('./Appilcation/components/navbar.php') ?>

    <?php
    if (empty($_GET['page']) || !ctype_alnum(str_replace(['-', '_'], '', $_GET['page'])) || !file_exists("Appilcation/view/{$_GET['page']}.php")) {
    die(header('Location: ?page=home'));
    }
    require_once "Appilcation/view/{$_GET['page']}.php";
    
     ?>
    <?php include('./Appilcation/components/footer.php') ?>
    <script src="Appilcation/includes/js/bootstrap.bundle.min.js"></script>
    <script src="Appilcation/includes/js/main.js"></script>
    <script src="Appilcation/includes/js/popper.min.js"></script>
    <script src="Appilcation/includes/js/bootstrap.min.js"></script>
</body>
<script>
</script>
</html>