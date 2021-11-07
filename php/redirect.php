<?php
    // utility to redirect user to another page without all this boilerplate in every file

    function redirectTo($page) {
        // check if we are running the project outside of xampp (in virtualbox)
        if (strpos($_SERVER['DOCUMENT_ROOT'], 'xampp') === false) {
            // fix the target url to include the apache subfolder path
            $page = '/f32ee/ee4717-project' . $page;
        }
        header('Location: ' . $page);
        exit;
    }
?>