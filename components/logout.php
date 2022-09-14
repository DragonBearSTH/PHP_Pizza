<?php 
    session_destroy();
    unset($_SESSION['authme_username']);
    header('location:/');
