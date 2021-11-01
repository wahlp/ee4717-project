<?php
    // utility to redirect user to another page without all this boilerplate in every file

    // create full url with absolute path
    // fixes broken redirects in xampp due to subfolder paths
    $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
    $subdir = dirname($_SERVER['PHP_SELF'], 2);
    if ($subdir == '\\') {
        $subdir = '';
    }

    function redirectTo($page) {
        global $host_url, $subdir;
        header('Location: ' . $host_url . $subdir . $page);
        exit;
    }
?>