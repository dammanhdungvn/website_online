<?php
session_start();
require_once 'config.php';
require_once _PATH_INCLUDES .'/connect.php';

require_once _PATH_INCLUDES .'/mailer/SMTP.php';
require_once _PATH_INCLUDES .'/mailer/Exception.php';
require_once _PATH_INCLUDES .'/mailer/PHPMailer.php';

require_once _PATH_INCLUDES .'/functions.php';
require_once _PATH_INCLUDES .'/database.php';
require_once _PATH_INCLUDES .'/session.php';



$module = _MODULE;
$action = _ACTION;


if (!empty($_GET['module'])) {
  $module = trim($_GET['module']);
}

if (!empty($_GET['action'])) {
  $action = trim($_GET['action']);
}

$path = "modules/$module/{$action}.php";

if (file_exists($path)) {
  require_once $path;
}
else {
  require_once 'modules/error/404.php';
}
