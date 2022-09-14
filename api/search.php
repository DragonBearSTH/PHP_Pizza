<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/database.php';
    $query = mysqli_real_escape_string($mysqli2, $_POST['queryusers']);
    $sql_query = mysqli_query($mysqli2, "SELECT * FROM authme WHERE username LIKE '%$query%'");
    if ($sql_query) {
        if (mysqli_num_rows($sql_query) > 0) {
            while ($row = mysqli_fetch_assoc($sql_query)) {
                echo json_encode(array('data' => '
                <div class="d-flex justify-content-center"><img src="https://minotar.net/avatar/' . $row['username'] . '" class=" rounded-4 w-75"></div>
                    <p class="text-warning text-center">' . $row['username'] . '</p>
                    <div class=" d-grid">
                        <input type="hidden" name="username" value="' . $_POST['username'] . '">
                        <input type="hidden" name="newusername" value="' . $row['username'] . '">
                        <button type="submit" class="btn btn-outline-warning rounded-4">ส่งของขวัญ</button>
                    </div>
                '));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'title' => 'ค้นหาผู้ใช้', 'message' => 'ไม่พบผู้ใช้ที่ค้นหา'));
        }
    }
}
