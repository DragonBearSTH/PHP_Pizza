<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Appilcation/Includes/css/main.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Hello, world!</title>

</head>

<body>
    <script>
    swal.fire({
        icon: "<?php echo $icon ?>",
        title: "<?php echo $title ?>!",
        text: "<?php echo $msg ?>",
        showConfirmButton: true,
        confirmButtonText: "ยืนยัน",
        confirmButtonColor: "<?php echo $swal_btn_color ?>",
        closeOnConfirm: false,
    }).then(function(result) {
        window.location = "<?php echo $header ?>";
    })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

</body>

</html>