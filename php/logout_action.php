<?php
    include 'redirect.php';

    // create full url with absolute path
    // fixes broken redirects in xampp due to subfolder paths
    $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
    $subdir = dirname($_SERVER['PHP_SELF']);
    if ($subdir == '\\') {
        $subdir = '';
    }

    // redirect user
    redirectTo('/index.php');
?>