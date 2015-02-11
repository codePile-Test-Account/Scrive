<?php

define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');

define('CONTENT_DIR', ROOT_DIR .'content/');
define('THEMES_DIR', ROOT_DIR .'themes/');
define('CORE_DIR', ROOT_DIR . '.scrive/');
define('VENDOR_DIR', CORE_DIR .'vendor/');
define('SCRIVE_DIR', CORE_DIR .'scrive/');
define('MODULE_DIR', CORE_DIR .'modules/');
define('EXT_DIR', CORE_DIR . 'ext/');
define('CONTENT_EXT', '.md');

require_once(CORE_DIR . 'scrive.php');
$scrive = new Scrive();
?>