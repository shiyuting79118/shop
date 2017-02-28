<?php
    include 'common.php';

    // 删除home下标即可
    unset($_SESSION['home']);

    header('location:'.$_SERVER['HTTP_REFERER']);
