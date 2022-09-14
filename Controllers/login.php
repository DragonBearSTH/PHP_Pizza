<?php
if (isset($_POST['login'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    if (empty($email)) {
        $icon = "error";
        $title = "เข้าสู่ระบบ";
        $msg = "โปรดทำการกรอก Email เพื่อ ทำการ login ";
        $header = "?page=login";
        $swal_btn_color = "#dc3545";
    } elseif (empty($password)) {
        $icon = "error";
        $title = "เข้าสู่ระบบ";
        $msg = "โปรดทำการกรอก Password เพื่อ ทำการ login ";
        $header = "?page=login";
        $swal_btn_color = "#dc3545";
    } else {
        $sql = "SELECT * FROM user WHERE email='$email' AND  password='$password'";
        $sql_q = mysqli_query($conn, $sql);
        if (mysqli_num_rows($sql_q) > 0) {
            $icon = "success";
            $title = "เข้าสู่ระบบ";
            $msg = "เข้าสู่ระบบเรียนร้อย";
            $header = "?page=home";
            $swal_btn_color = "#dc3545";
            $fa=mysqli_fetch_assoc($sql_q);
            $_SESSION['user'] = $fa['name'];
        } else{
            $icon = "error";
            $title = "เข้าสู่ระบบ";
            $msg = "password หรือ email ไม่ถูกต้อง";
            $header = "?page=login";
            $swal_btn_color = "#dc3545";
        }
    }
    include_once('Sweettalert.php');
}
