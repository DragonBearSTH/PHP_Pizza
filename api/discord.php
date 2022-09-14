<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    error_reporting(0);
    include '../classes/database.php';
    $setting = mysqli_query($mysqli2, "SELECT * FROM table_setting");
    $fetch_setting = mysqli_fetch_assoc($setting);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://discord.com/api/guilds/' . $fetch_setting['discord_uid'] . '/widget.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $json = json_decode($result, true);
    switch ($json['code']) {
        case '0':
            echo $json['message'];
            break;
        case '50013':
            echo $json['message'];
            break;
        case '50001':
            echo $json['message'];
            break;
        default:
            echo $json['presence_count'];
            break;
    }
}
