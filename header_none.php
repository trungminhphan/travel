<?php
function __autoload($class_name) {
    require_once('admin/cls/class.' . strtolower($class_name) . '.php');
}
require_once('admin/inc/functions.inc.php');
require_once('admin/inc/config.inc.php');
?>