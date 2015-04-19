<?php

function __autoload($className) {
    if (file_exists(__DIR__.'/utils/'.$className . '.php')) {
        require_once '/utils/'.$className . '.php';
        return true;
    }
    return false;
}

?>
