<?php
//	require_once 'utils/Auth.php';
//	require_once 'utils/Input.php';
//	require_once 'utils/Log.php';

function __autoload($className) {
    if (file_exists(__DIR__.'/utils/'.$className . '.php')) {
        require_once '/utils/'.$className . '.php';
        return true;
    }
    return false;
}

?>
