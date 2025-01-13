<?php
session_start();
include 'config.php';
include _PATH_INCLUDES .'/connect.php';

include _PATH_INCLUDES .'/mailer/SMTP.php';
include _PATH_INCLUDES .'/mailer/Exception.php';
include _PATH_INCLUDES .'/mailer/PHPMailer.php';

include _PATH_INCLUDES .'/functions.php';
include _PATH_INCLUDES .'/database.php';
include _PATH_INCLUDES .'/session.php';



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
  include $path;
}
else {
  include 'modules/error/404.php';
}

 
