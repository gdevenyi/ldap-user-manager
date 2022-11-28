<?php

set_include_path( __DIR__ . "/includes/");
include_once "web_functions.inc.php";

if ($VALIDATED) {
    header("Location: //${_SERVER['HTTP_HOST']}${SERVER_PATH}account_manager/\n\n");
} else {
    header("Location: //${_SERVER['HTTP_HOST']}${SERVER_PATH}log_in/\n\n");
}

?>
